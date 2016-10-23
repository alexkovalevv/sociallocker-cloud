<?php
	/**
	 * Контроллер манипулирует подпиской.
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */

	namespace backend\controllers;

	use Yii;
	use yii\base\Exception;
	use yii\web\Controller;
	use yii\web\HttpException;
	use yii\web\Response;

	class SubscribeController extends Controller {

		public $cachePrefix = '_sbcr_default';
		public $cachingDuration = 900;

		/**
		 * Возвращает все доступные списки подписок.
		 *
		 * @since 1.0.0
		 * @return array
		 */
		public function actionGetLists()
		{
			if( !Yii::$app->request->isAjax ) {
				throw new HttpException('403');
			}

			Yii::$app->response->format = Response::FORMAT_JSON;

			$service_name = Yii::$app->subscription->getCurrentServiceName();

			$cacheKey = $this->getCacheKey($service_name);

			if( !Yii::$app->cache->get($cacheKey) ) {
				try {
					$service = Yii::$app->subscription->getCurrentService();
					$lists = $service->getLists();
					Yii::$app->cache->set($cacheKey, $lists, $this->cachingDuration);

					return $lists;
				} catch( Exception $ex ) {
					return ['error' => 'Unable to get the lists: ' . $ex->getMessage()];
				}
			} else {
				return Yii::$app->cache->get($cacheKey);
			}
		}

		/**
		 * Возвращает все настраиваемые поля в выбранном сервисе подписки.
		 *
		 * @since 1.0.0
		 * @return array
		 */
		public function actionGetCustomFields()
		{

			if( !Yii::$app->request->isAjax ) {
				throw new HttpException('403');
			}

			$list_id = Yii::$app->request->getQueryParam('list_id', 'none');

			Yii::$app->response->format = Response::FORMAT_JSON;
			$cacheKey = $this->getCacheKey($list_id);

			if( !Yii::$app->cache->get($cacheKey) ) {
				try {
					$service = Yii::$app->subscription->getCurrentService();

					$fields = $service->getCustomFields($list_id);

					Yii::$app->cache->set($cacheKey, $fields, $this->cachingDuration);

					return $fields;
				} catch( Exception $ex ) {
					return ['error' => $ex->getMessage()];
				}
			} else {
				return Yii::$app->cache->get($cacheKey);
			}
		}

		public function beforeAction($action)
		{
			$this->enableCsrfValidation = false;

			return parent::beforeAction($action);
		}

		/**
		 * @param $key
		 *
		 * @return array
		 */
		protected function getCacheKey($key)
		{
			return [
				__CLASS__,
				Yii::$app->user->identity->id,
				$this->cachePrefix,
				$key
			];
		}
	}
