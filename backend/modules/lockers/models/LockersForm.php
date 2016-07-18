<?php
namespace backend\modules\lockers\models;

use Yii;
use yii\base\Exception;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\helpers\Html;
use backend\modules\lockers\models\Lockers;


/**
 * Create locker form
 */
class LockersForm extends Model
{
	//-----------------------------
	/**  Базовые настройки       */
	//-----------------------------
	//Название замка
    public $title;
	//Заголовок внутри замка
	public $header;
	//Текстовое сообщение внутри замка
	public $message;
	//Тип замка
	public $type = 'sociallocker';
	//Статус
    public $status = 2;

	//Тема для замка
	public $style;
	//Режим наложения
	public $overlap;
	//Позиция замка на слое
	public $overlap_position;
	//-----------------------------
	/**  Настройки отображения   */
	//-----------------------------
	//Скрывает Замок для зарегистрированных на сайте пользователей, если Вкл.
	public $hide_for_member;
	//Если Вкл, будучи ранее открыт, Замок появится снова через указанный интервал.
	public $relock;
	//Интервал через который появится замок
	public $relock_interval;
	//Тип значения(дни, часы, минуты)
	public $relock_interval_units;
	//Замок будет отображаться, даже если был ранее разблокирован.
	public $always;
	//Замок будет отображаться и на мобильных устройствах.
	public $mobile;
	//-----------------------------
	/** Дополнительные настройки */
	//-----------------------------
	//Показывает кнопку "Закрыть" в углу.
	public $close;
	//Устанавливает таймер обратного отсчета для Замка.
	public $timer;
	//Скрытый контент будет подгружаться только после разблокировки, то есть будет вырезан из исходного кода страницы.
	public $ajax;
	//Замок подсвечивает заблокированное содержимое после разблокировки.
	public $highlight;

	//-----------------------------
	/**    Кнопки авторизации    */
	//-----------------------------
	public $facebook_available;
	public $facebook_lead_available;
	public $twitter_available;
	public $twitter_lead_available;
	public $google_available;
	public $google_lead_available;
	public $linkedin_available;
	public $linkedin_lead_available;
	public $vk_available;
	public $vk_lead_available;

	//-----------------------------
	/**    Опции подписки        */
	//-----------------------------
	public $subscribe_to_service;
	public $subscribe_mode;

