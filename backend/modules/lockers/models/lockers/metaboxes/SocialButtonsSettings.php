<?php
/**
 * Модель настройки социальных кнопок. Является частью мультимодели редактирования замков.
 * @author Alex Kovalev <alex.kovalevv@gmail.com> 
 */
namespace backend\modules\lockers\models\lockers\metaboxes;

use Yii;
use yii\base\Model;

class SocialButtonsSettings extends Model
{
	// Активировать кнопку.
	public $facebook_like_available;

	// Адрес страницы, которую пользователь должен "лайкнуть",
	// чтобы разблокировать скрытый контент. Оставьте это поле пустым,
	// чтобы использовать адрес страницы, где будет установлен Замок.
	public $facebook_like_url;

	// Необязательно. Название кнопки, расположенное на обложке, используется
	// в некоторых темах (по умолчанию только в Secrets и Flat).
	public $facebook_like_title;

	// Активировать кнопку.
	public $facebook_share_available;

	// Адрес страницы, которой пользователь должен поделиться, чтобы разблокировать скрытый контент.
	public $facebook_share_url;

	// Название кнопки, расположенное на обложке,
	// используется в некоторых темах (по умолчанию только в Secrets и Flat).
	public $facebook_share_title;

	// Feed Dialog или Share Dialog. По умолчанию используется Facebook Feed Dialog. Оба диалога работают одинаково.
	// Но первый позволяет установить дополнительные параметры.
	public $facebook_share_dialog;

	// Заголовок записи.
	public $facebook_share_message_name;

	// Название ссылки. Если не указано, используется адрес ссылки.
	public $facebook_share_message_caption;

	// Описание, которые отображается под ссылкой. Если не указано, это поле заполняется автоматически,
	// обычно используется заголовок страницы.
	public $facebook_share_message_description;

	// Ссылка на картинку. Изображение будет добавлено к записи. Картина должна быть не менее 50px на 50px
	// (рекомендуется 200px на 200px). Соотношение сторон не более 3:1.
	public $facebook_share_message_image;

	// Активировать кнопку.
	public $twitter_tweet_available;

	// Адрес страницы, которую пользователь должен твитнуть, чтобы разблокировать скрытый контент. Оставьте это поле пустым,
	// чтобы использовать адрес страницы, где будет установлен Замок.
	public $twitter_tweet_url;

	// Cообщение для твита или оставьте это поле пустым, чтобы использовать сообщение по умолчанию.
	// По умолчания: название страницы + ссылка. Вы можете использовать шорткод [post_title]
	// для автоматической подстановки заголовка страницы в твит.
	public $twitter_tweet_text;

	// Проверяет, поделился ли пользователь вашей страницей или нет.
	// Пользователь должен авторизоваться в приложение BizPanda.
	public $twitter_tweet_auth;

	// Ваше имя пользователя в Twitter будет добавлено к твиту (указывается без @).
	public $twitter_tweet_via;

	// Название кнопки, расположенное на обложке, используется в некоторых темах
	// (по умолчанию только в Secrets и Flat).
	public $twitter_tweet_title;

	// Активировать кнопку.
	public $twitter_follow_available;

	// Cсылка на профиль в Twitter (включая http или https), на который пользователь должен подписаться,
	// чтобы разблокировать скрытый контент (для примера, https://twitter.com/byonepress).
	public $twitter_follow_url;

	// Проверяет, подписался ли пользователь на вашу страницу или нет.
	// Пользователь должен авторизоваться в приложение BizPanda.
	public $twitter_follow_auth;

	// Если true, то кнопка не будет содержать имени пользователя
	// (это необходимо, чтобы уменьшить ширину кнопки).
	public $twitter_follow_hide_name;

	// Название кнопки, расположенное на обложке, используется в некоторых темах (по умолчанию только в Secrets и Flat).
	public $twitter_follow_title;

	// Активировать кнопку.
	public $google_plus_available;

	// Адрес страницы, которой пользователь должен поделиться, чтобы разблокировать скрытый контент.
	public $google_plus_url;

	// Название кнопки, расположенное на обложке, используется в некоторых темах (по умолчанию только в Secrets и Flat).
	public $google_plus_title;

	// Активировать кнопку.
	public $google_share_available;

	// Адрес страницы, которой пользователь должен поделиться, чтобы разблокировать скрытый контент.
	public $google_share_url;

