<?php
	/**
	 * Контроллер управляет отображением замка на фронтенде пользователей.
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */
	namespace common\modules\lockers\controllers;

	use common\modules\lockers\models\lockers\Lockers;
	use common\modules\lockers\models\stats\LockersStatImpress;
	use common\modules\lockers\models\stats\LockersStatUnlock;
	use common\modules\lockers\models\visability\LockersVisability;
	use Yii;
	use yii\web\Response;
	use yii\helpers\ArrayHelper;
	use yii\helpers\Json;
	use yii\web\Controller;
	use yii\web\NotFoundHttpException;

	class ApiController extends Controller {

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

					$impress_model = new LockersStatImpress();
					$impress_model->locker_id = $param['context']['lockerId'];
					$impress_model->aggregate_date = date('d.m.Y');
					$impress_model->site_url = $param['context']['domain'];
					$impress_model->page_url_hash = md5($param['context']['pageUrl']);
					$impress_model->page_url = $param['context']['pageUrl'];

					if( !$impress_model->newUpdate() ) {
						return ['error' => 'Произошла неизвестная ошибка. Данные по просмотрам не добавлены!'];
					}

					return ['success' => 'Данные успешно обновлены'];
					break;
				case 'unlock':
					$unlock_model = new LockersStatUnlock();
					$unlock_model->locker_id = ArrayHelper::getValue($param['context'], 'lockerId');
					$unlock_model->button_name = ArrayHelper::getValue($param['stats'], 'buttonName');
					$unlock_model->network_user_id = ArrayHelper::getValue($param['stats'], 'userId', 0);
					$unlock_model->channel = ArrayHelper::getValue($param['stats'], 'channel', '');
					$unlock_model->referrer = ArrayHelper::getValue($param['context'], 'referrer', '');
					$unlock_model->user_agent = Yii::$app->request->userAgent;
					$unlock_model->ip = Yii::$app->request->userIP;
					$unlock_model->status = 1;
					if( !$unlock_model->save(true) ) {
						return ['error' => 'Произошла неизвестная ошибка. Данные по просмотрам не добавлены!'];
					}

					return ['success' => 'Данные успешно обновлены'];
					break;
			}

			return $param;
		}

		public function actionGetOptions($client_id, $site_id)
		{
			$headers = Yii::$app->response->headers;
			$headers->add('Access-Control-Allow-Origin', '*');
			$headers->add('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');
			Yii::$app->response->format = Response::FORMAT_HTML;

			$options = [];
			$lockers = Lockers::find()->where([
				'user_id' => $client_id,
				'status' => 'public'
			])->all();

			foreach($lockers as $locker) {

				$visability_options = $locker->lockersVisability;
				$locker_options = json_decode($locker->options, true);

				if( !empty($locker_options['buttons_order']) ) {
					$locker_options['buttons_order'] = explode(',', $locker_options['buttons_order']);
				}

				// создаем карту опций для замка
				$locker_options = $this->mapLockerOptions($locker_options, $locker->type);

				$locker_options['id'] = $locker->id;

				if( !empty($visability_options->conditions) ) {
					$locker_options['visibility'] = json_decode($visability_options->conditions);
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
					'dependPaths' => $dependPages,
					'visabilityOptions' => [
						'type' => $visability_options->lock_type,
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

			$js = 'if( !window.onpwgt___options ) {window.onpwgt___options = ' . $options_output . ';}';

			echo $js;
		}

		/**
		 * Собирает опции в массив по заранее установленной карте.
		 * Карта опций основана на модели принимаемых данных в
		 * jQuery версии социального замка.
		 *
		 * @return array - массив опций наложенных на карту
		 */
		public function mapLockerOptions($data, $locker_type)
		{
			$mapData = [
				'demo' => 'always',
				'theme' => 'style',
			];
			$mapData['text'] = [
				'header' => null,
				'message' => null
			];
			$mapData['overlap'] = [
				'mode' => 'overlap',
				'position' => 'overlap_position'
			];
			$mapData['effects'] = ['highlight' => null];
			$mapData['locker'] = [
				'timer' => null,
				'close' => null,
				'mobile' => null
			];

			if( $locker_type == 'emaillocker' ) {
				$mapData['subscribeActionOptions'] = [
					'listId' => 'subscribe_list',
					//'service' => 'database',
					'doubleOptin' => 'subscribe_mode'
				];
			}

			$mapData['form'] = [
				'buttonText' => 'form_button_text',
				'noSpamText' => 'form_after_button_text',
				'type' => 'form_type',
			];

			if( $locker_type == 'signinlocker' ) {
				$mapData['connectButtons'] = [
					'order' => 'buttons_order',
					'facebook' => [
						'actions' => 'facebook_actions',
						'version' => 'facebook_version',
					],
					'twitter' => [
						'actions' => 'twitter_actions',
						'follow' => [
							'user' => 'twitter_follow_user',
							'notifications' => 'twitter_follow_notifications',
						],
						'tweet' => [
							'message' => 'twitter_tweet_message'
						],
					],
					'google' => [
						'actions' => 'google_actions',
						'channelId' => 'google_youtube_subscribe_channel_id',
					],
					'linkedin' => [
						'actions' => 'linkedin_actions'
					],
					'vk' => [
						'actions' => 'vk_actions'
					]
				];
			}

			if( $locker_type == 'sociallocker' ) {
				$mapData['socialButtons'] = [
					'counters' => null,
					'order' => 'buttons_order',
					'facebook' => [
						'lang' => null,
						'version' => null,
						'like' => [
							'url' => 'facebook_like_url',
							'title' => 'facebook_like_title',
						],
						'share' => [
							'shareDialog' => 'facebook_share_dialog',
							'url' => 'facebook_share_url',
							'title' => 'facebook_share_title',
							'name' => 'facebook_share_message_name',
							'caption' => 'facebook_share_message_caption',
							'description' => 'facebook_share_message_description',
							'image' => 'facebook_share_message_image',
						]
					],
					'twitter' => [
						'lang' => null,
						'tweet' => [
							'url' => 'twitter_tweet_url',
							'text' => 'twitter_tweet_text',
							'title' => 'twitter_tweet_title',
							'doubleCheck' => 'twitter_tweet_auth',
							'via' => 'twitter_tweet_via'
						],
						'follow' => [
							'url' => 'twitter_follow_url',
							'title' => 'twitter_follow_title',
							'doubleCheck' => 'twitter_follow_auth',
							'hideScreenName' => 'twitter_follow_hide_name',
						]
					],
					'google' => [
						'plus' => [
							'url' => 'google_plus_url',
							'title' => 'google_plus_title',
						],
						'share' => [
							'url' => 'google_share_url',
							'title' => 'google_share_title',
						]
					],
					'youtube' => [
						'subscribe' => [
							'channelId' => 'google_youtube_channel_id',
							'title' => 'google_youtube_title',
						],
					],
					'linkedin' => [
						'share' => [
							'url' => 'linkedin_share_url',
							'title' => 'linkedin_share_title',
						],
					],
					'vk' => [
						'lang' => null,
						'like' => [
							'pageTitle' => 'vk_like_message_title',
							'pageDescription' => 'vk_like_message_description',
							'pageUrl' => 'vk_like_url',
							'pageImage' => 'vk_like_message_image',
							'text' => 'vk_like_message_caption',
							'title' => 'vk_like_title',
							'requireSharing' => 'vk_like_require_sharing',
						],
						'share' => [
							'pageUrl' => 'vk_share_url',
							'pageTitle' => 'vk_share_message_title',
							'pageDescription' => 'vk_share_description',
							'pageImage' => 'vk_share_message_image',
							'title' => 'vk_share_title'
						],
						'subscribe' => [
							'groupId' => 'vk_subscribe_group_id',
							'title' => 'vk_subscribe_title',
						]
					],
					'ok' => [
						'share' => [
							'url' => 'ok_share_url',
							'title' => 'ok_share_title',
						]
					],
					'mail' => [
						'share' => [
							'pageUrl' => 'mail_share_url',
							'pageDescription' => 'mail_share_message_description',
							'pageImage' => 'mail_share_message_image',
							'pageTitle' => 'mail_share_message_title',
							'title' => 'mail_share_title'
						],
					]
				];
			}

			return $this->recursivePushOptions($mapData, $data);
		}

		/**
		 * Рекурсивно заполняет массив опций по карте
		 * @param $map - карта опций
		 * @return array - массив опций наложенных на карту
		 */
		protected function recursivePushOptions($map, $data)
		{
			foreach($map as $key => $val) {
				if( !is_array($val) ) {
					if( !empty($val) ) {
						$map[$key] = isset($data[$val])
							? $data[$val]
							: null;
					} else {
						$map[$key] = isset($data[$key])
							? $data[$key]
							: null;
					}
				} else {
					$map[$key] = $this->recursivePushOptions($map[$key], $data);
				}
			}

			return $map;
		}


		public function beforeAction($action)
		{
			$this->enableCsrfValidation = false;

			return parent::beforeAction($action);
		}
	}
