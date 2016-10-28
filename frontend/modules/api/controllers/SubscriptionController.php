<?php
	/**
	 * Контроллер для работы с внешними запросами от форм подписки
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 * @copyright Alex Kovalev 27.10.2016
	 * @version 1.0
	 */
	namespace frontend\modules\api\controllers;

	use common\helpers\TextFormatTools;
	use common\modules\subscription\common\models\Leads;
	use common\modules\subscription\frontend\models\LeadsRecord;
	use Yii;
	use yii\web\NotFoundHttpException;

	class SubscriptionController extends \yii\web\Controller {

		public function actionConfirmation($locker_id, $email, $confirmation_code)
		{
			$locker_id = TextFormatTools::normalizeRequestParam($locker_id);
			$locker = Yii::$app->locker->getLocker($locker_id);

			$lead_model = LeadsRecord::user($locker->user_id, $locker->site_id);
			$email = TextFormatTools::normalizeRequestParam($email);

			if( filter_var($email, FILTER_VALIDATE_EMAIL) === false ) {
				throw new NotFoundHttpException('Переданы некорректные параметры запроса.');
			}

			$lead = $lead_model->getLeadByEmail($email);

			if( empty($lead) || $lead->email_confirmed == Leads::SUBSCRIPTION_CONFIRMED ) {
				throw new NotFoundHttpException('Подписка уже подтверждена.');
			}

			$confirmation_code = TextFormatTools::normalizeRequestParam($confirmation_code);

			if( $confirmation_code != $lead->confirmation_code ) {
				throw new NotFoundHttpException('Срок службы кода активации вышел или код введен некорректно.');
			}

			$lead->email_confirmed = Leads::SUBSCRIPTION_CONFIRMED;
			$lead->subscription_confirmed = Leads::SUBSCRIPTION_CONFIRMED;
			$lead->confirmation_code = null;

			$lead->temp = null;

			if( !$lead->save(true) ) {
				throw new NotFoundHttpException('Произошка ошибка во время активации подписки.');
			}

			if( !empty($lead->page_url) ) {
				return $this->redirect($lead->page_url);
			}

			Yii::$app->session->setFlash('alert', [
				'body' => 'Подписка успешно подтверждена!',
				'options' => ['class' => 'alert alert-success']
			]);

			return $this->redirect(['/']);
		}
	}