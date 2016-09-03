<?php
namespace common\modules\signin\handlers\twitter;

use common\modules\signin\models\SigninTemp;
use common\modules\signin\models\SigninUserAccess;
use common\modules\subscription\classes\LeadsHelper;
use yii;
use common\modules\signin\Handler;
use common\modules\signin\HandlerException;
use common\modules\signin\handlers\twitter\libs\TwitterOAuth;

/**
 * The class to proxy the request to the Twitter API.
 */
class TwitterHandler extends Handler {
    /**
     * Handles the proxy request.
     */
    public function handleRequest() {

        // the request type is to determine which action we should to run
        $requestType = !empty( $_REQUEST['opandaRequestType'] ) ? $_REQUEST['opandaRequestType'] : null;

        $this->actions = !empty( $_REQUEST['opandaActions'] ) ? $_REQUEST['opandaActions'] : null;

        $this->tweetMessage = !empty( $_REQUEST['opandaTweetMessage'] ) ? $_REQUEST['opandaTweetMessage'] : null;

        $this->followTo = isset( $_REQUEST['opandaFollowTo'] ) ? $_REQUEST['opandaFollowTo'] : null;

        // allowed request types, others will trigger an error
        //$allowed = array('init', 'callback', 'user_info', 'follow', 'tweet', 'get_tweets', 'get_followers');
        $allowed = array('init', 'callback');

        if ( empty( $requestType ) || !in_array($requestType, $allowed) )
            throw new HandlerException('Invalid request type.');

        // the visitor id is used as a key for the storage where all the tokens are saved
        $visitorId = !empty( $_REQUEST['opandaVisitorId'] ) ? $_REQUEST['opandaVisitorId'] : null;

        $readOnly = !empty( $_REQUEST['opandaReadOnly'] ) ? (bool)$_REQUEST['opandaReadOnly'] : null;
        if ( $readOnly ) {
            $this->options['consumer_key'] = 'BGzwxomRvrJce8jQr2ajg5LBj';
            $this->options['consumer_secret'] = 'bYCm0HawRTVCYARtJD6tLLkyccq9YRrmtU41QLrcuLEXR7CD9r';
        }

        switch( $requestType ) {

            case 'init':
                $this->doInit( $visitorId );
                break;
            case 'callback':
                $this->doCallback( $visitorId );
                break;

            /*case 'user_info':
                return $this->getUserData( $visitorId );
                break;
            case 'follow':
                return $this->follow( $visitorId );
                break;
            case 'tweet':
                return $this->tweet( $visitorId );
                break;
            case 'get_tweets':
                return $this->getTweets( $visitorId );
                break;
            case 'get_followers':
                return $this->getFollowers( $visitorId );*/
        }
    }

    /**
     * Build the callback URL for Twitter.
     */
    public function getCallbackUrl( $visitorId, $keepOpen ) {
        $proxy = $this->options['proxy'];
        $prefix = ( strpos( $proxy, '?') === false) ? '?' : '&';

        $extendUrlParams = '';

        if( !empty($this->actions) ) {
            $extendUrlParams .= '&opandaActions=' . $this->actions;
        }

        if( !empty($this->tweetMessage) ) {
            $extendUrlParams .= '&opandaTweetMessage=' . $this->tweetMessage;
        }

        if( !empty($this->followTo) ) {
            $extendUrlParams .= '&opandaFollowTo=' . $this->followTo;
        }


        return $proxy . $prefix . 'opandaHandler=twitter-' . ($this->sToken ? $this->sToken : '')  . '&opandaRequestType=callback' . $extendUrlParams . '&opandaVisitorId=' . $visitorId . ('&opandaKeepOpen=' . ($keepOpen ? '1' : '0'));
    }

    /**
     * Inits an OAuth request.
     */
    public function doInit( $visitorId ) {
        $options = $this->options;

        if ( empty( $visitorId ) ) $visitorId = $this->getGuid();
        $keepOpen = !empty( $_REQUEST['opandaKeepOpen'] ) ? (bool)$_REQUEST['opandaKeepOpen'] : null;
        $readOnly = !empty( $_REQUEST['opandaReadOnly'] ) ? (bool)$_REQUEST['opandaReadOnly'] : null;

        $oauth = new TwitterOAuth( $options['consumer_key'], $options['consumer_secret'] );
        $requestToken = $oauth->getRequestToken( $this->getCallbackUrl( $visitorId, $keepOpen ) );

        $token = $requestToken['oauth_token'];
        $secret = $requestToken['oauth_token_secret'];

        $this->saveValue( $visitorId, 'temp_twitter_token', $token );
        $this->saveValue( $visitorId, 'temp_twitter_secret', $secret );

        $authorizeURL = $oauth->getAuthorizeURL( $token, false );

        return Yii::$app->response->redirect($authorizeURL);
    }

