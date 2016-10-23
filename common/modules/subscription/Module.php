<?php

	namespace common\modules\subscription;

	use Yii;

	class Module extends \yii\base\Module {

		public function init()
		{
			$this->params['confirmation_url'] = '@frontendUrl/api/client/subscribe_confirmation';
			parent::init();
		}
	}
