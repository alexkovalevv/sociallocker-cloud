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
		public function handleRequest()
		{

			if( !isset($_REQUEST['opandaRequestType']) || !isset($_REQUEST['opandaService']) ) {
				throw new HandlerInternalException('Invalid request. The "opandaRequestType" or "opandaService" are not defined.');
			}

			if( !isset($_REQUEST['opandaContextData']) || empty($_REQUEST['opandaContextData']) ) {
				throw new HandlerInternalException('Invalid request. The "opandaContextData" are not defined.');
			}

			$lockerId = isset($_REQUEST['opandaContextData']['lockerId'])
				? intval($_REQUEST['opandaContextData']['lockerId'])
				: null;

			if( empty($lockerId) ) {
				throw new HandlerInternalException('Invalid locker id.');
			}

			$serviceName = Yii::$app->lockersSettings->getOne('subscription_to_service', 'none', ['locker_id' => $lockerId]);

			if( empty($serviceName) || $_REQUEST['opandaService'] !== $serviceName ) {
				throw new HandlerInternalException(sprintf('Invalid subscription service "%s".', $serviceName));
			}

			$service = SubscriptionServices::getService($serviceName);

			// - request type

			$requestType = strtolower($_REQUEST['opandaRequestType']);
			$allowed = ['check', 'subscribe'];

			if( !in_array($requestType, $allowed) ) {
				throw new HandlerInternalException(sprintf('Invalid request. The action "%s" not found.', $requestType));
			}

			// - identity data

			$identityData = isset($_REQUEST['opandaIdentityData'])
				? $_REQUEST['opandaIdentityData']
				: [];
			$identityData = $this->normilizeValues($identityData);

			if( empty($identityData['email']) ) {
				throw new HandlerException('Unable to subscribe. The email is not specified.');
			}

			// - service data

			$serviceData = isset($_REQUEST['opandaServiceData'])
				? $_REQUEST['opandaServiceData']
				: [];
			$serviceData = $this->normilizeValues($serviceData);

			// - context data

			$contextData = isset($_REQUEST['opandaContextData'])
				? $_REQUEST['opandaContextData']
				: [];
			$contextData = $this->normilizeValues($contextData);

			// - list id

			$listId = isset($_REQUEST['opandaListId'])
				? $_REQUEST['opandaListId']
				: null;
			if( empty($listId) ) {
				throw new HandlerException('Unable to subscribe. The list ID is not specified.');
			}

			// - double opt-in

			$doubleOptin = isset($_REQUEST['opandaDoubleOptin'])
				? $_REQUEST['opandaDoubleOptin']
				: true;
			$doubleOptin = $this->normilizeValue($doubleOptin);

			// - confirmation

			$confirm = isset($_REQUEST['opandaConfirm'])
				? $_REQUEST['opandaConfirm']
				: true;
			$confirm = $this->normilizeValue($confirm);

			// verifying user data if needed while subscribing
			// works for social subscription

			$verified = false;
			$mailServiceInfo = SubscriptionServices::getServiceInfo();
			$modes = $mailServiceInfo['modes'];

			if( 'subscribe' === $requestType ) {

				if( $doubleOptin && in_array('quick', $modes) ) {
					$verified = $this->verifyUserData($identityData, $serviceData);
				}
			}

			$identityData = $this->prepareDataToSave($service, $lockerId, $identityData);
			$serviceReadyData = $this->mapToServiceIds($service, $lockerId, $identityData);
			$identityData = $this->mapToCustomLabels($service, $lockerId, $identityData);

			// checks if the subscription has to be procces via WP
			$subscribeMode = Yii::$app->locker->getOption($lockerId, 'subscribe_mode', 'quick');

			//$subscribeDelivery = get_post_meta($lockerId, 'subscribe_delivery', true);
			$subscribeDelivery = false;

			$isWpSubscription = false;

			if( $service->hasSingleOptIn() && in_array($subscribeMode, [
					'double-optin',
					'quick-double-optin'
				]) && ($service->isTransactional() || $subscribeDelivery == 'wordpress')
			) {

				$isWpSubscription = true;
			}

			// creating subscription service

			try {

				$result = [];

				if( 'subscribe' === $requestType ) {

					if( $isWpSubscription ) {

						// if the use signes in via a social network and we managed to confirm that the email is real,
						// then we can skip the confirmation process

						if( $verified ) {
							//Leads::add( $identityData, $contextData, true, true );
							return $service->subscribe($serviceReadyData, $listId, false, $contextData, $verified);
						} else {
							//$result = $service->wpSubscribe( $identityData, $serviceReadyData, $contextData, $listId, $verified );
						}
					} else {
						$result = $service->subscribe($serviceReadyData, $listId, $doubleOptin, $contextData, $verified);
					}

					LeadsHelper::subscribe(($result && isset($result['status']))
						? $result['status']
						: 'error', $identityData, $contextData, $isWpSubscription);
				} elseif( 'check' === $requestType ) {

					if( $isWpSubscription ) {
						//$result = $service->wpCheck( $identityData, $serviceReadyData, $contextData, $listId, $verified );
					} else {
						$result = $service->check($serviceReadyData, $listId, $contextData);
					}

					LeadsHelper::subscribe(($result && isset($result['status']))
						? $result['status']
						: 'error', $identityData, $contextData, $isWpSubscription);
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
			} catch( Exception $ex ) {
				throw new HandlerException($ex->getMessage());
			}
		}
	}