	//-----------------------------
	/**    Социальные кнопки     */
	//-----------------------------
	//Активировать кнопку.
	public $facebook_like_available;
	//Адрес страницы, которую пользователь должен "лайкнуть",
	//чтобы разблокировать скрытый контент. Оставьте это поле пустым,
	//чтобы использовать адрес страницы, где будет установлен Замок.
	public $facebook_like_url;
	//Необязательно. Название кнопки, расположенное на обложке, используется
	//в некоторых темах (по умолчанию только в Secrets и Flat).
	public $facebook_like_title;
	//-----------------------------
	//Активировать кнопку.
	public $facebook_share_available;
	//Адрес страницы, которой пользователь должен поделиться, чтобы разблокировать скрытый контент.
	public $facebook_share_url;
	//Название кнопки, расположенное на обложке,
	//используется в некоторых темах (по умолчанию только в Secrets и Flat).
	public $facebook_share_title;
	//Feed Dialog или Share Dialog. По умолчанию используется Facebook Feed Dialog. Оба диалога работают одинаково.
	//Но первый позволяет установить дополнительные параметры.
	public $facebook_share_dialog;
	//Заголовок записи.
	public $facebook_share_message_name;
	//Название ссылки. Если не указано, используется адрес ссылки.
	public $facebook_share_message_caption;
	//Описание, которые отображается под ссылкой. Если не указано, это поле заполняется автоматически,
	//обычно используется заголовок страницы.
	public $facebook_share_message_description;
	//Ссылка на картинку. Изображение будет добавлено к записи. Картина должна быть не менее 50px на 50px
	//(рекомендуется 200px на 200px). Соотношение сторон не более 3:1.
	public $facebook_share_message_image;
	//-----------------------------
	//Активировать кнопку.
	public $twitter_tweet_available;
	//Адрес страницы, которую пользователь должен твитнуть, чтобы разблокировать скрытый контент. Оставьте это поле пустым,
	//чтобы использовать адрес страницы, где будет установлен Замок.
	public $twitter_tweet_url;
	//Cообщение для твита или оставьте это поле пустым, чтобы использовать сообщение по умолчанию.
	//По умолчания: название страницы + ссылка. Вы можете использовать шорткод [post_title]
	//для автоматической подстановки заголовка страницы в твит.
	public $twitter_tweet_text;
	//Проверяет, поделился ли пользователь вашей страницей или нет.
	//Пользователь должен авторизоваться в приложение BizPanda.
	public $twitter_tweet_auth;
	//Ваше имя пользователя в Twitter будет добавлено к твиту (указывается без @).
	public $twitter_tweet_via;
	//Название кнопки, расположенное на обложке, используется в некоторых темах
	//(по умолчанию только в Secrets и Flat).
	public $twitter_tweet_title;
	//-----------------------------
	//Активировать кнопку.
	public $twitter_follow_available;
	//Cсылка на профиль в Twitter (включая http или https), на который пользователь должен подписаться,
	//чтобы разблокировать скрытый контент (для примера, https://twitter.com/byonepress).
	public $twitter_follow_url;
	//Проверяет, подписался ли пользователь на вашу страницу или нет.
	//Пользователь должен авторизоваться в приложение BizPanda.
	public $twitter_follow_auth;
	//Если true, то кнопка не будет содержать имени пользователя
	//(это необходимо, чтобы уменьшить ширину кнопки).
	public $twitter_follow_hide_name;
	//Название кнопки, расположенное на обложке, используется в некоторых темах (по умолчанию только в Secrets и Flat).
	public $twitter_follow_title;
	//-----------------------------
	//Активировать кнопку.
	public $google_plus_available;
	//Адрес страницы, которой пользователь должен поделиться, чтобы разблокировать скрытый контент.
	public $google_plus_url;
	//Название кнопки, расположенное на обложке, используется в некоторых темах (по умолчанию только в Secrets и Flat).
	public $google_plus_title;
	//-----------------------------
	//Активировать кнопку.
	public $google_share_available;
	//Адрес страницы, которой пользователь должен поделиться, чтобы разблокировать скрытый контент.
	public $google_share_url;
	//Название кнопки, расположенное на обложке, используется в некоторых темах (по умолчанию только в Secrets и Flat).
	public $google_share_title;
	//-----------------------------
	//Активировать кнопку.
	public $google_youtube_available;
	//ID канала на Youtube (пример, UCANLZYMidaCbLQFWXBC95Jg).
	public $google_youtube_channel_id;
	//Название кнопки, расположенное на обложке, используется в некоторых темах (по умолчанию только в Secrets и Flat).
	public $google_youtube_title;
	//-----------------------------
	//Активировать кнопку.
	public $linkedin_share_available;
	//Адрес страницы, которой пользователь должен поделиться, чтобы разблокировать скрытый контент.
	public $linkedin_share_url;
	//Название кнопки, расположенное на обложке, используется в некоторых темах (по умолчанию только в Secrets и Flat).
	public $linkedin_share_title;
	//-----------------------------
	//Активировать кнопку.
	public $vk_like_available;
	//Если true, чтобы разблокировать социальный замок с помощью кнопки мне нравится,
	//пользователь обязательно должен нажать "Рассказать друзьям".
	public $vk_like_require_sharing;
	//Адрес страницы, которой пользователь должен поделиться, чтобы разблокировать скрытый контент.
	public $vk_like_url;
	//Название кнопки, расположенное на обложке, используется в некоторых темах (по умолчанию только в Secrets и Flat).
	public $vk_like_title;
	//Заголовок записи.
	public $vk_like_message_title;
	//Описание, которые отображается под ссылкой. Если не указано, это поле заполняется автоматически, обычно используется заголовок страницы.
	public $vk_like_message_description;
	//Ссылка на картинку. Изображение будет добавлено к записи. Картина должна быть не менее 50px на 50px (рекомендуется 200px на 200px).
	//Соотношение сторон не более 3:1.
	public $vk_like_message_image;
	//-----------------------------
	//Активировать кнопку.
	public $vk_share_available;
	//Адрес страницы, которой пользователь должен поделиться, чтобы разблокировать скрытый контент.
	public $vk_share_url;
	//Название кнопки, расположенное на обложке, используется в некоторых темах (по умолчанию только в Secrets и Flat).
	public $vk_share_title;
	//Заголовок записи.
	public $vk_share_message_title;
	//Описание, которые отображается под ссылкой. Если не указано, это поле заполняется автоматически, обычно используется заголовок страницы.
	public $vk_share_message_description;
	//Ссылка на картинку. Изображение будет добавлено к записи. Картина должна быть не менее 50px на 50px (рекомендуется 200px на 200px).
	//Соотношение сторон не более 3:1.
	public $vk_share_message_image;
	//-----------------------------
	//Активировать кнопку.
	public $vk_subscribe_available;
	//Числовой ID или короткое имя вашей страницы / группы в Вконтакте. Например,
	//для группы Яндекса (http://vk.com/yandex) корректное значение для этого поля будет 11283947 или yandex.
	//Если вам нужна подписка на страницу пользователя, то перед id нужно указать символ @(пример: @id5537523 или @dkihot)
	public $vk_subscribe_group_id;
	//Название кнопки, расположенное на обложке, используется в некоторых темах (по умолчанию только в Secrets и Flat).
	public $vk_subscribe_title;
	//-----------------------------
	//Активировать кнопку.
	public $ok_share_available;
	//Адрес страницы, которой пользователь должен поделиться, чтобы разблокировать скрытый контент.
	public $ok_share_url;
	//Название кнопки, расположенное на обложке, используется в некоторых темах (по умолчанию только в Secrets и Flat).
	public $ok_share_title;
	//-----------------------------
	//Активировать кнопку.
	public $mail_share_available;
	//Адрес страницы, которой пользователь должен поделиться, чтобы разблокировать скрытый контент.
	public $mail_share_url;
	//Название кнопки, расположенное на обложке, используется в некоторых темах (по умолчанию только в Secrets и Flat).
	public $mail_share_title;
	//Заголовок записи.
	public $mail_share_message_title;
	//Описание, которые отображается под ссылкой. Если не указано, это поле заполняется автоматически, обычно используется заголовок страницы.
	public $mail_share_message_description;
	//Ссылка на картинку. Изображение будет добавлено к записи. Картина должна быть не менее 50px на 50px (рекомендуется 200px на 200px).
	//Соотношение сторон не более 3:1.
	public $mail_share_message_image;
	//-----------------------------
	//Показывать счетчики
	public $counters;

