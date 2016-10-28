<?php
	/**
	 * Контроллер отвечает за выдачу настроек замков и статистику
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */

	namespace frontend\modules\api\controllers;

	use common\modules\lockers\classes\LockersTools;
	use Yii;
	use yii\helpers\ArrayHelper;
	use yii\helpers\Url;
	use yii\web\Controller;
	use yii\web\Response;

	use common\modules\lockers\models\stats\StatActions;
	use common\modules\lockers\models\stats\StatImpress;
	use common\modules\lockers\models\stats\StatSkips;
	use common\modules\lockers\models\stats\StatUnlocks;

	class LockersController extends Controller {

		public function behaviors()
		{
			return [
				[
					'class' => 'yii\filters\PageCache',
					'only' => ['get-options'],
					'duration' => 1800,
					'variations' => [
						Yii::$app->request->get('client_id'),
						Yii::$app->request->get('site_id'),
					],
					'dependency' => [
						'class' => 'yii\caching\DbDependency',
						'sql' => "SELECT GREATEST(MAX(lv.updated_at), MAX(l.updated_at)) FROM lockers l LEFT JOIN lockers_visability lv ON lv.locker_id = l.id WHERE user_id='" . Yii::$app->request->get('client_id') . "'",
					],
				]
			];
		}

		public function setModelSchemaDefault($model, $param)
		{
			$model->locker_id = ArrayHelper::getValue($param['context'], 'locker_id');
			$model->aggregate_date = date('d.m.Y');
			$model->page_title = ArrayHelper::getValue($param['context'], 'page_title', '');
			$model->page_url_hash = md5(ArrayHelper::getValue($param['context'], 'page_url', ''));
			$model->page_url = ArrayHelper::getValue($param['context'], 'page_url', '');

			if( !$model->newUpdate() ) {
				return ['error' => 'Произошла неизвестная ошибка во время сохранения данных.'];
			}

			return ['success' => 'Данные успешно обновлены'];
		}

		public function actionStat()
		{
			$headers = Yii::$app->response->headers;
			$headers->add('Access-Control-Allow-Origin', '*');
			$headers->add('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');

			Yii::$app->response->format = Response::FORMAT_JSON;

			$param = Yii::$app->request->getBodyParams();

			if( empty($param) || (!isset($param['stats']) || !isset($param['context'])) ) {
				return ['error' => 'Переданы некорректные параметры запросы'];
			}
			switch( $param['stats']['eventName'] ) {
				case 'impress':

					$impress_model = new StatImpress();

					return $this->setModelSchemaDefault($impress_model, $param);
					break;
				case 'skip':

					$skips_model = new StatSkips();
					$skips_model->channel_name = ArrayHelper::getValue($param['stats'], 'channel_name');

					return $this->setModelSchemaDefault($skips_model, $param);
					break;
				case 'unlock':
					$unlock_model = new StatUnlocks();

					$locker_id = ArrayHelper::getValue($param['context'], 'locker_id');
					$service_name = ArrayHelper::getValue($param['stats'], 'service');
					$channel_name = ArrayHelper::getValue($param['stats'], 'channel_name');

					$unlock_model->locker_id = $locker_id;
					$unlock_model->service = $service_name;
					$unlock_model->oauth_client_id = ArrayHelper::getValue($param['stats'], 'oauth_client_id', 0);
					$unlock_model->page_title = ArrayHelper::getValue($param['context'], 'page_title', '');
					$unlock_model->page_url_hash = md5(ArrayHelper::getValue($param['context'], 'page_url', ''));
					$unlock_model->page_url = ArrayHelper::getValue($param['context'], 'page_url', '');
					$unlock_model->referrer = ArrayHelper::getValue($param['context'], 'referrer', '');
					$unlock_model->user_agent = Yii::$app->request->userAgent;
					$unlock_model->ip = Yii::$app->request->userIP;

					if( $unlock_model->save(true) ) {
						$interal_error = false;
						$locker = Yii::$app->locker->getLocker($locker_id);

						$actions[] = $channel_name;

						if( !empty($locker) && $locker->type === 'signinlocker' ) {
							$actions = [];
							$group_actions = Yii::$app->locker->getOption($locker_id, $service_name . '_actions');

							if( !empty($group_actions) && is_array($group_actions) ) {
								foreach($group_actions as $group_action) {
									$actions[] = $service_name . '-' . $group_action;
								}
							}
						}

						if( !empty($actions) ) {
							foreach($actions as $action) {
								$actions_model = new StatActions();

								$actions_model->locker_id = $locker_id;
								$actions_model->unlock_id = $unlock_model->id;
								$actions_model->channel_name = $action;
								$actions_model->channel_value = ArrayHelper::getValue($param['stats'], 'channel_value', '');
								$actions_model->status = StatActions::STATUS_ACTIVE;

								if( !$actions_model->save(true) ) {
									$interal_error = true;
								}
							}
						}

						if( !$interal_error ) {
							return ['success' => 'Данные успешно обновлены'];
						}
					}

					var_dump($unlock_model->getErrors());

					return ['error' => 'Произошла неизвестная ошибка. Данные по просмотрам не добавлены!'];

					break;
			}

			return $param;
		}

		public function actionGetOptions($site_id)
		{
			$headers = Yii::$app->response->headers;
			$headers->add('Access-Control-Allow-Origin', '*');
			$headers->add('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');
			Yii::$app->response->format = Response::FORMAT_HTML;

			$options = [];

			$lockers = Yii::$app->locker->getLockers([
				'site_id' => $site_id,
				'status' => 'public'
			]);

			foreach($lockers as $locker) {

				$visability_options = $locker->lockersVisability;
				$old_locker_options = json_decode($locker->options, true);

				if( !empty($old_locker_options['buttons_order']) ) {
					$old_locker_options['buttons_order'] = explode(',', $old_locker_options['buttons_order']);
				}

				// создаем карту опций для замка
				$locker_tools = new LockersTools();
				$locker_options = $locker_tools->mapLockerOptions($old_locker_options, $locker->type);

				$locker_options['id'] = $locker->id;
				$locker_options['proxy'] = Url::to(['@proxyUrl'], true);

				if( $locker->type == 'emaillocker' || $locker->type == 'signinlocker' ) {
					$service_name = Yii::$app->settings->getUserOption($locker->user_id, 'subscription_to_service');

					if( !empty($service_name) ) {
						$locker_options['subscribeActionOptions']['service'] = $service_name;

						$subscribe_mode = ArrayHelper::getValue($old_locker_options, 'subscribe_mode', false);

						if( $locker->type == 'emaillocker' || $subscribe_mode === true ) {
							$double_option = in_array($old_locker_options['subscribe_mode'], [
								'quick-double-optin',
								'double-optin'
							]);
							$locker_options['subscribeActionOptions']['doubleOptin'] = $double_option;

							$confirm = $old_locker_options['subscribe_mode'] == 'double-optin';
							$locker_options['subscribeActionOptions']['confirm'] = $confirm;
						}
					}
				}

				$locker_options['groups'] = ['social-buttons'];

				if( $locker->type === 'signinlocker' ) {
					$locker_options['groups'] = ['connect-buttons'];
				} else if( $locker->type === 'emaillocker' ) {

					$locker_options['groups'] = ['subscription'];
					$sbcr_allow_social = ArrayHelper::getValue($old_locker_options, 'subscribe_allow_social', false);

					if( $sbcr_allow_social === true ) {
						$sbcr_social_buttons = ArrayHelper::getValue($old_locker_options, 'subscribe_social_buttons', []);

						if( sizeof($sbcr_social_buttons) ) {
							$locker_options['connectButtons']['order'] = [];
							$locker_options['groups'] = ['subscription', 'connect-buttons'];

							foreach($old_locker_options['subscribe_social_buttons'] as $val) {

								$locker_options['connectButtons'][$val]['actions'][] = 'subscribe';
								$locker_options['connectButtons']['order'][] = $val;
							}
						}
					}

					$locker_options['subscription']['order'] = ['form'];
				}

				if( !empty($visability_options->conditions) ) {
					$conditions = json_decode($visability_options->conditions, true);
					$locker_options['locker']['visibility'] = $conditions;
				}

				if( $visability_options->way_lock == 'html' ) {
					$locker_options['content'] = $visability_options->hidden_content;
				}

				$dependPages = !empty($visability_options->pages)
					? json_decode($visability_options->pages)
					: [];

				if( empty($dependPages) ) {
					continue;
				}

				$options['lockers'][] = [
					'id' => $locker->id,
					'type' => $locker->type,
					'dependPaths' => $dependPages,
					'visabilityOptions' => [
						'lockType' => $visability_options->lock_type,
						'whenShow' => $visability_options->when_show,
						'selector' => $visability_options->lock_selector,
						'targetSelector' => $visability_options->target_selector,
						'start' => $visability_options->delay,
					],
					'lockerOptions' => $locker_options,
				];
			}

			$options_output = json_encode($options);

			if( empty($options_output) ) {
				$options_output = '{}';
			}

			$js = 'if(!window._onpwgt)window._onpwgt={};window._onpwgt.options = ' . $options_output . ';';

			echo $js;
		}

		public function beforeAction($action)
		{
			$this->enableCsrfValidation = false;

			return parent::beforeAction($action);
		}
	}