	// Название кнопки, расположенное на обложке, используется в некоторых темах (по умолчанию только в Secrets и Flat).
	public $google_share_title;

	// Активировать кнопку.
	public $google_youtube_available;

	// ID канала на Youtube (пример, UCANLZYMidaCbLQFWXBC95Jg).
	public $google_youtube_channel_id;

	// Название кнопки, расположенное на обложке, используется в некоторых темах (по умолчанию только в Secrets и Flat).
	public $google_youtube_title;

	// Активировать кнопку.
	public $linkedin_share_available;

	// Адрес страницы, которой пользователь должен поделиться, чтобы разблокировать скрытый контент.
	public $linkedin_share_url;

	// Название кнопки, расположенное на обложке, используется в некоторых темах (по умолчанию только в Secrets и Flat).
	public $linkedin_share_title;

	// Активировать кнопку.
	public $vk_like_available;

	// Если true, чтобы разблокировать социальный замок с помощью кнопки мне нравится,
	// пользователь обязательно должен нажать "Рассказать друзьям".
	public $vk_like_require_sharing;

	// Адрес страницы, которой пользователь должен поделиться, чтобы разблокировать скрытый контент.
	public $vk_like_url;

	// Название кнопки, расположенное на обложке, используется в некоторых темах (по умолчанию только в Secrets и Flat).
	public $vk_like_title;

	// Заголовок записи.
	public $vk_like_message_title;

	// Описание, которые отображается под ссылкой. Если не указано, это поле заполняется автоматически, обычно используется заголовок страницы.
	public $vk_like_message_description;

	// Ссылка на картинку. Изображение будет добавлено к записи. Картина должна быть не менее 50px на 50px (рекомендуется 200px на 200px).
	// Соотношение сторон не более 3:1.
	public $vk_like_message_image;

	// Активировать кнопку.
	public $vk_share_available;

	// Адрес страницы, которой пользователь должен поделиться, чтобы разблокировать скрытый контент.
	public $vk_share_url;

	// Название кнопки, расположенное на обложке, используется в некоторых темах (по умолчанию только в Secrets и Flat).
	public $vk_share_title;

	// Заголовок записи.
	public $vk_share_message_title;

	// Описание, которые отображается под ссылкой. Если не указано, это поле заполняется автоматически, обычно используется заголовок страницы.
	public $vk_share_message_description;

	// Ссылка на картинку. Изображение будет добавлено к записи. Картина должна быть не менее 50px на 50px (рекомендуется 200px на 200px).
	// Соотношение сторон не более 3:1.
	public $vk_share_message_image;

	// Активировать кнопку.
	public $vk_subscribe_available;

	// Числовой ID или короткое имя вашей страницы / группы в Вконтакте. Например,
	// для группы Яндекса (http://vk.com/yandex) корректное значение для этого поля будет 11283947 или yandex.
	// Если вам нужна подписка на страницу пользователя, то перед id нужно указать символ @(пример: @id5537523 или @dkihot)
	public $vk_subscribe_group_id;

	// Название кнопки, расположенное на обложке, используется в некоторых темах (по умолчанию только в Secrets и Flat).
	public $vk_subscribe_title;

	// Активировать кнопку.
	public $ok_share_available;

	// Адрес страницы, которой пользователь должен поделиться, чтобы разблокировать скрытый контент.
	public $ok_share_url;

	// Название кнопки, расположенное на обложке, используется в некоторых темах (по умолчанию только в Secrets и Flat).
	public $ok_share_title;

	// Активировать кнопку.
	public $mail_share_available;

	// Адрес страницы, которой пользователь должен поделиться, чтобы разблокировать скрытый контент.
	public $mail_share_url;

	// Название кнопки, расположенное на обложке, используется в некоторых темах (по умолчанию только в Secrets и Flat).
	public $mail_share_title;

	// Заголовок записи.
	public $mail_share_message_title;

	// Описание, которые отображается под ссылкой. Если не указано, это поле заполняется автоматически, обычно используется заголовок страницы.
	public $mail_share_message_description;

	// Ссылка на картинку. Изображение будет добавлено к записи. Картина должна быть не менее 50px на 50px (рекомендуется 200px на 200px).
	// Соотношение сторон не более 3:1.
	public $mail_share_message_image;

	// Показывать счетчики
	public $counters;

