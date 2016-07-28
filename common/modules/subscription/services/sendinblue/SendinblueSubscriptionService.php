<?php
namespace common\modules\subscription\services\sendinblue;


use Yii;
use common\modules\subscription\classes\Subscription;
use common\modules\subscription\classes\SubscriptionException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class SendinblueSubscriptionService extends Subscription {

	/**
	 * @param $endPoint
	 * @param string $method
	 * @param array $data
	 *
	 * @return array|mixed
	 * @throws SubscriptionException
	 * @throws SubscriptionException
	 */
	public function request( $endPoint, $method = 'GET', $data = array() ) {
        
        $apiKey = Yii::$app->lockersSettings->get('sendinblue_apikey', false);
        if( empty( $apiKey )) throw new SubscriptionException ('The API Key not set.');

        $url = 'https://api.sendinblue.com/v2.0/' . $endPoint;

		$client = new Client([
			'timeout' => 30
		]);
        
        $args = array(
            'headers' => array(
                'api-key' => $apiKey,
                'Content-Type' => 'application/json'
            )
        );
        
        if ( !empty( $data) ) $args['query'] = $data;

		try {
			$result = $client->request($method, $url, $args);
			$resultBody = $result->getBody();

			if ( empty( $resultBody ) ) return array();

			$data = json_decode($result['body']);
			if ($data === FALSE) {
				throw new SubscriptionException('Unexpected error occurred during connection to SendInBlue. ' . $resultBody );
			}

			return $data;
		} catch (RequestException $e) {
			throw new SubscriptionException( 'Unexpected error occurred during connection to SendInBlue: ' . $e->getResponse() );
		}
    }
    
    /**
     * Returns lists available to subscribe.
     * 
     * @since 1.0.0
     * @return mixed[]
     */
    public function getLists() {
        
        $result = $this->request('list', 'GET', array(
            'page' => 1,
            'page_limit' => 100
        ));

        if ( $result->code !== 'success' ) throw new SubscriptionException( $result->message );

        $lists = array();
        
        if ( isset( $result->data->lists) ) {
            
            foreach( $result->data->lists as $value ) {
                $lists[] = array(
                    'title' => $value->name,
                    'value' => $value->id
                );
            }
        }

        return array(
            'items' => $lists
        ); 
    }

    /**
     * Subscribes the person.
     */
    public function subscribe( $identityData, $listId, $doubleOptin, $contextData, $verified ) {

        $email = $identityData['email'];
        $result = $this->request("user/$email", "GET");

        // user exists already
        
        if ( $result->code == 'success' ) {
            
            if ( !isset( $result->listid ) || empty( $result->listid ) ) $lists = array();
            else $lists = $result->listid;
                
            if ( !in_array($listId, $lists) ) $lists[] = $listId;

        // user doesn't exist yet
            
        } else {
            
            $lists[] = $listId;
            
        }

        unset($identityData['email']);
        $attrs = $identityData;        

        $result = $this->request("user/createdituser", "POST", array(
            'email' => $email,
            'attributes' => $attrs,
            'listid' => $lists
        ));
        
        if ( $result->code !== 'success' ) throw new SubscriptionException( $result->message );

        return array('status' => 'subscribed');
    }
    
    /**
     * Checks if the user subscribed.
     */  
    public function check( $identityData, $listId, $contextData ) { 
        
        $email = $identityData['email'];
        $result = $this->request("user/$email", "GET");
        
        if ( $result->code !== 'success' ) throw new SubscriptionException( $result->message );
        
        return array('status' => 'subscribed');
    }
    
    /**
     * Returns custom fields.
     */
    public function getCustomFields( $listId ) {
        
        return array(
            'error' => 'Sorry, the plugin doesn\'t support custom fields for SendInBlue. Please <a href="http://support.onepress-media.com/create-ticket/" target="_blank">contact us</a> if you need this feature.'
        );
    }
}
