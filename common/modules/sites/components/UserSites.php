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

	class UserSites extends Component {

		/**
		 * Получает модель сайта пользователя
		 * @param $condition site_id или условие выборки array
		 * @return object|null common\modules\sites\models\Sites
		 * @throws \Exception
		 */
		public function getModel($condition)
		{
			$db = Yii::$app->db;

			$result = $db->cache(function ($db) use ($condition) {
				if( is_array($condition) ) {
					Sites::find()->where($condition)->one();
				}

				return Sites::findOne($condition);
			}, 1800);

			return $result;
		}

		/**
		 * Получает модель сайта пользователя
		 * @param $site_id
		 * @return object|null common\modules\sites\models\Sites
		 */
		public function getSite($site_id)
		{
			return $this->getModel($site_id);
		}

		/**
		 * Получает модель сайта по id замка
		 * @param $locker_id
		 * @return object|null common\modules\sites\models\Sites
		 */
		public function getSiteByLockerId($locker_id)
		{
			$locker = Yii::$app->locker->getLocker($locker_id);

			if( empty($locker->site_id) ) {
				return null;
			}

			return $this->getModel($locker->site_id);
		}

		/**
		 * Получает текущую выбранную модель сайта
		 * @return object|null common\modules\sites\models\Sites
		 */
		public function getSelected()
		{
			return $this->getModel([
				'user_id' => Yii::$app->user->getId(),
				'selected' => SitesForm::SELECTED
			]);
		}

		/**
		 * Устанавливает модель сайта в статус выбранный
		 * @param $site_id
		 * @return bool
		 */
		public function setSelected($site_id)
		{
			Sites::updateAll(['selected' => SitesForm::NOT_SELECTED], ['user_id' => Yii::$app->user->getId()]);

			$model = $this->getModel($site_id);
			$model->selected = SitesForm::SELECTED;

			if( $model->save() ) {
				return true;
			}

			return false;
		}
	}
