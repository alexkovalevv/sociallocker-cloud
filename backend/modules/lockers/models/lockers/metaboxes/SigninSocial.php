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

    // Активация режима email подписки через кнопку facebook
	public $facebook_lead_available;

	// Активации кнопки twitter
	public $twitter_available;

    // Активация режима email подписки, через кнопку twitter
	public $twitter_lead_available;

    // Активация режима подписки на twitter, через кнопку twitter
    public $twitter_follow_available;

    // Имя пользователя в Twitter
    public $twitter_follow_user;

    // Уведомления
    public $twitter_follow_notifications;

    // Активация режима размещения сообщения в twitter, через кнопку twitter
    public $twitter_tweet_available;

    // Сообщение
    public $twitter_tweet_message;

	// Активации кнопки google
	public $google_available;

    // Активация режима email подписки через кнопку google
	public $google_lead_available;

    // Активация режима подписки на канал youtube
    public $google_youtube_subscribe_available;

    // ID youtube канала
    public $google_youtube_channel_id;

	// Активации кнопки linkedin
	public $linkedin_available;

    // Активация режима email подписки через кнопку linkedin
	public $linkedin_lead_available;

	// Активация кнопки вконтакте
	public $vk_available;

    // Активация режима email подписки через кнопку вконтакте
	public $vk_lead_available;

	public function rules()
	{
		return [
            [[
                 'google_youtube_channel_id',
                 'twitter_follow_user',
                 'twitter_tweet_message',
             ], 'string'],
			[[
                 'facebook_available',
                 'facebook_lead_available',
                 'twitter_available',
                 'twitter_lead_available',
                 'twitter_tweet_available',
                 'twitter_follow_available',
                 'twitter_follow_notifications',
                 'google_available',
                 'google_lead_available',
                 'google_youtube_subscribe_available',
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
                 'twitter_tweet_available',
                 'twitter_follow_available',
                 'twitter_follow_notifications',
				 'google_available',
				 'google_lead_available',
                 'google_youtube_subscribe_available',
				 'linkedin_available',
				 'linkedin_lead_available',
				 'vk_available',
				 'vk_lead_available'
			 ], 'filter', 'filter' => function($value) {return empty($value) ? false : true;}]
		];
	}

    public function attributeLabels()
    {
        return [
            'facebook_available'                 => 'Активна',
            'facebook_lead_available'            => 'Сохранять email адрес',
            'twitter_available'                  => 'Активна',
            'twitter_lead_available'             => 'Сохранять email адрес',
            'twitter_tweet_available'            => 'Опубликовать сообщение в twitter',
            'twitter_tweet_message'              => 'Сообщение для публикации в twitter',
            'twitter_follow_available'           => 'Подписаться на twitter',
            'twitter_follow_notifications'       => 'Уведомления',
            'twitter_follow_user'                => 'Ваше имя в Twitter',
            'google_available'                   => 'Активна',
            'google_lead_available'              => 'Сохранять email адрес',
            'google_youtube_subscribe_available' => 'Подписка на канал youtube',
            'google_youtube_channel_id'          => 'ID канала',
            'linkedin_available'                 => 'Активна',
            'linkedin_lead_available'            => 'Сохранять email адрес',
            'vk_available'                       => 'Активна',
            'vk_lead_available'                  => 'Сохранять email адрес',
        ];
    }

    public function attributeHints()
    {
        return [
            'facebook_available'                 => 'Нажмите Вкл, чтобы активировать кнопку.',
            'facebook_lead_available'            => 'Это действие получает электронную почту и некоторые другие личные данные пользователя и сохраняет их в базе данных.',
            'twitter_available'                  => 'Нажмите Вкл, чтобы активировать кнопку.',
            'twitter_lead_available'             => 'Это действие получает электронную почту и некоторые другие личные данные пользователя и сохраняет их в базе данных.',
            'twitter_tweet_available'            => 'Отправляет указанный твит ниже от имени пользователя после нажатия на кнопку авторизации.',
            'twitter_tweet_message'              => 'Введите сообщение, которое будет опубликовано на стене пользователя. Оно может включать любые URL-адреса.',
            'twitter_follow_available'           => 'Это действие подписывает пользователя на вашу страничку в Twitter после нажатия на кнопку авторизации.',
            'twitter_follow_notifications'       => 'Если Вкл, подписчик будет получать уведомления о новых твитах (по SMS).',
            'twitter_follow_user'                => 'Впишите в поле свое имя в Twitter (например, byonepress)',
            'google_available'                   => 'Нажмите Вкл, чтобы активировать кнопку.',
            'google_lead_available'              => 'Это действие получает электронную почту и некоторые другие личные данные пользователя и сохраняет их в базе данных.',
            'google_youtube_subscribe_available' => 'Это действие подписывает пользователя на указанный канал в YouTube.',
            'google_youtube_channel_id'          => 'Установите ID канала на Youtube (пример, UCANLZYMidaCbLQFWXBC95Jg).',
            'linkedin_available'                 => 'Нажмите Вкл, чтобы активировать кнопку.',
            'linkedin_lead_available'            => 'Это действие получает электронную почту и некоторые другие личные данные пользователя и сохраняет их в базе данных.',
            'vk_available'                       => 'Нажмите Вкл, чтобы активировать кнопку.',
            'vk_lead_available'                  => 'Это действие получает электронную почту и некоторые другие личные данные пользователя и сохраняет их в базе данных.',
        ];
    }

	/**
	 * Значения полей по умолчанию. Если элемента массива не существует, то возвращается false или null.
	 * @return array
	 */
	public function attributeDefaults() {
		return [
            'facebook_available'       => false,
            'facebook_lead_available'  => true,
            'twitter_available'        => true,
            'twitter_lead_available'   => true,
            'google_available'         => true,
            'google_lead_available'    => true,
            'linkedin_available'       => false,
            'linkedin_lead_available'  => true,
            'vk_available'             => true,
            'vk_lead_available'        => true
		];
	}

}
