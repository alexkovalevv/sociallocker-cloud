<?php
namespace common\modules\signin\handlers\subscription;


use yii;
use common\modules\signin\Handler;
use common\modules\signin\HandlerInternalException;
use common\modules\signin\HandlerException;
use common\modules\subscription\classes\SubscriptionServices;
use common\modules\subscription\classes\LeadsHelper;
use yii\base\Exception;

/**
 * The class to proxy the request to the Subscription API.
 */
class SubscriptionHandler extends Handler {
    /**
     * Handles the proxy request.
     */
    public function handleRequest() {
        
        if( !Yii::$app->request->getQueryParam('opandaRequestType') || !Yii::$app->request->getQueryParam('opandaService') ) {
           throw new HandlerInternalException('Invalid request. The "opandaRequestType" or "opandaService" are not defined.');
        }

        $service = SubscriptionServices::getCurrentService();

        if ( empty( $service) ) {
           throw new HandlerInternalException( sprintf( 'The subscription service is not set.' )); 
        }

        // - service name
        
        $serviceName = $this->options['service'];
        if ( $serviceName !== $service->name  ) {
           throw new HandlerInternalException( sprintf( 'Invalid subscription service "%s".', $serviceName ));
        }
        
        // - request type
        
        $requestType = strtolower( Yii::$app->request->getQueryParam('opandaRequestType') );
        $allowed = array('check', 'subscribe');

        if ( !in_array( $requestType, $allowed ) ) {
           throw new HandlerInternalException( sprintf( 'Invalid request. The action "%s" not found.', $requestType ));
        }
        
        // - identity data
        
        $identityData = Yii::$app->request->getQueryParam('opandaIdentityData', array());
        $identityData = $this->normilizeValues( $identityData );
        
        if ( empty( $identityData['email'] )) {
           throw new HandlerException( 'Unable to subscribe. The email is not specified.' );
        }
        
        // - service data
        
        $serviceData = Yii::$app->request->getQueryParam('opandaServiceData', array());
        $serviceData = $this->normilizeValues( $serviceData );
        
        // - context data
        
        $contextData = Yii::$app->request->getQueryParam('opandaContextData', array());
        $contextData = $this->normilizeValues( $contextData );

        // - list id
        
        $listId = Yii::$app->request->getQueryParam('opandaListId');
        if ( empty( $listId ) ) {
           throw new HandlerException( 'Unable to subscribe. The list ID is not specified.' );
        }
        
        // - double opt-in
        
        $doubleOptin =  Yii::$app->request->getQueryParam('opandaDoubleOptin', true);
        $doubleOptin = $this->normilizeValue( $doubleOptin );
        
        // - confirmation
        
        $confirm =  isset( $_POST['opandaConfirm'] ) ? $_POST['opandaConfirm'] : true;
        $confirm = $this->normilizeValue( $confirm );
        
        // verifying user data if needed while subscribing
        // works for social subscription
        
        $verified = false; 
        $mailServiceInfo = SubscriptionServices::getServiceInfo();
        $modes = $mailServiceInfo['modes'];
            
        if ( 'subscribe' === $requestType ) {

            if ( $doubleOptin && in_array( 'quick', $mailServiceInfo['modes'] ) ) {
                $verified = $this->verifyUserData( $identityData, $serviceData );
            }     
        }

        // prepares data received from custom fields to be transferred to the mailing service
        
        $itemId = intval( $contextData['itemId'] );
        
        $identityData = $this->prepareDataToSave( $service, $itemId, $identityData );
        $serviceReadyData = $this->mapToServiceIds( $service, $itemId, $identityData );
        $identityData = $this->mapToCustomLabels( $service, $itemId, $identityData );
        
        // checks if the subscription has to be procces via WP
        
        $subscribeMode = Yii::$app->lockerMeta($itemId, 'subscribe_mode', true);

        //$subscribeDelivery = get_post_meta($itemId, 'subscribe_delivery', true);
        $subscribeDelivery = false;
        
        $isWpSubscription = false;
        
        if ( $service->hasSingleOptIn() 
                && in_array( $subscribeMode, array('double-optin', 'quick-double-optin') ) 
                && ( $service->isTransactional() || $subscribeDelivery == 'wordpress' ) ) {
            
            $isWpSubscription = true;
        }

        // creating subscription service

        try {    
            
            $result = array();
            
            if ( 'subscribe' === $requestType ) {
                
                if ( $isWpSubscription ) {
                    
                    // if the use signes in via a social network and we managed to confirm that the email is real,
                    // then we can skip the confirmation process
                    
                    if ( $verified ) {
                        //Leads::add( $identityData, $contextData, true, true );
                        return $service->subscribe( $serviceReadyData, $listId, false, $contextData, $verified );
                    } else {
                        //$result = $service->wpSubscribe( $identityData, $serviceReadyData, $contextData, $listId, $verified );
                    }
      
                } else {
                    $result = $service->subscribe( $serviceReadyData, $listId, $doubleOptin, $contextData, $verified );         
                }

                LeadsHelper::subscribe(( $result && isset( $result['status'] ) ) ? $result['status'] : 'error',
                    $identityData, $contextData, $isWpSubscription);
                
            } elseif ( 'check' === $requestType ) {
                
                if ( $isWpSubscription ) {
                    //$result = $service->wpCheck( $identityData, $serviceReadyData, $contextData, $listId, $verified );
                } else {
                    $result = $service->check( $serviceReadyData, $listId, $contextData );   
                }

                LeadsHelper::subscribe(( $result && isset( $result['status'] ) ) ? $result['status'] : 'error',
                    $identityData, $contextData, $isWpSubscription);
            }

            //if ( !defined( 'WORDPRESS' ) ) return $result;
            
            // calls the hook to save the lead in the database
            /*if ( $result && isset( $result['status'] ) ) {

                $actionData = array(
                    'identity' => $identityData,
                    'requestType' => $requestType,
                    'service' => $this->options['service'],
                    'list' => $listId,
                    'doubleOptin' => $doubleOptin,
                    'confirm' => $confirm,
                    'context' => $contextData
                );
                
                if ( 'subscribed' === $result['status'] ) {
                    do_action('subscribed', $actionData);
                } else {
                    do_action('pending', $actionData); 
                }
            }*/
            
            return $result;
            
        } catch(Exception $ex) {
            throw new HandlerException( $ex->getMessage() );
        }
    }
}
