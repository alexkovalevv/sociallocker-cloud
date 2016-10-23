<?php
/**
 * 
 * @author Alex Kovalev <alex.kovalevv@gmail.com> 
 */

namespace common\modules\subscription\backend\models;


use common\modules\subscription\common\models\Leads;
use Yii;

class LeadsRecord extends Leads{
	/**
	 * @return static
	 */
	public static function beforeCreate($model, $user_id, $site_id)
	{
		$model->user_id = empty($user_id)
			? Yii::$app->user->getId()
			: null;
		$model->site_id = empty($site_id)
			? Yii::$app->userSites->getSelectedId($model->user_id)
			: null;

		return $model;
	}
}