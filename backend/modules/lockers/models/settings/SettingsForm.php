<?php
namespace backend\modules\lockers\models\settings;

use Yii;
use yii\helpers\Json;
use common\base\MultiModel;
use backend\modules\lockers\models\settings\Settings;


class SettingsForm extends MultiModel
{

	public function setMultiModel($model)
	{
		if( $model === null ) return false;

		foreach ($this->models as $k => $m ) {
			$m->attributes = Json::decode($model->value);
		}

		return true;
	}

	public function saveMultiModel($model = null, $runValidation = true) {
		if ($runValidation && !$this->validate()) {
			return false;
		}

		if( empty($model) ) $model = new Settings();

		$data = [];
		foreach ($this->models as $k => $m ) {
			$data = array_merge($data, $m->attributes);
		}

		return $model->setModel($data);
	}
}
