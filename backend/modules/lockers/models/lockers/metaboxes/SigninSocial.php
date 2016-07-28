<?php
/**
 * Модель настройки кнопок авторизации. Является частью мультимодели редактирования замков.
 * @author Alex Kovalev <alex.kovalevv@gmail.com> 
 */

namespace backend\modules\lockers\models\lockers\metaboxes;

use Yii;
use yii\base\Model;

class SigninSocial extends Model
{
	// Активации кнопки facebook
	public $facebook_available;

	// Активация подписки через кнопку facebook
	public $facebook_lead_available;

	// Активации кнопки twitter
	public $twitter_available;

	// Активации подписки через кнопку twitter
	public $twitter_lead_available;

	// Активации кнопки google
	public $google_available;

	// Активация подписки через кнопку google
	public $google_lead_available;

	// Активации кнопки linkedin
	public $linkedin_available;

	// Активация подписки через кнопку linkedin
	public $linkedin_lead_available;

	// Активация кнопки вконтакте
	public $vk_available;

	// Активация подписки через кнопку вконтакте
	public $vk_lead_available;

	public function rules()
	{
		return [
			[[
				 'facebook_available',
				 'facebook_lead_available',
				 'twitter_available',
				 'twitter_lead_available',
				 'google_available',
				 'google_lead_available',
				 'linkedin_available',
				 'linkedin_lead_available',
				 'vk_available',
				 'vk_lead_available'
			 ], 'integer'],
			[[
				 'facebook_available',
				 'facebook_lead_available',
				 'twitter_available',
				 'twitter_lead_available',
				 'google_available',
				 'google_lead_available',
				 'linkedin_available',
				 'linkedin_lead_available',
				 'vk_available',
				 'vk_lead_available'
			 ], 'filter', 'filter' => function($value) {return empty($value) ? false : true;}]
		];
	}

	public function attributeLabels() {
		return [
			'facebook_available'      => 'Активна',
			'facebook_lead_available' => 'Сохранять email адрес',
			'twitter_available'       => 'Активна',
			'twitter_lead_available'  => 'Сохранять email адрес',
			'google_available'        => 'Активна',
			'google_lead_available'   => 'Сохранять email адрес',
			'linkedin_available'      => 'Активна',
			'linkedin_lead_available' => 'Сохранять email адрес',
			'vk_available'            => 'Активна',
			'vk_lead_available'       => 'Сохранять email адрес',
		];
	}

	public function attributeHints() {
		return [
			'facebook_available'      => 'Нажмите Вкл, чтобы активировать кнопку.',
			'facebook_lead_available' => 'Это действие получает электронную почту и некоторые другие личные данные пользователя и сохраняет их в базе данных.',
			'twitter_available'       => 'Нажмите Вкл, чтобы активировать кнопку.',
			'twitter_lead_available'  => 'Это действие получает электронную почту и некоторые другие личные данные пользователя и сохраняет их в базе данных.',
			'google_available'        => 'Нажмите Вкл, чтобы активировать кнопку.',
			'google_lead_available'   => 'Это действие получает электронную почту и некоторые другие личные данные пользователя и сохраняет их в базе данных.',
			'linkedin_available'      => 'Нажмите Вкл, чтобы активировать кнопку.',
			'linkedin_lead_available' => 'Это действие получает электронную почту и некоторые другие личные данные пользователя и сохраняет их в базе данных.',
			'vk_available'            => 'Нажмите Вкл, чтобы активировать кнопку.',
			'vk_lead_available'       => 'Это действие получает электронную почту и некоторые другие личные данные пользователя и сохраняет их в базе данных.',
		];
	}

	/**
	 * Значения полей по умолчанию. Если элемента массива не существует, то возвращается false или null.
	 * @return array
	 */
	public function attributeDefaults() {
		return [
			'facebook_available'      => false,
			'facebook_lead_available' => true,
			'twitter_available'       => true,
			'twitter_lead_available'  => true,
			'google_available'        => true,
			'google_lead_available'   => true,
			'linkedin_available'      => false,
			'linkedin_lead_available' => true,
			'vk_available'            => true,
			'vk_lead_available'       => true
		];
	}

}
