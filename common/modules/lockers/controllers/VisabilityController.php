<?php
/**
 * Контроллер управляет отображением замка на фронтенде пользователей.
 * @author Alex Kovalev <alex.kovalevv@gmail.com>
 */
namespace common\modules\lockers\controllers;


use Yii;
use yii\web\Controller;
use common\modules\lockers\models\visability\EditConditions;
use common\modules\lockers\models\search\VisabilitySearch;
use common\modules\lockers\models\lockers\Lockers;

class VisabilityController extends Controller {

	public function actionEdit($locker_id)  {

		$model = new EditConditions();

		if( !($visability_model = $model->setModel($locker_id)) ) {
			return $this->redirect( ['index'] );
		}

		if( $model->load( Yii::$app->request->post()) && $model->save(true, $visability_model) ) {
			Yii::$app->session->setFlash( 'alert', [
				'body'    => 'Настройки успешно сохранены!',
				'options' => ['class' => 'alert alert-success']
			] );

			return $this->redirect(['default/index']);
		}

		return $this->render( 'edit', [
			'filters'   => $this->getVisibilityFilters(),
			'templates' => $this->getVisibilityTemplates(),
			'model'     => $model
		]);
	}

	public function actionCreate($locker_id) {
		$model = new EditConditions();

		if( empty($locker_id) ) {
			return $this->redirect( ['index'] );
		}

		$model->locker_id = $locker_id;

		// Создаем черновик
		if ( $model->save(true, null, true) ) {
			return $this->redirect( ['visability/edit?locker_id=' . $locker_id] );
		} else {
			Yii::$app->session->setFlash( 'alert', [
				'body'    => 'Возникла не известная ошибка при создании замка!',
				'options' => ['class' => 'alert alert-danger']
			] );

			var_dump($model->getErrors());

			//return $this->redirect( ['index'] );
		}


		/*if( $model->load( Yii::$app->request->post()) && $model->save(true) ) {
			Yii::$app->session->setFlash( 'alert', [
				'body'    => 'Условие успешно создано!',
				'options' => ['class' => 'alert alert-success']
			] );

			return $this->redirect('index');
		}

		return $this->render( 'edit', [
			'filters'   => $this->getVisibilityFilters(),
			'templates' => $this->getVisibilityTemplates(),
			'model'     => $model,
			'lockers'   => $this->getLockersList()
		] );*/
	}

	public function actionDelete($id) {
		$model = EditConditions::getModel($id);
		if( empty($model) ) return $this->redirect('index');

		$model->delete();

		Yii::$app->session->setFlash( 'alert', [
			'body'    => 'Плавило успешно удалено!',
			'options' => ['class' => 'alert alert-danger']
		] );

		return $this->redirect('index');
	}

	public function getVisibilityFilters() {
		// filter parameters
		$groupedFilterParams = array(
			array(
				'id'    => 'user',
				'title' => 'Пользователи',
				'items' => array(
					array(
						'id'          => 'user-country',
						'title'       => 'Страна пользователя',
						'type'        => 'select',
						'values'      => array(
							array(
								'value' => 'RU',
								'title' => 'Россия'
							),
							array(
								'value' => 'US',
								'title' => 'США'
							),
							array(
								'value' => 'EN',
								'title' => 'Англия'
							),
							array(
								'value' => 'UA',
								'title' => 'Украина'
							),
						),
						'description' => 'Страна из которой пользователь просматривает ваш сайт.'
					),
					array(
						'id'          => 'user-mobile',
						'title'       => 'Мобильное устройство',
						'type'        => 'select',
						'values'      => array(
							array(
								'value' => 'yes',
								'title' => 'Да'
							),
							array(
								'value' => 'no',
								'title' => 'Нет'
							)
						),
						'description' => "Определяет, просматривает ли пользователь ваш сайт с мобильного устройства или нет."
					),
				)
			),
			array(
				'id'    => 'location',
				'title' => 'Перемещение',
				'items' => array(
					array(
						'id'          => 'location-page',
						'title'       => 'Текущая страница',
						'type'        => 'text',
						'description' => 'URL-адрес текущей страницы или его часть, где находится пользователь, который просматривает ваш сайт.'
					),
					array(
						'id'          => 'location-referrer',
						'title'       => 'Откуда пришел',
						'type'        => 'text',
						'description' => 'URL страницы или его часть, с которой пришел пользователь.'
					)
				)
			),
			array(
				'id'    => 'session',
				'title' => 'Активность',
				'items' => array(
					array(
						'id'          => 'page-views',
						'title'       => 'Просмотрено страниц',
						'type'        => 'integer',
						'description' => 'Общее количество просмотров страниц, совершенных пользователем за месяц.'
					),
					array(
						'id'          => 'locker-21-impress',
						'title'       => 'Просмотров замка',
						'type'        => 'integer',
						'description' => 'Количество просмотров страниц, где установлен замок, совершенные пользователем в течение одной текущей сессии на вашем сайте.'
					),
					array(
						'id'          => 'new-guest',
						'title'       => 'Новый пользователь',
						'type'        => 'select',
						'values'      => array(
							array(
								'value' => 'yes',
								'title' => 'Да'
							),
							array(
								'value' => 'no',
								'title' => 'Нет'
							)
						),
						'description' => 'Пользователь, который зашел первый раз на ваш сайт'
					)
				)
			)
		);

		return $groupedFilterParams;
	}

	public function getVisibilityTemplates() {
		// templates
		$templates = array(
			array(
				'id'     => 'hide_for_members',
				'title'  => '[Скрыть для новых пользователей]',
				'filter' => array(
					'type'       => 'showif',
					'conditions' => array(
						array(
							'type'     => 'condition',
							'param'    => 'new-guest',
							'operator' => 'equals',
							'value'    => 'no'
						)
					)
				)
			),
			array(
				'id'     => 'mobile',
				'title'  => '[Скрыть на мобильных]',
				'filter' => array(
					'type'       => 'hideif',
					'conditions' => array(
						array(
							'type'     => 'condition',
							'param'    => 'user-mobile',
							'operator' => 'equals',
							'value'    => 'yes'
						)
					)
				)
			),
			array(
				'id'     => 'user_country',
				'title'  => '[Только русскоязычной аудитории]',
				'filter' => array(
					'type'       => 'showif',
					'conditions' => array(
						array(
							'type'     => 'condition',
							'param'    => 'user-country',
							'operator' => 'equals',
							'value'    => 'RU'
						),
						array(
							'type'     => 'condition',
							'param'    => 'user-country',
							'operator' => 'equals',
							'value'    => 'UA'
						)
					)
				)
			),
		);

		return $templates;
	}
}
