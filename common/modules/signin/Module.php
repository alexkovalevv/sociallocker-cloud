<?php

namespace common\modules\signin;

use Yii;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'common\modules\signin\controllers';

    public function init()
    {
        parent::init();
    }

    /**
     * Returns the connect handler options.
     *
     * @since 1.0.0
     */
    public static function getConnectOptions( $handlerName )
    {

        switch ( $handlerName ) {
            case 'vk':
                return [
                    'app_id' => Yii::$app->lockersSettings->get('vk_app_id'),
                    'app_secret' => Yii::$app->lockersSettings->get('vk_app_secret'),
                    'proxy' => Yii::getAlias('@proxyUrl') . '?opandaHandler=vk'
                ];
            case 'twitter':
                $consumerKey = 'Fr5DrCse2hsNp5odQdJOexOOA';
                $consumerSecret = 'jzNmDGYPZOGV10x2HmN8tYMDqnMTowycXFu4xTTLbw3VBVeFKm';

                $optDefaultKeys = Yii::$app->lockersSettings->get('twitter_use_dev_keys', 'default');

                if ( 'default' !== $optDefaultKeys ) {
                    $consumerKey = Yii::$app->lockersSettings->get('twitter_consumer_key');
                    $consumerSecret = Yii::$app->lockersSettings->get('twitter_consumer_secret');
                }

                return [
                    'consumer_key' => $consumerKey,
                    'consumer_secret' => $consumerSecret,
                    'proxy' => Yii::getAlias('@proxyUrl')  . '?opandaHandler=twitter'
                ];

            case 'linkedin':
                $clientId = Yii::$app->lockersSettings->get('linkedin_client_id');
                $clientSecret = Yii::$app->lockersSettings->get('linkedin_client_secret');

                return [
                    'client_id' => $clientId,
                    'client_secret' => $clientSecret,
                    'proxy' => Yii::getAlias('@proxyUrl')
                ];

            case 'subscription':
                return [
                    'service' => Yii::$app->lockersSettings->get('subscription_to_service', 'database')
                ];
        }
    }
}
