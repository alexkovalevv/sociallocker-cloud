<?php
namespace common\modules\subscription\services\smartresponder;

use Yii;
use common\modules\subscription\classes\Subscription;
use common\modules\subscription\classes\SubscriptionException;

class SmartresponderSubscriptionService extends Subscription {

	public function initSmartResponderOptions() {

		$md5Securiry =  Yii::$app->lockersSettings->get('smartresponder_availible_md5', false);
		$apiId       =  Yii::$app->lockersSettings->get('smartresponder_api_id', null);
		$apiSecret   =  Yii::$app->lockersSettings->get('smartresponder_api_secret', null);
		$apiKey      =  Yii::$app->lockersSettings->get('smartresponder_api_key', null);

		if( $md5Securiry ) {
			if( !empty($apiId) && !empty($apiSecret) ) {
				return array(
					'apiId' => $apiId,
					'apiSecret' => $apiSecret
				);
			}
			throw new SubscriptionException ( '[initSmartResponderOptions]: api id и секретного ключа несуществует.');
		}

		if( empty($apiKey) ) {
			throw new SubscriptionException ( '[initSmartResponderOptions]: api ключ несуществует.');
		}

		return array(
			'apiKey' => $apiKey
		);
	}

	/**
	 * Returns lists available to subscribe.
	 *
	 * @since 1.0.0
	 * @return mixed[]
	 */
	public function getLists() {

		$method = 'deliveries';
		$action = 'list';

		$response = $this->callApi($method, $action,
			array(
				'fields' => 'id,title'
			)
		);

		if( isset($response['error']) ) {
			throw new SubscriptionException( $response['error']['message'] );
		}

		$lists = array();
		foreach( $response['list']['elements'] as $value ) {
			$lists[] = array(
				'title' => $value['title'],
				'value' => $value['id']
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

		$method = 'subscribers';
		$email = $identityData['email'];

		$vars = $this->refine( $identityData );

		if ( empty( $vars['first_name'] ) && !empty( $identityData['name'] ) ) $vars['first_name'] = $identityData['name'];
		if ( empty( $vars['last_name'] ) && !empty( $identityData['family'] ) ) $vars['last_name'] = $identityData['family'];

		$data = array_merge(array(
			'delivery_id' => $listId
		), $vars);

		$response = $this->callApi($method, 'create', $data);

		if( isset($response['error']) && $response['error']['code'] !== '-2.EMAIL_IS_ALREADY_IN_YOUR_LIST' ) {
			throw new SubscriptionException ( '[subscribe]: ' . $response['error']['message'] );
		}

		if( isset($response['error']) && $response['error']['code'] === '-2.EMAIL_IS_ALREADY_IN_YOUR_LIST'  ) {

			$getSubscriber = $this->callApi($method, 'list',
				array(
					'search[email]' => $email
				)
			);

			if( isset($getSubscriber['error']) ) {
				throw new SubscriptionException ( '[subscribe]: ' . $response['error']['message'] );
			}

			if( !isset($getSubscriber['list']['elements'][0]) ) {
				throw new SubscriptionException ( '[subscribe]: Подписчик с таким email адресом не существует.' );
			}

			$data = array_merge(array(
				'id' => $getSubscriber['list']['elements'][0]['id']
			), $vars);

			$response = $this->callApi($method, 'update', $data);

			if( isset($response['error']) ) {
				throw new SubscriptionException ( '[subscribe]: ' . $response['error']['message'] );
			}
		}

		return array('status' => 'pending');
	}

	/**
	 * Checks if the user subscribed.
	 */
	public function check( $identityData, $listId, $contextData ) {

		$method = 'subscribers';

		$getSubscriber = $this->callApi($method, 'list',
			array(
				'search[email]' => $identityData['email']
			)
		);

		if( isset($getSubscriber['error']) ) {
			throw new SubscriptionException ( '[check]: ' . $getSubscriber['error']['message'] );
		}

		$status = 'false';

		switch( $getSubscriber['list']['elements'][0]['state'] ) {
			case 'active':
				$status = 'subscribed';
				break;
			case 'activation':
				$status = 'pending';
				break;
		}

		return array('status' => $status);
	}

	/**
	 * Returns custom fields.
	 */
	public function getCustomFields( $listId ) {

		$defaultFields = array(
			array(
				'name'  => 'first_name',
				'title' => 'Имя',
				'type'  => 'text'
			),
			array(
				'name'  => 'last_name',
				'title' => 'Фамилия',
				'type'  => 'text'
			),
			array(
				'name'  => 'middle_name',
			    'title' => 'Отчество',
				'type'  => 'text'
			),
			array(
				'name'  => 'city',
				'title' => 'Город',
				'type'  => 'text'
			),
			array(
				'name'  => 'address',
				'title' => 'Адрес',
				'type'  => 'text'
			),
			array(
				'name'  => 'homepage',
				'title' => 'Сайт',
				'type'  => 'text'
			),
			array(
				'name'  => 'phones',
				'title' => 'Телефон',
				'type'  => 'text'
			)
		);

		$customFields = array();
		$mappingRules = array(
			'text' => array('text', 'checkbox', 'hidden')
		);

		foreach( $defaultFields as $mergeVars ) {
			$fieldType = $mergeVars['type'];
			$pluginFieldType = isset( $mappingRules[$fieldType] ) ? $mappingRules[$fieldType] : strtolower( $fieldType );

			$can = array(
				'changeType'     => true,
				'changeReq'      => true,
				'changeDropdown' => false,
				'changeMask'     => true
			);

			$fieldOptions = array();

			$customFields[] = array(

				'fieldOptions' => $fieldOptions,
				'mapOptions' => array(
					'req'        => false,
					'id'         => $mergeVars['name'],
					'name'       => $mergeVars['name'],
					'title'      => $mergeVars['title'],
					'labelTitle' => $mergeVars['title'],
					'mapTo'      => is_array( $pluginFieldType ) ? $pluginFieldType : array($pluginFieldType),
					'service'    => $mergeVars
				),

				'premissions' => array(

					'can' => $can,
					'notices' => array(
						'changeReq' => 'You can change this checkbox in your SmartResponder account.',
						'changeDropdown' => 'Please visit your SmartResponder account to modify the choices.'
					),
				)
			);
		}

		return $customFields;
	}

	//get data by method
	public function callApi( $method = null, $action = null, array $params = array() ) {

		$apiOptions = $this->initSmartResponderOptions();

		if( empty( $method ) || empty( $action ) ) {
			throw new SubscriptionException( '[callApi]: Не был передан метод или действие.' );
		}

		$params = array_merge( array(
			'action'  =>  $action,
			'format'  => 'json'
		), $params );

		if( isset($apiOptions['apiId']) ) {
			$params['api_id']  = $apiOptions['apiId'];
			$params['password'] = $apiOptions['apiSecret'];

			$gluingStr = '';
			foreach( $params as $optionName => $optionVal ) {
				$gluingStr .= $optionName."=".$optionVal.":";
			}
			$gluingStr = rtrim($gluingStr, ':');

			$params['hash'] = md5($gluingStr);
			unset($params['password']);

		} else {
			$params['api_key'] = $apiOptions['apiKey'];
		}

		$params = http_build_query( $params );
		$url = "http://api.smartresponder.ru/" . trim( $method ) . ".html?" . $params;

		$options = array(
			CURLOPT_URL            => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => 0,
		);

		$ch = curl_init();
		curl_setopt_array( $ch, $options );
		$result = curl_exec( $ch );

		if( $result == false ) {
			throw new Exception( curl_error( $ch ) );
		}
		curl_close( $ch );

		$final = json_decode( $result, true );

		if( empty( $final ) ) {
			throw new SubscriptionException('[callApi]: Запрос завершился не удачей, произошла неизвестная ошибка.');
		}

		return $final;
	}
}
