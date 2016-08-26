<?php
namespace common\modules\subscription\classes;

use yii\base\Exception;
use Yii;
use yii\helpers\ArrayHelper;
use  yii\imagine\Image;
use common\modules\subscription\models\Leads;
use common\modules\subscription\models\LeadsFields;
use GuzzleHttp\Client;

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

        if ( !empty($itemId) && isset($identity['source']) && !Yii::$app->lockerMeta->get($itemId, $identity['source'] . '_lead_available', true) )
            return false;

        $email = isset( $identity['email'] ) ? $identity['email'] : false;
 
        $leads_model = new Leads();
        $lead = $leads_model->getByEmail( $email );

        return $leads_model->checkAndSave( $lead, $identity, $context, $emailConfirmed, $subscriptionConfirmed, $temp );
    }

    public static function saveAvatar( $lead_id ) {

        if( !$lead_id ) return false;

        $lead_fields_model = new LeadsFields();
        $image_source = $lead_fields_model->getLeadField( $lead_id, 'externalImage' );

        /*if ( empty( $image_source ) ) {
            $lead_model = new Leads();
            $lead_model = $lead_model->findOne($lead_id);

            if( empty($lead_model) ) return false;

            $image_source = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $lead_model->lead_email ) ) ) . "?s=500&d=mm";
            $lead_fields_model->updateLeadField( $lead_id, 'externalImage', $image_source );
        }*/

        $upload_dir = Yii::getAlias('@backend/web/upload/leads/');

        if ( !is_dir($upload_dir) )
            throw new Exception('Директория для загрузки аватаров подписчиков не найдена');

        $path_avatar = $upload_dir . $lead_id . '_x40.jpeg';
        $path_original = $upload_dir . $lead_id . '_x500.jpeg';

        $client = new Client();
        $result = $client->request('GET', $image_source);
        $result_body = $result->getBody();
        $contents = $result_body->getContents();
        $cType = $result->getHeader('content-type')[0];

        if (
            empty( $cType ) ||
            empty( $contents ) ||
            !preg_match( "/image/i", $cType ) ) {

            $lead_fields_model->removeLeadField($lead_id, 'externalImage');
            return false;
        }

        file_put_contents($path_original, $contents);

        Image::thumbnail($path_original, 40, 40)
            ->save(Yii::getAlias($path_avatar), ['quality' => 90]);

        if( !file_exists($path_avatar) || !file_exists($path_original) )
            return false;

        if( !$lead_fields_model->updateLeadField( $lead_id, '_image_x40',  $lead_id . '_x40.jpeg' ) ||
            !$lead_fields_model->updateLeadField( $lead_id, '_image_x500',  $lead_id . '_x500.jpeg' ) ) {
            return false;
        }

        return true;
    }

    /**
     * Return an URL of the image to use as an avatar.
     * 
     * @since 1.0.7
     * @param int $lead_id A lead ID for which we need to return the URL of the avatar.
     * @param int $size A size of the avatar (px).
     * @return string
     */
    public static function getAvatarUrl( $lead_id, $size = 40 ) {
        $lead_fields_model = new LeadsFields();

        //$image_source = $lead_fields_model->getLeadField( $lead_id, 'externalImage', null );
        $image = $lead_fields_model->getLeadField( $lead_id, '_image_x' . $size, null );
        
        // getting an avatar from cache
        if ( !empty( $image ) ) {
            $upload_dir = Yii::getAlias('@backend/web/upload/leads/');
            $upload_dir_url = Yii::getAlias('@backendUrl/upload/leads/');
     
            $path = $upload_dir . $image;
            $url = $upload_dir_url . $image;

            if ( file_exists( $path ) ) return $url;
            $lead_fields_model->removeLeadField($lead_id, '_image_x' . $size);
        }
        
        // trying to process an external image
        if( !empty( $image_source ) ) {
            if( self::saveAvatar($lead_id) ) {
                return self::getAvatarUrl( $lead_id, $size );
            }
        }

        /*if ( !empty( $image_source ) && function_exists('wp_get_image_editor') ) {
            return admin_url('admin-ajax.php?action=opanda_avatar&opanda_lead_id=' . $lead_id) . '&opanda_size=' . $size;
        } */
        
        // else return a gravatar
        
        /*$gravatar = get_avatar( $email, $size );
        if ( preg_match('/https?\:\/\/[^\'"]+/i', $gravatar, $match) ) {
            return $match[0];
        }*/

        $lead_model = new Leads();
        $lead_model = $lead_model->get($lead_id);

        if( empty($lead_model) ) return null;

        return "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $lead_model->lead_email ) ) ) . "?s=" . $size . "&d=mm";
    }
    
    /**
     * Return a HTML code markup to display avatar.
     * 
     * @since 1.0.7
     * @param int $lead_id A lead ID for which we need to return the URL of the avatar.
     * @param int $size A size of the avatar (px).
     * @return string HTML
     */
    public static function getAvatar( $lead_id, $size = 40 ) {
        
        $url = self::getAvatarUrl( $lead_id, $size );
        if ( empty( $url ) ) return null;
        
        $alt = 'Аватар пользователя';
        return "<img src='$url' width='$size' height='$size' alt='$alt' />";
    }

    /**
     * Returns an URL of the social profile of the lead.
     * 
     * @since 1.0.7
     * @param int $lead_id A lead ID for which we need to return an URL of the social profile.
     * @return string|false An URL of the social profile of the lead.
     */
    public static function getSocialUrl( $lead_id ) {
        $lead_fields_model = new LeadsFields();
        $fields = $lead_fields_model->getLeadFields( $lead_id );
        
        if ( isset( $fields['facebookUrl'] )) return $fields['facebookUrl'];
        if ( isset( $fields['twitterUrl'] )) return $fields['twitterUrl'];
        if ( isset( $fields['googleUrl'] )) return $fields['googleUrl'];
        if ( isset( $fields['linkedinUrl'] )) return $fields['linkedinUrl'];
		if ( isset( $fields['vkUrl'] )) return $fields['vkUrl'];

        
        return false;
    }

    public static function getSourceIcons( $lead_id ) {
        $output = '';

        $lead_fields_model = new LeadsFields();
        $fields = $lead_fields_model->getLeadFields( $lead_id  );

        if ( isset( $fields['facebookUrl'] ) ) {
            $output .= sprintf( '<a href="%s" target="_blank" class="lead-social-icon lead-facebook-icon"><i class="fa fa-facebook"></i></a>', $fields['facebookUrl'] );
        }

        if ( isset( $fields['twitterUrl'] ) ) {
            $output .= sprintf( '<a href="%s" target="_blank" class="lead-social-icon lead-twitter-icon"><i class="fa fa-twitter"></i></a>', $fields['twitterUrl'] );
        }

        if ( isset( $fields['googleUrl'] ) ) {
            $output .= sprintf( '<a href="%s" target="_blank" class="lead-social-icon lead-google-icon"><i class="fa fa-google-plus"></i></a>', $fields['googleUrl'] );
        }

        if ( isset( $fields['linkedinUrl'] ) ) {
            $output .= sprintf( '<a href="%s" target="_blank" class="lead-social-icon lead-linkedin-icon"><i class="fa fa-linkedin"></i></a>', $fields['linkedinUrl'] );
        }

        if( isset( $fields['vkUrl'] ) ) {
            $output .= sprintf( '<a href="%s" target="_blank" class="lead-social-icon lead-vk-icon"><i class="fa  fa-vk"></i></a>', $fields['vkUrl'] );
        }

        return $output;
    }
}