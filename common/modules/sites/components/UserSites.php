<?php

	/**
	 * Предоставляет возможность получить настройки сайтов пользователей
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */
	namespace common\modules\sites\components;

	use common\modules\sites\models\Sites;
	use common\modules\sites\models\SitesForm;
	use yii;
	use yii\base\Component;
	use yii\caching\DbDependency;
	use yii\helpers\ArrayHelper;

	class UserSites extends Component {

		/**
		 * @var int время хранения кеша
		 */
		public $cachingDuration = 300;

		/**
		 * Получает все модели сайтов согасно условиям
		 * @param array $filters
		 * @return null|object
		 */
		public function getSites(array $filters = [])
		{
			return $this->getModels($filters);
		}

		/**
		 * Получает модель сайта пользователя
		 * @param integer $site_id
		 * @return object|null common\modules\sites\models\Sites
		 */
		public function getSite($site_id)
		{
			return $this->getModels(['id' => $site_id], true);
		}

		/**
		 * Получает модель сайта по id замка
		 * @param integer $locker_id
		 * @return object|null common\modules\sites\models\Sites
		 */
		public function getSiteByLockerId($locker_id)
		{
			$locker = Yii::$app->locker->getLocker($locker_id);

			if( empty($locker->site_id) ) {
				return null;
			}

			return $this->getModels(['id' => $locker->site_id], true);
		}

		/**
		 * Получает текущую выбранную модель сайта
		 * @param integer $user_id
		 * @return object|null common\modules\sites\models\Sites
		 */
		public function getSelected($user_id = null)
		{
			$model = $this->getModels([
				'user_id' => $user_id,
				'selected' => SitesForm::SELECTED
			], true);

			if( empty($model) ) {
				return null;
			}

			return $model;
		}

		/**
		 * Получает id текущей выбранной модели сайта
		 * @param integer $user_id
		 * @return object|null common\modules\sites\models\Sites
		 */
		public function getSelectedId($user_id = null)
		{
			$model = $this->getSelected($user_id);

			if( empty($model) ) {
				return null;
			}

			return $model->id;
		}

		/**
		 * Устанавливает модель сайта в статус выбранный
		 * @param $site_id
		 * @return bool
		 */
		public function setSelected($site_id)
		{
			$model = $this->getSite($site_id);

			if( empty($model) || $model->status === SitesForm::STATUS_DEACTIVE ) {
				return false;
			}

			Sites::updateAll(['selected' => SitesForm::NOT_SELECTED], ['user_id' => Yii::$app->user->getId()]);

			$model->selected = SitesForm::SELECTED;

			if( $model->save() ) {
				return true;
			}

			return false;
		}

		/**
		 * Получает все модели сайтов пользователя
		 * @param array $filters условие выборки
		 * @param boolean $one если true, результат выборки будет одна строка
		 * @return object|null common\modules\sites\models\Sites
		 * @throws \Exception
		 */
		public function getModels(array $filters = [], $one = false)
		{

			$db = Yii::$app->db;
			$dep = new DbDependency();

			if( !isset($filters['user_id']) || empty($filters['user_id']) ) {
				$filters['user_id'] = Yii::$app->user->getId();

				if( empty($filters['user_id']) ) {
					return null;
				}
			}

			$dep->sql = "SELECT COUNT(*) FROM sites WHERE user_id = '{$filters['user_id']}'";

			$result = $db->cache(function ($db) use ($filters, $one) {
				if( $one ) {
					return Sites::find()->where($filters)->one();
				}

				return Sites::find()->where($filters)->all();
			}, 300);

			return $result;
		}
	}