    /**
     * Handles a callback from Twitter (when the user has been redirected)
     */
    public function doCallback( $visitorId ) {
        $options = $this->options;
        $keepOpen = !empty( $_REQUEST['opandaKeepOpen'] ) ? (bool)$_REQUEST['opandaKeepOpen'] : null;

        if ( empty( $visitorId ) ) {
            throw new HandlerException( 'Invalid visitor ID.' );
        }

        $denied = isset( $_REQUEST['denied'] );
        if ( $denied ) {
            return Yii::$app->response->redirect(['signin/connect/blank']);
        }

        $response_package = [];
        $accessData = SigninUserAccess::getAccessData($visitorId);

        if( empty($accessData) ) {

            $token = !empty( $_REQUEST['oauth_token'] ) ? $_REQUEST['oauth_token'] : null;
            $verifier = !empty( $_REQUEST['oauth_verifier'] ) ? $_REQUEST['oauth_verifier'] : null;

            if (empty( $token ) || empty( $verifier )) {
                $redirect_url = str_replace('=callback', '=init', Yii::$app->request->absoluteUrl);
                return Yii::$app->response->redirect($redirect_url);
            }

            $secret = $this->getValue( $visitorId, 'temp_twitter_secret' );

            if (empty( $secret )) {
                throw new HandlerException( "The secret of the request token is invalid for $visitorId" );
            }

            $connection = new TwitterOAuth( $options['consumer_key'], $options['consumer_secret'], $token, $secret );

            $accessToken = $connection->getAccessToken( $verifier );

            SigninUserAccess::saveAccessData($visitorId, 'twitter', [
                'twitter_token' => $accessToken['oauth_token'],
                'twitter_secret' => $accessToken['oauth_token_secret']
            ]);

            $response_package['access_token'] = $accessToken;
        }

        $response_package['visitor_id'] = $visitorId;
        $response_package['user_info'] = $this->getUserData( $visitorId );

        // Если токен устарел или не существует, отправляем на повторную авторизацию
        if ( isset( $response_package['user_info']->errors ) ) {
            if ( $response_package['user_info']->errors[0]->code == 89 ) {

                SigninUserAccess::removeAccessData($visitorId);
                $redirect_url = str_replace('=callback', '=init', Yii::$app->request->absoluteUrl);
                return Yii::$app->response->redirect($redirect_url);
            }
        }

        if( !empty($this->actions) ) {
             $actions = explode(',', $this->actions);

            foreach($actions as $action) {
                if( in_array($action, ['follow', 'tweet']) ) {
                    $response_package[$action] = call_user_func([$this, $action], $visitorId);
                }
            }
        }

        if( !empty($this->sToken) ) {
            SigninTemp::saveTempData($this->sToken, 'twitter', $response_package);
        }

        if( !$keepOpen ) {
            return Yii::$app->response->redirect( array('signin/connect/blank') );
        }

        exit;
    }

    protected function getTwitterOAuth( $visitorId = null, $token = null, $secret = null ) {
        $options = $this->options;

        if ( empty( $visitorId ) && ( empty( $token ) || empty( $secret ) ) )
            throw new HandlerException('Invalid visitor ID.');

        $accessData = SigninUserAccess::getAccessData($visitorId);

        if ( empty( $accessData ) && ( empty( $token ) || empty( $secret ) ) )
            throw new HandlerException('Invalid access data.');

        if ( empty( $token ) ) {
            $token = isset($accessData['twitter_token']) ? $accessData['twitter_token'] : null;
            if ( empty( $token ) ) throw new HandlerException( "The access token not found for $visitorId" );
        }
        if ( empty( $secret ) ) {
            $secret = isset($accessData['twitter_secret']) ? $accessData['twitter_secret'] : null;
            if ( empty( $secret ) ) throw new HandlerException( "The secret of the access token is invalid for $visitorId" );
        }

        return new TwitterOAuth( $options['consumer_key'], $options['consumer_secret'], $token, $secret);
    }

    public function getUserData( $visitorId ) {
        $oauth = $this->getTwitterOAuth( $visitorId );

        $response = $oauth->get('account/verify_credentials', array('skip_status' => 1, 'include_email' => 'true'));

        return $response;
    }

    public function getTweets( $visitorId ) {
        $oauth = $this->getTwitterOAuth( $visitorId );

        $response = $oauth->get('statuses/user_timeline', array('count' => 3));
        return $response;
    }

    public function getFollowers( $visitorId ) {
        $oauth = $this->getTwitterOAuth( $visitorId );
        $sceenName = !empty( $_REQUEST['opandaSceenName']) ? $_REQUEST['opandaSceenName'] : null;

        $response = $oauth->get('friendships/lookup', array('screen_name' => $sceenName));
        return $response;
    }

    protected function follow( $visitorId ) {
        $oauth = $this->getTwitterOAuth( $visitorId );

        $contextData = isset( $_POST['opandaContextData'] ) ? $_POST['opandaContextData'] : array();
        $contextData = $this->normilizeValues( $contextData );

        $followTo = $this->followTo;
        if ( empty( $followTo) ) throw new HandlerException( "The user name to follow is not specified" );

        $notifications = isset( $_REQUEST['opandaNotifications'] ) ? $_REQUEST['opandaNotifications'] : false;
        $notifications = $this->normilizeValue( $notifications );

        $response = $oauth->get('friendships/lookup', array(
            'screen_name' => $followTo
        ));

        if ( isset( $response->errors ) ) {
            return array('error' => $response->errors[0]->message );
        }

        if ( isset( $response[0]->connections ) && in_array( 'following', $response[0]->connections ) ) {
            return array('success' => true);
        }

        $response = $oauth->post('friendships/create', array(
            'screen_name' => $followTo,
            'follow' => $notifications
        ));

        if ( isset( $response->errors ) ) {
            return array('error' => $response->errors[0]->message );
        }

        return $response;
    }

    protected function tweet( $visitorId ) {
        $oauth = $this->getTwitterOAuth( $visitorId );

        $contextData = isset( $_POST['opandaContextData'] ) ? $_POST['opandaContextData'] : array();
        $contextData = $this->normilizeValues( $contextData );

        $message = $this->tweetMessage;
        if ( empty( $message) ) throw new HandlerException( "The tweet text is not specified." );

        $response = $oauth->post('statuses/update', array(
            'status' => $message
        ));

        if ( isset( $response->errors ) ) {

            // the tweet already is twitted
            if ( $response->errors[0]->code == 187 ) {
                return ['success' => true];
            }

            return ['error' => $response->errors[0]->message];
        }

       return $response;
    }

    protected function getGuid() {
        if (function_exists('com_create_guid') === true) return trim(com_create_guid(), '{}');
        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }
}


