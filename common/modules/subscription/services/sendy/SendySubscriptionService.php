<?php
namespace common\modules\subscription\services\sendy;

use common\modules\subscription\classes\SubscriptionException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Yii;
use common\modules\subscription\classes\Subscription;

class SendySubscriptionService extends Subscription {

    /*public function init( $options ) {
        parent::init( $options );
    }*/

    /**
     * Returns available Opt-In modes.
     * 
     * @since 1.0.0
     * @return mixed[]
     */
    public function getOptInModes() {
        return array( 'double-optin', 'quick-double-optin', 'quick' );
    }

    /**
     * Makes a request to Acumbamail.
     * 
     * @since 1.0.9 
     */
    public function request( $method, $args = array(), $requestMethod = 'GET' ) {

        $apiKey = Yii::$app->lockersSettings->get('sendy_apikey', false);
        $sendyUrl = Yii::$app->lockersSettings->get('sendy_url', false);

        if ( empty( $apiKey ) )
            throw new SubscriptionException('The Sendy API Key is not specified.');
        
        if ( empty( $sendyUrl ) )
            throw new SubscriptionException('The Sendy Installation is not specified.');
        
        $sendyUrl = trim($sendyUrl, '/');
        if ( false === strpos($sendyUrl, 'http://') ) $sendyUrl = 'http://' . $sendyUrl;
        
        $url = $sendyUrl . $method;
        $args['api_key'] = $apiKey;

	    $client = new Client([
		    'timeout' => 30
	    ]);

	    try {
		    $result = $client->request("POST", $url, [
			    'query' => $args
		    ]);

		    $code = $result->getStatusCode();

		    if ( 200 !== $code ) {
			    throw new SubscriptionException('Unexpected error occurred during connection to Sendy: ' .  $result->getReasonPhrase() );
		    }

		    $resultBody = $result->getBody();

		    if ( empty( $resultBody ) ) return false;

		    return $resultBody;

	    } catch (RequestException $e) {
		    throw new SubscriptionException('Unexpected error occurred during connection to Sendy: ' . $e->getResponse() );
	    }
    }
    
    /**
     * Returns lists available to subscribe.
     * 
     * @since 1.0.0
     * @return mixed[]
     */
    public function getLists() {
        return array();
    }

    /**
     * Subscribes the person.
     */
    public function subscribe( $identityData, $listId, $doubleOptin, $contextData, $verified ) {

        $result = $this->request('/api/subscribers/subscription-status.php', array(
            'email' => $identityData['email'],
            'list_id' => $listId
        ));

        // if not subscribed yet
        
        if ( strpos($result, 'does not exist') > 0 ) {
            
            $data = array(
                'email' => $identityData['email'],
                'list' => $listId ,
                'boolean' => true
            );
            
            if ( !empty( $identityData['name'] ) ) {
                $userData['name'] = $identityData['name']; 
                $userData['firstname'] = $identityData['name'];
            }

            if ( !empty( $identityData['family'] ) ) {
                $userData['family'] = $identityData['family'];
                $userData['lastname'] = $identityData['family'];
                $userData['surname'] = $identityData['family'];
            }

            if ( empty( $identityData['name'] ) && empty( $identityData['family'] ) && !empty( $identityData['displayName'] ) ) {
                $userData['name'] = $identityData['displayName'];
                $userData['firstname'] = $identityData['displayName']; 
            }
            
            $result = $this->request('/subscribe', $data);

            if ( 'true' === $result || strpos( $result, 'subscribed' ) || strpos( $result, 'confirmation email' ) ) {
                return array('status' => $doubleOptin ? 'pending' : 'subscribed');
            } else {
                throw new SubscriptionException( $result );
            }
        }
        
        // if already subscribed
        
        $success = array( 'subscribed', 'unsubscribed', 'bounced', 'soft bounced', 'unconfirmed', 'complained' );
        if ( !in_array( strtolower( $result ), $success )) {
            throw new SubscriptionException( $result );
        }
        
        if ( 'subscribed' === strtolower( $result ) ) {
            return array('status' => 'subscribed');
        } else {
            return array('status' => 'pending');
        }
    }
 
    /**
     * Checks if the user subscribed.
     */  
    public function check( $identityData, $listId, $contextData ) { 
        
        $result = $this->request('/api/subscribers/subscription-status.php', array(
            'email' => $identityData['email'],
            'list_id' => $listId
        ));
        
        $success = array( 'subscribed', 'unsubscribed', 'bounced', 'soft bounced', 'unconfirmed', 'complained' );
        if ( !in_array( strtolower( $result ), $success )) {
            throw new SubscriptionException( $success );
        }
        
        if ( 'subscribed' === strtolower( $result ) ) {
            return array('status' => 'subscribed');
        } else {
            return array('status' => 'pending');
        }
    }
    
    /**
     * Returns custom fields.
     */
    public function getCustomFields( $listId ) {

        return array(
            'error' => 'Sorry, the plugin doesn\'t custom fields for Sendy. Please <a href="http://support.onepress-media.com/create-ticket/" target="_blank">contact us</a> if you need this feature.'
        );
    }
}