    //  Сортировка кнопок
    public $buttons_order;


	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[[
				 'facebook_like_title',
				 'facebook_share_title',
				 'facebook_share_message_name',
				 'facebook_share_message_caption',
				 'facebook_share_message_description',
				 'twitter_tweet_text',
				 'twitter_tweet_auth',
				 'twitter_tweet_via',
				 'twitter_tweet_title',
				 'twitter_follow_auth',
				 'twitter_follow_hide_name',
				 'twitter_follow_title',
				 'google_plus_title',
				 'google_share_title',
				 'google_youtube_channel_id',
				 'google_youtube_title',
				 'linkedin_share_title',
				 'vk_like_title',
				 'vk_like_message_title',
				 'vk_like_message_description',
				 'vk_share_title',
				 'vk_share_message_title',
				 'vk_share_message_description',
				 'vk_subscribe_group_id',
				 'vk_subscribe_title',
				 'ok_share_title',
				 'mail_share_title',
				 'mail_share_message_title',
				 'mail_share_message_description',
                 'buttons_order'
			 ], 'string'],
			[[
				 'facebook_share_url',
				 'facebook_share_message_image',
				 'facebook_like_url',
				 'twitter_tweet_url',
				 'twitter_follow_url',
				 'google_plus_url',
				 'google_share_url',
				 'linkedin_share_url',
				 'vk_like_url',
				 'vk_like_message_image',
				 'vk_share_url',
				 'vk_share_message_image',
				 'ok_share_url',
				 'mail_share_url',
				 'mail_share_message_image'
			 ], 'url'],
			[[
				 'counters',
				 'facebook_like_available',
				 'facebook_share_available',
				 'facebook_share_dialog',
				 'twitter_tweet_available',
				 'twitter_tweet_auth',
				 'twitter_follow_available',
				 'twitter_follow_auth',
				 'google_plus_available',
				 'google_share_available',
				 'google_youtube_available',
				 'linkedin_share_available',
				 'vk_like_available',
				 'vk_share_available',
				 'vk_subscribe_available',
				 'ok_share_available',
				 'mail_share_available',
			 ], 'integer'],
			[[
				 'counters',
				 'facebook_like_available',
				 'facebook_share_available',
				 'facebook_share_dialog',
				 'twitter_tweet_available',
				 'twitter_tweet_auth',
				 'twitter_follow_available',
				 'twitter_follow_auth',
				 'google_plus_available',
				 'google_share_available',
				 'google_youtube_available',
				 'linkedin_share_available',
				 'vk_like_available',
				 'vk_share_available',
				 'vk_subscribe_available',
				 'ok_share_available',
				 'mail_share_available',
			 ], 'filter', 'filter' => function($value) {return empty($value) ? false : true;}]
		];
	}


	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'facebook_like_available'            => 'Активна',
			'facebook_like_url'                  => 'URL страницы',
			'facebook_like_title'                => 'Текст кнопки',
			'facebook_share_available'           => 'Активна',
			'facebook_share_url'                 => 'URL страницы',
			'facebook_share_title'               => 'Текст кнопки',
			'facebook_share_dialog'              => 'Использовать Facebook Share Dialog',
			'facebook_share_message_name'        => 'Заголовок',
			'facebook_share_message_caption'     => 'Название ссылки',
			'facebook_share_message_description' => 'Описание',
			'facebook_share_message_image'       => 'Изображение',
			'twitter_tweet_available'            => 'Активна',
			'twitter_tweet_url'                  => 'URL страницы',
			'twitter_tweet_text'                 => 'Сообщение',
			'twitter_tweet_auth'                 => 'Дополнительная проверка',
			'twitter_tweet_via'                  => 'Через (via)',
			'twitter_tweet_title'                => 'Текст кнопки',
			'twitter_follow_available'           => 'Активна',
			'twitter_follow_url'                 => 'Ваше имя в Twitter',
			'twitter_follow_auth'                => 'Дополнительная проверка',
			'twitter_follow_hide_name'           => 'Скрыть имя',
			'twitter_follow_title'               => 'Текст кнопки',
			'google_plus_available'              => 'Активна',
			'google_plus_url'                    => 'URL страницы',
			'google_plus_title'                  => 'Текст кнопки',
			'google_share_available'             => 'Активна',
			'google_share_url'                   => 'URL страницы',
			'google_share_title'                 => 'Текст кнопки',
			'google_youtube_available'           => 'Активна',
			'google_youtube_channel_id'          => 'ID канала на youtube',
			'google_youtube_title'               => 'Текст кнопки',
			'linkedin_share_available'           => 'Активна',
			'linkedin_share_url'                 => 'URL страницы',
			'linkedin_share_title'               => 'Текст кнопки',
			'vk_like_available'                  => 'Активна',
			'vk_like_require_sharing'            => 'Рассказать друзьям',
			'vk_like_url'                        => 'URL страницы',
			'vk_like_title'                      => 'Текст кнопки',
			'vk_like_message_title'              => 'Заголовок',
			'vk_like_message_description'        => 'Описание',
			'vk_like_message_image'              => 'Изображение',
			'vk_share_available'                 => 'Активна',
			'vk_share_url'                       => 'URL страницы',
			'vk_share_title'                     => 'Текст кнопки',
			'vk_share_message_title'             => 'Заголовок',
			'vk_share_message_description'       => 'Описание',
			'vk_share_message_image'             => 'Изображение',
			'vk_subscribe_available'             => 'Активна',
			'vk_subscribe_group_id'              => 'Группа или страница',
			'vk_subscribe_title'                 => 'Текст кнопки',
			'ok_share_available'                 => 'Активна',
			'ok_share_url'                       => 'URL страницы',
			'ok_share_title'                     => 'Текст кнопки',
			'mail_share_available'               => 'Активна',
			'mail_share_url'                     => 'URL страницы',
			'mail_share_title'                   => 'Текст кнопки',
			'mail_share_message_title'           => 'Заголовок',
			'mail_share_message_description'     => 'Описание',
			'mail_share_message_image'           => 'Изображение',
			'counters'                           => 'Показывать счетчики'
		];
	}

	public function attributeHints() {
		return [

			'facebook_like_available'            => 'Нажмите Вкл, чтобы активировать кнопку.',
			'facebook_like_url'                  => 'Задайте адрес страницы, которую пользователь должен "лайкнуть", чтобы разблокировать скрытый контент. Оставьте это поле пустым, чтобы использовать адрес страницы, где будет установлен Замок.',
			'facebook_like_title'                => 'Необязательно. Название кнопки, расположенное на обложке, используется в некоторых темах (по умолчанию только в Secrets и Flat).',
			'facebook_share_available'           => 'Нажмите Вкл, чтобы активировать кнопку.',
			'facebook_share_url'                 => 'Задайте адрес страницы, которой пользователь должен поделиться, чтобы разблокировать скрытый контент. Оставьте это поле пустым, чтобы использовать адрес страницы, где будет установлен Замок.',
			'facebook_share_title'               => 'Необязательно. Название кнопки, расположенное на обложке, используется в некоторых темах (по умолчанию только в Secrets и Flat).',
			'facebook_share_dialog'              => 'Установите Share Dialog вместо Feed Dialog и используйте Open Graph Meta Tags, чтобы задать сообщение, которым будет делиться пользователь',
			'facebook_share_message_name'        => 'Необязательно. Заголовок записи.',
			'facebook_share_message_caption'     => 'Необязательно. Название ссылки. Если не указано, используется адрес ссылки.',
			'facebook_share_message_description' => 'Необязательно. Описание, которые отображается под ссылкой. Если не указано, это поле заполняется автоматически, обычно используется заголовок страницы.',
			'facebook_share_message_image'       => 'Необязательно. Ссылка на картинку. Изображение будет добавлено к записи. Картина должна быть не менее 50px на 50px (рекомендуется 200px на 200px). Соотношение сторон не более 3:1.',
			'twitter_tweet_available'            => 'Нажмите Вкл, чтобы активировать кнопку.',
			'twitter_tweet_url'                  => 'Задайте адрес страницы, которую пользователь должен твитнуть, чтобы разблокировать скрытый контент. Оставьте это поле пустым, чтобы использовать адрес страницы, где будет установлен Замок.',
			'twitter_tweet_text'                 => 'Задайте сообщение для твита или оставьте это поле пустым, чтобы использовать сообщение по умолчанию. По умолчания: название страницы + ссылка. Вы можете использовать шорткод [post_title] для автоматической подстановки заголовка страницы в твит.',
			'twitter_tweet_auth'                 => 'Необязательно. Проверяет, поделился ли пользователь вашей страницей или нет. Пользователь должен авторизоваться в приложение BizPanda.',
			'twitter_tweet_via'                  => 'Необязательно. Ваше имя пользователя в Twitter будет добавлено к твиту (указывается без @).',
			'twitter_tweet_title'                => 'Необязательно. Название кнопки, расположенное на обложке, используется в некоторых темах (по умолчанию только в Secrets и Flat).',
			'twitter_follow_available'           => 'Нажмите Вкл, чтобы активировать кнопку.',
			'twitter_follow_url'                 => 'Вставьте полную ссылку на свой профиль в Twitter (включая http или https), на который пользователь должен подписаться, чтобы разблокировать скрытый контент (для примера, https://twitter.com/byonepress).',
			'twitter_follow_auth'                => 'Необязательно. Проверяет, подписался ли пользователь на вашу страницу или нет. Пользователь должен авторизоваться в приложение BizPanda.',
			'twitter_follow_hide_name'           => 'Если Вкл, то кнопка не будет содержать имени пользователя (это необходимо, чтобы уменьшить ширину кнопки).',
			'twitter_follow_title'               => 'Необязательно. Название кнопки, расположенное на обложке, используется в некоторых темах (по умолчанию только в Secrets и Flat).',
			'google_plus_available'              => 'Нажмите Вкл, чтобы активировать кнопку.',
			'google_plus_url'                    => 'Задайте адрес страницы, которую пользователь должен "плюсануть", чтобы разблокировать скрытый контент. Оставьте это поле пустым, чтобы использовать адрес страницы, где будет установлен Замок.',
			'google_plus_title'                  => 'Необязательно. Название кнопки, расположенное на обложке, используется в некоторых темах (по умолчанию только в Secrets и Flat).',
			'google_share_available'             => 'Нажмите Вкл, чтобы активировать кнопку.',
			'google_share_url'                   => 'Задайте адрес страницы, которой пользователь должен поделиться, чтобы разблокировать скрытый контент. Оставьте это поле пустым, чтобы использовать адрес страницы, где будет установлен Замок.',
			'google_share_title'                 => 'Необязательно. Название кнопки, расположенное на обложке, используется в некоторых темах (по умолчанию только в Secrets и Flat).',
			'google_youtube_available'           => 'Нажмите Вкл, чтобы активировать кнопку.',
			'google_youtube_channel_id'          => 'Установите ID канала на Youtube (пример, UCANLZYMidaCbLQFWXBC95Jg).',
			'google_youtube_title'               => 'Необязательно. Текст отображается на крышках кнопок в некоторых темах (по умолчанию только в Secrets и Flat).',
			'linkedin_share_available'           => 'Нажмите Вкл, чтобы активировать кнопку.',
			'linkedin_share_url'                 => 'Задайте адрес страницы, которой пользователь должен поделиться, чтобы разблокировать скрытый контент. Оставьте это поле пустым, чтобы использовать адрес страницы, где будет установлен Замок.',
			'linkedin_share_title'               => 'Необязательно. Название кнопки, расположенное на обложке, используется в некоторых темах (по умолчанию только в Secrets и Flat).',
			'vk_like_available'                  => 'Нажмите Вкл, чтобы активировать кнопку.',
			'vk_like_require_sharing'            => 'Если Вкл, чтобы разблокировать социальный замок с помощью кнопки мне нравится, пользователь обязательно должен нажать "Рассказать друзьям".',
			'vk_like_url'                        => 'Задайте адрес страницы, которую пользователь должен "лайкнуть", чтобы разблокировать скрытый контент. Оставьте это поле пустым, чтобы использовать адрес страницы, где будет установлен Замок.',
			'vk_like_title'                      => 'Необязательно. Название кнопки, расположенное на обложке, используется в некоторых темах (по умолчанию только в Secrets и Flat).',
			'vk_like_message_title'              => 'Необязательно. Заголовок записи.',
			'vk_like_message_description'        => 'Необязательно. Описание, которые отображается под ссылкой. Если не указано, это поле заполняется автоматически, обычно используется заголовок страницы.',
			'vk_like_message_image'              => 'Необязательно. Ссылка на картинку. Изображение будет добавлено к записи. Картина должна быть не менее 50px на 50px (рекомендуется 200px на 200px). Соотношение сторон не более 3:1.',
			'vk_share_available'                 => 'Нажмите Вкл, чтобы активировать кнопку.',
			'vk_share_url'                       => 'Задайте адрес страницы, которую пользователь должен "лайкнуть", чтобы разблокировать скрытый контент. Оставьте это поле пустым, чтобы использовать адрес страницы, где будет установлен Замок.',
			'vk_share_title'                     => 'Необязательно. Название кнопки, расположенное на обложке, используется в некоторых темах (по умолчанию только в Secrets и Flat).',
			'vk_share_message_title'             => 'Необязательно. Заголовок записи.',
			'vk_share_message_description'       => 'Текстовое сообщение, которое будет опубликовано на стене пользователя.',
			'vk_share_message_image'             => 'Необязательно. Ссылка на картинку. Изображение будет добавлено к записи. Картина должна быть не менее 50px на 50px (рекомендуется 200px на 200px). Соотношение сторон не более 3:1.',
			'vk_subscribe_available'             => 'Нажмите Вкл, чтобы активировать кнопку.',
			'vk_subscribe_group_id'              => 'Числовой ID или короткое имя вашей страницы / группы в Вконтакте. Например, для группы Яндекса (http://vk.com/yandex) корректное значение для этого поля будет 11283947 или yandex. Если вам нужна подписка на страницу пользователя, то перед id нужно указать символ @(пример: @id5537523 или @dkihot)',
			'vk_subscribe_title'                 => 'Необязательно. Название кнопки, расположенное на обложке, используется в некоторых темах (по умолчанию только в Secrets и Flat).',
			'ok_share_available'                 => 'Нажмите Вкл, чтобы активировать кнопку.',
			'ok_share_url'                       => 'Задайте адрес страницы, которой пользователь должен поделиться, чтобы разблокировать скрытый контент. Оставьте это поле пустым, чтобы использовать адрес страницы, где будет установлен Замок.',
			'ok_share_title'                     => 'Необязательно. Название кнопки, расположенное на обложке, используется в некоторых темах (по умолчанию только в Secrets и Flat).',
			'mail_share_available'               => 'Нажмите Вкл, чтобы активировать кнопку.',
			'mail_share_url'                     => 'Задайте адрес страницы, которой пользователь должен поделиться, чтобы разблокировать скрытый контент. Оставьте это поле пустым, чтобы использовать адрес страницы, где будет установлен Замок.',
			'mail_share_title'                   => 'Необязательно. Название кнопки, расположенное на обложке, используется в некоторых темах (по умолчанию только в Secrets и Flat).',
			'mail_share_message_title'           => 'Необязательно. Заголовок записи.',
			'mail_share_message_description'     => 'Необязательно. Описание, которые отображается под ссылкой. Если не указано, это поле заполняется автоматически, обычно используется заголовок страницы.',
			'mail_share_message_image'           => 'Необязательно. Ссылка на картинку. Изображение будет добавлено к записи. Картина должна быть не менее 50px на 50px (рекомендуется 200px на 200px). Соотношение сторон не более 3:1.',
			'counters'                           => 'Показывать счетчики'
		];
	}

	/**
	 * Значения полей по умолчанию. Если элемента массива не существует, то возвращается false или null.
	 * @return array
	 */
	public function attributeDefaults() {
		return [
			'facebook_like_available'            => true,
			'facebook_like_title'                => 'мне нравится',
			'facebook_share_title'               => 'поделиться',
			'twitter_tweet_available'            => true,
			'twitter_tweet_auth'                 => true,
			'twitter_tweet_title'                => 'твитнуть',
			'twitter_follow_available'           => true,
			'twitter_follow_auth'                => true,
			'twitter_follow_title'               => 'читать',
			'google_plus_available'              => true,
			'google_plus_title'                  => 'плюсануть',
			'google_share_title'                 => 'поделиться',
			'google_youtube_title'               => 'подписаться',
			'linkedin_share_title'               => 'поделиться',
			'vk_like_available'                  => true,
			'vk_like_require_sharing'            => true,
			'vk_like_title'                      => 'мне нравится',
			'vk_share_title'                     => 'поделиться',
			'vk_subscribe_title'                 => 'подписаться',
			'ok_share_title'                     => 'класс',
			'mail_share_title'                   => 'поделиться',
			'counters'                           => true
		];
	}
}
