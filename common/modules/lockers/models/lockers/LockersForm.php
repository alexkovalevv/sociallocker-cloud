<?php
	/**
	 * Мультимодель редактирования замков.
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */

	namespace common\modules\lockers\models\lockers;

	use Yii;
	use yii\base\Exception;
	use yii\helpers\ArrayHelper;
	use yii\helpers\Json;
	use common\modules\lockers\models\lockers\Lockers;
	use common\base\MultiModel;

	class LockersForm extends MultiModel {

		public function setMultiModel($model)
		{
			if( $model === null ) {
				return false;
			}

			foreach($this->models as $k => $m) {
				$m->attributes = ArrayHelper::merge($model->attributes, Json::decode($model->options));
			}

			return true;
		}


		/**
		 * Сохраняет данные текущей модели
		 * @param $type - передается тип замка в формате string
		 *
		 * @return bool|Exception
		 */
		public function saveMultiModel($type, $model = null, $draft = false, $runValidation = true)
		{

			if( !$draft && $runValidation && !$this->validate() ) {
				return false;
			}

			$optionFilter = ['title', 'type', 'status'];

			if( empty($model) ) {
				$model = new Lockers();
			}

			$data = [];
			foreach($this->models as $k => $m) {

				if( $draft && method_exists($m, 'attributeDefaults') ) {
					$m->attributes = array_merge($m->attributes, $m->attributeDefaults());
				}

				$data = array_merge($data, $m->attributes);
			}

			$model->title = $data['title'];
			$model->type = $type;
			$model->status = $data['status'];
			$model->user_id = Yii::$app->user->getId();

			$sites_model = Yii::$app->userSites->getSelected();
			$model->site_id = $sites_model->id;

			$locker_options = [];
			foreach($data as $key => $attr) {
				if( !in_array($key, $optionFilter) ) {
					$locker_options[$key] = $attr;
				}
			}

			$model->options = json_encode($locker_options);

			if( $draft ) {
				return $model->save(true);
			}

			return $model->save();
		}
	}
