<?php
namespace common\modules\subscription\classes;

use common\modules\subscription\models\Leads;
use common\modules\subscription\models\LeadsFields;
use Yii;
use yii\helpers\ArrayHelper;

class LeadsHelper {

    /**
     * Calls always when we subscribe an user.
     */
     public static function subscribe( $status, $identity, $context, $isWpSubscription ) {
        if ( $isWpSubscription ) return;

        if ( 'subscribed' == $status ) {

            // if the current service is 'database',
            // then all emails should be added as unconfirmed

            $serviceName = SubscriptionServices::getCurrentName();
            $confirmed = $serviceName === 'database' ? false : true;

            self::add( $identity, $context, $confirmed, $confirmed );

        } elseif ( 'pending' == $status ) {
            self::add($identity, $context, false, false);
        }
    }


    /**
     * Calls always when we check the subscription status of the user.
     */
    public static function check( $status, $identity, $context ) {

        if ( 'subscribed' == $status ) {
            self::add( $identity, $context, true, true );
        }
    }

    /**
     * Adds a new lead.
     * 
     * @since 1.0.7
     * @param string[] $identity An array of the identity data.
     * @param string[] $context An array of the context data.
     * @param bool $confirmed Has a lead confirmed one's email address?
     * @return int A lead ID.
     */
    public static function add( $identity = array(), $context = array(), $emailConfirmed = false, $subscriptionConfirmed = false, $temp = null ) 
    {
        $itemId = isset( $context['itemId'] ) ? intval( $context['itemId'] ) : 0;
        if ( !empty( $itemId ) && !Yii::$app->LockerMeta->get($itemId, 'opanda_catch_leads', true) )
            return false;

        $email = isset( $identity['email'] ) ? $identity['email'] : false;
 
        $leads_model = new Leads();
        $lead = $leads_model->getByEmail( $email );

        return $leads_model->checkAndSave( $lead, $identity, $context, $emailConfirmed, $subscriptionConfirmed, $temp );
    }

    /**
     * Return an URL of the image to use as an avatar.
     * 
     * @since 1.0.7
     * @param int $leadId A lead ID for which we need to return the URL of the avatar.
     * @param int $size A size of the avatar (px).
     * @return string
     */
    public static function getAvatarUrl( $leadId, $email = null, $size = 40 ) {
        $fields_model = new LeadsFields();

        $imageSource = $fields_model->getLeadField( $leadId, 'externalImage', null );
        $image = $fields_model->getLeadField( $leadId, '_image' . $size, null );
        
        // getting an avatar from cache
        
        /*if ( !empty( $image ) ) {
            $upload_dir = wp_upload_dir(); 
     
            $path = $upload_dir['path'] . '/bizpanda/avatars/' . $image;
            $url = $upload_dir['url'] . '/bizpanda/avatars/' . $image;

            if ( file_exists( $path ) ) return $url;
            self::removeLeadField($leadId, '_image' . $size);
        }
        
        // trying to process an external image
        
        if ( !empty( $imageSource ) && function_exists('wp_get_image_editor') ) {
            return admin_url('admin-ajax.php?action=opanda_avatar&opanda_lead_id=' . $leadId) . '&opanda_size=' . $size;
        } 
        
        // else return a gravatar
        
        $gravatar = get_avatar( $email, $size );
        if ( preg_match('/https?\:\/\/[^\'"]+/i', $gravatar, $match) ) {
            return $match[0];
        }*/

        return null;
    }
    
    /**
     * Return a HTML code markup to display avatar.
     * 
     * @since 1.0.7
     * @param int $leadId A lead ID for which we need to return the URL of the avatar.
     * @param int $size A size of the avatar (px).
     * @return string HTML
     */
    public static function getAvatar( $leadId, $email = null, $size = 40 ) {
        
        $url = self::getAvatarUrl( $leadId, $email, $size );
        if ( empty( $url ) ) return null;
        
        $alt = 'Аватар пользователя';
        return "<img src='$url' width='$size' height='$size' alt='$alt' />";
    }
    
    /**
     * Returns an URL of the social profile of the lead.
     * 
     * @since 1.0.7
     * @param int $leadId A lead ID for which we need to return an URL of the social profile.
     * @return string|false An URL of the social profile of the lead.
     */
    public static function getSocialUrl( $leadId ) {
        $fields_model = new LeadsFields();
        $fields = $fields_model->getLeadFields( $leadId );
        
        if ( isset( $fields['facebookUrl'] )) return $fields['facebookUrl'];
        if ( isset( $fields['twitterUrl'] )) return $fields['twitterUrl'];
        if ( isset( $fields['googleUrl'] )) return $fields['googleUrl'];
        if ( isset( $fields['linkedinUrl'] )) return $fields['linkedinUrl'];
		if ( isset( $fields['vkUrl'] )) return $fields['vkUrl'];

        
        return false;
    }
}