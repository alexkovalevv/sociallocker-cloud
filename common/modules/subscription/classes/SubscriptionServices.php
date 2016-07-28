<?php
namespace common\modules\subscription\classes;

use Yii;
use yii\base\Exception;
use yii\helpers\ArrayHelper;

class SubscriptionServices {

    /**
     * Возвращает все доступные сервисы подписки
     * 
     * @since 1.0.8
     * @return mixed[]
     */
    public static function getSerivcesList() {
	    $services = require(Yii::getAlias('@subscription/boot.php'));

	    if( empty($services) ) {
		    throw new Exception('Не установлены сервисы подписки.');
	    }

	    return $services;
    }
    
    /**
     * Возвращает имя текущего сервиса подписки
     * 
     * @since 1.0.8
     * @return string
     */
    public static function getCurrentName() {
        return Yii::$app->lockersSettings->get('subscription_to_service', 'none');
    }
    
    /**
     * Возвращает заголовок текущего сервиса подписки.
     * 
     * @since 1.0.8
     * @return string|null
     */
    public static function getCurrentServiceTitle() {
        $info = self::getCurrentServiceInfo();
        return !empty( $info ) ? $info['title'] : null;
    }
    
    /**
     * Returns information about the current subscription service.
     * 
     * @since 1.0.8
     * @return string[]
     */
    public static function getCurrentServiceInfo() {
        return self::getServiceInfo( null );
    }
    
    /**
     * Returns an object of the current subscription service.
     * 
     * @since 1.0.8
     * @return Subscription
     */
    public static function getCurrentService() {
        return self::getService( null );
    }
    
    /**
     * Returns information about a specified service.
     * 
     * @since 1.0.8
     * @param string $name A name of the service to return.
     * @return string[]
     */
    public static function getServiceInfo( $name = null ) {

        $services = self::getSerivcesList();
        $name = empty( $name ) ? Yii::$app->lockersSettings->get('subscription_to_service', 'none') : $name;
        if ( !isset( $services[$name] ) ) $name = 'none';

        if ( isset( $services[$name] ) ) {
            $services[$name]['name'] = $name;
            return $services[$name];
        }
        return null;
    }
    
    /**
     * Returns an object of a specified subscription service.
     * 
     * @since 1.0.8
     * @param string $name A name of the service to return.
     * @return Subscription
     */
    public static function getService( $name = null ) {
        $info = self::getServiceInfo( $name );
        if ( empty( $info) ) return null;

        return new $info['class'];
    }
    
    /**
     * Возвращает доступные режимы проверки для сервисов подписки
     * 
     * @since 1.0.8
     * @param string $name A name of the service to return.
     * @return mixed[]
     */
    public static function getCurrentOptinModes( $toList = false ) {

        $result = array();
        $finish = array();
        
        $info = self::getCurrentServiceInfo();

        if ( empty( $info ) ) return array();

        $all = self::getAllOptinModes();

        foreach( $info['modes'] as $name ) {
	        $result[$name] = array(
		        'value' => $name,
		        'text' => $all[$name]['title'],
		        'hint' => $all[$name]['description']
	        );
        }

        if ( !$toList ) return $result;

        if ( isset( $result['quick'] ) ) {
            
            if ( !isset($result['double-optin'] ) )  {
                $result['double-optin'] = array(
	                'value' => 'double-optin',
	                'text' => $all['double-optin']['title'],
	                'hint' => $all['double-optin']['description']

                );
            }
            
            if ( !isset($result['quick-double-optin'] ) )  {
	            $result['quick-double-optin'] = array(
		            'value' => 'quick-double-optin',
		            'text' => $all['quick-double-optin']['title'],
		            'hint' => $all['quick-double-optin']['description']

	            );
            }
        }
        return $result;
    }
    
    /**
     * Возвращает доступные режимы проверки.
     * 
     * @since 1.0.8
     * @return mixed[]
     */
    public static function getAllOptinModes() {
        
        $modes = array(
            'double-optin' => array(
                'title' => "Двойная проверка",
                'description' => "После того, как пользователь вводит свой адрес электронной почты, плагин отправляет ему подтверждение и ждет, пока пользователь не подтвердит подписку. И только после этого разблокирует содержимое."
            ),
            'quick-double-optin' => array(
                'title' => "Ленивая проверка",
                'description' => "Разблокирует содержимое сразу после того, как пользователь вводит свой адрес электронной почты, но также посылает сообщение о подтверждении подписки по электронной почте."
            ),
            'quick' => array(
                'title' => "Одинарная проверка",
                'description' => "Разблокирует содержимое сразу после того, как пользователь вводит свой адрес электронной почты. Не отправляет подтверждение по электронной почте."
            ),
        );
        
        return $modes;
    }
}