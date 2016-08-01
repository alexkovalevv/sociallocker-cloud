<?php
namespace common\modules\signin\handlers\twitter;

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
        $requestType = Yii::$app->request->getQueryParam('opandaRequestType');

        // allowed request types, others will trigger an error
        $allowed = array('init', 'callback', 'user_info', 'follow', 'tweet', 'get_tweets', 'get_followers');
        
        if ( empty( $requestType ) || !in_array($requestType, $allowed) )
            throw new HandlerException('Invalid request type.');
        
        // the visitor id is used as a key for the storage where all the tokens are saved
        $visitorId = Yii::$app->request->getQueryParam('opandaVisitorId');
        $readOnly = Yii::$app->request->getQueryParam('opandaReadOnly');

        if ( $readOnly ) {
            $this->options['consumer_key'] = 'BGzwxomRvrJce8jQr2ajg5LBj';
            $this->options['consumer_secret'] = 'bYCm0HawRTVCYARtJD6tLLkyccq9YRrmtU41QLrcuLEXR7CD9r';
        }

        switch( $requestType ) {
            
            case 'init':
                $this->doInit( $visitorId ); 
 
            case 'callback':
                $this->doCallback( $visitorId ); 
            
            case 'user_info':
                $this->getUserData( $visitorId );
                
            case 'follow':
                $this->follow( $visitorId );
                
            case 'tweet':
                $this->tweet( $visitorId );    
                
            case 'get_tweets':
                $this->getTweets( $visitorId ); 
                
            case 'get_followers':
                $this->getFollowers( $visitorId );  
        }
    }
    
    /**
     * Build the callback URL for Twitter.
     */
    public function getCallbackUrl( $visitorId, $keepOpen ) {
        $proxy = $this->options['proxy'];
        $prefix = ( strpos( $proxy, '?') === false) ? '?' : '&';
        return $proxy . $prefix . 'opandaHandler=twitter&opandaRequestType=callback&opandaVisitorId=' . $visitorId . ('&opandaKeepOpen=' . ($keepOpen ? '1' : '0'));
    }
    
    /**
     * Inits an OAuth request.
     */
    public function doInit( $visitorId ) {
        $options = $this->options;

        if ( empty( $visitorId ) ) $visitorId = $this->getGuid();
        $keepOpen = Yii::$app->request->getQueryParam('opandaKeepOpen');
        $readOnly = Yii::$app->request->getQueryParam('opandaReadOnly');
        
        $oauth = new TwitterOAuth( $options['consumer_key'], $options['consumer_secret'] );
        $requestToken = $oauth->getRequestToken( $this->getCallbackUrl( $visitorId, $keepOpen ) ); 

        $token = $requestToken['oauth_token'];
        $secret = $requestToken['oauth_token_secret'];          

        $this->saveValue( $visitorId, 'twitter_token', $token );
        $this->saveValue( $visitorId, 'twitter_secret', $secret );

        $authorizeURL = $oauth->getAuthorizeURL( $token, false );

        header("Location: $authorizeURL");
        exit;
    }
    
    /**
     * Handles a callback from Twitter (when the user has been redirected)
     */
    public function doCallback( $visitorId ) {
        $options = $this->options;
        $keepOpen = Yii::$app->request->getQueryParam('opandaKeepOpen');

        if ( empty( $visitorId ) )
            throw new HandlerException('Invalid visitor ID.');
        
        $denied = isset( $_REQUEST['denied'] );
        if ( $denied ) { 
        ?>
            <script>
                if( window.opener ) window.opener.OPanda_TwitterOAuthDenied( '<?php echo $visitorId ?>' );
                window.close();                
            </script>
        <?php
        exit;
        }
        
        $token = Yii::$app->request->getQueryParam('oauth_token');
        $verifier = Yii::$app->request->getQueryParam('oauth_verifier');

        if ( empty( $token ) || empty( $verifier ) ) {
            throw new HandlerException('The verifier value is invalid.');
        }

        $secret = $this->getValue( $visitorId, 'twitter_secret' );

        if ( empty( $secret ) ) {
            throw new HandlerException( "The secret of the request token is invalid for $visitorId" );
        }    

        $connection = new TwitterOAuth( $options['consumer_key'], $options['consumer_secret'], $token, $secret );

        $accessToken = $connection->getAccessToken( $verifier );

        $this->saveValue( $visitorId, 'twitter_token', $accessToken['oauth_token'] );
        $this->saveValue( $visitorId, 'twitter_secret', $accessToken['oauth_token_secret'] );  

        ?>
            <script>
                if( window.opener ) window.opener.OPanda_TwitterOAuthCompleted( '<?php echo $visitorId ?>' );
                <?php if ( !$keepOpen ) { ?>
                    window.close();
                <?php } ?>
                
                window.updateState = function( url, width, height, x, y ){
                    window.location.href = url;
                    window.resizeTo && window.resizeTo(width, height);
                    window.moveTo && window.moveTo(x, y);
                }
            </script>
        <?php
        
        exit;
    }
    
    protected function getTwitterOAuth( $visitorId = null, $token = null, $secret = null ) {
        $options = $this->options;
        
        if ( empty( $visitorId ) && ( empty( $token ) || empty( $secret ) ) )
            throw new HandlerException('Invalid visitor ID.');
        
        if ( empty( $token ) ) {
            $token = $this->getValue( $visitorId, 'twitter_token' );
            if ( empty( $token ) ) throw new HandlerException( "The access token not found for $visitorId" );
        }
        if ( empty( $secret ) ) {
            $secret = $this->getValue( $visitorId, 'twitter_secret' );
            if ( empty( $secret ) ) throw new HandlerException( "The secret of the access token is invalid for $visitorId" );
        }
        
        return new TwitterOAuth( $options['consumer_key'], $options['consumer_secret'], $token, $secret);
    }
    
    public function getUserData( $visitorId, $returnData = false ) {
        $oauth = $this->getTwitterOAuth( $visitorId );

        $response = $oauth->get('account/verify_credentials', array('skip_status' => 1, 'include_email' => 'true'));
        if ( $returnData ) return $response;
        
        echo json_encode($response);
        exit;
    }
    
    public function getTweets( $visitorId ) {
        $oauth = $this->getTwitterOAuth( $visitorId );

        $response = $oauth->get('statuses/user_timeline', array('count' => 3));
        echo json_encode($response);
        
        exit;
    }
    
    public function getFollowers( $visitorId ) {
        $oauth = $this->getTwitterOAuth( $visitorId );
        $sceenName = Yii::$app->request->getQueryParam('opandaSceenName');

        $response = $oauth->get('friendships/lookup', array('screen_name' => $sceenName));
        echo json_encode($response);
        
        exit;
    }    
    
    protected function follow( $visitorId ) {
        $oauth = $this->getTwitterOAuth( $visitorId );
        
        $contextData = Yii::$app->request->getQueryParam('opandaContextData', array());
        $contextData = $this->normilizeValues( $contextData );
        
        $followTo = Yii::$app->request->getQueryParam('opandaFollowTo');
        if ( empty( $followTo) ) throw new HandlerException( "The user name to follow is not specified" );
        
        $notifications = Yii::$app->request->getQueryParam('opandaNotifications', false);
        $notifications = $this->normilizeValue( $notifications );

        $response = $oauth->get('friendships/lookup', array(
            'screen_name' => $followTo
        ));
        
        if ( isset( $response->errors ) ) {
            echo json_encode(array('error' => $response->errors[0]->message )); 
            exit;
        }
        
        if ( isset( $response[0]->connections ) && in_array( 'following', $response[0]->connections ) ) {
            echo json_encode(array('success' => true)); 
            exit;
        }

        $response = $oauth->post('friendships/create', array(
            'screen_name' => $followTo,
            'follow' => $notifications
        ));
        
        if ( isset( $response->errors ) ) {
            echo json_encode(array('error' => $response->errors[0]->message )); 
            exit;
        }

        echo json_encode($response);
        exit;
    }
    
    protected function tweet( $visitorId ) {
        $oauth = $this->getTwitterOAuth( $visitorId );
        
        $contextData = Yii::$app->request->getQueryParam('opandaContextData', array());
        $contextData = $this->normilizeValues( $contextData );
        
        $message = Yii::$app->request->getQueryParam('opandaTweetMessage');
        if ( empty( $message) ) throw new HandlerException( "The tweet text is not specified." );
        
        $response = $oauth->post('statuses/update', array(
            'status' => $message
        ));
        
        if ( isset( $response->errors ) ) {
            
            // the tweet already is twitted
            if ( $response->errors[0]->code == 187 ) {
                echo json_encode(array('success' => true)); 
                exit;
            }
            
            echo json_encode(array('error' => $response->errors[0]->message )); 
            exit;
        }

        echo json_encode($response);
        exit;
    }
    
    protected function getGuid() {
        if (function_exists('com_create_guid') === true) return trim(com_create_guid(), '{}');
        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }
}


