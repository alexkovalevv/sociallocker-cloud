<?php
namespace common\modules\subscription\classes;

use yii\base\Exception;

abstract class Subscription {
    
    public $name;
    public $title; 
    public $data;
    
    public $deliveryError;
    
    public function __construct( $data = array() ) {
        $this->setData($data);
    }

    public function setData($data) {
        $this->data = $data;

        if ( isset( $data['name']) ) $this->name = $data['name'];
        if ( isset( $data['title']) ) $this->title = $data['title'];
    }

    public function isEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);       
    }
    
    public function isTransactional() {
        return isset( $this->data['transactional'] ) && $this->data['transactional'];
    }
    
    public function hasSingleOptIn() {
        return in_array('quick', $this->data['modes'] );
    }

    public abstract function getLists();
    public abstract function subscribe( $identityData, $listId, $doubleOptin, $contextData, $verified );
    public abstract function check( $identityData, $listId, $contextData );
    public abstract function getCustomFields( $listId );
    
    public function prepareFieldValueToSave( $mapOptions, $value ) {
        return $value;
    }
    
    public function getNameFieldIds() {
        return array();
    }
    
    public function slugify($text, $separator = ' ')
    { 
      // replace non letter or digits by -
      $text = preg_replace('~[^\\pL\d]+~u', $separator, $text);

      // trim
      $text = trim($text, '-');

      // transliterate
      $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

      // lowercase
      $text = strtolower($text);

      // remove unwanted characters
      $text = preg_replace('~[^-\w]+~', '', $text);

      if (empty($text))
      {
        return 'n-a';
      }

      return $text;
    }
    
    public function refine( $identityData, $clearEmpty = false ) {
        if ( empty( $identityData ) ) return $identityData;
        
        unset( $identityData['html'] );     
        unset( $identityData['label'] ); 
        unset( $identityData['separator'] );        
        unset( $identityData['name'] );
        unset( $identityData['family'] );
        unset( $identityData['displayName'] );
        unset( $identityData['fullname'] ); 
        
        if ( $clearEmpty ) {
            foreach ($identityData as $key => $value) {
                if ( empty($value) ) unset( $identityData[$key] );
            }
        }
        
        return $identityData;
    }
}

/**
 * A subscription service exception.
 */
class SubscriptionException extends Exception {
    
    public function __construct ($message) {
        parent::__construct($message, 0, null);
    }
}