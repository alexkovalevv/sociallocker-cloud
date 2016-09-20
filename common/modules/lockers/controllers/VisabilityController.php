<?php
/**
 * Контроллер управляет отображением замка на фронтенде пользователей.
 * @author Alex Kovalev <alex.kovalevv@gmail.com>
 */
namespace common\modules\lockers\controllers;

use common\modules\lockers\models\lockers\Lockers;
use Yii;
use yii\web\Controller;
use common\modules\lockers\models\visability\EditConditions;

class VisabilityController extends Controller {
	public function actionIndex() {
		$model = new EditConditions();

		$lockers_model = new Lockers();
		$lockers = $lockers_model->find()->where( [
			'user_id' => Yii::$app->user->identity->id,
			'status'  => 'public'
		] )->all();

		$lockers_list = [];
		foreach( $lockers as $locker ) {
			$lockers_list[] = [
				'value' => $locker->id,
				'text'  => $locker->title
			];
		}

		if( $model->load( Yii::$app->request->post()) && $model->save() ) {
			Yii::$app->session->setFlash( 'alert', [
				'body'    => 'Настройки успешно обновлены!',
				'options' => ['class' => 'alert alert-success']
			] );

			//return $this->refresh();
		}

		return $this->render( 'index', [
			'filters'   => $this->getVisibilityFilters(),
			'templates' => $this->getVisibilityTemplates(),
			'model'     => $model,
			'lockers'   => $lockers_list
		] );
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
