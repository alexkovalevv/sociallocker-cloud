<?php
	namespace common\models;

	use Yii;
	use yii\helpers\Json;
	use common\base\MultiModel;
	use common\modules\lockers\models\settings\Settings;

	class SettingsForm extends MultiModel {

		public function setMultiModel($model)
		{
			if( $model === null ) {
				return false;
			}

			foreach($this->models as $k => $m) {
				$m->attributes = Json::decode($model->value);
			}

			return true;
		}

		public function saveMultiModel($section, $runValidation = true)
		{
			if( $runValidation && !$this->validate() ) {
				return false;
			}

			$data = [];
			foreach($this->models as $k => $m) {
				$data = array_merge($data, $m->attributes);
			}

			return Yii::$app->settings->updateModel($section, $data);
		}
	}