    private $model;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['title', 'header', 'message', 'status', 'style'], 'required'],
            [[
	             'overlap',
	             'overlap_position',
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
	             'subscribe_mode',

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
	             'always',
	             'mobile',
	             'timer',
	             'highlight',
	             'close',
	             'counters',
	             'facebook_available',
	             'facebook_lead_available',
	             'twitter_available',
	             'twitter_lead_available',
	             'google_available',
	             'google_lead_available',
	             'linkedin_available',
	             'linkedin_lead_available',
	             'vk_available',
	             'vk_lead_available',
	             'subscribe_to_service',
                 'facebook_like_available',
			     'facebook_share_available',
			     'facebook_share_dialog',
	    	     'twitter_tweet_available',
	             'twitter_tweet_auth',
			     'twitter_folllow_available',
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
			['status', 'default', 'value' => '2'],
			['overlap', 'default', 'value' => 'full'],
            ['overlap_position', 'default', 'value' => 'middle']
        ];
    }


	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'title'                              => 'Название замка',
			'header'                             => 'Заголовок',
			'message'                            => 'Описание',
			'status'                             => 'Состояние',
			'style'                              => 'Выберите тему',
			'overlap'                            => 'Выберите режим наложения',
			'overlap_position'                   => 'Позиция замка на слое',
			//-----------------------------
			/**  Настройки отображения   */
			//-----------------------------
			'hide_for_member'                    => 'Зарег. пользов.',
			'relock'                             => 'Повторная блк.',
			'always'                             => 'Не запоминать',
			'mobile'                             => 'Мобильный',
			//-----------------------------
			/** Дополнительные настройки */
			//-----------------------------
			'close'                              => 'Кнопка закрыть',
			'timer'                              => 'Таймер (в сек.)',
			'ajax'                               => 'AJAX',
			'highlight'                          => 'Подсветка',
			//-----------------------------
			/**    Кнопки авторизации     */
			//-----------------------------
			'facebook_available'                 => 'Активна',
			'facebook_lead_available'            => 'Сохранять email адрес',
			'twitter_available'                  => 'Активна',
			'twitter_lead_available'             => 'Сохранять email адрес',
			'google_available'                   => 'Активна',
			'google_lead_available'              => 'Сохранять email адрес',
			'linkedin_available'                 => 'Активна',
			'linkedin_lead_available'            => 'Сохранять email адрес',
			'vk_available'                       => 'Активна',
			'vk_lead_available'                  => 'Сохранять email адрес',
			//-----------------------------
			/**    Опции подписки        */
			//-----------------------------
			'subscribe_to_service'               => 'Синхронизация с сервисами рассылки',
			'subscribe_mode'                     => 'Режим проверки',
			//-----------------------------
			/**    Социальные кнопки     */
			//-----------------------------
			'facebook_like_available'            => 'Активна',
			'facebook_like_url'                  => 'URL страницы',
			'facebook_like_title'                => 'Текст кнопки',
			//-----------------------------
			'facebook_share_available'           => 'Активна',
			'facebook_share_url'                 => 'URL страницы',
			'facebook_share_title'               => 'Текст кнопки',
			'facebook_share_dialog'              => 'Использовать Facebook Share Dialog',
			'facebook_share_message_name'        => 'Заголовок',
			'facebook_share_message_caption'     => 'Название ссылки',
			'facebook_share_message_description' => 'Описание',
			'facebook_share_message_image'       => 'Изображение',
			//-----------------------------
			'twitter_tweet_available'            => 'Активна',
			'twitter_tweet_url'                  => 'URL страницы',
			'twitter_tweet_text'                 => 'Сообщение',
			'twitter_tweet_auth'                 => 'Дополнительная проверка',
			'twitter_tweet_via'                  => 'Через (via)',
			'twitter_tweet_title'                => 'Текст кнопки',
			//-----------------------------
			'twitter_follow_available'           => 'Активна',
			'twitter_follow_url'                 => 'Ваше имя в Twitter',
			'twitter_follow_auth'                => 'Дополнительная проверка',
			'twitter_follow_hide_name'           => 'Скрыть имя',
			'twitter_follow_title'               => 'Текст кнопки',
			//-----------------------------
			'google_plus_available'              => 'Активна',
			'google_plus_url'                    => 'URL страницы',
			'google_plus_title'                  => 'Текст кнопки',
			//-----------------------------
			'google_share_available'             => 'Активна',
			'google_share_url'                   => 'URL страницы',
			'google_share_title'                 => 'Текст кнопки',
			//-----------------------------
			'google_youtube_available'           => 'Активна',
			'google_youtube_channel_id'          => 'ID канала на youtube',
			'google_youtube_title'               => 'Текст кнопки',
			//-----------------------------
			'linkedin_share_available'           => 'Активна',
			'linkedin_share_url'                 => 'URL страницы',
			'linkedin_share_title'               => 'Текст кнопки',
			//-----------------------------
			'vk_like_available'                  => 'Активна',
			'vk_like_require_sharing'            => 'Рассказать друзьям',
			'vk_like_url'                        => 'URL страницы',
			'vk_like_title'                      => 'Текст кнопки',
			'vk_like_message_title'              => 'Заголовок',
			'vk_like_message_description'        => 'Описание',
			'vk_like_message_image'              => 'Изображение',
			//-----------------------------
			'vk_share_available'                 => 'Активна',
			'vk_share_url'                       => 'URL страницы',
			'vk_share_title'                     => 'Текст кнопки',
			'vk_share_message_title'             => 'Заголовок',
			'vk_share_message_description'       => 'Описание',
			'vk_share_message_image'             => 'Изображение',
			//-----------------------------
			'vk_subscribe_available'             => 'Активна',
			'vk_subscribe_group_id'              => 'Группа или страница',
			'vk_subscribe_title'                 => 'Текст кнопки',
			//-----------------------------
			'ok_share_available'                 => 'Активна',
			'ok_share_url'                       => 'URL страницы',
			'ok_share_title'                     => 'Текст кнопки',
			//-----------------------------
			'mail_share_available'               => 'Активна',
			'mail_share_url'                     => 'URL страницы',
			'mail_share_title'                   => 'Текст кнопки',
			'mail_share_message_title'           => 'Заголовок',
			'mail_share_message_description'     => 'Описание',
			'mail_share_message_image'           => 'Изображение',
			//-----------------------------
			'counters'                           => 'Показывать счетчики'
		];
	}

	public function attributeHints() {
		return [
			'header'                             => 'Введите заголовок, который привлекает внимание или призывает к действию. Вы можете оставить это поле пустым.',
			'message'                            => 'Введите основное сообщение, которое будет отображаться под заголовком.',
			'status'                             => 'В состоянии отключен, замок не будет отображаться на вашем сайте.',
			'style'                              => 'Выберите наиболее подходящую тему.',
			'overlap'                            => 'Выберите режим наложения',
			//-----------------------------
			/**  Настройки отображения   */
			//-----------------------------
			'hide_for_member'                    => 'Скрывает Замок для зарегистрированных на сайте пользователей, если Вкл.',
			'relock'                             => 'Если Вкл, будучи ранее открыт, Замок появится снова через указанный интервал.',
			'always'                             => 'Если Вкл, Замок будет отображаться, даже если был ранее разблокирован.',
			'mobile'                             => 'Если Вкл, Замок будет отображаться и на мобильных устройствах.',
			//-----------------------------
			/** Дополнительные настройки */
			//-----------------------------
			'close'                              => 'Показывает кнопку "Закрыть" в углу.',
			'timer'                              => 'Устанавливает таймер обратного отсчета для Замка.',
			'ajax'                               => 'Если Вкл, скрытый контент будет подгружаться только после разблокировки, то есть будет вырезан из исходного кода страницы.',
			'highlight'                          => 'Если Вкл, Замок подсвечивает заблокированное содержимое после разблокировки.',
			//-----------------------------
			/**    Кнопки авторизации     */
			//-----------------------------
			'facebook_available'                 => 'Нажмите Вкл, чтобы активировать кнопку.',
			'facebook_lead_available'            => 'Это действие получает электронную почту и некоторые другие личные данные пользователя и сохраняет их в базе данных.',
			'twitter_available'                  => 'Нажмите Вкл, чтобы активировать кнопку.',
			'twitter_lead_available'             => 'Это действие получает электронную почту и некоторые другие личные данные пользователя и сохраняет их в базе данных.',
			'google_available'                   => 'Нажмите Вкл, чтобы активировать кнопку.',
			'google_lead_available'              => 'Это действие получает электронную почту и некоторые другие личные данные пользователя и сохраняет их в базе данных.',
			'linkedin_available'                 => 'Нажмите Вкл, чтобы активировать кнопку.',
			'linkedin_lead_available'            => 'Это действие получает электронную почту и некоторые другие личные данные пользователя и сохраняет их в базе данных.',
			'vk_available'                       => 'Нажмите Вкл, чтобы активировать кнопку.',
			'vk_lead_available'                  => 'Это действие получает электронную почту и некоторые другие личные данные пользователя и сохраняет их в базе данных.',
			//-----------------------------
			/**    Опции подписки        */
			//-----------------------------
			'subscribe_to_service'               => 'Это действие позволяет автоматически добавить пользователя в выбранный сервис email рассылок. Действие срабатывает после нажатия на кнопку авторизации.',
			'subscribe_mode'                     => '',
			//-----------------------------
			/**    Социальные кнопки     */
			//-----------------------------
			'facebook_like_available'            => 'Нажмите Вкл, чтобы активировать кнопку.',
			'facebook_like_url'                  => 'Задайте адрес страницы, которую пользователь должен "лайкнуть", чтобы разблокировать скрытый контент. Оставьте это поле пустым, чтобы использовать адрес страницы, где будет установлен Замок.',
			'facebook_like_title'                => 'Необязательно. Название кнопки, расположенное на обложке, используется в некоторых темах (по умолчанию только в Secrets и Flat).',
			//-----------------------------
			'facebook_share_available'           => 'Нажмите Вкл, чтобы активировать кнопку.',
			'facebook_share_url'                 => 'Задайте адрес страницы, которой пользователь должен поделиться, чтобы разблокировать скрытый контент. Оставьте это поле пустым, чтобы использовать адрес страницы, где будет установлен Замок.',
			'facebook_share_title'               => 'Необязательно. Название кнопки, расположенное на обложке, используется в некоторых темах (по умолчанию только в Secrets и Flat).',
			'facebook_share_dialog'              => 'Установите Share Dialog вместо Feed Dialog и используйте Open Graph Meta Tags, чтобы задать сообщение, которым будет делиться пользователь',
			'facebook_share_message_name'        => 'Необязательно. Заголовок записи.',
			'facebook_share_message_caption'     => 'Необязательно. Название ссылки. Если не указано, используется адрес ссылки.',
			'facebook_share_message_description' => 'Необязательно. Описание, которые отображается под ссылкой. Если не указано, это поле заполняется автоматически, обычно используется заголовок страницы.',
			'facebook_share_message_image'       => 'Необязательно. Ссылка на картинку. Изображение будет добавлено к записи. Картина должна быть не менее 50px на 50px (рекомендуется 200px на 200px). Соотношение сторон не более 3:1.',
			//-----------------------------
			'twitter_tweet_available'            => 'Нажмите Вкл, чтобы активировать кнопку.',
			'twitter_tweet_url'                  => 'Задайте адрес страницы, которую пользователь должен твитнуть, чтобы разблокировать скрытый контент. Оставьте это поле пустым, чтобы использовать адрес страницы, где будет установлен Замок.',
			'twitter_tweet_text'                 => 'Задайте сообщение для твита или оставьте это поле пустым, чтобы использовать сообщение по умолчанию. По умолчания: название страницы + ссылка. Вы можете использовать шорткод [post_title] для автоматической подстановки заголовка страницы в твит.',
			'twitter_tweet_auth'                 => 'Необязательно. Проверяет, поделился ли пользователь вашей страницей или нет. Пользователь должен авторизоваться в приложение BizPanda.',
			'twitter_tweet_via'                  => 'Необязательно. Ваше имя пользователя в Twitter будет добавлено к твиту (указывается без @).',
			'twitter_tweet_title'                => 'Необязательно. Название кнопки, расположенное на обложке, используется в некоторых темах (по умолчанию только в Secrets и Flat).',
			//-----------------------------
			'twitter_follow_available'           => 'Нажмите Вкл, чтобы активировать кнопку.',
			'twitter_follow_url'                 => 'Вставьте полную ссылку на свой профиль в Twitter (включая http или https), на который пользователь должен подписаться, чтобы разблокировать скрытый контент (для примера, https://twitter.com/byonepress).',
			'twitter_follow_auth'                => 'Необязательно. Проверяет, подписался ли пользователь на вашу страницу или нет. Пользователь должен авторизоваться в приложение BizPanda.',
			'twitter_follow_hide_name'           => 'Если Вкл, то кнопка не будет содержать имени пользователя (это необходимо, чтобы уменьшить ширину кнопки).',
			'twitter_follow_title'               => 'Необязательно. Название кнопки, расположенное на обложке, используется в некоторых темах (по умолчанию только в Secrets и Flat).',
			//-----------------------------
			'google_plus_available'              => 'Нажмите Вкл, чтобы активировать кнопку.',
			'google_plus_url'                    => 'Задайте адрес страницы, которую пользователь должен "плюсануть", чтобы разблокировать скрытый контент. Оставьте это поле пустым, чтобы использовать адрес страницы, где будет установлен Замок.',
			'google_plus_title'                  => 'Необязательно. Название кнопки, расположенное на обложке, используется в некоторых темах (по умолчанию только в Secrets и Flat).',
			//-----------------------------
			'google_share_available'             => 'Нажмите Вкл, чтобы активировать кнопку.',
			'google_share_url'                   => 'Задайте адрес страницы, которой пользователь должен поделиться, чтобы разблокировать скрытый контент. Оставьте это поле пустым, чтобы использовать адрес страницы, где будет установлен Замок.',
			'google_share_title'                 => 'Необязательно. Название кнопки, расположенное на обложке, используется в некоторых темах (по умолчанию только в Secrets и Flat).',
			//-----------------------------
			'google_youtube_available'           => 'Нажмите Вкл, чтобы активировать кнопку.',
			'google_youtube_channel_id'          => 'Установите ID канала на Youtube (пример, UCANLZYMidaCbLQFWXBC95Jg).',
			'google_youtube_title'               => 'Необязательно. Текст отображается на крышках кнопок в некоторых темах (по умолчанию только в Secrets и Flat).',
			//-----------------------------
			'linkedin_share_available'           => 'Нажмите Вкл, чтобы активировать кнопку.',
			'linkedin_share_url'                 => 'Задайте адрес страницы, которой пользователь должен поделиться, чтобы разблокировать скрытый контент. Оставьте это поле пустым, чтобы использовать адрес страницы, где будет установлен Замок.',
			'linkedin_share_title'               => 'Необязательно. Название кнопки, расположенное на обложке, используется в некоторых темах (по умолчанию только в Secrets и Flat).',
			//-----------------------------
			'vk_like_available'                  => 'Нажмите Вкл, чтобы активировать кнопку.',
			'vk_like_require_sharing'            => 'Если Вкл, чтобы разблокировать социальный замок с помощью кнопки мне нравится, пользователь обязательно должен нажать "Рассказать друзьям".',
			'vk_like_url'                        => 'Задайте адрес страницы, которую пользователь должен "лайкнуть", чтобы разблокировать скрытый контент. Оставьте это поле пустым, чтобы использовать адрес страницы, где будет установлен Замок.',
			'vk_like_title'                      => 'Необязательно. Название кнопки, расположенное на обложке, используется в некоторых темах (по умолчанию только в Secrets и Flat).',
			'vk_like_message_title'              => 'Необязательно. Заголовок записи.',
			'vk_like_message_description'        => 'Необязательно. Описание, которые отображается под ссылкой. Если не указано, это поле заполняется автоматически, обычно используется заголовок страницы.',
			'vk_like_message_image'              => 'Необязательно. Ссылка на картинку. Изображение будет добавлено к записи. Картина должна быть не менее 50px на 50px (рекомендуется 200px на 200px). Соотношение сторон не более 3:1.',
			//-----------------------------
			'vk_share_available'                 => 'Нажмите Вкл, чтобы активировать кнопку.',
			'vk_share_url'                       => 'Задайте адрес страницы, которую пользователь должен "лайкнуть", чтобы разблокировать скрытый контент. Оставьте это поле пустым, чтобы использовать адрес страницы, где будет установлен Замок.',
			'vk_share_title'                     => 'Необязательно. Название кнопки, расположенное на обложке, используется в некоторых темах (по умолчанию только в Secrets и Flat).',
			'vk_share_message_title'             => 'Необязательно. Заголовок записи.',
			'vk_share_message_description'       => 'Текстовое сообщение, которое будет опубликовано на стене пользователя.',
			'vk_share_message_image'             => 'Необязательно. Ссылка на картинку. Изображение будет добавлено к записи. Картина должна быть не менее 50px на 50px (рекомендуется 200px на 200px). Соотношение сторон не более 3:1.',
			//-----------------------------
			'vk_subscribe_available'             => 'Нажмите Вкл, чтобы активировать кнопку.',
			'vk_subscribe_group_id'              => 'Числовой ID или короткое имя вашей страницы / группы в Вконтакте. Например, для группы Яндекса (http://vk.com/yandex) корректное значение для этого поля будет 11283947 или yandex. Если вам нужна подписка на страницу пользователя, то перед id нужно указать символ @(пример: @id5537523 или @dkihot)',
			'vk_subscribe_title'                 => 'Необязательно. Название кнопки, расположенное на обложке, используется в некоторых темах (по умолчанию только в Secrets и Flat).',
			//-----------------------------
			'ok_share_available'                 => 'Нажмите Вкл, чтобы активировать кнопку.',
			'ok_share_url'                       => 'Задайте адрес страницы, которой пользователь должен поделиться, чтобы разблокировать скрытый контент. Оставьте это поле пустым, чтобы использовать адрес страницы, где будет установлен Замок.',
			'ok_share_title'                     => 'Необязательно. Название кнопки, расположенное на обложке, используется в некоторых темах (по умолчанию только в Secrets и Flat).',
			//-----------------------------
			'mail_share_available'               => 'Нажмите Вкл, чтобы активировать кнопку.',
			'mail_share_url'                     => 'Задайте адрес страницы, которой пользователь должен поделиться, чтобы разблокировать скрытый контент. Оставьте это поле пустым, чтобы использовать адрес страницы, где будет установлен Замок.',
			'mail_share_title'                   => 'Необязательно. Название кнопки, расположенное на обложке, используется в некоторых темах (по умолчанию только в Secrets и Flat).',
			'mail_share_message_title'           => 'Необязательно. Заголовок записи.',
			'mail_share_message_description'     => 'Необязательно. Описание, которые отображается под ссылкой. Если не указано, это поле заполняется автоматически, обычно используется заголовок страницы.',
			'mail_share_message_image'           => 'Необязательно. Ссылка на картинку. Изображение будет добавлено к записи. Картина должна быть не менее 50px на 50px (рекомендуется 200px на 200px). Соотношение сторон не более 3:1.',
			//-----------------------------
			'counters'                           => 'Показывать счетчики'
		];
	}

	/**
	 * Возвращает массив опций отформатированных по модели
	 * данных социального замка.
	 * @return array
	 */
	public function getLockerOptions() {
		return $this->mapLockerOptions();
	}

	/**
	 * Получает все поля текущей модели и возвращает их атрибуты
	 * в виде JSON строки. Метод в основном используется для отправки или
	 * обработки формы, через JavaScript.
	 *
	 * @return string - отформатированная JSON строка
	 */
	public function getModelFieldsFormatJSONString() {
		$provider_fields = [];

		foreach( $this->attributes as $attribute => $value ) {
			$provider_fields[] = [
				'id' => Html::getInputId($this, $attribute),
			    'name' => Html::getInputName($this, $attribute),
			    'attribute' => $attribute
			];
		}

		return Json::htmlEncode(json_encode($provider_fields));
	}

	/**
	 * Собирает опции в массив по заранее установленной карте.
	 * Карта опций основана на модели принимаемых данных в
	 * jQuery версии социального замка.
	 *
	 * @return array - массив опций наложенных на карту
	 */
	public function mapLockerOptions() {
		$mapData = [
			'demo'  => 'always',
			'theme' => 'style',
		];
		$mapData['text'] = [
			'header'  => null,
			'message' => null
		];
		$mapData['overlap'] = [
			'mode'     => 'overlap',
			'position' => 'overlap_position'
		];
		$mapData['effects'] = ['highlight' => null];
		$mapData['locker'] = [
			'timer'  => null,
			'close'  => null,
			'mobile' => null
		];
		$mapData['socialButtons'] = [
			'counters' => null,
			'facebook' => [
				/*'appId' => null,
				'lang'  => null,
				'version' => null,*/
				'like'  => [
					'url'   => 'facebook_like_url',
					'title' => 'facebook_like_title',
				],
				'share' => [
					'shareDialog' => 'facebook_share_dialog',
					'url'         => 'facebook_share_url',
					'title'       => 'facebook_share_title',
					'name'        => 'facebook_share_message_name',
					'caption'     => 'facebook_share_message_caption',
					'description' => 'facebook_share_message_description',
					'image'       => 'facebook_share_message_image',
				]
			],
			'twitter'  => [
				//'lang' => null,
				'tweet'  => [
					'url'         => 'twitter_tweet_url',
					'text'        => 'twitter_tweet_text',
					'title'       => 'twitter_tweet_title',
					'doubleCheck' => 'twitter_tweet_auth',
					'via'         => 'twitter_tweet_via'
				],
				'follow' => [
					'url'            => 'twitter_follow_url',
					'title'          => 'twitter_follow_title',
					'doubleCheck'    => 'twitter_follow_auth',
					'hideScreenName' => 'twitter_follow_hide_name',
				]
			],
			'google'   => [
				//'lang' => null,
				'plus'  => [
					'url'   => 'google_plus_url',
					'title' => 'google_plus_title',
				],
				'share' => [
					'url'   => 'google_share_url',
					'title' => 'google_share_title',
				]
			],
			'youtube'  => [
				'subscribe' => [
					'channelId' => 'google_youtube_channel_id',
					'title'     => 'google_youtube_title',
				],
			],
			'linkedin' => [
				'share' => [
					'url'   => 'linkedin_share_url',
					'title' => 'linkedin_share_title',
				],
			],
			'vk'       => [
				/*'appId' => null,
				'accessToken'  => null,
				'lang' => null,*/
				'like'      => [
					'pageTitle'       => 'vk_like_message_title',
					'pageDescription' => 'vk_like_message_description',
					'pageUrl'         => 'vk_like_url',
					'pageImage'       => 'vk_like_message_image',
					'text'            => 'vk_like_message_caption',
					'title'           => 'vk_like_title',
					'requireSharing'  => 'vk_like_require_sharing',
				],
				'share'     => [
					'pageUrl'         => 'vk_share_url',
					'pageTitle'       => 'vk_share_message_title',
					'pageDescription' => 'vk_share_description',
					'pageImage'       => 'vk_share_message_image',
					'title'           => 'vk_share_title'
				],
				'subscribe' => [
					'groupId' => 'vk_subscribe_group_id',
					'title'   => 'vk_subscribe_title',
				]
			],
			'ok'       => [
				'share' => [
					'url'   => 'ok_share_url',
					'title' => 'ok_share_title',
				]
			],
			'mail'     => [
				'share' => [
					'pageUrl'         => 'mail_share_url',
					'pageDescription' => 'mail_share_message_description',
					'pageImage'       => 'mail_share_message_image',
					'pageTitle'       => 'mail_share_message_title',
					'title'           => 'mail_share_title'
				],
			]
		];

		return $this->recursivePushOptions($mapData);
	}

	/**
	 * Рекурсивно заполняет массив опций по карте
	 * @param $map - карта опций
	 *
	 * @return array - массив опций наложенных на карту
	 */
	protected function recursivePushOptions($map) {
		foreach( $map as $key => $val ) {
			if( !is_array($val) ) {
				if( !empty($val) ) {
					$map[$key] = isset($this->attributes[$val])
						? (( $this->attributes[$val] === "0" ||  $this->attributes[$val] === "1" ) ? (boolean)$this->attributes[$val] : $this->attributes[$val])
						: null;
				} else {
					$map[$key] = isset($this->attributes[$key])
						? (($this->attributes[$key] === "0" || $this->attributes[$key] === "1" ) ? (boolean)$this->attributes[$key] : $this->attributes[$key])
						: null;
				}
			} else {
				$map[$key] = $this->recursivePushOptions($map[$key]);
			}
		}
		return $map;
	}

	/**
	 * @param Lockers $model
	 * @return mixed
	 */
	public function setModel($model)
	{
		$this->attributes = ArrayHelper::merge(
			Json::decode($model->options),
			$model->attributes
		);

		return $this->model;
	}


	/**
	 * Сохраянет данные текущей модели
	 * @param $type - передается тип замка в формате string
	 *
	 * @return bool|Exception
	 */
	public function save($type, $model = null) {
		$optionFilter = ['title', 'header', 'message', 'type', 'status'];

		if( empty($model) ) $model = new Lockers();

		$model->attributes = $this->attributes;

		if( !empty($id) ) $model->id = $id;

		$model->type = $type;
		$model->user_id = Yii::$app->user->identity->id;

		$locker_options = [];
		foreach( $this->attributes as $key => $attr ) {
			if( !in_array($key, $optionFilter) ) {
				$locker_options[$key] = $attr;
			}
		}

		$model->options = json_encode($locker_options);

		if( !$model->save() )
			return new Exception("Возникла ошибка при создание замка!");

		return true;
	}
}
