<?php
namespace common\modules\subscription\services\database;

use common\modules\subscription\classes\Subscription;

class DatabaseSubscriptionService extends Subscription {

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
        return array('status' => 'subscribed');
    }
    
    /**
     * Checks if the user subscribed.
     */  
    public function check( $identityData, $listId, $contextData ) { 
        return array('status' => 'subscribed');
    }

    /**
     * Returns custom fields.
     */
    public function getCustomFields( $listId ) {
        
        $can = array(
            'changeType' => true,
            'changeReq' => true,
            'changeDropdown' => true,
            'changeMask' => true
        );
        
        $customFields = array();
        
        $customFields[] = array(
                    
            'fieldOptions' => array(),
            
            'mapOptions' => array(
                'req' => false,
                'id' => 'void',
                'name' => 'void',
                'title' => 'Custom Field',
                'labelTitle' => 'Custom Field',
                'mapTo' => 'any',
                'service' => array()
            ),
            
            'premissions' => array(
                'can' => $can,
                'notices' => array()
            )
        );

        return $customFields;
    }
}