<?php
namespace common\modules\subscription\services\freshmail;

use Yii;
use common\modules\subscription\classes\Subscription;
use common\modules\subscription\classes\SubscriptionException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class FreshmailSubscriptionService extends Subscription {
    
    /**
     * Make a call to the Freshmail API.
     */
    public function request( $strUrl, $arrParams = array() ) {
        
        $apiKey = Yii::$app->lockersSettings->get('freshmail_apikey', false);
        $apiSecret = Yii::$app->lockersSettings->get('freshmail_apisecret', false);
        
        if( empty( $apiKey ) || empty( $apiSecret ) )
            throw new SubscriptionException ('The API Key or API Secret not set.');
        
        $isPost = empty( $arrParams ) ? false : true;
        $url = 'https://api.freshmail.com/rest/' . $strUrl;
        
        if ( $isPost ) {
            $jsonData = json_encode( $arrParams );
            $strSign = sha1( $apiKey . '/rest/' . $strUrl . $jsonData . $apiSecret );
        } else {
            $strSign = sha1( $apiKey . '/rest/' . $strUrl . $apiSecret );
        }
        
        $arrHeaders = array();
        $arrHeaders['X-Rest-ApiKey'] = $apiKey;
        $arrHeaders['X-Rest-ApiSign'] = $strSign;
        $arrHeaders['Content-Type'] = $isPost ? 'application/json' : 'text/json';

	    $client = new Client([
		    'timeout' => 30
	    ]);

        if ( $isPost ) {
	        $result = $client->request('POST', $url, [
		        'headers' => $arrHeaders,
		        'query' => $arrParams
	        ]);
        } else {
	        $result = $client->request('GET', $url, [
		        'headers' => $arrHeaders
	        ]);
        }

	    try {
		    $resultBody = $result->gerBody();

		    if ( empty( $resultBody ) ) return array();
		    return json_decode( $resultBody );

	    } catch (RequestException $e) {
		    throw new SubscriptionException( 'Unexpected error occurred during connection to FreshMail: ' . $e->getResponse() );
	    }
    }
    
    /**
     * Returns lists available to subscribe.
     * 
     * @since 1.0.0
     * @return mixed[]
     */
    public function getLists() {
        
        $result = $this->request('subscribers_list/lists' );
        
        if ( isset( $result->errors ) ) {
            throw new SubscriptionException( $result->errors[0]->message );
        }


        foreach( $result->lists as $value ) {
            $lists[] = array(
                'title' => $value->name,
                'value' => $value->subscriberListHash
            );
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
        $result = $this->request("subscriber/get/$listId/$email" );

        if ( isset( $result->errors ) ) {
            
            // 1311: the subscriber not found
            if ( 1311 !== $result->errors[0]->code  ) {
                throw new SubscriptionException( $result->errors[0]->message );
            }
            
        } else {
            
            $state = intval( $result->data->state );
            if ( $doubleOptin ) return array('status' => $state === 1 ? 'subscribed' : 'pending');
            return array('status' => 'subscribed');                  
        }  
        
        $data = array(
            'email' => $identityData['email'],
            'list'  => $listId,
            'confirm' => ( $verified || !$doubleOptin ) ? 0 : 1,
            'state' => ( $verified || !$doubleOptin ) ? 1 : 2
        );

        $fields = $identityData;

        unset( $fields['email'] );        
        unset( $fields['name'] );
        unset( $fields['family'] );
        unset( $fields['displayName'] );
            
        $data['custom_fields'] = $fields;
        $result = $this->request('subscriber/add', $data, true );
        
        if ( isset( $result->errors ) ) {
            
            // 1304: the subscriber already exists
            if ( 1304 === $result->errors[0]->code  ) {
                return array('status' => 'subscribed');
            } else {
                throw new SubscriptionException( $result->errors[0]->message );
            }
        }  

        return array('status' => (!$verified && $doubleOptin) ? 'pending' : 'subscribed');
    }
    
    /**
     * Checks if the user subscribed.
     */  
    public function check( $identityData, $listId, $contextData ) { 
        
        $email = $identityData['email'];
        $result = $this->request("subscriber/get/$listId/$email" );
        
        if ( isset( $result->errors ) ) {
            throw new SubscriptionException( $result->errors[0]->message );
        } else {
            $state = intval( $result->data->state );
            return array('status' => $state === 1 ? 'subscribed' : 'pending');             
        }  
    }
    
    /**
     * Returns custom fields.
     */
    public function getCustomFields( $listId ) {

        try {
            
            $mappingRules = array(
                'text' => 'any',
                'number' => array('integer', 'checkbox')
            );
            
            $result = $this->request("subscribers_list/getFields", array('hash' => $listId));
            
            if ( isset( $result->errors ) ) {
                throw new SubscriptionException( $result->errors[0]->message );
            }
        
            $customFields = array();
            foreach( $result->fields as $field ) {
                
                $pluginFieldType = isset( $mappingRules[$field->type] ) 
                        ? $mappingRules[$field->type] 
                        : strtolower( $field->type );

                $can = array(
                    'changeType' => true,
                    'changeReq' => false,
                    'changeDropdown' => false,
                    'changeMask' => true
                );
            
                $customFields[] = array(
   
                    'fieldOptions' => array(),
                    
                    'mapOptions' => array(
                        'id' => $field->tag,
                        'name' => $field->tag,
                        'title' => $field->name,
                        'labelTitle' => $field->name,
                        'type' => $field->type,
                        'mapTo' => ( is_array($pluginFieldType) || $pluginFieldType == 'any') ? $pluginFieldType : array( $pluginFieldType )
                    ),

                    'premissions' => array(

                        'can' => $can,
                        'notices' => array(
                            'changeReq' => 'You can change this checkbox in your MailChimp account.',
                            'changeDropdown' => 'Please visit your MailChimp account to modify the choices. <a href="http://kb.mailchimp.com/merge-tags/using/getting-started-with-merge-tags#List-merge-tags" target="_blank">Learn more</a>.'
                        ), 
                    )
                );
            }

            return $customFields;
            
        } catch(Exception $ext) {
            throw new SubscriptionException ('[custom-fields]: ' . $ext->getMessage());
       }
    }
}
