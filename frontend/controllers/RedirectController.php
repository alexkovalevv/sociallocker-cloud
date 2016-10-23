<?php
	/**
	 * Контроллер отвечает за перенаправления
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */

	namespace frontend\controllers;

	use Yii;
	use yii\web\Controller;

	class RedirectController extends Controller {

		public $layout = null;

		public function actionBlank()
		{
			return $this->render('blank');
		}
	}