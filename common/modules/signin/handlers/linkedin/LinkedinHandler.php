<?php
namespace common\modules\signin\handlers\linkedin;

use common\modules\signin\Handler;
use common\modules\signin\HandlerException;
use common\modules\signin\handlers\linkedin\libs\LinkedIn_Client;
use common\modules\signin\models\SigninTemp;
use Yii;

/**
 * The class to proxy the request to the LinkedIn API.
 */
class LinkedinHandler extends Handler {

    /**
     * Handles the proxy request.
     */
    public function handleRequest() {
        
        // the request type is to determine which action we should to run
        $requestType = !empty( $_REQUEST['opandaRequestType'] ) ? $_REQUEST['opandaRequestType'] : null;

        // allowed request types, others will trigger an error
        $allowed = array('init', 'callback' /*'user_info'*/);
        
        if ( empty( $requestType ) || !in_array($requestType, $allowed) )
            return ['error' => 'Invalid request type.'];
        
        $accessToken = !empty( $_REQUEST['opandaAccessToken'] ) ? $_REQUEST['opandaAccessToken'] : null;

        switch( $requestType ) {
            
            case 'init':
                $this->doInit(); 
 
            case 'callback':
                $this->doCallback(); 
            
            /*case 'user_info':
                $this->getUserData( $accessToken );  */
        }
    }
    
    /**
     * Build the callback URL for Twitter.
     */
    public function getCallbackUrl() {
        $proxy = $this->options['proxy'];
        $prefix = ( strpos( $proxy, '?') === false) ? '?' : '&';
        return $proxy . $prefix . 'opandaHandler=linkedin-' . ($this->sToken ? $this->sToken : '')  . '&opandaRequestType=callback';
    }
    
    /**
     * Inits an OAuth request.
     */
    public function doInit() {
        $options = $this->options;

        $client = new LinkedIn_Client($options['client_id'], $options['client_secret']);
        $authorizeURL = $client->getAuthorizationUrl( $this->getCallbackUrl() );

        return Yii::$app->response->redirect($authorizeURL);
    }
    
    /**
     * Handles a callback from Twitter (when the user has been redirected)
     */
    public function doCallback() {
        $options = $this->options;
        
        $denied = isset( $_REQUEST['error'] );
        if ( $denied ) {
            return Yii::$app->response->redirect(array('signin/connect/blank'));
        }
        
        $code = isset( $_REQUEST['code'] ) ? $_REQUEST['code'] : false;
        if ( empty( $code ) ) ['error' => 'Invalid code.'];
        
        $client = new LinkedIn_Client($options['client_id'], $options['client_secret']);
        $response = $client->fetchAccessToken($code, $this->getCallbackUrl());

        if ( !isset( $response['access_token'] ) ) {
            return ['error' => 'Invalid request.'];
        }
        
        $accessToken = $response['access_token'];

        if( !empty($this->sToken) ) {
            $user_info = $this->getUserData( $accessToken );
            $user_info['access_token'] = $accessToken;
            SigninTemp::saveTempData( $this->sToken, 'linkedin', $user_info );
        }

        return Yii::$app->response->redirect(array('signin/connect/blank'));
    }
    
    public function getUserData( $accessToken  ) {

        $options = $this->options;
        
        $client = new LinkedIn_Client($options['client_id'], $options['client_secret']);
        $client->setAccessToken( $accessToken );

        $fields = array("firstName", "lastName", "emailAddress", "publicProfileUrl", "pictureUrls::(original)");

        $response = $client->fetch('/v1/people/~:(' . implode(',', $fields) . ')');

        return $response;
    }
}


