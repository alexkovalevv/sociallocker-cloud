<?php

namespace common\modules\subscription\models;

use common\modules\subscription\classes\SubscriptionServices;
use Yii;
use yii\base\Exception;
use yii\helpers\ArrayHelper;
use common\modules\subscription\models\LeadsFields;

/**
 * This is the model class for table "leads".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $lead_display_name
 * @property string $lead_name
 * @property string $lead_family
 * @property string $lead_email
 * @property integer $lead_date
 * @property integer $lead_email_confirmed
 * @property integer $lead_subscription_confirmed
 * @property integer $lead_item_id
 * @property string $lead_item_title
 * @property string $lead_referer
 * @property string $lead_confirmation_code
 * @property string $lead_temp
 */
class Leads extends \yii\db\ActiveRecord
{
    private $_leads = [];
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%leads}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'lead_email', 'lead_date'], 'required'],
            [['user_id', 'lead_date'], 'safe'],
            [['user_id', 'lead_email_confirmed', 'lead_subscription_confirmed', 'lead_item_id'], 'integer'],
            [['lead_referer', 'lead_temp'], 'string'],
            [['lead_display_name', 'lead_item_title'], 'string', 'max' => 255],
            [['lead_name', 'lead_family'], 'string', 'max' => 100],
            [['lead_email'], 'string', 'max' => 50],
            [['lead_confirmation_code'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lead_display_name' => 'Полное имя',
            'lead_name' => 'Имя',
            'lead_family' => 'Фамилия',
            'lead_email' => 'Email',
            'lead_date' => 'Добавлен',
            'lead_email_confirmed' => 'Email подтвержден',
            'lead_subscription_confirmed' => 'Подписка подтверждена',
            'lead_item_id' => 'ID замка',
            'lead_item_title' => 'Заголовок замка',
            'lead_referer' => 'Откуда пришел',
            'lead_confirmation_code' => 'Код подтверждения',
            'lead_temp' => 'Время',
        ];
    }

    /**
     * Returns a lead.
     */
    public function get( $leadId ) {
        if ( isset( $this->_leads[$leadId] ) ) return $this->_leads[$leadId];

        $lead = $this->findOne($leadId);

        $this->_leads[$leadId] = $lead;
        return $lead;
    }

    /**
     * Inserts or updates a lead in the database.
     *
     * @since 1.0.7
     * @param object $model A lead to update.
     * @param string[] $identity An array of the identity data.
     * @param string[] $context An array of the context data.
     * @param bool $confirmed Has a lead confirmed one's email address?
     * @return int A lead ID.
     */
    public function checkAndSave( $model = null, $identity = array(), $context = array(), $emailConfirmed = false, $subscriptionConfirmed = false, $temp = null ) {

        $email = ArrayHelper::getValue('email', $identity, false);
        if ( isset( $identity['social'] ) ) $emailConfirmed = true;

        $itemId = isset( $context['itemId'] ) ? intval( $context['itemId'] ) : 0;
        //$postId = isset( $context['postId'] ) ? intval( $context['postId'] ) : null;

        //$item = get_post( $itemId );
        $itemTitle = !empty( $item ) ? $item->post_title : null;
        $postUrl = ArrayHelper::getValue('postUrl', $context);

        $name = ArrayHelper::getValue('name', $context);
        $family = ArrayHelper::getValue('family', $context);

        $displayName = ArrayHelper::getValue('displayName', $context);
        if ( empty( $displayName ) ) {

            if ( !empty( $name ) && !empty( $family ) ) {
                $displayName = $name . ' ' . $family;
            } elseif ( !empty( $name ) ) {
                $displayName = $name;
            } elseif ( !empty( $family ) ) {
                $displayName = $family;
            } else {
                $displayName = "";
            }
        }

        $leadId = empty( $model ) ? null : $model->id;

        // counts the number of confirmed emails (subscription)
        /*if ( $subscriptionConfirmed && $leadId && !$lead->lead_subscription_confirmed ) {
            require_once OPANDA_BIZPANDA_DIR . '/admin/includes/stats.php';
            OPanda_Stats::countMetrict( $itemId, $postId, 'email-confirmed');
        }*/

        if ( !$leadId ) {
            // counts the number of new recivied emails
            //OPanda_Stats::countMetrict( $itemId, $postId, 'email-received');

            $this->user_id = Yii::$app->user->identity->id;
            $this->lead_display_name = $displayName;
            $this->lead_name = $name;
            $this->lead_family = $family;
            $this->lead_email_confirmed = $emailConfirmed ? 1 : 0;
            $this->lead_subscription_confirmed = $subscriptionConfirmed ? 1 : 0;
            $this->lead_temp = !empty( $temp ) ? json_encode( $temp ) : null;
            $this->lead_email = $email;
            $this->lead_date = time();
            $this->lead_item_id = $itemId;
            $this->lead_item_title = $itemTitle;
            $this->lead_referer = $postUrl;
            $this->lead_ip = Yii::$app->request->getUserIP();

            if( $this->save(true) ) {
                $leadId = Yii::$app->db->getLastInsertID();
            }

        } else {

            //$model = $this->findOne($leadId);

            if( $model ) {
                if( !empty($displayName) )
                    $model->lead_display_name = $displayName;
                if( !empty($name) )
                    $model->lead_name = $name;
                if( !empty($family) )
                    $model->lead_family = $family;
                if( !empty($emailConfirmed) )
                    $model->lead_email_confirmed = $emailConfirmed ? 1 : 0;
                if( !empty($subscriptionConfirmed) )
                    $model->lead_subscription_confirmed = $subscriptionConfirmed ? 1 : 0;
                if( !empty($subscriptionConfirmed) )
                    $model->lead_temp = !empty( $temp ) ? json_encode( $temp ) : null;

                $model->save(true);
            }
        }

        // saving extra fields

        $fields = array();

        foreach( $identity as $itemName => $itemValue ) {
            if ( in_array( $itemName, array( 'email', 'name', 'family', 'displayName' ) ) ) continue;
            if ( 'image' === $itemName ) $itemName = 'externalImage';
            $fields[trim( $itemName, '{}') ] = array('value' => $itemValue, 'custom' => ( strpos($itemName, '{') === 0 )  ? 1 : 0 );
        }

        if( !empty($fields) ) {
            $leads_fields_model = new LeadsFields();
            $leads_fields_model->lead_id = $leadId;
            $leads_fields_model->fields_value = json_decode($fields);
            $leads_fields_model->save(true);
        }

        return $leadId;
    }



    /**
     * Sets a confirmation code for the lead.
     * @param object $model A lead to update.
     */
    public function setConfirmationCode( $model, $code ) {
        if ( empty( $model ) ) return false;

        $model->lead_confirmation_code = $code;
        return $model->save(true);
    }

    /**
     * Returns a lead by email or null.
     * @return object
     */
    public function getByEmail( $email ) {
        return $this->find()->where(['user_id' => $email]);
    }


    /**
     * Confirms a lead.
     */
    public function confirm( $email, $code, $push = false ) {
        if ( empty( $email ) ) return false;

        $model = self::getByEmail($email);

        if ( !$model || $model->lead_subscription_confirmed ) return false;

        if ( $code !== $model->lead_confirmation_code ) return false;

        $temp = !empty( $model->lead_temp ) ? json_decode( $model->lead_temp, true ) : null;
        $itemId = isset( $temp['context']['itemId'] ) ? $temp['context']['itemId'] : null;

        if ( $push ) {
            try {

                $serviceReady = isset( $temp['serviceReady'] ) ? $temp['serviceReady'] : null;
                $context = isset( $temp['context'] ) ? $temp['context'] : null;
                $listId = isset( $temp['listId'] ) ? $temp['listId'] : null;
                $verified = isset( $temp['verified'] ) ? $temp['verified'] : null;

                $service = SubscriptionServices::getCurrentService();

                if ( empty( $service) ) {
                    throw new Exception( sprintf( 'The subscription service is not set.' ));
                }

                $service->subscribe( $serviceReady, $listId, false, $context, $verified );

            } catch (Exception $ex) {
                echo "<strong>Error:</strong> ". $ex->getMessage();
                return false;
            }
        }

        $model->lead_email_confirmed = 1;
        $model->lead_subscription_confirmed = 1;
        return $model->save(true);

        // counts the number of confirmed emails (subscription)
        //if ( $model->id && !$model->lead_subscription_confirmed && $itemId ) {
            //require_once OPANDA_BIZPANDA_DIR . '/admin/includes/stats.php';
            //OPanda_Stats::countMetrict( $itemId, $postId, 'email-confirmed');
        //}
    }

    /**
     * @param object $model
     * @param $temp
     */
    public function setTempData( $model, $temp )  {
        $model->lead_temp = json_encode($temp);
        return $model->save(true);
    }

    /**
     * Returns the following array:
     *
     * 'confirmed' => the number of leads (int),
     * 'not-fonfirmed' => the number of leads (int)
     *
     * @since 1.0.7
     */
    public static function getCountByStatus() {

        $rows = self::find()->select(['COUNT(*) as status_count, lead_email_confirmed'])
            ->where(['user_id' => Yii::$app->user->identity->id])
            ->groupBy(['lead_email_confirmed'])
            ->asArray()
            ->all();

        $result = array();

        foreach( $rows as $row ) {
            $status = $row['lead_email_confirmed'] == 1 ? 'confirmed' : 'not-confirmed';
            $result[$status] = intval( $row['status_count'] );
        }

        if ( !isset( $result['confirmed'] )) $result['confirmed'] = 0;
        if ( !isset( $result['not-confirmed'] )) $result['not-confirmed'] = 0;

        return $result;
    }


    /*public static function getCountLeads() {
        return self::find()->where(['user_id' => Yii::$app->user->identity->id])->count();
    }*/

    public static function getCount( $cache = true ) {
        $count = null;
        $cacheKey = self::getCacheKey();

        if ( $cache ) {
            $count = Yii::$app->cache->get( $cacheKey );

            if ( $count && ($count === '0' || !empty( $count )) ) {
                return intval( $count );
            }
        }

        $count = self::find()->where(['user_id' => Yii::$app->user->identity->id])->count();
        Yii::$app->cache->get( $cacheKey, $count, 60 * 5 );

        return $count;
    }

    public static function updateCount() {
        self::getCount( false );
    }

    /**
     * @param $key
     *
     * @return array
     */
    protected static function getCacheKey()
    {
        return [
            __CLASS__,
            Yii::$app->user->identity->id,
            '_leads'
        ];
    }
}
