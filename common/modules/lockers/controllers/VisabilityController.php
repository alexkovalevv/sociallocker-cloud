<?php
	/**
	 * Контроллер управляет отображением замка на фронтенде пользователей.
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */
	namespace common\modules\lockers\controllers;

	use Yii;
	use yii\web\Controller;
	use common\modules\lockers\models\visability\EditConditions;
	use common\modules\lockers\models\lockers\Lockers;

	class VisabilityController extends Controller {

		public function actionEdit($locker_id)
		{

			$model = new EditConditions();

			if( !($visability_model = $model->setModel($locker_id)) ) {
				return $this->redirect(['index']);
			}

			if( $model->load(Yii::$app->request->post()) && $model->save(true, $visability_model) ) {
				Yii::$app->session->setFlash('alert', [
					'body' => 'Настройки успешно сохранены!',
					'options' => ['class' => 'alert alert-success']
				]);

				return $this->redirect(['default/index']);
			}

			return $this->render('edit', [
				'filters' => $this->getVisibilityFilters(),
				'templates' => $this->getVisibilityTemplates(),
				'model' => $model
			]);
		}

		public function actionCreate($locker_id)
		{
			$model = new EditConditions();

			if( empty($locker_id) ) {
				return $this->redirect(['index']);
			}

			$model->locker_id = $locker_id;

			// Создаем черновик
			if( $model->save(true, null, true) ) {
				return $this->redirect(['visability/edit?locker_id=' . $locker_id]);
			} else {
				Yii::$app->session->setFlash('alert', [
					'body' => 'Возникла не известная ошибка при создании замка!',
					'options' => ['class' => 'alert alert-danger']
				]);
			}
		}

		/*public function actionDelete($id) {
			$model = EditConditions::getModel($id);
			if( empty($model) ) return $this->redirect('index');

			$model->delete();
			return $this->redirect('index');
		}*/

		public function getVisibilityFilters()
		{
			// filter parameters
			$groupedFilterParams = [
				[
					'id' => 'user',
					'title' => 'Пользователи',
					'items' => [
						[
							'id' => 'user-country',
							'title' => 'Страна пользователя',
							'type' => 'select',
							'values' => [
								[
									'value' => 'RU',
									'title' => 'Россия'
								],
								[
									'value' => 'US',
									'title' => 'США'
								],
								[
									'value' => 'EN',
									'title' => 'Англия'
								],
								[
									'value' => 'UA',
									'title' => 'Украина'
								],
							],
							'description' => 'Страна из которой пользователь просматривает ваш сайт.'
						],
						[
							'id' => 'user-mobile',
							'title' => 'Мобильное устройство',
							'type' => 'select',
							'values' => [
								[
									'value' => 'yes',
									'title' => 'Да'
								],
								[
									'value' => 'no',
									'title' => 'Нет'
								]
							],
							'description' => "Определяет, просматривает ли пользователь ваш сайт с мобильного устройства или нет."
						],
					]
				],
				[
					'id' => 'location',
					'title' => 'Перемещение',
					'items' => [
						[
							'id' => 'location-referrer',
							'title' => 'Откуда пришел',
							'type' => 'text',
							'description' => 'URL страницы или его часть, с которой пришел пользователь.'
						]
					]
				],
				[
					'id' => 'session',
					'title' => 'Активность',
					'items' => [
						[
							'id' => 'page-views',
							'title' => 'Просмотрено страниц',
							'type' => 'integer',
							'description' => 'Общее количество просмотров страниц, совершенных пользователем за месяц.'
						],
						[
							'id' => 'locker-21-impress',
							'title' => 'Просмотров замка',
							'type' => 'integer',
							'description' => 'Количество просмотров страниц, где установлен замок, совершенные пользователем в течение одной текущей сессии на вашем сайте.'
						],
						[
							'id' => 'new-guest',
							'title' => 'Новый пользователь',
							'type' => 'select',
							'values' => [
								[
									'value' => 'yes',
									'title' => 'Да'
								],
								[
									'value' => 'no',
									'title' => 'Нет'
								]
							],
							'description' => 'Пользователь, который зашел первый раз на ваш сайт'
						]
					]
				]
			];

			return $groupedFilterParams;
		}

		public function getVisibilityTemplates()
		{
			// templates
			$templates = [
				[
					'id' => 'hide_for_members',
					'title' => '[Скрыть для новых пользователей]',
					'filter' => [
						'type' => 'showif',
						'conditions' => [
							[
								'type' => 'condition',
								'param' => 'new-guest',
								'operator' => 'equals',
								'value' => 'no'
							]
						]
					]
				],
				[
					'id' => 'mobile',
					'title' => '[Скрыть на мобильных]',
					'filter' => [
						'type' => 'hideif',
						'conditions' => [
							[
								'type' => 'condition',
								'param' => 'user-mobile',
								'operator' => 'equals',
								'value' => 'yes'
							]
						]
					]
				],
				[
					'id' => 'user_country',
					'title' => '[Только русскоязычной аудитории]',
					'filter' => [
						'type' => 'showif',
						'conditions' => [
							[
								'type' => 'condition',
								'param' => 'user-country',
								'operator' => 'equals',
								'value' => 'RU'
							],
							[
								'type' => 'condition',
								'param' => 'user-country',
								'operator' => 'equals',
								'value' => 'UA'
							]
						]
					]
				],
			];

			return $templates;
		}
	}
