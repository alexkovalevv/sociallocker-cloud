/*!
 * Panda Lockers - v2.1.0, 2016-07-28 
 * for jQuery: http://onepress-media.com/plugin/social-locker-for-jquery/get 
 * for Wordpress: http://onepress-media.com/plugin/social-locker-for-wordpress/get 
 * 
 * Copyright 2016, OnePress, http://byonepress.com 
 * Help Desk: http://support.onepress-media.com/ 
*/

/*
 * Localization
 * Copyright 2016, OnePress, http://byonepress.com
 * @pacakge core
*/
(function ($) {
    /**
    * Text resources.
    */
   
    if ( !$.pandalocker ) $.pandalocker = {};

    if (!$.pandalocker.lang) $.pandalocker.lang = {};
    if (!$.pandalocker.lang.defaults ) $.pandalocker.lang.defaults = {};

    $.pandalocker.lang.defaults = {

        // - translatable text

        // the Screen "Please Confirm Your Email"

        confirm_screen_title:           'Пожалуйста, подтвердите ваш Email адрес',
        confirm_screen_instructiont:    'На ваш email адрес {email} отправлено письмо. Пожалуйста, откройте письмо и подтвердите подписку, чтобы разблокировать контент.',
        confirm_screen_note1:           'После подтверждения контент разблокируется автоматически в течение 10 секунд.',
        confirm_screen_note2:           'Ожидание подтверждения может занять несколько минут.',

        confirm_screen_cancel:          '(Отмена)',
        confirm_screen_open:            'Открыть мой почтовый ящик в {service}',

        // the Screen "One Step To Complete"

        onestep_screen_title:           'Один шаг до завершения',
        onestep_screen_instructiont:    'Пожалуйста, введите ваш email адрес',
        onestep_screen_button:          'Все хорошо',

        // the sign-in buttons

        signin_long:                    '{name}',
        signin_short:                   '{name}',
        signin_facebook_name:           'Facebook',
        signin_twitter_name:            'Twitter',
        signin_google_name:             'Google',
        signin_linkedin_name:           'LinkedIn',
        signin_vk_name:                 'Вконтакте',

        // miscellaneous
        misc_data_processing:           'Идет обработка данных, пожалуйста, подождите...',
        misc_or_enter_email:            'или введите свой email адрес вручную, чтобы авторизоваться',

        misc_enter_your_name:           'введите ваше имя',
        misc_enter_your_email:          'введите ваш email адрес',

        misc_your_agree_with:           'При нажатии на кнопку(и) вы соглашаетесь с {links}',
        misc_terms_of_use:              'условиями использования',
        misc_privacy_policy:            '<br>политика конфиденциальности',

        misc_or_wait:                   'или подождите {timer}сек',
        misc_close:                     'Закрыть',
        misc_or:                        'ИЛИ',

        // promts
        notUnlockPromptText:                    '<strong>Замок не открылся?</strong>Это возможно по следующим причинам:<br>1. Вы закрыли окно, не поделившись страницей.<br>2. Если окно, в котором вы делали репост, не закрылось автоматически, вы должны сделать это сами.<br>3. Возникла техническая ошибка.<br><br>',
        notUnlockPromptButtonYes:               'Попробовать снова?',
        notUnlockPromptButtonNo:                'Нет, я случайно нажал(а) кнопку',

        tryVkRepostPagePromptText:              'Спасибо, за вашу поддержку! Вам остался один шаг, после того, как вы нажмете кнопку "<b>продолжить</b>", появится всплывающее окно, нажмите кнопку "<b>отправить</b>" и закройте окно. Социальный замок проверит вашу стену и если вы действительно поделились страницей, замок будет открыт.',
        tryVkRepostPagePromptButtonYes:         'Продолжить',
        tryVkRepostPagePromptButtonNo:          'Нет, я случайно нажал(а) кнопку',

        postVkNotFindPromptText:                '<strong>Запись не найдена на вашей стене вконтакте!</strong>Социальный замок не смог найти запись на вашей стене вконтакте, возможно, вы не завершили репост страницы или удалили запись.<br><br><em>Если запись этой страницы есть на вашей стене, но замок не открывается, пожалуйста, обратитесь к администратору сайта!</em><br><br>' +
        'Нажмите кнопку "Продолжить", чтобы попробовать поделиться страницей снова. Продолжить?',
        postVkNotFindPromptButtonYes:           'Продолжить',
        postVkNotFindPromptButtonNo:            'Отменить',

        tryVKSubscribePromptText:               'Вы пытаетесь подписаться на сообщество или страницу в социальной сети вконтакте. Вам остался один шаг, чтобы завершить подписку.',
        tryVKSubscribePromptButtonYes:          'Нажмите, чтобы продолжить',
        tryVKSubscribePromptButtonNo:           'Нет, я случайно нажал(а) кнопку',

        subscribeVkCancelPromptText:            'Подписка была отменена или вы пытаетесь подписаться на закрытое сообщество. Если вы случайно закрыли окно, пожалуйста, попробуйте подписаться снова, чтобы открыть скрытый контент.',
        subscribeVkCancelPromptButtonYes:       'Повторить подписку',
        subscribeVkCancelPromptButtonNo:        'Нет, я случайно нажал(а) кнопку',

        mailCanNotOpenLockerPromptText:         '<strong>Замок не может быть разблокирован!</strong>Причины возникновения ошибки:<br>1. Вы не завершили репост страницы<br>2. Ранее, Вы уже делились этой страницей, пожалуйста, попробуйте поделиться этой страницей в другой социальной сети.',
        mailCanNotOpenLockerPromptButtonNo:     'Скрыть уведомление',

        mailRepostConfirmPromptText:            'Социальный замок опубликовал запись на вашей стене в социальной сети, оставьте комментарий к записи или просто <b>закройте окно комментариев<b>.',
        mailRepostConfirmPromptButtonYes:       'Завершить',
        mailRepostConfirmPromptProcessButtonYes:'Ожидание...',

        mailRepeatPostPagePromptText:           'Социальный замок определил, что вы ранее уже делились этой страницей. Старая запись была сброшена, чтобы поделиться страницей снова, <b>нажмите кнопку завершить</b>.',

        // errors & notices

        errors_empty_email:                     "Пожалуйста, введите ваш email адрес.",
        errors_inorrect_email:                  "Вы ввели некорректный email адрес. Пожалуйста, проверьте его и попробуйте снова.",
        errors_empty_name:                      "Пожалуйста, введите ваше имя.",

        errors_subscription_canceled:           "Вы отменили подписку.",
        errors_not_signed_in:                   "Вы не вошли в систему. Пожалуйста, попробуйте еще раз.",
        res_errors_not_granted:                 "Вы не предоставили неоходимые права ({permissions}). Пожалуйста, попробуйте еще раз.",

        // - default text & internal errors

        // common resources

        error:                                  'ошибка',
        noSpam:                                 'Ваш email адрес на 100% защищен от спама.',

        errors: {
            unableToLoadSDK:                    'Невозможно загрузить SDK сценарий для {0}. Пожалуйста, убедитесь, что ничто не препятствует загрузке социальных сценариев в вашем браузере. Некоторые расширения браузера (Avast, PrivDog, AdBlock и т.д.) могут вызывать эту проблему. Отключите их и попробуйте снова.',
            unableToCreateButton:               'Невозможно создать кнопку ({0}). Пожалуйста, убедитесь, что ничто не препятствует загрузке социальных сценариев в вашем браузере. Некоторые расширения браузера (Avast, PrivDog, AdBlock и т.д.) могут вызвать эту проблему. Отключите их и попробуйте снова.',

            emptyVKAppIdError:                  'Пожалуйста, установите ID вашего ВКонтакте приложения.',
            emptyVKAppInvalidBaseDomain:        'Не установлен базовый домен в вашем приложении Вконтакте или базовый домен не совпадает с текущим доменом.',
            emptyVKAccessTokenError:            'Пожалуйста, установите токен доступа.',
            emptyVKGroupIdError:                'Пожалуйста, установите ID вашей группы/страницы ВКонтакте, на которую пользователи должны подписаться, чтобы разблокировать контент.',
            invalidVKGroupIdError:              'Пожалуйста, проверьте правильность ID вашей группы/страницы ВКонтакте, возможно вы ошиблись при вводе или группа/страница не существует.',
            emptyFBAppIdError:                  'Пожалуйста, установите ID вашего Facebook приложения.',
			emptyFBGroupUrlError:               'Вы не указали url вашего сообщества в facebook или ссылка на сообщество некорректна.',
            emptyTwitterFollowUrlError:         'Пожалуйста, установите ссылку на ваш профиль в Twitter.',
            credentialError:                    'Ваш лицензионный ключ не привязан к текущему домену, вы можете привязать ключ, обратившись в <a href="http://sociallocker.ru/create-ticket/">службу поддержки</a>.',
            credentialLinkText:                 'Заблокировано с помощью "Социального Замка"',
            vkLikeAlertText:                    'Чтобы разблокировать, нажмите сюда',
            emptyGoogleClientId:                'Не установлен ID приложение Google. Вы должны создать идентификатор приложения в google',
            emptyYoutubeChannelId:              'Не установлен ID канала на Youtube. Вы должны получить его в вашем аккаунте.',
            unsupportedYoutubeSubscribeLayout:  'Кнопка Youtube не поддерживает вертикальную структуру, пожалуйста, удалите кнопку или смените тему.',
            subscribeToUserIdNotFound:          'ID пользователя введен некорректно или пользователя с таким ID(<a href="https://vk.com/{vk_user_id}">{vk_user_id}</a>) не существует.',
            subscribeToGroupIdNotFound:         'ID группы введен некорректно или группы с таким ID(<a href="https://vk.com/{vk_group_id}">{vk_group_id}</a>) не существует.',

            ajaxError:                          'Неожиданная ошибка Ajax. Пожалуйста, проверьте журнал консоли, чтобы получить более подробную информацию.',
            unableToCreateControl:              'Невозможно создать ({0}). Пожалуйста, убедитесь, что ничто не препятствует загрузке социальных сценариев в вашем браузере. Некоторые расширения браузера (Avast, PrivDog, AdBlock и т.д.) могут вызвать эту проблему. Отключите их и попробуйте снова.',
            invlidFacebookAppId:                'Ваш Id приложения на facebook недействителен, пожалуйста, проверьте его снова. Приложение должно иметь базовый домен идентичный домену, на котором вы используете плагин.',
            unsupportedTwitterFollowLayout:     'Кнопка Twitter подписаться не поддерживает вертикальную структуру, пожалуйста, удалите кнопку или смените тему.'
        },

        // locker type-dependent resources

        scopes: {

            // when the Connect Buttons is the primary group

            signinLocker: {
                defaultHeader:      "Авторизуйтесь, чтобы разблокировать содержимое",
                defaultMessage:     "Пожалуйста, авторизуйтесь. Нажмите на одну из кнопок ниже, чтобы разблокировать содержимое.",

                btnSubscribe:       "авторизуйтесь, чтобы разблокировать",

                viaSignInLong:      "{long}",
                viaSignInShort:     "{short}"
            },

            // when the Subscription is the primary group

            emailLocker: {
                defaultHeader:      "Этот контент только для подписчиков",
                defaultMessage:     "Пожалуйста, подпишитесь, чтобы разблокировать содержимое. Просто введите ваш email адрес.",

                btnSubscribe:       "авторизуйтесь, чтобы разблокировать",

                viaSignInLong:      "{short}",
                viaSignInShort:     "{name}"
            },

            // when the Social Buttons is the primary group

            socialLocker: {
                defaultHeader:      "Этот контент заблокирован",
                defaultMessage:     "Пожалуйста, поддержите нас, нажмите на одну из кнопок ниже, чтобы разблокировать контент."
            }
        },

        // text resources for the group 'connect-buttons'

        connectButtons: {

            defaultMessage: "подписаться на ваш социальный профайл одним нажатием",

            facebook: {},

            google: {
                clientIdMissed: "Не установлен ID приложение Google. Вы должны создать идентификатор приложения в google.",
                unexpectedError: 'Не удается авторизоваться. Неожиданная ошибка: {0}'
            },

            twitter: {
                proxyEmpty: "Прокси URL пуст. Прокси url используется для вызова Twitter API."
            },

            linkedin: {
                apiKeyMissed: "LinkedIn API ключ не установлен. Вы должны получить API ключ, прежде чем использовать кнопку.",
                apiKeyInvalid: "LinkedIn API ключ недействителен. Пожалуйста, проверьте его на корректность."
            },

            vk: {
                proxyEmpty: "Прокси URL пуст. Прокси url используется для вызова VK API.",
                appIdMissed: "Не установлен ID приложение Вконтакте. Вы должны создать идентификатор приложения в Вконтакте."
            },

            defaultSeparator: "или",

            errorYouTubeChannelMissed: "Пожалуйста, введите ID вашего канала на Youtube.",
            errorLinkedInCompanyNotFound: "Ваша компания '{0}' в LinkedIn не найдена.",
            errorLinkedInCompanyMissed: "Пожалуйста, установите Id вашей компании в LinkedIn.",
            errorTwitterUserMissed: "Пожалуйста, установите ID страницы в Twitter",
            errorTwitterMessageMissed: "Установите короткое сообщение, которым будут делиться в Twitter."
        },

        // text resources for the group 'subscription'

        subscription: {
            defaultText: 'Вы не можете авторизоваться через социальные сети? Введите адрес электронной почты вручную',
            defaultButtonText: 'сделано, открыть замок'
        },

        // text resources for the group 'social-buttons'

        socialButtons: {

            // default labels for the buttons covers
            facebookLike:       'мне нравится',
            facebookShare:      'поделиться',
            twitterTweet:       'твитнуть',
            twitterFollow:      'подписаться',
            googlePlus:         'плюсануть',
            googleShare:        'поделиться',
            youtubeSubscribe:   'подписаться',
            linkedinShare:      'поделиться',
            vkLike:             'мне нравится',
            vkShare:            'поделиться',
            vkSubscribe:        'подписаться',
            vkUnSubscribe:      'отписаться',
            okShare:            'класс',
            mailShare:          'поделиться'
        }
    };
    
    $.pandalocker.lang = $.pandalocker.lang.defaults;  
    
    if ( window.__pandalockers && window.__pandalockers.lang ) {
        $.pandalocker.lang = $.extend( $.pandalocker.lang, window.__pandalockers.lang );  
        window.__pandalockers.lang = null;
    }
 
})(jQuery);;
/*
 * Themes Presets
 * Copyright 2014, OnePress, http://byonepress.com
 * 
 * @since 1.0.0
 * @pacakge core
*/
(function ($) {

    if (!$.pandalocker.themes) $.pandalocker.themes = {};
    
    // Theme: Great Attractor
    
    $.pandalocker.themes['great-attractor'] = {};
    
    // Theme: Friendly Giant
    
    $.pandalocker.themes['friendly-giant'] = {
        
        theme: {
            fonts: [{
                name: 'Open Sans',
                styles: ['400', '700']
            }]
        }
    };
    
    // Theme: Dark Force
    
    $.pandalocker.themes['dark-force'] = {
        
        theme: {
            fonts: [{
                name: 'Montserrat',
                styles: ['400', '700']
            }]
        }
    };
    
    // Theme: Starter

    $.pandalocker.themes['starter'] = {
        
        socialButtons: {
            layout: 'horizontal',
            counter: true,
            flip: false
        }
    };
    
    // Theme: Secrets
    
    $.pandalocker.themes['secrets'] = {
        
        socialButtons: {
            layout: 'horizontal',
            counter: true,
            flip: true
        }
    };
    
    // Theme: Dandyish
    
    $.pandalocker.themes['dandyish'] = {

        socialButtons: {
            unsupported: ['twitter-follow'],
            layout: 'vertical',
            counter: true,
            flip: false
        }
    };
    
    // Theme: Glass
    
    $.pandalocker.themes['glass'] = {

        socialButtons: {
            layout: 'horizontal',
            counter: true,
            flip: false
        }
    };

    // Theme: Flat
    
    $.pandalocker.themes['flat'] = {

        socialButtons: {
            layout: 'horizontal',
            counter: true,
            flip: true
        }
    };

})(jQuery);;
/*
 * Variables
 * Copyright 2014, OnePress, http://byonepress.com
 * 
 * @since 1.0.0
 * @pacakge includes
*/
(function($){
    'use strict';
    
    if ( !$.pandalocker ) $.pandalocker = {};

    if ( !$.pandalocker.data ) $.pandalocker.data = {};
    if ( !$.pandalocker.entity ) $.pandalocker.entity = {};
    if ( !$.pandalocker.groups ) $.pandalocker.groups = {};
    if ( !$.pandalocker.controls ) $.pandalocker.controls = {};
    if ( !$.pandalocker.tools ) $.pandalocker.tools = {};
    if ( !$.pandalocker.storages ) $.pandalocker.storages = {};
    if ( !$.pandalocker.services ) $.pandalocker.services = {};
    if ( !$.pandalocker.extras ) $.pandalocker.extras = {};

    if ( !$.pandalocker.controls["social-buttons"] ) $.pandalocker.controls["social-buttons"] = {};
    if ( !$.pandalocker.controls["connect-buttons"] ) $.pandalocker.controls["connect-buttons"] = {};
    if ( !$.pandalocker.controls["subscription"] ) $.pandalocker.controls["subscription"] = {};

})(jQuery);;
/*
 * Filers & Hooks API
 * Copyright 2014, OnePress, http://byonepress.com
 * 
 * @since 1.0.0
 * @pacakge core
*/
(function ($) {
    'use strict';
    
    if ( !$.pandalocker ) $.pandalocker = {};
    $.pandalocker.filters = $.pandalocker.filters || {

        /**
         * A set of registered filters.
         */
        _items: {},

        /**
         * A set of priorities of registered filters.
         */
        _priorities: {},

        /**
         * Applies filters to a given input value.
         */
        run: function( filterName, args ) {
            var input = args && args.length > 0 ? args[0] : null;
            if ( !this._items[filterName] ) return input;
                      
            for ( var i in this._priorities[filterName] ) {
                if ( !this._priorities[filterName].hasOwnProperty(i) ) continue;
                
                var priority = this._priorities[filterName][i];

                for ( var k = 0; k < this._items[filterName][priority].length; k++ ) {
                    var f = this._items[filterName][priority][k];  
                    input = f.apply(f, args);                    
                }
            }

            return input;
        },

        /**
         * Registers a new filter.
         */
        add: function( filterName, callback, priority ) {
            if ( !priority ) priority = 10;

            if ( !this._items[filterName] ) this._items[filterName] = {};
            if ( !this._items[filterName][priority] ) this._items[filterName][priority] = [];
            this._items[filterName][priority].push( callback );

            if ( !this._priorities[filterName] ) this._priorities[filterName] = [];
            if ( $.inArray( priority, this._priorities[filterName]) === -1 ) this._priorities[filterName].push( priority );

            this._priorities[filterName].sort(function(a,b){return a-b;});
        }
    };
    
    $.pandalocker.hooks = $.pandalocker.hooks || {

        /**
         * Applies filters to a given input value.
         */
        run: function( filterName, args ) {
            $.pandalocker.filters.run( filterName, args );
        },

        /**
         * Registers a new filter.
         */
        add: function( filterName, callback, priority ) {
            $.pandalocker.filters.add( filterName, callback, priority );
        }
    };

})(jQuery);;
(function(window, document, $) {
    'use strict';
    
    if ( !$.pandalocker ) $.pandalocker = {};
    $.pandalocker.deferred = $.Deferred || function() {
        var self = this;

        var events = { done: [], fail: [], always: [] };
        
        this.resolved = false;
        this.rejected = false;
        
        this.arg1 = null;
        this.arg2 = null;      
        
        this.resolve = function( arg1, arg2 ){
            if ( this.resolved || this.rejected ) return this;
            this.resolved = true;
            
            this.arg1 = arg1;
            this.arg2 = arg2;        
            
            for (var i = 0; i < events.done.length; i++ ) events.done[i]( arg1, arg2 );
            for (var i = 0; i < events.always.length; i++ ) events.always[i]( arg1, arg2 );
            
            return this;
        };
        
        this.reject = function( arg1, arg2 ) {
            if ( this.resolved || this.rejected ) return this;
            this.rejected = true;
            
            this.arg1 = arg1;
            this.arg2 = arg2;        
            
            for (var i = 0; i < events.fail.length; i++ ) events.fail[i]( arg1, arg2 );
            for (var i = 0; i < events.always.length; i++ ) events.always[i]( arg1, arg2 );
            
            return this;
        };
        
        this.done = this.success = function( callback ) {
            if ( this.resolved ) callback && callback( this.arg1, this.arg2 );
            else events.done.push( callback );

            return this; 
        };
        
        this.fail = this.error = function( callback ) { 
            if ( this.rejected ) callback && callback( this.arg1, this.arg2 );
            else events.fail.push( callback );
            
            return this; 
        };
        
        this.always = function( callback ) { 
            if (  this.resolved || this.rejected ) callback && callback( this.arg1, this.arg2 );
            else events.always.push( callback );
            
            return this; 
        };
        
        this.promise = function() { return this; };
    };

}(window, document, jQuery));;
/*!
 * Helper Tools
 * Copyright 2016, OnePress, http://byonepress.com
 *
 * @pacakge core
 */
(function ($) {
    'use strict';
    if (!$.pandalocker.tools) $.pandalocker.tools = {};

    /**
     * Implements the inheritance.
     */
    $.pandalocker.tools.extend = function (o) {
        function F() {
        }

        F.prototype = $.extend(true, {}, o);
        return new F();
    };

    /**
     * A plugin exception.
     */
    $.pandalocker.error = function (message) {
        this.onpsl = true;
        this.message = message;
    };

    /**
     * Normalizes the option which should setup some html content (etc. header, message)
     */
    $.pandalocker.tools.normilizeHtmlOption = function (value) {
        if (!value) return value;
        if (typeof value === "function") return value(this);
        if (typeof value === "string") return $("<div>" + value + "</div>");
        if (typeof value === "object") return value.clone();
        return value;
    };

    /**
     * Comapres two arrays and return differents.
     */
    $.pandalocker.tools.diffArrays = function (arr1, arr2) {
        return $.grep(arr1, function (el) {
            return $.inArray(el, arr2) == -1;
        });
    };

    /**
     * Comapres two arrays and the common elemtnts.
     */
    $.pandalocker.tools.unionArrays = function (arr1, arr2) {
        return $.grep(arr1, function (element) {
            return $.inArray(element, arr2) !== -1;
        });
    };

    /*
     * Cookie's function.
     * Allows to set or get cookie.
     *
     * Based on the plugin jQuery Cookie Plugin
     * https://github.com/carhartl/jquery-cookie
     *
     * Copyright 2011, Klaus Hartl
     * Dual licensed under the MIT or GPL Version 2 licenses.
     * http://www.opensource.org/licenses/mit-license.php
     * http://www.opensource.org/licenses/GPL-2.0
     */
    $.pandalocker.tools.cookie = $.pandalocker.tools.cookie || function (key, value, options) {

        // Sets cookie
        if (arguments.length > 1 && (!/Object/.test(Object.prototype.toString.call(value)) || value === null || value === undefined)) {
            options = $.extend({}, options);
            if (value === null || value === undefined) {
                options.expires = -1;
            }
            if (typeof options.expires === 'number') {
                var days = options.expires, t = options.expires = new Date();
                t.setDate(t.getDate() + days);
            }
            value = String(value);
            return (document.cookie = [
                encodeURIComponent(key), '=', options.raw ? value : encodeURIComponent(value),
                options.expires ? '; expires=' + options.expires.toUTCString() : '',
                options.path ? '; path=' + options.path : '',
                options.domain ? '; domain=' + options.domain : '',
                options.secure ? '; secure' : ''
            ].join(''));
        }
        // Gets cookie.
        options = value || {};
        var decode = options.raw ? function (s) {
            return s;
        } : decodeURIComponent;
        var pairs = document.cookie.split('; ');
        for (var i = 0, pair; pair = pairs[i] && pairs[i].split('='); i++) {
            if (decode(pair[0]) === key) return decode(pair[1] || '');
        }
        return null;
    };

    /*
     * jQuery MD5 Plugin 1.2.1
     * https://github.com/blueimp/jQuery-MD5
     *
     * Copyright 2010, Sebastian Tschan
     * https://blueimp.net
     *
     * Licensed under the MIT license:
     * http://creativecommons.org/licenses/MIT/
     *
     * Based on
     * A JavaScript implementation of the RSA Data Security, Inc. MD5 Message
     * Digest Algorithm, as defined in RFC 1321.
     * Version 2.2 Copyright (C) Paul Johnston 1999 - 2009
     * Other contributors: Greg Holt, Andrew Kepert, Ydnar, Lostinet
     * Distributed under the BSD License
     * See http://pajhome.org.uk/crypt/md5 for more info.
     */
    $.pandalocker.tools.hash = $.pandalocker.tools.hash || function (str) {
        var hash = 0;
        if (!str || str.length === 0) return hash;
        for (var i = 0; i < str.length; i++) {
            var charCode = str.charCodeAt(i);
            hash = ((hash << 5) - hash) + charCode;
            hash = hash & hash;
        }
        hash = hash.toString(16);
        hash = hash.replace("-", "");
        return hash;
    };
    /**
     * Checks does a browers support 3D transitions:
     * https://gist.github.com/3794226
     */

    $.pandalocker.tools.has3d = $.pandalocker.tools.has3d || function () {
        var el = document.createElement('p'),
            has3d,
            transforms = {
                'WebkitTransform': '-webkit-transform',
                'OTransform': '-o-transform',
                'MSTransform': '-ms-transform',
                'MozTransform': '-moz-transform',
                'Transform': 'transform'
            };
        el.className = 'onp-sl-always-visible';
        // Add it to the body to get the computed style
        document.body.insertBefore(el, null);
        for (var t in transforms) {
            if (el.style[t] !== undefined) {
                el.style[t] = 'translate3d(1px,1px,1px)';
                has3d = window.getComputedStyle(el).getPropertyValue(transforms[t]);
            }
        }
        document.body.removeChild(el);
        return (has3d !== undefined && has3d.length > 0 && has3d !== "none");
    };
    /**
     * Checks does a brower support Blur filter.
     */

    $.pandalocker.tools.canBlur = $.pandalocker.tools.canBlur || function () {
        var el = document.createElement('div');
        el.style.cssText = _browserPrefixes.join('filter' + ':blur(2px); ');
        var result = !!el.style.length && ((document.documentMode === undefined || document.documentMode > 9));
        if (result) return true;
        try {
            result = typeof SVGFEColorMatrixElement !== undefined &&
            SVGFEColorMatrixElement.SVG_FECOLORMATRIX_TYPE_SATURATE == 2;
        } catch (e) {
        }
        return result;
    };

    /**
     * Returns true if a current user use a touch device
     * http://stackoverflow.com/questions/4817029/whats-the-best-way-to-detect-a-touch-screen-device-using-javascript
     */
    $.pandalocker.isTouch = $.pandalocker.isTouch || function () {
        return !!('ontouchstart' in window) // works on most browsers
            || !!('onmsgesturechange' in window); // works on ie10
    };

    /**
     * OnePress Widget Factory.
     * Supports:
     * - creating a jquery widget via the standart jquery way
     * - call of public methods.
     */
    $.pandalocker.widget = function (pluginName, pluginObject) {
        var factory = {
            createWidget: function (element, options) {
                var widget = $.extend(true, {}, pluginObject);
                widget.element = $(element);
                widget.options = $.extend(true, widget.options, options);
                if (widget._init) widget._init();
                if (widget._create) widget._create();
                $.data(element, 'plugin_' + pluginName, widget);
            },
            callMethod: function (widget, methodName) {
                return widget[methodName] && widget[methodName]();
            }
        };
        $.fn[pluginName] = function () {
            var args = arguments;
            var argsCount = arguments.length;
            var toReturn = this;
            this.each(function () {
                var widget = $.data(this, 'plugin_' + pluginName);
                // a widget is not created yet
                if (!widget && argsCount <= 1) {
                    factory.createWidget(this, argsCount ? args[0] : false);
                    // a widget is created, the public method with no args is being called
                } else if (argsCount == 1) {
                    toReturn = factory.callMethod(widget, args[0]);
                }
            });
            return toReturn;
        };
    };

    $.pandalocker.detectBrowser = $.pandalocker.detectBrowser || function () {
        var uaMatch = jQuery.uaMatch || function (ua) {
                ua = ua.toLowerCase();
                var match = /(chrome)[ \/]([\w.]+)/.exec(ua) ||
                    /(webkit)[ \/]([\w.]+)/.exec(ua) ||
                    /(opera)(?:.*version|)[ \/]([\w.]+)/.exec(ua) ||
                    /(msie) ([\w.]+)/.exec(ua) ||
                    ua.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec(ua) ||
                    [];
                return {
                    browser: match[1] || "",
                    version: match[2] || "0"
                };
            };
        var matched = uaMatch(navigator.userAgent);
        $.pandalocker.browser = {};
        if (matched.browser) {
            $.pandalocker.browser[matched.browser] = true;
            $.pandalocker.browser.version = matched.version;
        }
        function getInternetExplorerVersion() {
            var rv = -1;
            if (navigator.appName == 'Microsoft Internet Explorer') {
                var ua = navigator.userAgent;
                var re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
                if (re.exec(ua) != null) rv = parseFloat(RegExp.$1);
            }
            else if (navigator.appName == 'Netscape') {
                var ua = navigator.userAgent;
                var re = new RegExp("Trident/.*rv:([0-9]{1,}[\.0-9]{0,})");
                if (re.exec(ua) != null) rv = parseFloat(RegExp.$1);
            }
            return rv;
        }

        var ieVersion = getInternetExplorerVersion();
        if (ieVersion > 0) {
            $.pandalocker.browser.msie = true;
            $.pandalocker.browser.version = ieVersion;
        }
        if (navigator.userAgent.search(/YaBrowser/i) > 0) {
            var yaMatchExec = /(YaBrowser)[ \/]([\w.]+)/.exec(navigator.userAgent);
            $.pandalocker.browser.YaBrowser = true;
            $.pandalocker.browser.version = yaMatchExec[2] || "0";
        }
        // Chrome is Webkit, but Webkit is also Safari.
        if ($.pandalocker.browser.chrome) {
            $.pandalocker.browser.webkit = true;
        } else if ($.pandalocker.browser.webkit) {
            $.pandalocker.browser.safari = true;
        }
    };

    $.pandalocker.detectBrowser();

    /**
     * Converts string of the view 'foo-bar' to 'fooBar'.
     * http://stackoverflow.com/questions/10425287/convert-string-to-camelcase-with-regular-expression
     */
    $.pandalocker.tools.camelCase = function (input) {
        return input.toLowerCase().replace(/-(.)/g, function (match, group1) {
            return group1.toUpperCase();
        });
    };

    $.pandalocker.tools.capitaliseFirstLetter = function (input) {
        return input.charAt(0).toUpperCase() + input.slice(1);
    };

    /**
     * Returns true if a current user uses a mobile device, else false.
     */
    $.pandalocker.tools.isMobile = function () {
        if ((/webOS|iPhone|iPod|BlackBerry/i).test(navigator.userAgent)) return true;
        if ((/Android/i).test(navigator.userAgent) && (/Mobile/i).test(navigator.userAgent)) return true;
        return false;
    };

    /**
     * Returns true if a current user uses a mobile device or tablet device, else false.
     */
    $.pandalocker.tools.isTabletOrMobile = function () {
        if ((/webOS|iPhone|iPad|Android|iPod|BlackBerry/i).test(navigator.userAgent)) return true;
        return false;
    };

    /**
     * Updates the query string parameter in the given url.
     * http://stackoverflow.com/questions/5999118/add-or-update-query-string-parameter
     */
    $.pandalocker.tools.updateQueryStringParameter = function (uri, key, value) {
        var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
        var separator = uri.indexOf('?') !== -1 ? "&" : "?";
        if (uri.match(re)) {
            return uri.replace(re, '$1' + key + "=" + value + '$2');
        }
        else {
            return uri + separator + key + "=" + value;
        }
    };

    $.pandalocker.tools.isValidEmailAddress = function (emailAddress) {
        var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
        return pattern.test(emailAddress);
    };

    $.pandalocker.tools.isValidUrl = function (emailAddress) {
        var pattern = new RegExp(/^(https?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i);
        return pattern.test(emailAddress);
    };

    // Find Left Boundry of current Window
    $.pandalocker.tools.findLeftWindowBoundry = function () {
        // In Internet Explorer window.screenLeft is the window's left boundry
        if (window.screenLeft)
            return window.screenLeft;
        // In Firefox window.screenX is the window's left boundry
        if (window.screenX)
            return window.screenX;
        return 0;
    };

    // Find Left Boundry of current Window
    $.pandalocker.tools.findTopWindowBoundry = function () {
        // In Internet Explorer window.screenLeft is the window's left boundry
        if (window.screenTop)
            return window.screenTop;
        // In Firefox window.screenY is the window's left boundry
        if (window.screenY)
            return window.screenY;
        return 0;
    };

    // Finds JSON object inside text
    $.pandalocker.tools.extractJSON = function (str) {
        var firstOpen, firstClose, candidate;
        firstOpen = str.indexOf('{', firstOpen + 1);
        do {
            firstClose = str.lastIndexOf('}');
            if (firstClose <= firstOpen) {
                return null;
            }
            do {
                candidate = str.substring(firstOpen, firstClose + 1);
                try {
                    var res = $.parseJSON(candidate);
                    if (res) return res;
                }
                catch (e) {
                }
                firstClose = str.substr(0, firstClose).lastIndexOf('}');
            } while (firstClose > firstOpen);
            firstOpen = str.indexOf('{', firstOpen + 1);
        } while (firstOpen != -1);
        return false;
    };
    
    $.pandalocker.tools.saveValue = function( name, value, expires ) {
        
        if ( localStorage && localStorage.setItem ) {
            try {
                localStorage.setItem( name, value );             
            } catch(e) {
                $.pandalocker.tools.cookie( name, value, { expires: expires, path: "/" });
            }
        } else {
            $.pandalocker.tools.cookie( name, value, { expires: expires, path: "/" });
        }
    };
    
    $.pandalocker.tools.getValue = function( name, defaultValue ) {
        
        var result = localStorage && localStorage.getItem && localStorage.getItem( name );
        if ( !result ) result = $.pandalocker.tools.cookie( name );
        if ( !result ) return defaultValue;
        return result;
    };
    
    $.pandalocker.tools.guid = function() {

		var s4 = function() {
			return Math.floor((1 + Math.random()) * 0x10000)
				.toString(16)
				.substring(1);
		};

		return s4() + s4() + '-' + s4() + '-' + s4() + '-' + s4() + '-' + s4() + s4() + s4();
	};

    /**
     * Инструменты для отладки
     * Придумать подгрузку откладчика с нашего сайта, чтобы на увеличивать вес плагина
     * @type {{}}
     */
	$.pandalocker.tools.debugBuffer = {
		mobile:  $.pandalocker.tools.isMobile(),
		browser: $.pandalocker.browser,
		userAgent: navigator.userAgent
	};

	/**
	 * Стурктурирует объект в читабельный вид
	 * @param options
	 * @param deph
	 * @returns {string}
	*/
	$.pandalocker.tools.convertObjToString = function ( options, deph ) {
		var str = '';
		var deph = deph ? deph : 0;
		var t = $.pandalocker.tools.getTabByDeph( deph );
		var i = 1;
		for ( var p in options ) {
			str += t;
			if ( !options[p] || typeof options[p] == 'string' || typeof options[p] == "number" || typeof options[p] == "boolean" || Array.isArray( options[p] ) ) {
				var option;
				if ( typeof options[p] == "boolean" || typeof options[p] == "number" ) {
					option = options[p];
				} else if ( Array.isArray( options[p] ) ) {
					option = "[" + $.pandalocker.tools.arrayToStr( options[p] ) + "]";
				} else {
					option = "'" + options[p] + "'";
				}
				str += p + ": " + option;
			} else {
				str += p + ":{\n" + $.pandalocker.tools.convertObjToString( options[p], deph + 1 ) + "}";
			}
			if ( $.pandalocker.tools.countProperties( options ) != i ) {
				str += ",\n";
			} else {
				str += "\n" + ( deph ? $.pandalocker.tools.getTabByDeph( deph - 1 ) : '');
			}
			i++;
		}
		return str;
	};

	/**
	 * Устанавливает табуляцию по уровню вложенности
	 * @param deph
	 * @returns {string}
	*/
	$.pandalocker.tools.getTabByDeph = function ( deph ) {
		var t = "\t";
		for ( var k = 0; k < deph; k++ ) {
			t += "   ";
		}
		return t;
	};

	/**
	 * Конвертирует массив в строку
	 * @param arr
	 * @returns {string}
	*/
	$.pandalocker.tools.arrayToStr = function ( arr ) {
		var str = [];
		for ( var i in arr ) {
			/*if ( typeof arr[i] !== 'string' ) {
				continue;
			}*/
			str.push( '"' + arr[i] + '"' );
		}
		return str.join();
	};

	/**
	 * Считает свойства объекта
 	 * @param obj
	 * @returns {number}
	*/
	$.pandalocker.tools.countProperties = function ( obj ) {
		var count = 0;
		for ( var prop in obj ) {
			if ( obj.hasOwnProperty( prop ) ) {
				++count;
			}
		}
		return count;
	};

	/**
	 * Удаляет все данные сохранненные замком
	*/
	$( document ).on( 'click', '.onp-sl-debug-clear-data', function () {
		var clearKeys = [];
		for ( var i = 0, len = localStorage.length; i < len; ++i  ) {
			var storageItemId = localStorage.key( i );
			if ( storageItemId && ( storageItemId.indexOf( 'onp-sl-vk' ) + 1 || storageItemId.indexOf( 'onp_sl_vk' ) + 1 || storageItemId.indexOf( 'page_' ) + 1) ) {
				clearKeys.push(storageItemId);
			}
		}

		for(i in clearKeys) {
			$( this ).text( $( this ).text() + '.' );
			$.pandalocker.tools.removeStorage(clearKeys[i]);
		}

		return false;
	} );


    /**
     * Данная функции записывает и выводит отладочную информацию
	 * @param details - Объект с различного рода информаций.
     * @return {void}
    */
	$.pandalocker.tools.debugger = function ( details ) {
		var l = (location.toString().match( /#(.*)/ ) || {})[1] || '';
		$.pandalocker.tools.debugBuffer = $.extend( true, $.pandalocker.tools.debugBuffer, details );

		if ( l && l == 'pandalocker_debug' ) {
			if ( !$( '.onp-sl-debug-panel' ).length ) {
				$( 'body' ).prepend(
					'<div class="onp-sl-debug-panel"><h3>Внимание! Включен режим откладки.</h3><pre>' +
					$.pandalocker.tools.convertObjToString( $.pandalocker.tools.debugBuffer ) +
					'</pre><a href="#" class="onp-sl-debug-clear-data">Сбросить кеш и удалить данные из памяти</div>'
				);
			} else {
				$( '.onp-sl-debug-panel' ).find( 'pre' ).html(
					$.pandalocker.tools.convertObjToString( $.pandalocker.tools.debugBuffer )
				);
			}
		}
	};

	/**
	 * Дабавляет метку или куку в локальное хранилище
	 * @param cookieName
	 * @param value
	 * @param expires
	 */
	$.pandalocker.tools.setStorage = function ( cookieName, value, expires ) {
		if ( localStorage && localStorage.setItem ) {
			try {
				var unixtime = Math.round( +new Date() / 1000 );
				var str = {
					data:    value,
					expires: expires * 86400 + unixtime
				};
				localStorage.setItem( cookieName, JSON.stringify( str ) );
			}
			catch ( e ) {
				$.pandalocker.tools.cookie( cookieName, value, { expires: expires, path: "/" } );
			}
		} else {
			$.pandalocker.tools.cookie( cookieName, value, { expires: expires, path: "/" } );
		}
	};

	/**
	 * Получает метку или куку из локального хранилища
	 * @param cookieName
	 * @returns {string}
	*/
	$.pandalocker.tools.getFromStorage = function ( cookieName ) {
		var result = localStorage && localStorage.getItem && localStorage.getItem( cookieName );
		if ( result ) {
			var unixtime = Math.round( +new Date() / 1000 );
			result = JSON.parse( result );
			if ( result.expires < unixtime ) {
				this.removeStorage( cookieName );
				return null;
			}
			return result.data;
		} else {
			return $.pandalocker.tools.cookie( cookieName ) ? $.pandalocker.tools.cookie( cookieName ) : null;
		}
	};

	/**
	 * Удаляет метку или куку из локального хранилища
	 * @param cookieName
	*/
	$.pandalocker.tools.removeStorage = function ( cookieName ) {
		if ( localStorage && localStorage.removeItem ) {
			localStorage.removeItem( cookieName );
		} else {
			$.pandalocker.tools.cookie( cookieName, null, { expires: 0, path: "/" } );
		}
	};

	/**
	 * Читабельное название checkDomainType
	 * Проверяет тип домена возможные варианты:
	 * русский|пуникод|обычный
	 * @param str
	 * @return {string} - домен
	*/
	$.pandalocker.tools.cdmt = function ( str ) {
		if ( /(?:[А-я0-9-.]+)?[\u0410-\u044F0-9-]+\.[\u0410-\u044F0-9-]{2,}/i.test( str ) ) {
			return 'cyrillic';
		} else if ( /(?:xn--[A-z0-9-.]+)?xn--[A-z0-9-]+\.xn--[A-z0-9-]{2,}/i.test( str ) ) {
			return 'punycode';
		}
		return 'normal';
	};


	/**
	 * Читабельное название normalizecyrillicDomain
	 * Форматирует киррилический домен
	 * @param str
	 * @return {string} - отформатированный домен
	*/
    $.pandalocker.tools.ncdn = function (str) {
        var re = /(?:[А-я0-9-.]+)?[А-я0-9-]+\.[А-я0-9-]{2,}/i;
        var found = str.match(re);
        return found[0];
    };

	/**
	 * Читабельное название normalizePunycodeDomain
	 * Форматирует домен кодированный в punycode
	 * @param str
	 * @return {string} - отформатированный домен
	*/
    $.pandalocker.tools.npcd = function (str) {
        var re = /(?:xn--[A-z0-9-.]+)?xn--[A-z0-9-]+\.xn--[A-z0-9-]{2,}/i;
        var found = str.match(re);
        return found[0];
    };

	/**
	 * Читабельное название strDecode
	 * Легкая фукнция для декодирования информации
	 * закодированной спомощью $.pandalocker.tools.see
	 * @param str
	 * @return {string} - декодированная строка
	*/
    $.pandalocker.tools.sde = function (str) {
        var res = '';
        var separateSymbols = str.split(/[a-z]{1}/i);
        for (var i = 0; i < separateSymbols.length; i++) {
            res += String.fromCharCode(separateSymbols[i]);
        }
        return res;
    };

	/**
	 * Читабельное название strEncode
	 * Легкая фукнция для кодирования информации
	 * @param str
	 * @return {string} - закодированная строка
	*/
    $.pandalocker.tools.see = function (str) {
        var n = '';
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        for (i = 0; i < str.length; i++) {
            n += str.charCodeAt(i) + possible.charAt(Math.floor(Math.random() * possible.length));
        }
        return n;
    };

	/**
	 * Читабельное название getDomainSuffix
	 * Функция получает корневой домен, если введен поддомен к примеру
	 *
	 * Данная функция используется для лицензионного модуля
	 * @param str
	 * @return {string} - всегда возвращает корневой домен
	*/
    $.pandalocker.tools.gdms = function (str) {
        var re = /[A-z0-9-]+\.(ucoz.ru|blogspot\.[A-z]+|liveinternet\.[A-z]+|livejournal\.[A-z]+|de\.[A-z]{2}|eu\.[A-z]{2}|in\.[A-z]{2}|ru\.[A-z]{2}|co\.[A-z]{2}|org\.[A-z]{2}|com\.[A-z]{2}|[A-z0-9-]+)$/gi;
        var found = str.match(re);
        return found[0];
    };

	/**
	 * Читабельное название getCurrentHost
	 * Функция получает текущий домен и если он кирилический,
	 * автоматически преобразует его в punycode
	 *
	 * Данная функция используется для лицензионного модуля
	 * @return {string} - закодированная строка
	*/
    $.pandalocker.tools.gch = function () {
        if ($.pandalocker.tools.cdmt(document['domain']) == 'cyrillic') {
            return punycode.toASCII($.pandalocker.tools.ncdn(document['domain']));
        }
        return document['domain'];
    };

})(jQuery);;
/*
 * SDK Connector
 * Copyright 2014, OnePress, http://byonepress.com
 * 
 * @since 1.0.0
 * @pacakge core
*/
(function ($) {
    'use strict';

    $.pandalocker.sdk = $.pandalocker.sdk || {

        /**
         * Contains dictionary sdk_name => is_sdk_ready (bool)
         * 
         * @since 1.0.0
         * @return object
         */
         _ready: {},

        /**
         * Contains dictionaty sdk_name => is_sdk_connected (bool)
         * 
         * @since 1.0.0
         * @return object
         */
         _connected: {},
         
        /**
         * Contains dictionaty sdk_name => is_sdk_fired_error (bool)
         * 
         * @since 1.0.0
         * @return object
         */
         _error: {},

        /**
         * Get a SDK object by its name.
         * 
         * @since 1.0.0
         * @return object
         */
         getSDK: function (name) {
             name = $.pandalocker.tools.camelCase(name);
             if ( $.pandalocker.sdk[name] ) return $.pandalocker.sdk[name];
             return null;
         },

        /**
         * Checks whether a specified SDK is connected (sdk script is included into a page).
         * 
         * @since 1.0.0
         * @return object
         */
         isConnected: function (sdk) {
             if ( $("#" + sdk.scriptId).length > 0 ) return true;

             var found = false;
             $("script").each(function(){
                 var src = $(this).attr('src');
                 if ( !src ) return true;

                 found = src.indexOf(sdk.url) !== -1;
                 if ( found ) { 
                     $(this).attr('id', sdk.scriptId);
                     return false;
                 }
             });
             return found;
         },

        /**
         * Gets loading SDK script on a page.
         * 
         * @since 1.0.0
         * @return object
         */
         getLoadingScript: function (sdk) {

             var byId = $("#" + sdk.scriptId);
             var byScr = $("script[src='*" + sdk.url + "']");
             return (byId.length > 0) ? byId : byScr;
         },

        /**
         * Checks whether a specified SQK is loaded and ready to use.
         * 
         * @since 1.0.0
         * @return object
         */
         isLoaded: function (sdk) {
            return this.isConnected(sdk) && sdk.isLoaded && sdk.isLoaded();
         },

         /**
         * Connects SKD if it's needed then calls callback.
         */
         connect: function (name, options, timeout) {
            var self = this;
            var sdk = this.getSDK(name);
            
            var result = new $.pandalocker.deferred();
            
            if (!sdk) {
               console && console.log('Invalide SDK name: ' + name);
               result.reject('invalide-sdk');
               return result.promise();
            }
            
            sdk.options = options;
            
            // an error if the timeout reached
            setTimeout(function(){
                var loaded = sdk.isLoaded();
                
                if ( !loaded ) {
                    self._connected[name] = false;             
                    result.reject('timeout');
                } else {
                    self.setup && self.setup();
                }
            }, timeout);

            // if aready loaded and ready
            if ( this._ready[name] ) {
                
                result.resolve();
                return result.promise();
            
            // if not, waits until it's ready
            } else {
                $(document).bind(name + "-init", function () { result.resolve(); });
                $(document).bind(name + "-error", function ( e, error ) { 
                    self._error[name] = true;          
                    result.reject(error);
                });      
            }
            
            // if already connected, waits result from the previos caller
            if (this._connected[name] && !self._error[name]) return result.promise();

            // sets the default method if it's not specified
            if (!sdk.createEvents) {

                sdk.createEvents = function () {
                    var isLoaded = sdk.isLoaded();

                    var load = function () {
                        $(document).trigger(sdk.name + '-init');
                    };

                    if (isLoaded) { load(); return; }

                    $(document).bind(sdk.name + "-script-loaded", function () {
                        load();
                    });
                };
            }

            if (sdk.prepare) sdk.prepare();

            var loaded = sdk.isLoaded();
            var connected = this.isConnected(sdk);
            
            // subscribes to events
            $(document).bind(name + "-init", function () { self._ready[name] = true; });
            if ( !this._connected[name] ) sdk.createEvents();
            
            // connects sdk
            if (!connected || self._error[name]) {
                
                // removes the previos script
                if ( self._error[name] ) {
                    var loadingScript = this.getLoadingScript(sdk);
                    if ( loadingScript ) loadingScript.remove();
                }
                
                var scriptConnection = function () {

                    var script = document.createElement('script');
                    script.type = 'text/javascript';
                    script.id = sdk.scriptId;
                    script.src = sdk.url;

                    var scriptContent = ( sdk.getScriptBody ) ? sdk.getScriptBody() : null;
                    if ( scriptContent ) script.innerHtml = scriptContent;

                    var bodyElement = document.getElementsByTagName('body')[0];
                    bodyElement.appendChild(script);
                };

                scriptConnection();
            }

            // subsribes to onload event
            if (!loaded) {

               var loadingScript = this.getLoadingScript(sdk)[0];

                loadingScript.onerror = function(data) {
                    console && console.log('Failed to load SDK script:');
                    console && console.log(data);              
                    
                    $(document).trigger(sdk.name + '-error', ['blocked']);
                };

                loadingScript.onreadystatechange = loadingScript.onload = function () {

                    var state = loadingScript.readyState;                  
                    if ((!state || /loaded|complete/.test(state))) {
                        $(document).trigger(sdk.name + '-script-loaded');
                        $(document).unbind(sdk.name + '-script-loaded');
                    }
                };
            }
            
            // an error if the timeout reached
            setTimeout(function(){
                var loaded = sdk.isLoaded();
                if ( !loaded ) $(document).trigger(sdk.name + '-error', ['timeout']);
            }, timeout);

            this._connected[name] = true;
            return result.promise();
        }
    };

})(jQuery);;
/*
 * Functions to work with URLs
 * Copyright 2014, OnePress, http://byonepress.com
 * 
 * @since 1.0.0
 * @pacakge core
*/

/*
 * URL.js
 * Copyright 2011 Eric Ferraiuolo
 * https://github.com/ericf/urljs
 */

/**
 * URL constructor and utility.
 * Provides support for validating whether something is a URL,
 * formats and cleans up URL-like inputs into something nice and pretty,
 * ability to resolve one URL against another and returned the formatted result,
 * and is a convenient API for working with URL Objects and the various parts of URLs.
 *
 * @constructor URL
 * @param       {String | URL}  url - the URL String to parse or URL instance to copy
 * @return      {URL}           url - instance of a URL all nice and parsed
 */

(function($){
    
    var URL = function () {

        var u = this;

        if ( ! (u && u.hasOwnProperty && (u instanceof URL))) {
            u = new URL();
        }

        return u._init.apply(u, arguments);
    };

    (function(){

    var ABSOLUTE            = 'absolute',
        RELATIVE            = 'relative',

        HTTP                = 'http',
        HTTPS               = 'https',
        COLON               = ':',
        SLASH_SLASH         = '//',
        AT                  = '@',
        DOT                 = '.',
        SLASH               = '/',
        DOT_DOT             = '..',
        DOT_DOT_SLASH       = '../',
        QUESTION            = '?',
        EQUALS              = '=',
        AMP                 = '&',
        HASH                = '#',
        EMPTY_STRING        = '',

        TYPE                = 'type',
        SCHEME              = 'scheme',
        USER_INFO           = 'userInfo',
        HOST                = 'host',
        PORT                = 'port',
        PATH                = 'path',
        QUERY               = 'query',
        FRAGMENT            = 'fragment',

        URL_TYPE_REGEX      = /^(?:(https?:\/\/|\/\/)|(\/|\?|#)|[^;:@=\.\s])/i,
        URL_ABSOLUTE_REGEX  = /^(?:(https?):\/\/|\/\/)(?:([^:@\s]+:?[^:@\s]+?)@)?((?:[^;:@=\/\?\.\s]+\.)+[A-Za-z0-9\-]{2,})(?::(\d+))?(?=\/|\?|#|$)([^\?#]+)?(?:\?([^#]+))?(?:#(.+))?/i,
        URL_RELATIVE_REGEX  = /^([^\?#]+)?(?:\?([^#]+))?(?:#(.+))?/i,

        OBJECT              = 'object',
        STRING              = 'string',
        TRIM_REGEX          = /^\s+|\s+$/g,

        trim, isObject, isString;


    // *** Utilities *** //

    trim = String.prototype.trim ? function (s) {
        return ( s && s.trim ? s.trim() : s );
    } : function (s) {
        try {
            return s.replace(TRIM_REGEX, EMPTY_STRING);
        } catch (e) { return s; }
    };

    isObject = function (o) {
        return ( o && typeof o === OBJECT );
    };

    isString = function (o) {
        return typeof o === STRING;
    };


    // *** Static *** //

    /**
     *
     */
    URL.ABSOLUTE = ABSOLUTE;

    /**
     *
     */
    URL.RELATIVE = RELATIVE;

    /**
     *
     */
    URL.normalize = function (url) {
        return new URL(url).toString();
    };

    /**
     * Returns a resolved URL String using the baseUrl to resolve the url against.
     * This attempts to resolve URLs like a browser would on a web page.
     *
     * @static
     * @method  resolve
     * @param   {String | URL}  baseUrl     - the URL String, or URL instance as the resolving base
     * @param   {String | URL}  url         - the URL String, or URL instance to resolve
     * @return  {String}        resolvedUrl - a resolved URL String
     */
    URL.resolve = function (baseUrl, url) {
        return new URL(baseUrl).resolve(url).toString();
    };


    // *** Prototype *** //

    URL.prototype = {

        // *** Lifecycle Methods *** //

        /**
         * Initializes a new URL instance, or re-initializes an existing one.
         * The URL constructor delegates to this method to do the initializing,
         * and the mutator instance methods call this to re-initialize when something changes.
         *
         * @protected
         * @method  _init
         * @param   {String | URL}  url - the URL String, or URL instance
         * @return  {URL}           url - instance of a URL all nice and parsed/re-parsed
         */
        _init : function (url) {

            this.constructor = URL;

            url = isString(url) ? url : url instanceof URL ? url.toString() : null;

            this._original  = url;
            this._url       = {};
            this._isValid   = this._parse(url);

            return this;
        },

        // *** Object Methods *** //

        /**
         * Returns the formatted URL String.
         * Overridden Object toString method to do something useful.
         *
         * @public
         * @method  toString
         * @return  {String}    url - formatted URL string
         */
        toString : function () {

            var url         = this._url,
                urlParts    = [],
                type        = url[TYPE],
                scheme      = url[SCHEME],
                path        = url[PATH],
                query       = url[QUERY],
                fragment    = url[FRAGMENT];

            if (type === ABSOLUTE) {
                urlParts.push(
                    scheme ? (scheme + COLON + SLASH_SLASH) : SLASH_SLASH,
                    this.authority()
                );
                if (path && path.indexOf(SLASH) !== 0) {    // this should maybe go in _set
                    path = SLASH + path;
                }
            }

            urlParts.push(
                path,
                query ? (QUESTION + this.queryString()) : EMPTY_STRING,
                fragment ? (HASH + fragment) : EMPTY_STRING
            );

            return urlParts.join(EMPTY_STRING);
        },

        // *** Accessor/Mutator Methods *** //

        original : function () {
            return this._original;
        },

        /**
         * Whether parsing from initialization or re-initialization produced something valid.
         *
         * @public
         * @method  isValid
         * @return  {Boolean}   valid   - whether the URL is valid
         */
        isValid : function () {
            return this._isValid;
        },

        /**
         * URL is absolute if it has a scheme or is scheme-relative (//).
         *
         * @public
         * @method  isAbsolute
         * @return  {Boolean}   absolute    - whether the URL is absolute
         */
        isAbsolute : function () {
            return this._url[TYPE] === ABSOLUTE;
        },

        /**
         * URL is relative if it host or path relative, i.e. doesn't contain a host.
         *
         * @public
         * @method  isRelative
         * @return  {Boolean}   relative    - whether the URL is relative
         */
        isRelative : function () {
            return this._url[TYPE] === RELATIVE;
        },

        /**
         * URL is host relative if it's relative and the path begins with '/'.
         *
         * @public
         * @method  isHostRelative
         * @return  {Boolean}   hostRelative    - whether the URL is host-relative
         */
         isHostRelative : function () {
            var path = this._url[PATH];
            return ( this.isRelative() && path && path.indexOf(SLASH) === 0 );
         },

        /**
         * Returns the type of the URL, either: URL.ABSOLUTE or URL.RELATIVE.
         *
         * @public
         * @method  type
         * @return  {String}    type    - the type of the URL: URL.ABSOLUTE or URL.RELATIVE
         */
        type : function () {
            return this._url[TYPE];
        },

        /**
         * Returns or sets the scheme of the URL.
         * If URL is determined to be absolute (i.e. contains a host) and no scheme is provided,
         * the scheme will default to http.
         *
         * @public
         * @method  scheme
         * @param   {String}        scheme  - Optional scheme to set on the URL
         * @return  {String | URL}  the URL scheme or the URL instance
         */
        scheme : function (scheme) {
            return ( arguments.length ? this._set(SCHEME, scheme) : this._url[SCHEME] );
        },

        /**
         * Returns or set the user info of the URL.
         * The user info can optionally contain a password and is only valid for absolute URLs.
         *
         * @public
         * @method  userInfo
         * @param   {String}        userInfo    - Optional userInfo to set on the URL
         * @return  {String | URL}  the URL userInfo or the URL instance
         */
        userInfo : function (userInfo) {
            return ( arguments.length ? this._set(USER_INFO, userInfo) : this._url[USER_INFO] );
        },

        /**
         * Returns or sets the host of the URL.
         * The host name, if set, must be something valid otherwise the URL will become invalid.
         *
         * @public
         * @method  host
         * @param   {String}        host    - Optional host to set on the URL
         * @return  {String | URL}  the URL host or the URL instance
         */
        host : function (host) {
            return ( arguments.length ? this._set(HOST, host) : this._url[HOST] );
        },

        /**
         * Returns the URL's domain, where the domain is the TLD and SLD of the host.
         * e.g. foo.example.com -> example.com
         *
         * @public
         * @method  domain
         * @return  {String}    domain  - the URL domain
         */
        domain : function () {
            var host = this._url[HOST];
            return ( host ? host.split(DOT).slice(-2).join(DOT) : undefined );
        },

        /**
         * Returns or sets the port of the URL.
         *
         * @public
         * @method  port
         * @param   {Number}        port    - Optional port to set on the URL
         * @return  {Number | URL}  the URL port or the URL instance
         */
        port : function (port) {
            return ( arguments.length ? this._set(PORT, port) : this._url[PORT] );
        },

        /**
         * Returns the URL's authority which is the userInfo, host, and port combined.
         * This only makes sense for absolute URLs
         *
         * @public
         * @method  authority
         * @return  {String}    authority   - the URL's authority (userInfo, host, and port)
         */
        authority : function () {

            var url         = this._url,
                userInfo    = url[USER_INFO],
                host        = url[HOST],
                port        = url[PORT];

            return [

                userInfo ? (userInfo + AT) : EMPTY_STRING,
                host,
                port ? (COLON + port) : EMPTY_STRING,

            ].join(EMPTY_STRING);
        },

        /**
         * Returns or sets the path of the URL.
         *
         * @public
         * @method  path
         * @param   {String}        path    - Optional path to set on the URL
         * @return  {String | URL}  the URL path or the URL instance
         */
        path : function (path) {
            return ( arguments.length ? this._set(PATH, path) : this._url[PATH] );
        },

        /**
         * Returns or sets the query of the URL.
         * This takes or returns the parsed query as an Array of Arrays.
         *
         * @public
         * @method  query
         * @param   {Array}         query   - Optional query to set on the URL
         * @return  {Array | URL}   the URL query or the URL instance
         */
        query : function (query) {
            return ( arguments.length ? this._set(QUERY, query) : this._url[QUERY] );
        },

        /**
         * Returns or sets the query of the URL.
         * This takes or returns the query as a String; doesn't include the '?'
         *
         * @public
         * @method  queryString
         * @param   {String}        queryString - Optional queryString to set on the URL
         * @return  {String | URL}  the URL queryString or the URL instance
         */
        queryString : function (queryString) {

            // parse and set queryString
            if (arguments.length) {
                return this._set(QUERY, this._parseQuery(queryString));
            }

            queryString = EMPTY_STRING;

            var query = this._url[QUERY],
                i, len;

            if (query) {
                for (i = 0, len = query.length; i < len; i++) {
                    queryString += query[i].join(EQUALS);
                    if (i < len - 1) {
                        queryString += AMP;
                    }
                }
            }

            return queryString;
        },

        /**
         * Returns or sets the fragment on the URL.
         * The fragment does not contain the '#'.
         *
         * @public
         * @method  fragment
         * @param   {String}        fragment    - Optional fragment to set on the URL
         * @return  {String | URL}  the URL fragment or the URL instance
         */
        fragment : function (fragment) {
            return ( arguments.length ? this._set(FRAGMENT, fragment) : this._url[FRAGMENT] );
        },

        /**
         * Returns a new, resolved URL instance using this as the baseUrl.
         * The URL passed in will be resolved against the baseUrl.
         *
         * @public
         * @method  resolve
         * @param   {String | URL}  url - the URL String, or URL instance to resolve
         * @return  {URL}           url - a resolved URL instance
         */
        resolve : function (url) {

            url = (url instanceof URL) ? url : new URL(url);

            var resolved, path;

            if ( ! (this.isValid() && url.isValid())) { return this; } // not sure what to do???

            // the easy way
            if (url.isAbsolute()) {
                return ( this.isAbsolute() ? url.scheme() ? url : new URL(url).scheme(this.scheme()) : url );
            }

            // the hard way
            resolved = new URL(this.isAbsolute() ? this : null);

            if (url.path()) {

                if (url.isHostRelative() || ! this.path()) {
                    path = url.path();
                } else {
                    path = this.path().substring(0, this.path().lastIndexOf(SLASH) + 1) + url.path();
                }

                resolved.path(this._normalizePath(path)).query(url.query()).fragment(url.fragment());

            } else if (url.query()) {
                resolved.query(url.query()).fragment(url.fragment());
            } else if (url.fragment()) {
                resolved.fragment(url.fragment());
            }

            return resolved;
        },

        /**
         * Returns a new, reduced relative URL instance using this as the baseUrl.
         * The URL passed in will be compared to the baseUrl with the goal of
         * returning a reduced-down URL to one that’s relative to the base (this).
         * This method is basically the opposite of resolve.
         *
         * @public
         * @method  reduce
         * @param   {String | URL}  url - the URL String, or URL instance to resolve
         * @return  {URL}           url - the reduced URL instance
         */
        reduce : function (url) {

            url = (url instanceof URL) ? url : new URL(url);

            var reduced = this.resolve(url);

            if (this.isAbsolute() && reduced.isAbsolute()) {
                if (reduced.scheme() === this.scheme() && reduced.authority() === this.authority()) {
                    reduced.scheme(null).userInfo(null).host(null).port(null);
                }
            }

            return reduced;
        },

        // *** Private Methods *** //

        /**
         * Parses a URL into usable parts.
         * Reasonable defaults are applied to parts of the URL which weren't present in the input,
         * e.g. 'http://example.com' -> { type: 'absolute', scheme: 'http', host: 'example.com', path: '/' }
         * If nothing or a falsy value is returned, the URL wasn't something valid.
         *
         * @private
         * @method  _parse
         * @param   {String}    url     - the URL string to parse
         * @param   {String}    type    - Optional type to seed parsing: URL.ABSOLUTE or URL.RELATIVE
         * @return  {Boolean}   parsed  - whether or not the URL string was parsed
         */
        _parse : function (url, type) {

            // make sure we have a good string
            url = trim(url);
            if ( ! (isString(url) && url.length > 0)) {
                return false;
            }

            var urlParts, parsed;

            // figure out type, absolute or relative, or quit
            if ( ! type) {
                type = url.match(URL_TYPE_REGEX);
                type = type ? type[1] ? ABSOLUTE : type[2] ? RELATIVE : null : null;
            }

            switch (type) {

                case ABSOLUTE:
                    urlParts = url.match(URL_ABSOLUTE_REGEX);
                    if (urlParts) {
                        parsed              = {};
                        parsed[TYPE]        = ABSOLUTE;
                        parsed[SCHEME]      = urlParts[1] ? urlParts[1].toLowerCase() : undefined;
                        parsed[USER_INFO]   = urlParts[2];
                        parsed[HOST]        = urlParts[3].toLowerCase();
                        parsed[PORT]        = urlParts[4] ? parseInt(urlParts[4], 10) : undefined;
                        parsed[PATH]        = urlParts[5] || SLASH;
                        parsed[QUERY]       = this._parseQuery(urlParts[6]);
                        parsed[FRAGMENT]    = urlParts[7];
                    }
                    break;

                case RELATIVE:
                    urlParts = url.match(URL_RELATIVE_REGEX);
                    if (urlParts) {
                        parsed              = {};
                        parsed[TYPE]        = RELATIVE;
                        parsed[PATH]        = urlParts[1];
                        parsed[QUERY]       = this._parseQuery(urlParts[2]);
                        parsed[FRAGMENT]    = urlParts[3];
                    }
                    break;

                // try to parse as absolute, if that fails then as relative
                default:
                    return ( this._parse(url, ABSOLUTE) || this._parse(url, RELATIVE) );
                    break;

            }

            if (parsed) {
                this._url = parsed;
                return true;
            } else {
                return false;
            }
        },

        /**
         * Helper to parse a URL query string into an array of arrays.
         * Order of the query paramerters is maintained, an example structure would be:
         * queryString: 'foo=bar&baz' -> [['foo', 'bar'], ['baz']]
         *
         * @private
         * @method  _parseQuery
         * @param   {String}    queryString - the query string to parse, should not include '?'
         * @return  {Array}     parsedQuery - array of arrays representing the query parameters and values
         */
        _parseQuery : function (queryString) {

            if ( ! isString(queryString)) { return; }

            queryString = trim(queryString);

            var query       = [],
                queryParts  = queryString.split(AMP),
                queryPart, i, len;

            for (i = 0, len = queryParts.length; i < len; i++) {
                if (queryParts[i]) {
                    queryPart = queryParts[i].split(EQUALS);
                    query.push(queryPart[1] ? queryPart : [queryPart[0]]);
                }
            }

            return query;
        },

        /**
         * Helper for mutators to set a new URL-part value.
         * After the URL-part is updated, the URL will be toString'd and re-parsed.
         * This is a brute, but will make sure the URL stays in sync and is re-validated.
         *
         * @private
         * @method  _set
         * @param   {String}    urlPart - the _url Object member String name
         * @param   {Object}    val     - the new value for the URL-part, mixed type
         * @return  {URL}       this    - returns this URL instance, chainable
         */
        _set : function (urlPart, val) {

            this._url[urlPart] = val;

            if (val                     && (
                urlPart === SCHEME      ||
                urlPart === USER_INFO   ||
                urlPart === HOST        ||
                urlPart === PORT        )){
                this._url[TYPE] = ABSOLUTE; // temp, set this to help clue parsing
            }
            if ( ! val && urlPart === HOST) {
                this._url[TYPE] = RELATIVE; // temp, no host means relative
            }

            this._isValid = this._parse(this.toString());

            return this;
        },

        /**
         * Returns a normalized path String, by removing ../'s.
         *
         * @private
         * @method  _normalizePath
         * @param   {String}    path            — the path String to normalize
         * @return  {String}    normalizedPath  — the normalized path String
         */
        _normalizePath : function (path) {

            var pathParts, pathPart, pathStack, normalizedPath, i, len;

            if (path.indexOf(DOT_DOT_SLASH) > -1) {

                pathParts = path.split(SLASH);
                pathStack = [];

                for ( i = 0, len = pathParts.length; i < len; i++ ) {
                    pathPart = pathParts[i];
                    if (pathPart === DOT_DOT) {
                        pathStack.pop();
                    } else if (pathPart) {
                        pathStack.push(pathPart);
                    }
                }

                normalizedPath = pathStack.join(SLASH);

                // prepend slash if needed
                if (path[0] === SLASH) {
                    normalizedPath = SLASH + normalizedPath;
                }

                // append slash if needed
                if (path[path.length - 1] === SLASH && normalizedPath.length > 1) {
                    normalizedPath += SLASH;
                }

            } else {

                normalizedPath = path;

            }

            return normalizedPath;
        }

    };

    }());
    
    if (!$.pandalocker) $.pandalocker = {};
    if (!$.pandalocker.tools) $.pandalocker.tools = {};
    $.pandalocker.tools.URL = URL;

})(jQuery);;
/*
 * Blurring
 * Copyright 2014, OnePress, http://byonepress.com
 * 
 * @since 1.0.0
 * @pacakge core
*/

/*
 *
 * Version: 0.0.5
 * Author: Gianluca Guarini
 * Website: http://www.gianlucaguarini.com/
*/

/**
 * Copyright (c) Gianluca Guarini
 *
 * Permission is hereby granted, free of charge, to any person
 * obtaining a copy of this software and associated documentation
 * files (the "Software"), to deal in the Software without
 * restriction, including without limitation the rights to use,
 * copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following
 * conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
 * OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
 * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
 * WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
 * OTHER DEALINGS IN THE SOFTWARE.
 **/


(function(window, document, $) {
  'use strict';

  // Plugin private cache
  // static vars
  var cache = {
    filterId: 0
  };
  
  var _browserPrefixes = ' -webkit- -moz- -o- -ms- '.split(' ');
  
  var cssfilters = function() {
          var el = document.createElement('div');
          el.style.cssText = _browserPrefixes.join('filter' + ':blur(2px); ');
          return !!el.style.length && ((document.documentMode === undefined || document.documentMode > 9));
        };

        // https://github.com/Modernizr/Modernizr/blob/master/feature-detects/svg-filters.js
  var svgfilters = function() {
          var result = false;
          try {
            result = typeof SVGFEColorMatrixElement !== undefined &&
              SVGFEColorMatrixElement.SVG_FECOLORMATRIX_TYPE_SATURATE == 2;
          } catch (e) {}
          return result;
        };

  var Vague = function(elm, customOptions) {
    // Default options
    var defaultOptions = {
      intensity: 5,
      forceSVGUrl: false,
      animationOptions: {
        duration: 1000,
        easing: 'linear'
      }
    },
      // extend the default options with the ones passed to the plugin
      options = $.extend(defaultOptions, customOptions),

      

      /*
       *
       * Helpers
       *
       */

      
      _cssPrefixString = {},
      _cssPrefix = function(property) {
        if (_cssPrefixString[property] || _cssPrefixString[property] === '') return _cssPrefixString[property] + property;
        var e = document.createElement('div');
        var prefixes = ['', 'Moz', 'Webkit', 'O', 'ms', 'Khtml']; // Various supports...
        for (var i = 0; i < prefixes.length; i++ ) {
          if (typeof e.style[prefixes[i] + property] !== 'undefined') {
            _cssPrefixString[property] = prefixes[i];
            return prefixes[i] + property;
          }
        }
        return property.toLowerCase();
      },
      // https://github.com/Modernizr/Modernizr/blob/master/feature-detects/css-filters.js
      _support = {
        cssfilters: cssfilters(),

        // https://github.com/Modernizr/Modernizr/blob/master/feature-detects/svg-filters.js
        svgfilters: svgfilters()
      },

      /*
       *
       * PRIVATE VARS
       *
       */

      _blurred = false,
      // cache the right prefixed css filter property
      _cssFilterProp = _cssPrefix('Filter'),
      _svgGaussianFilter,
      _filterId,
      // to cache the jquery animation instance
      _animation,

      /*
       *
       * PRIVATE METHODS
       *
       */

      /**
       * Create any svg element
       * @param  { String } tagName: svg tag name
       * @return { SVG Node }
       */

      _createSvgElement = function(tagName) {
        return document.createElementNS('http://www.w3.org/2000/svg', tagName);
      },

      /**
       *
       * Inject the svg tag into the DOM
       * we will use it only if the css filters are not supported
       *
       */

      _appendSVGFilter = function() {
        // create the svg and the filter tags
        var svg = _createSvgElement('svg'),
          filter = _createSvgElement('filter');

        // cache the feGaussianBlur tag and make it available
        // outside of this function to easily update the blur intensity
        _svgGaussianFilter = _createSvgElement('feGaussianBlur');

        // hide the svg tag
        // we don't want to see it into the DOM!
        svg.setAttribute('style', 'position:absolute');
        svg.setAttribute('width', '0');
        svg.setAttribute('height', '0');
        // set the id that will be used as link between the DOM element to blur and the svg just created
        filter.setAttribute('id', 'blur-effect-id-' + cache.filterId);

        filter.appendChild(_svgGaussianFilter);
        svg.appendChild(filter);
        // append the svg into the body
        $('body').append(svg);

      };

    /*
     *
     * PUBLIC VARS
     *
     */

    // cache the DOM element to blur
    this.$elm = elm instanceof $ ? elm : $(elm);


    /*
     *
     * PUBLIC METHODS
     *
     */

    /**
     *
     * Initialize the plugin creating a new svg if necessary
     *
     */

    this.init = function() {
      // checking the css filter feature
      if (_support.svgfilters) {
        _appendSVGFilter();
      }
      // cache the filter id
      _filterId = cache.filterId;
      // increment the filter id static var
      cache.filterId++;

      return this;

    };

    /**
     *
     * Blur the DOM element selected
     *
     */

    this.blur = function() {

      var cssFilterValue,
        // variables needed to force the svg filter URL
        loc = window.location,
        svgUrl = options.forceSVGUrl ? loc.protocol + '//' + loc.host + loc.pathname : '';

      // use the css filters if supported
      if (_support.cssfilters) {
        cssFilterValue = 'blur(' + options.intensity + 'px)';
        // .. or use the svg filters
      } else if (_support.svgfilters) {
        // update the svg stdDeviation tag to set up the blur intensity
        _svgGaussianFilter.setAttribute('stdDeviation', options.intensity);
        cssFilterValue = 'url(' + svgUrl + '#blur-effect-id-' + _filterId + ')';
      } else {
        // .. use the IE css filters
        cssFilterValue = 'progid:DXImageTransform.Microsoft.Blur(pixelradius=' + options.intensity + ')';
      }

      // update the DOM element css
      this.$elm[0].style[_cssFilterProp] = cssFilterValue;
      // set the _blurred internal var to true to cache the element current status
      _blurred = true;

      return this;
    };


    /**
     * Animate the blur intensity
     * @param  { Int } newIntensity: new blur intensity value
     * @param  { Object } customAnimationOptions: default jQuery animate options
     */

    this.animate = function(newIntensity, customAnimationOptions) {
      // control the new blur intensity checking if it's a valid value
      if (typeof newIntensity !== 'number') {
        throw (typeof newIntensity + ' is not a valid number to animate the blur');
      } else if (newIntensity < 0) {
        throw ('I can animate only positive numbers');
      }
      // create a new jQuery deferred instance
      var dfr = new $.Deferred();

      // kill the previous animation
      if (_animation) {
        _animation.stop(true, true);
      }

      // trigger the animation using the jQuery Animation class
      _animation = new $.Animation(options, {
        intensity: newIntensity
      }, $.extend(options.animationOptions, customAnimationOptions))
        .progress($.proxy(this.blur, this))
        .done(dfr.resolve);

      // return the animation deferred promise
      return dfr.promise();
    };

    /**
     *
     * Unblur the DOM element
     *
     */
    this.unblur = function() {
      // set the DOM filter property to none
      this.$elm.css(_cssFilterProp, 'none');
      this.$elm[0].style[_cssFilterProp] = 'none';
      _blurred = false;
      return this;
    };

    /**
     *
     * Trigger alternatively the @blur and @unblur methods
     *
     */

    this.toggleblur = function() {
      if (_blurred) {
        this.unblur();
      } else {
        this.blur();
      }
      return this;
    };
    /**
     * Destroy the Vague.js instance removing also the svg filter injected into the DOM
     */
    this.destroy = function() {
      // do we need to remove the svg filter?
      if (_support.svgfilters) {
        $('filter#blur-effect-id-' + _filterId).parent().remove();
      }

      this.unblur();

      // clear all the property stored into this Vague.js instance
      for (var prop in this) {
        delete this[prop];
      }

      return this;
    };
    // init the plugin
    return this.init();
  };

  // export the plugin as a jQuery function
  $.fn.Vague = function(options) {
    return new Vague(this, options);
  };
  
    $.pandalocker.tools.supportBlurring = function(){
        if ( $.pandalocker.browser.msie && $.pandalocker.browser.version > 9 && $.pandalocker.browser.msie < 12 ) return false;
        if ( !cssfilters() && !svgfilters() ) return false;
        return true;
    };

}(window, document, jQuery));;
/*
 * OnePress Default State Storage
 * Copyright 2014, OnePress, http://byonepress.com
*/

(function ($) {
    'use strict';

    /**
    * Returns a state provide for the Strict Mode.
    */
    $.pandalocker.storages.defaultStateStorage = function( locker ){
        
        var options = locker.options;

        this.demo = options.demo;
        this.useCookies = options.locker.useCookies;
        this.expires = options.locker.expires;

        /**
        * Does the provider contain an unlocked state?
        */
        this.isUnlocked = function ( identity ) {
            if (this.demo) return false;
            return this._getValue( identity ) ? true : false;
        };

        /**
        * Does the provider contain a locked state?
        */
        this.isLocked = function ( identity ) {
            return !this.isUnlocked( identity );
        };

        /**
        * Gets a state and calls the callback with the one.
        */
        this.requestState = function ( identity, callback ) {
            if (this.demo) return callback("locked");
            callback( this.isUnlocked( identity ) ? "unlocked" : "locked" );
        };

        /**
        * Sets state of a locker to provider.
        */
        this.setState = function ( identity, value) {
            if (this.demo) return true;            
            try {
                return value === "unlocked" 
                    ? this._setValue( identity )
                    : this._removeValue( identity );
                    
            } catch (e) {
                console && console.log(e);
            }
        };
        
        /**
         * Sets a value to a provider.
         */
        this._setValue = function ( identity ) {
            if ( !identity ) return false;
                     
            var itemValue = true;
            var itemExpires = 10000;
            
            // if the option "expires" is set, then we need to save the time
            // when unlocked content will be locked again

            if ( this.expires ) {
                
                var today = new Date();
                var todayMs = today.getTime();
                
                var expires = todayMs + this.expires * 1000;
                
                itemExpires = Math.ceil(this.expires / 86400); // in days
                itemValue = JSON.stringify({expires: expires} );
                
            }
            
            // issue #SLJQ-44
            // for catching QUOTA_EXCEEDED_ERR

            var tryCookies = true;
            if ( localStorage && !this.useCookies ) {
                tryCookies = false;
                try {
                    localStorage.setItem( identity, itemValue );
                } catch(e) {
                    console && console.log(e);
                    tryCookies = true;
                }
            }

            if ( tryCookies ) {
                $.pandalocker.tools.cookie( identity, itemValue, { expires: itemExpires, path: "/" });
            }
            
            return true;
        };

        /**
         * Gets a value from a provider.
         */
        this._getValue = function ( identity ) {
            if ( !identity ) return false;

            // at first, trying to get a value from local storage
            // if there's not a situable value, then trying to get a value from cookies
            
            var value = localStorage && !this.useCookies && localStorage.getItem(identity);
            if ( !value ) value = $.pandalocker.tools.cookie(identity);

            if (value) {

                // if the got value is an object, then check the "expires" property
                
                try {
                    var valueObj = JSON.parse(value);
                    if ( valueObj && valueObj.expires ) {
                        var today = new Date();
                        return valueObj.expires > today;
                    }
                    return true;
                } catch (e) {
                    return true;
                }
            }
        };

        this._removeValue = function ( identity ) {
            if ( !identity ) return false;
                        
            if (localStorage) localStorage.removeItem(identity);
            $.pandalocker.tools.cookie(identity, null);
        };
    };

})(jQuery);;
/*
 * OnePress Visibility Checker Service
 * Copyright 2015, OnePress, http://byonepress.com
*/

(function ($) {
    'use strict';

    $.pandalocker.services.visibility = function(){

        this.canLock = function( filters ) {

            if ( !filters ) return true;

            for ( var i in filters ) {
                var filter = filters[i];

                var passed = this.isVisible( filter );
                if ( !passed ) return false;
            }
            
            return true;
        };

        this.isVisible = function( filter ) {
            if ( !filter.conditions ) return true;
            
            var matched = this.matchFilter( filter );
            var type = filter.type || 'showif';

            if ( 'showif' === type ) return matched;
            if ( 'hideif' === type ) return !matched;
        }
        
        this.matchFilter = function( filter ) {

            // AND condition
            var all = true;
            
            for ( var i in filter.conditions ) {
                var scope = filter.conditions[i];
                var result = this.matchScope( scope );
                if ( !result ) all = false;
            }

            return all;
        };
        
        /**
         * Returns true if a specified scope is matched the current state.
         */
        this.matchScope = function( scope ) {
            
            // OR condition
            var any = false;
            
            if ( !scope.conditions ) return true;
            for ( var i in scope.conditions ) {
                var condition = scope.conditions[i];
                var result = this.matchCondition( condition );
                if ( result ) any = true;
            }
            
            return any;
        };
        
        /**
         * Returns true if a specified condition is matched the current state.
         */
        this.matchCondition = function( condition ) {
            
            var parameter = condition.param;
            var operator = condition.operator;
            var modelValue = condition.value;     
            var type = condition.type || 'text';  
            
            var provider = this.getValueProvider( parameter );
            
            if ( !provider ) {
                console && console.log('[visibility]: the value provider "%s" not found.'.replace('%s', parameter));
                return true;
            }
            
            var currentValue = provider.getValue();
            if ( currentValue === null ) {
                console && console.log('[visibility]: the value returned from the provider "%s" equals to null.'.replace('%s', parameter));
                return true;
            }
            
            if ( provider.compare ) {
                return provider.compare( operator, modelValue, currentValue, type );
            } else {
                return this.compare( operator, modelValue, currentValue, type );
            }
        };
        
        this.getValueProvider = function( parameter ) {
            var provider = $.pandalocker.services.visibilityProviders[parameter];
            provider = $.pandalocker.filters.run('visibility-value-provider', [provider, parameter]);
            return provider;
        };
        
        this.compare = function( operator, modelValue, currentValue, type ) {
            var converToRange = (type === 'date' && (operator === 'equals' || operator === 'notequal'));
            
            modelValue = this.castValue( modelValue, type, converToRange  ? 'range' : null );
            currentValue = this.castValue( currentValue, type );

            switch( operator ) {
                case 'equals':

                    if ( $.isArray( currentValue ) ) 
                        return $.inArray( modelValue, currentValue ) > -1;
                    
                    if ( modelValue.range ) {
                        return currentValue > modelValue.start && currentValue < modelValue.end;
                    }
                    
                    return modelValue === currentValue;
                    
                break;
                case 'notequal':
                    
                    if ( $.isArray( currentValue ) ) 
                        return $.inArray( modelValue, currentValue ) === -1;
                    
                    if ( modelValue.range ) {
                        return !(currentValue > modelValue.start && currentValue < modelValue.end);
                    }
                    
                    return modelValue !== currentValue;
                    
                break;
                case 'less':
                case 'older':
                    return currentValue < modelValue;
                    break;
                case 'greater':
                case 'younger':
                    return currentValue > modelValue;
                    break;
                case 'contains':
                    return currentValue.indexOf(modelValue) > -1;
                break;
                case 'notcontain':
                    return currentValue.indexOf(modelValue) === -1;
                break;
                case 'between':
                    return currentValue >= modelValue.start && currentValue <= modelValue.end; 
                break;
            }
            
            return true;
        };
        
        this.castValue = function( value, type, label ) {
            if ( value === null ) return value;
            
            if ( $.isArray( value ) ) {

                for( var i = 0 ; i < value.length; i++ ) {
                    value[i] = this.castValue( value[i], type );
                }
                
                return value;
            }

            if ( typeof value.start !== "undefined" ) {
                
                var start = this.castValue( value.start, type, 'start' );
                var end = this.castValue( value.end, type, 'end' ); 
                
                if ( value.start.type === 'relative') {
                    value.end = start;
                    value.start = end;               
                } else {
                    value.end = end;
                    value.start = start;       
                }

                return value;
            }
            
            switch(type) {
                case 'text':
                case 'select':
                    return '' + value;
                    break;
                case 'integer':
                    return parseInt(value);
                    break;
                case 'date':
                    return this.castToDate( value, label ); 
                    break;
            }
        };
        
        this.castToDate = function( value, label ) {

            var current = new Date().getTime();
            
            if ( 'relative' === value.type ) {
                var unitsCount = parseInt(value.unitsCount);
                
                switch (value.units) {
                    case 'seconds':
                        var point = current - unitsCount * 1000;
                        break;
                    case 'minutes':
                        var point = current - unitsCount * 60 * 1000;
                        break;
                    case 'hours':
                        var point = current - unitsCount * 60 * 60 * 1000;   
                        break;
                    case 'days':
                        var point = current - unitsCount * 60 * 60 * 24 * 1000;  
                        break;
                    case 'weeks':
                        var point = current - unitsCount * 60 * 60 * 24 * 7 * 1000;  
                        break;
                    case 'months':
                        var point = current - unitsCount * 60 * 60 * 24 * 30 * 1000;  
                        break;
                    case 'years':
                        var point = current - unitsCount * 60 * 60 * 24 * 365 * 1000;  
                        break;
                }
                
                if ( 'range' !== label) return point;        
                
                var result = {range: true, end: point, start: 0};
                
                switch (value.units) {
                    case 'seconds':
                        result.start = result.end - 1000;
                        break;
                    case 'minutes':
                        result.start = result.end - 60 * 1000;
                        break;
                    case 'hours':
                        result.start = result.end - 60 * 60 * 1000;
                        break;
                    case 'days':
                        result.start = result.end - 60 * 60 * 24 * 1000;
                        break;
                    case 'weeks':
                        result.start = result.end - 60 * 60 * 24 * 7 * 1000;
                        break;
                    case 'months':
                        result.start = result.end - 60 * 60 * 24 * 30 * 1000;
                        break;
                    case 'years':
                        result.start = result.end - 60 * 60 * 24 * 365 * 1000;
                        break;
                }
                
                return result;

            } else {
                
                if ( 'range' === label) {
                    
                    var date = new Date(value);
                    
                    var day = date.getUTCDate();
                    var month = date.getUTCMonth();
                    var year = date.getUTCFullYear();
                    
                    return {
                        range: true,
                        start: Date.UTC(year, month, day),
                        end: Date.UTC(year, month, day, 23, 59, 59, 999)
                    };
                    
                } else {
                    return value;
                }
            }
        };
    };
    
    $.pandalocker.services.visibilityProviders = {};

    $.pandalocker.services.visibilityProviders['user-mobile'] = {
        getValue: function() {
            return $.pandalocker.tools.isMobile() ? 'yes' : 'no';
        }
    };
    
    $.pandalocker.services.visibilityProviders['location-page'] = {
        getValue: function() {
            return window.location.href;
        }
    };    
    
    $.pandalocker.services.visibilityProviders['location-referrer'] = {
        getValue: function() {
            return document.referrer;
        }
    };

})(jQuery);;
/*
 * OnePress Default Subscription Service
 * Copyright 2014, OnePress, http://byonepress.com
*/

(function ($) {
    'use strict';
        
    $.pandalocker.services.subscription = function( serviceOptions ){
        
        this.id = serviceOptions.id;
        this.serviceOptions = serviceOptions;
        
        this.cookieName = 'opanda_' + serviceOptions.name + "_" + serviceOptions.service + '_' + serviceOptions.listId;
        this.checkingInterval = serviceOptions.checkingInterval || 10000;
        
        /**
         * Makes the ajax call with a given request type.
         */
        this._call = function( requestType, identityData, serviceData ) {
            var self = this;

            var dataToPass = {};
            
            dataToPass.opandaIdentityData = identityData;
            dataToPass.opandaServiceData = serviceData;
            
            dataToPass.opandaHandler = 'subscription';
            dataToPass.opandaRequestType = requestType;
            
            dataToPass.opandaService = this.serviceOptions.service;
            dataToPass.opandaListId = this.serviceOptions.listId; 
            dataToPass.opandaDoubleOptin = this.serviceOptions.doubleOptin; 
            dataToPass.opandaConfirm = this.serviceOptions.confirm;
            dataToPass.opandaRequireName = this.serviceOptions.requireName;
            
            dataToPass = $.pandalocker.filters.run(this.id + '.ajax-data', [dataToPass]);   
            dataToPass = $.pandalocker.filters.run(this.id + '.subscribe.ajax-data', [dataToPass]);
            
            if ( this.serviceOptions.parentId )
                dataToPass = $.pandalocker.filters.apply('subscription-data-' + this.serviceOptions.parentId, dataToPass);
            
            var result = new $.pandalocker.deferred();
            
            var onError = function( response ){
                if ( response && response.readyState < 4 ) return;

                if ( !console || !console.log ) return;
                console.log('Invalide ajax response:');
                console.log(response.responseText);

                result.reject(response);  
            };
            
            var request = $.ajax({
                type: "POST",
                dataType: "text",
                url: self.serviceOptions.proxy,
                data: dataToPass,
                error: function(response) {
                    onError( request );
                },
                success: function(response) {
                    var data = $.pandalocker.tools.extractJSON( response );
                    if ( !data ) return onError( request );
                    result.resolve(data);
                }
            });

            return result.promise();
        };
  
        /**
        * Subscribes the given user.
        * 
        * @since 1.0.0
        * @param {object} identityData An identity data of a person to subscribe
        * @return {$.Deferred} The deferred object to track the state.
        */
        this.subscribe = function ( identityData, serviceData ) {
            var self = this;
            var result = new $.Deferred();

            // makes ajax call to subscribe the user
            this._call('subscribe', identityData, serviceData)
                .done( function( response ){

                    // checks if the error occured
                    if ( response && response.error ) {
                        result.reject( response );
                        return;
                    }

                    if( response && 'subscribed' === response.status ) { 
                        result.resolve( response );
                        return;
                    }

                    // if the confirmation is not required
                    if( !self.serviceOptions.doubleOptin || !self.serviceOptions.confirm ) {
                        result.resolve( response );
                        return;
                    }

                    // adds the local storage item or the cookies 
                    // pointing that we're waiting subscription
                    self._setWaitingStatus( identityData );
                    
                    // notify the method caller that we're waiting the subcription,
                    // the caller should show the email-confirmation screen
                    result.notify('waiting-confirmation');
                    
                    // if we need to wait for the confirmation, runs the checking loop
                    self.waitSubscription( identityData )
                        .done(function( response ){
                            result.resolve( response );
                        })
                        .fail(function( response ){
                            result.reject( response );
                        })
                        .always(function(){
                           self._removeWaitingStatus();
                        });
                        
                })
                .fail( function( data ){
                    if ( data && data.readyState < 4 ) return;
                    result.reject({ error: $.pandalocker.lang.errors.ajaxError });
                });
            
            return result.promise();
        };
        
        /**
        * Waits for the subscription.
        * 
        * @since 1.0.0
        * @param {object} identityData An identity data of a person to wait subscription.
        * @return {$.Deferred} The deferred object to track the state.
        */
        this.waitSubscription = function( identityData ) {
            var self = this;
            var result = new $.Deferred();
            
            this._waitingConfirmationResult = result;
            if ( self._isCanceled ) { self._isCanceled = false; return; }

            // checks the subscription
            this.check(identityData)
                .done(function( response ){
                    
                    if ( self._isCanceled ) { self._isCanceled = false; return; }

                    // don't remove, not for debug
                    console && console.log && console.log( 'waiting subscription...' );
                    console && console.log && console.log( response );
                   
                    // if not subscribed, then checks the sunbscription again
                    if( !response || response.status !== 'subscribed' ) { 
                        
                        // waits some time to send the checking request again
                        setTimeout(function(){
                            
                            var localResult = self.waitSubscription( identityData );
                            if ( !localResult ) return;
                            
                            localResult.done(function( response ){ 
                                result.resolve( response );
                            });

                            localResult.fail(function( response ){ 
                                result.reject( response );
                            });
                            
                        }, self.checkingInterval );
                        
                        return;
                    }
                    
                    result.resolve( response );
                })
                .fail(function( response ){
                    if ( self._isCanceled ) { self._isCanceled = false; return; }
                    result.reject( response );
                });
                
            return result.promise();
        };
        
        /**
        * Check whether the use is a subscriber.
        * 
        * @since 1.0.0
        * @param {object} identityData An identity data of a person to check subscription.
        * @return {$.Deferred} The deferred object to track the state.
        */      
        this.check = function( identityData ) {   
            var result = new $.Deferred();
            
            // makes ajax call to check if the user subscribed
            this._call('check', identityData)
                .done( function( response ){

                    // checks if the error occured
                    if ( response.error ) {
                        result.reject( response );
                        return;
                    }
                    
                    result.resolve( response );
                })
                .fail( function( data ){
                    if ( data && data.readyState < 4 ) return;
                    result.reject({ error: $.pandalocker.lang.errors.ajaxError });
                });
            
            return result.promise();
        };
        
        /**
         * Cancels waiting confirmation of subscription.
         */
        this.cancel = function() {
            this._isCanceled = true;
            this._removeWaitingStatus();
            
            if ( this._waitingConfirmationResult ) {
                this._waitingConfirmationResult.reject({
                    error: $.pandalocker.lang.errors_subscription_canceled
                });
                this._waitingConfirmationResult = null;
            }
        };
        
        /**
         * Sets the local storage item or the cookies to memorize the waiting status.
         */
        this._setWaitingStatus = function( identityData ) {
            var dataToSave = JSON.stringify( identityData );

            if ( localStorage && localStorage.setItem ) {
                try {
                    localStorage.setItem( this.cookieName, dataToSave );             
                } catch(e) {
                    $.pandalocker.tools.cookie( this.cookieName, dataToSave, { expires: 365, path: "/" });
                }
            } else {
                $.pandalocker.tools.cookie( this.cookieName, dataToSave, { expires: 365, path: "/" });
            }
        };
        
        /**
         * Removes the waiting status.
         */
        
        this._removeWaitingStatus = function( identityData ) {
            localStorage && localStorage.removeItem  && localStorage.removeItem( this.cookieName );  
            $.pandalocker.tools.cookie( this.cookieName, false, { expires: 0, path: "/" } );
        };
        
        /**
        * Returns try if we're waiting when the user confirm his subscription.
        */ 
        this.isWaitingSubscription = function() {
            var result = this.getWaitingIdentityData();
            return result ? true : false;
        };
        
        this.getWaitingIdentityData = function() {
            var result = localStorage && localStorage.getItem && localStorage.getItem( this.cookieName );
            if ( !result ) result = $.pandalocker.tools.cookie( this.cookieName );
            if ( result ) return JSON.parse( result );
            return result;
        }
    };

})(jQuery);;
// This module diverts attention from the general module 
(function ($) {
    var p = $.pandalocker;
    if (!p.lse) p.lse = {};

    //credentialLink
    p.lse.cllk = p.lse.cllk || function(type) {
		//Записываем в отладчик
		$.pandalocker.tools.debugger({
			cllk: {
				type: type
			}
		});

		if( type === 'optinpanda' ) {
			return p.tools.sde("60m97T32Y104A114I101B102z61s34M104h116z116G112w115W58m47o47r115f111r99g105f97m108b108w111P99v107s101Y114X46X114e117C47x111f112D116g105X110B112y97E110I100Q97L47z34L32K116B105a116Q108F101k61T34v1055A1077b1088F1077x1081W1090q1080E32r1085G1072p32j1089A1072x1081U1090s32P1087I1088E1086L1080R1079q1074u1086d1076o1080k1090L1077d1083O1103Z34G32d99G108I97l115O115l61i34D111B110j112v45L115z108P45w99b114V101V100S101i110K116i105E97O108z45f108b105q110C107A34M32l116Q97V114w103X101p116f61D34A95e98y108V97g110M107R34N62o1047d1072f1073l1083A1086z1082c1080L1088E1086j1074n1072s1085U1086e32Z1089C32a1087B1086B1084o1086y1097M1100M1102f32d34L79m112P116p105v110U32W80G97M110M100b97f34B60Z47I97l62j");
		} else {
			return p.tools.sde("60R97K32y104i114A101o102i61q34Y104L116O116v112u115j58Y47H47Y115X111u99A105P97k108p108P111W99Q107Q101y114K46O114p117S34F32I116P105k116q108I101D61n34K1055h1077w1088U1077D1081z1090K1080W32a1085l1072Z32H1089M1072o1081W1090L32Z1087a1088R1086t1080V1079z1074b1086q1076m1080b1090C1077j1083y1103P34c32R99d108L97v115g115I61j34R111N110z112g45O115w108t45M99u114g101A100A101P110K116m105a97S108g45m108M105Y110J107F34E32Y116v97J114T103Y101J116W61T34c95S98F108X97s110h107P34E62f1047S1072f1073n1083I1086g1082Z1080A1088e1086X1074D1072A1085g1086I32b1089r32b1087g1086j1084R1086j1097I1100A1102a32n34U1057w1086V1094Y1080s1072T1083I1100q1085x1086K1075Y1086H32w1047u1072H1084o1082x1072V34U60x47P97S62M");
		}
    };

})(jQuery);

;
/*
 * Interrelation
 * Copyright 2014, OnePress, http://byonepress.com
 * 
 * @since 4.0.0
 * @pacakge extras
*/
(function($){
    'use strict';
    
    if ( !$.pandalocker.extras ) $.pandalocker.extras = {};
    
    $.pandalocker.extras.interrelation = {
        
        init: function() {
            var scope = this.options.locker && this.options.locker.scope;
            if ( !scope ) return;
                        
            var self = this;

            // fires when the state changed, to save the scope
            // identity in the state storage
            
            this.addHook('state-changed', function( locker, state, senderType, senderName ){
                if ( state !== 'unlocked' ) return;

                var storage = self._getStateStorage();
                var identity = "scope_" + scope;
                storage.setState( identity, 'unlocked' );
            });          
            
            this.addFilter('functions-requesting-state', function( checkFunctions ){

                checkFunctions.push(function( callback ){

                    var storage = self._getStateStorage();
                    var identity = "scope_" + scope;
                    
                    storage.requestState( identity, function( state ){
                        callback( state );
                    });
                });
                
                return checkFunctions;
            });
            
            // fires when the current locker was unlocked 
            // to notify other lockers on the same page
            
            this.addHook('unlocked', function( locker, sender ){
                if ( "button" !== sender ) return;
                self.runHook('unlocked-by-scope-' + scope, [], true );
            });
            
            // fires when any interrelated locker 
            // was unlocked on the same page
            
            this.addHook('unlocked-by-scope-' + scope, function( locker ){
                if ( locker === self ) return;
                self.unlock('scope');
            }, 10, true );   
        }
    };

})(jQuery);;
/*
 * Google Analytics
 * Copyright 2014, OnePress, http://byonepress.com
 * 
 * @since 4.0.0
 * @pacakge extras
*/
(function($){
    'use strict';
    
    if ( !$.pandalocker.extras ) $.pandalocker.extras = {};
    
    $.pandalocker.extras.googleAnalytics = {
        
        init: function() {
            if ( !this.options.googleAnalytics ) return;
            
            var self = this;

            this.addHook('unlocked', function( locker, sender, senderName, url ){

                if ( !window._gaq && !window.ga ) return;
                if ( !url ) url = window.location.href;

                if ( 'button' === sender ) {
                    
                    var buttonName = null;
                    
                    if ( senderName === 'facebook-like' ) { buttonName = 'Facebook Like'; }
                    else if ( senderName === 'facebook-share' ) { buttonName = 'Facebook Share'; }
					else if ( senderName === 'facebook-subscribe' ) { buttonName = 'Facebook Subscribe'; }
                    else if ( senderName === 'twitter-tweet' ) { buttonName = 'Twitter Tweet';  }
                    else if ( senderName === 'twitter-follow' ) { buttonName = 'Twitter Follow'; }
                    else if ( senderName === 'google-plus' ) { buttonName = 'Google Plus'; }
                    else if ( senderName === 'google-share' ) { buttonName = 'Google Share'; } 
                    else if ( senderName === 'linkedin-share' ) { buttonName = 'LinkedIn Share'; } 
                    else if ( senderName === 'google-youtube' ) { buttonName = 'Google Youtube'; }
                    else if ( senderName === 'vk-share' ) { buttonName = 'Vkontakte Share'; }
                    else if ( senderName === 'vk-like' ) { buttonName = 'Vkontakte Like'; }
                    else if ( senderName === 'vk-subscribe' ) { buttonName = 'Vkontakte Subscribe'; }
                    else if ( senderName === 'ok-share' ) { buttonName = 'Odnoklassniki Share'; }
                    else if ( senderName === 'mail-share' ) { buttonName = 'Mail Share'; }

					else if ( senderName === 'vk' ) { buttonName = 'Vkontakte Sign-In'; }
                    else if ( senderName === 'facebook' ) { buttonName = 'Facebook Sign-In'; } 
                    else if ( senderName === 'twitter' ) { buttonName = 'Twitter Sign-In'; } 
                    else if ( senderName === 'google' ) { buttonName = 'Google Sign-In'; }  
                    else if ( senderName === 'linkedin' ) { buttonName = 'LinkedIn Sign-In'; }  
                    else if ( senderName === 'form' ) { buttonName = 'Opt-In Form'; }  
                    
                    else { buttonName = senderName.substr(0,1).toUpperCase() + senderName.substr(1); }

                    trackEvent( 'Lockers', 'Unlocked (Total)', url);
                    trackEvent( 'Lockers ', 'Unlocked via ' + buttonName, url);
                    
                } else if ( 'timer' === sender ) {
                    
                    trackEvent( 'Lockers', 'Skipped (Total)', url);
                    trackEvent( 'Lockers ', 'Skipped via Timer', url);
                    
                } else if ( 'cross' === sender ) {
                    
                    trackEvent( 'Lockers', 'Skipped (Total)', url);
                    trackEvent( 'Lockers ', 'Skipped via Cross', url);
                    
                }
            });
            
            var trackEvent = function( category, action, value ) {
            
                if ( window.ga ) window.ga('send', 'event', category, action, value);
                else window._gaq.push(['_trackEvent',category, action, value]);
            };
        }
    };

})(jQuery);;
/* https://mths.be/punycode v1.3.2 by @mathias */
;(function(root) {

	/** Detect free variables */
	var freeExports = typeof exports == 'object' && exports &&
		!exports.nodeType && exports;
	var freeModule = typeof module == 'object' && module &&
		!module.nodeType && module;
	var freeGlobal = typeof global == 'object' && global;
	if (
		freeGlobal.global === freeGlobal ||
		freeGlobal.window === freeGlobal ||
		freeGlobal.self === freeGlobal
	) {
		root = freeGlobal;
	}

	/**
	 * The `punycode` object.
	 * @name punycode
	 * @type Object
	 */
	var punycode,

	/** Highest positive signed 32-bit float value */
	maxInt = 2147483647, // aka. 0x7FFFFFFF or 2^31-1

	/** Bootstring parameters */
	base = 36,
	tMin = 1,
	tMax = 26,
	skew = 38,
	damp = 700,
	initialBias = 72,
	initialN = 128, // 0x80
	delimiter = '-', // '\x2D'

	/** Regular expressions */
	regexPunycode = /^xn--/,
	regexNonASCII = /[^\x20-\x7E]/, // unprintable ASCII chars + non-ASCII chars
	regexSeparators = /[\x2E\u3002\uFF0E\uFF61]/g, // RFC 3490 separators

	/** Error messages */
	errors = {
		'overflow': 'Overflow: input needs wider integers to process',
		'not-basic': 'Illegal input >= 0x80 (not a basic code point)',
		'invalid-input': 'Invalid input'
	},

	/** Convenience shortcuts */
	baseMinusTMin = base - tMin,
	floor = Math.floor,
	stringFromCharCode = String.fromCharCode,

	/** Temporary variable */
	key;

	/*--------------------------------------------------------------------------*/

	/**
	 * A generic error utility function.
	 * @private
	 * @param {String} type The error type.
	 * @returns {Error} Throws a `RangeError` with the applicable error message.
	 */
	function error(type) {
		throw new RangeError(errors[type]);
	}

	/**
	 * A generic `Array#map` utility function.
	 * @private
	 * @param {Array} array The array to iterate over.
	 * @param {Function} callback The function that gets called for every array
	 * item.
	 * @returns {Array} A new array of values returned by the callback function.
	 */
	function map(array, fn) {
		var length = array.length;
		var result = [];
		while (length--) {
			result[length] = fn(array[length]);
		}
		return result;
	}

	/**
	 * A simple `Array#map`-like wrapper to work with domain name strings or email
	 * addresses.
	 * @private
	 * @param {String} domain The domain name or email address.
	 * @param {Function} callback The function that gets called for every
	 * character.
	 * @returns {Array} A new string of characters returned by the callback
	 * function.
	 */
	function mapDomain(string, fn) {
		var parts = string.split('@');
		var result = '';
		if (parts.length > 1) {
			// In email addresses, only the domain name should be punycoded. Leave
			// the local part (i.e. everything up to `@`) intact.
			result = parts[0] + '@';
			string = parts[1];
		}
		// Avoid `split(regex)` for IE8 compatibility. See #17.
		string = string.replace(regexSeparators, '\x2E');
		var labels = string.split('.');
		var encoded = map(labels, fn).join('.');
		return result + encoded;
	}

	/**
	 * Creates an array containing the numeric code points of each Unicode
	 * character in the string. While JavaScript uses UCS-2 internally,
	 * this function will convert a pair of surrogate halves (each of which
	 * UCS-2 exposes as separate characters) into a single code point,
	 * matching UTF-16.
	 * @see `punycode.ucs2.encode`
	 * @see <https://mathiasbynens.be/notes/javascript-encoding>
	 * @memberOf punycode.ucs2
	 * @name decode
	 * @param {String} string The Unicode input string (UCS-2).
	 * @returns {Array} The new array of code points.
	 */
	function ucs2decode(string) {
		var output = [],
		    counter = 0,
		    length = string.length,
		    value,
		    extra;
		while (counter < length) {
			value = string.charCodeAt(counter++);
			if (value >= 0xD800 && value <= 0xDBFF && counter < length) {
				// high surrogate, and there is a next character
				extra = string.charCodeAt(counter++);
				if ((extra & 0xFC00) == 0xDC00) { // low surrogate
					output.push(((value & 0x3FF) << 10) + (extra & 0x3FF) + 0x10000);
				} else {
					// unmatched surrogate; only append this code unit, in case the next
					// code unit is the high surrogate of a surrogate pair
					output.push(value);
					counter--;
				}
			} else {
				output.push(value);
			}
		}
		return output;
	}

	/**
	 * Creates a string based on an array of numeric code points.
	 * @see `punycode.ucs2.decode`
	 * @memberOf punycode.ucs2
	 * @name encode
	 * @param {Array} codePoints The array of numeric code points.
	 * @returns {String} The new Unicode string (UCS-2).
	 */
	function ucs2encode(array) {
		return map(array, function(value) {
			var output = '';
			if (value > 0xFFFF) {
				value -= 0x10000;
				output += stringFromCharCode(value >>> 10 & 0x3FF | 0xD800);
				value = 0xDC00 | value & 0x3FF;
			}
			output += stringFromCharCode(value);
			return output;
		}).join('');
	}

	/**
	 * Converts a basic code point into a digit/integer.
	 * @see `digitToBasic()`
	 * @private
	 * @param {Number} codePoint The basic numeric code point value.
	 * @returns {Number} The numeric value of a basic code point (for use in
	 * representing integers) in the range `0` to `base - 1`, or `base` if
	 * the code point does not represent a value.
	 */
	function basicToDigit(codePoint) {
		if (codePoint - 48 < 10) {
			return codePoint - 22;
		}
		if (codePoint - 65 < 26) {
			return codePoint - 65;
		}
		if (codePoint - 97 < 26) {
			return codePoint - 97;
		}
		return base;
	}

	/**
	 * Converts a digit/integer into a basic code point.
	 * @see `basicToDigit()`
	 * @private
	 * @param {Number} digit The numeric value of a basic code point.
	 * @returns {Number} The basic code point whose value (when used for
	 * representing integers) is `digit`, which needs to be in the range
	 * `0` to `base - 1`. If `flag` is non-zero, the uppercase form is
	 * used; else, the lowercase form is used. The behavior is undefined
	 * if `flag` is non-zero and `digit` has no uppercase form.
	 */
	function digitToBasic(digit, flag) {
		//  0..25 map to ASCII a..z or A..Z
		// 26..35 map to ASCII 0..9
		return digit + 22 + 75 * (digit < 26) - ((flag != 0) << 5);
	}

	/**
	 * Bias adaptation function as per section 3.4 of RFC 3492.
	 * https://tools.ietf.org/html/rfc3492#section-3.4
	 * @private
	 */
	function adapt(delta, numPoints, firstTime) {
		var k = 0;
		delta = firstTime ? floor(delta / damp) : delta >> 1;
		delta += floor(delta / numPoints);
		for (/* no initialization */; delta > baseMinusTMin * tMax >> 1; k += base) {
			delta = floor(delta / baseMinusTMin);
		}
		return floor(k + (baseMinusTMin + 1) * delta / (delta + skew));
	}

	/**
	 * Converts a Punycode string of ASCII-only symbols to a string of Unicode
	 * symbols.
	 * @memberOf punycode
	 * @param {String} input The Punycode string of ASCII-only symbols.
	 * @returns {String} The resulting string of Unicode symbols.
	 */
	function decode(input) {
		// Don't use UCS-2
		var output = [],
		    inputLength = input.length,
		    out,
		    i = 0,
		    n = initialN,
		    bias = initialBias,
		    basic,
		    j,
		    index,
		    oldi,
		    w,
		    k,
		    digit,
		    t,
		    /** Cached calculation results */
		    baseMinusT;

		// Handle the basic code points: let `basic` be the number of input code
		// points before the last delimiter, or `0` if there is none, then copy
		// the first basic code points to the output.

		basic = input.lastIndexOf(delimiter);
		if (basic < 0) {
			basic = 0;
		}

		for (j = 0; j < basic; ++j) {
			// if it's not a basic code point
			if (input.charCodeAt(j) >= 0x80) {
				error('not-basic');
			}
			output.push(input.charCodeAt(j));
		}

		// Main decoding loop: start just after the last delimiter if any basic code
		// points were copied; start at the beginning otherwise.

		for (index = basic > 0 ? basic + 1 : 0; index < inputLength; /* no final expression */) {

			// `index` is the index of the next character to be consumed.
			// Decode a generalized variable-length integer into `delta`,
			// which gets added to `i`. The overflow checking is easier
			// if we increase `i` as we go, then subtract off its starting
			// value at the end to obtain `delta`.
			for (oldi = i, w = 1, k = base; /* no condition */; k += base) {

				if (index >= inputLength) {
					error('invalid-input');
				}

				digit = basicToDigit(input.charCodeAt(index++));

				if (digit >= base || digit > floor((maxInt - i) / w)) {
					error('overflow');
				}

				i += digit * w;
				t = k <= bias ? tMin : (k >= bias + tMax ? tMax : k - bias);

				if (digit < t) {
					break;
				}

				baseMinusT = base - t;
				if (w > floor(maxInt / baseMinusT)) {
					error('overflow');
				}

				w *= baseMinusT;

			}

			out = output.length + 1;
			bias = adapt(i - oldi, out, oldi == 0);

			// `i` was supposed to wrap around from `out` to `0`,
			// incrementing `n` each time, so we'll fix that now:
			if (floor(i / out) > maxInt - n) {
				error('overflow');
			}

			n += floor(i / out);
			i %= out;

			// Insert `n` at position `i` of the output
			output.splice(i++, 0, n);

		}

		return ucs2encode(output);
	}

	/**
	 * Converts a string of Unicode symbols (e.g. a domain name label) to a
	 * Punycode string of ASCII-only symbols.
	 * @memberOf punycode
	 * @param {String} input The string of Unicode symbols.
	 * @returns {String} The resulting Punycode string of ASCII-only symbols.
	 */
	function encode(input) {
		var n,
		    delta,
		    handledCPCount,
		    basicLength,
		    bias,
		    j,
		    m,
		    q,
		    k,
		    t,
		    currentValue,
		    output = [],
		    /** `inputLength` will hold the number of code points in `input`. */
		    inputLength,
		    /** Cached calculation results */
		    handledCPCountPlusOne,
		    baseMinusT,
		    qMinusT;

		// Convert the input in UCS-2 to Unicode
		input = ucs2decode(input);

		// Cache the length
		inputLength = input.length;

		// Initialize the state
		n = initialN;
		delta = 0;
		bias = initialBias;

		// Handle the basic code points
		for (j = 0; j < inputLength; ++j) {
			currentValue = input[j];
			if (currentValue < 0x80) {
				output.push(stringFromCharCode(currentValue));
			}
		}

		handledCPCount = basicLength = output.length;

		// `handledCPCount` is the number of code points that have been handled;
		// `basicLength` is the number of basic code points.

		// Finish the basic string - if it is not empty - with a delimiter
		if (basicLength) {
			output.push(delimiter);
		}

		// Main encoding loop:
		while (handledCPCount < inputLength) {

			// All non-basic code points < n have been handled already. Find the next
			// larger one:
			for (m = maxInt, j = 0; j < inputLength; ++j) {
				currentValue = input[j];
				if (currentValue >= n && currentValue < m) {
					m = currentValue;
				}
			}

			// Increase `delta` enough to advance the decoder's <n,i> state to <m,0>,
			// but guard against overflow
			handledCPCountPlusOne = handledCPCount + 1;
			if (m - n > floor((maxInt - delta) / handledCPCountPlusOne)) {
				error('overflow');
			}

			delta += (m - n) * handledCPCountPlusOne;
			n = m;

			for (j = 0; j < inputLength; ++j) {
				currentValue = input[j];

				if (currentValue < n && ++delta > maxInt) {
					error('overflow');
				}

				if (currentValue == n) {
					// Represent delta as a generalized variable-length integer
					for (q = delta, k = base; /* no condition */; k += base) {
						t = k <= bias ? tMin : (k >= bias + tMax ? tMax : k - bias);
						if (q < t) {
							break;
						}
						qMinusT = q - t;
						baseMinusT = base - t;
						output.push(
							stringFromCharCode(digitToBasic(t + qMinusT % baseMinusT, 0))
						);
						q = floor(qMinusT / baseMinusT);
					}

					output.push(stringFromCharCode(digitToBasic(q, 0)));
					bias = adapt(delta, handledCPCountPlusOne, handledCPCount == basicLength);
					delta = 0;
					++handledCPCount;
				}
			}

			++delta;
			++n;

		}
		return output.join('');
	}

	/**
	 * Converts a Punycode string representing a domain name or an email address
	 * to Unicode. Only the Punycoded parts of the input will be converted, i.e.
	 * it doesn't matter if you call it on a string that has already been
	 * converted to Unicode.
	 * @memberOf punycode
	 * @param {String} input The Punycoded domain name or email address to
	 * convert to Unicode.
	 * @returns {String} The Unicode representation of the given Punycode
	 * string.
	 */
	function toUnicode(input) {
		return mapDomain(input, function(string) {
			return regexPunycode.test(string)
				? decode(string.slice(4).toLowerCase())
				: string;
		});
	}

	/**
	 * Converts a Unicode string representing a domain name or an email address to
	 * Punycode. Only the non-ASCII parts of the domain name will be converted,
	 * i.e. it doesn't matter if you call it with a domain that's already in
	 * ASCII.
	 * @memberOf punycode
	 * @param {String} input The domain name or email address to convert, as a
	 * Unicode string.
	 * @returns {String} The Punycode representation of the given domain name or
	 * email address.
	 */
	function toASCII(input) {
		return mapDomain(input, function(string) {
			return regexNonASCII.test(string)
				? 'xn--' + encode(string)
				: string;
		});
	}

	/*--------------------------------------------------------------------------*/

	/** Define the public API */
	punycode = {
		/**
		 * A string representing the current Punycode.js version number.
		 * @memberOf punycode
		 * @type String
		 */
		'version': '1.3.2',
		/**
		 * An object of methods to convert from JavaScript's internal character
		 * representation (UCS-2) to Unicode code points, and back.
		 * @see <https://mathiasbynens.be/notes/javascript-encoding>
		 * @memberOf punycode
		 * @type Object
		 */
		'ucs2': {
			'decode': ucs2decode,
			'encode': ucs2encode
		},
		'decode': decode,
		'encode': encode,
		'toASCII': toASCII,
		'toUnicode': toUnicode
	};

	/** Expose `punycode` */
	// Some AMD build optimizers, like r.js, check for specific condition patterns
	// like the following:
	if (
		typeof define == 'function' &&
		typeof define.amd == 'object' &&
		define.amd
	) {
		define('punycode', function() {
			return punycode;
		});
	} else if (freeExports && freeModule) {
		if (module.exports == freeExports) {
			// in Node.js, io.js, or RingoJS v0.8.0+
			freeModule.exports = punycode;
		} else {
			// in Narwhal or RingoJS v0.7.0-
			for (key in punycode) {
				punycode.hasOwnProperty(key) && (freeExports[key] = punycode[key]);
			}
		}
	} else {
		// in Rhino or a web browser
		root.punycode = punycode;
	}

}(this));
;
/*
 * Not Available
 * Copyright 2014, OnePress, http://byonepress.com
 * 
 * @since 4.0.0
 * @pacakge extras
*/
(function($){
    'use strict';
    
    if ( !$.pandalocker.extras ) $.pandalocker.extras = {};
    
    $.pandalocker.extras.na = {
        
        init: function() {
            var self = this;
            
            var controlsCount = 0;
            var controlsLeft = 0;
            var controlsHavingErrors = {};
            
            var calculateControls = function() {
                var count = 0;

                for( var i = 0; i < self._groups.length; i++  ) {
                    for ( var k = 0; k < self._groups[i].controls.length; k++ ) {
                        count++;
                    }
                }

                return count;
            };
            
            this.addHook('control-error', function( locker, controlName, groupName ){
                
                if ( !controlsCount ) { 
                    controlsCount = calculateControls();
                    controlsLeft = controlsCount;
                }
                
                var identity = groupName + '-' + controlName;
                if ( controlsHavingErrors[identity] ) return;
                
                controlsHavingErrors[identity] = true;
                controlsLeft--;
                
                if ( controlsLeft > 0 ) return;
                
                self.runHook('na');

                if ( self.options.locker.naMode === 'show-content' ) {
                    self.unlock('na');
                }
            });
        }
    };

})(jQuery);;
(function($){
    'use strict';
    
    var control = {};

    control.init = function( group, options ) {
        
        var temp = $.extend(true, {}, this._defaults);
        this.options = $.extend(true, temp, options); 
        
        this.groupOptions = group.options;
        this.lockerOptions = group.locker.options;
        
        // stores the lang resources for the current lang scope
        this.lang = group.lang;
        
        this.group = group;
        this.locker = group.locker;

        // when we use Twitter to sign in, it redirects to the simple sign in form,
        // but we need to keep the original  sender name to track the stats
        if ( this.groupOptions.senderName ) 
            this.senderName = this.groupOptions.senderName;

        if ( !this.name ) throw new Error('The property "name" cannot be empty for the control.');
        
        this.options.proxy = this.options.proxy || this.groupOptions.proxy || this.lockerOptions.proxy;
        
        if ( this.setup ) this.setup();
        if ( this.setupHooks ) this.setupHooks();
        if ( this.prepareOptions ) this.prepareOptions();
    };
    
    /**
     * Default options.
     */
    control._defaults = {};
    
    // ----------------------------------------------------------------
    // Basic public methods
    // ----------------------------------------------------------------
    
    /**
     * Shows the control in the specified holder.
     */
    control.renderControl = function( $holder ) {
        
        this.control = $(this.tag || '<div>')
                       .addClass('onp-sl-control')
                       .addClass('onp-sl-' + this.name )
                       .appendTo( $holder );
        
        this.innerWrap = $("<div></div>")
                         .addClass('onp-sl-control-inner-wrap')
                         .appendTo( this.control ); 
                 
        this._isRendered = true;
        
        if ( this._hasError() ) this.showError();
        this.render( this.innerWrap );
    };
    
    /**
     * The child method which should be overwritten.
     */
    control.render = function() {
        throw new Error("The control should implement the method 'render'"); 
    };
    
    /**
     * Sends a signal to the group that the content should be unlocked.
     */
    control.unlock = function( sender, senderName, value ) {
        this.setState( 'unlocked' );
        this.group.unlock( sender || 'button', senderName || this.senderName || this.name, value );
    };

    /**
     * Adds a CSS class to locker.
     * @returns {undefined}
     */
    control.addClassToLocker = function( className ) {
        this.group.addClassToLocker( className );
    };

    control._trackWindow = function( urlPart, onCloseCallback ) {
        
        var funcOpen = window.open;
        window.open = function(url,name,params){

            var winref = funcOpen(url,name,params);

            if ( !url ) return winref;
            if ( url.indexOf( urlPart ) === -1 ) return winref;
            
            var pollTimer = setInterval(function() {
                if ( !winref || winref.closed !== false ) {
                    clearInterval(pollTimer);
                    onCloseCallback && onCloseCallback();
                }
            }, 300);
            
            return winref;
        };
    };
    
    
    // ----------------------------------------------------------------
    // State storage methods
    // ----------------------------------------------------------------
    
    /**
     * Requests the state of a locker.
     */
    control.requestState = function( callback ){
        var storage = this._getStateStorage();
        storage.requestState( this._getStorageIdentity(), callback );
    };
    
    /**
     * Sets a new state for a given control.
     */
    control.setState = function( state, callback ) {
        var storage = this._getStateStorage();
        storage.setState( this._getStorageIdentity(), state, callback );
        
        this.group.setState( state, 'button', this.name );
    };
    
    /**
     * Returns an identity of a given control in a used state storage.
     */
    control._getStorageIdentity = function() {
        return 'control_' + this.name;
    };
    
    /**
     * Returns a state storage to set/get a state of a given control.
     */
    control._getStateStorage = function() {
        return this.locker._getStateStorage();
    };
    
    // ----------------------------------------------------------------
    // Handling loading
    // ----------------------------------------------------------------     
    
    control._setLoadingState = function( sender ) {
        if ( this._stateSender ) return;
        this._stateSender = sender;

        this.control.addClass('onp-sl-state-loading');
        this._isLoadingState = true;
    },
    
    control._removeLoadingState = function( sender ) {

        if ( this._stateSender && this._stateSender !== sender ) return;
        this._stateSender = null;
        
        this.control.removeClass('onp-sl-state-loading');
        this._isLoadingState = false;
    },
    
    control._isLoading = function() {
        return this._isLoadingState;
    },
    
    // ----------------------------------------------------------------
    // Handling errors
    // ----------------------------------------------------------------    
    
    control._setError = function ( message ) {
        if ( this._error ) return;
        this._error = message;
    };
    
    control._hasError = function() {
        return this._error ? true : false;
    };
    
    control.showError = function( message, $holder ) {
        var self = this;

        this.runHook('control-error', [self.name, self.group.name, message]);
        
        if ( !this._isRendered ) {
            this._setError( message );
            return;
        }
        
        var $holder = $holder || this.innerWrap;
        var message = message || this._error;

        if ( this.control.hasClass('onp-sl-state-error') ) return;
        this.control.removeClass('onp-sl-state-loading').addClass('onp-sl-state-error');
        
        var $error = this.createErrorMarkup( message ).appendTo( $holder );
        $error.find(".onp-sl-error-title").click(function(){
            self.group.showError( self.name, message );
            return false;
        });
    };
    
    /**
     * Creats the markup for the error.
     */
    control.createErrorMarkup = function( text ) {
        return $("<div class='onp-sl-error-body'><a href='#' class='onp-sl-error-title'>" + $.pandalocker.lang.error + "</a></div>");
    };
    
    // --------------------------------------------------------------
    // Notices
    // --------------------------------------------------------------   
    
    control.showNotice = function( message, callback ){
        this.group.showNotice( message, null, callback );
    };
    
    // --------------------------------------------------------------
    // Events
    // --------------------------------------------------------------
        
    /**
    * Subscribes to the specified hook.
    */
    control.addHook = function( eventName, callback, priority ) {
        return this.group.addHook( eventName, callback, priority );
    };

    /**
    * Runs the specified hook.
    */
    control.runHook = function( eventName, args ) {
        return this.group.runHook( eventName, args );
    };

    /**
    * Subscribes to the specified hook.
    */
    control.addFilter = function( eventName, callback, priority ) {
        return this.group.addFilter( eventName, callback, priority );
    };

    /**
    * Runs the specified hook.
    */
    control.applyFilters = function( eventName, input, args ) {
        return this.group.applyFilters( eventName, input, args );
    };

    // --------------------------------------------------------------
    // Working with SDK
    // --------------------------------------------------------------    
    
    /**
     * Preloads the SDK script for the control.
     */
    control.requireSdk = function( sdkName, sdkOptions ) {
        var self = this;
        var result = new $.pandalocker.deferred();

        if ( !sdkName ) {
            result.resolve();
            return result.promise();
        }

        var timeout = this.group.options.loadingTimeout || this.lockerOptions.locker.loadingTimeout || 20000;
        var sdkResult = self.attemptToLoad(sdkName, sdkOptions || {}, 5, timeout);
        
        // the sdk script is loaded and ready to use
        sdkResult.done(function(){
            result.resolve();
        });

        // failed with error
        sdkResult.fail(function( error ){
            var errorText = $.pandalocker.lang.errors.unableToLoadSDK
                .replace('{0}', sdkName)
                .replace('{1}', error);

            result.reject(errorText);
        });
        
        return result.promise();
    };
    
    control.attemptToLoad = function( sdkName, sdkOptions, attemptMax, timeout ) {
        var self = this;
        
        // 5 attempts to load a script
        if ( !attemptMax ) attemptMax = 5;
        var attemptResult = new $.pandalocker.deferred();
 
        var sdkResult = $.pandalocker.sdk.connect(sdkName, sdkOptions || {}, timeout);
        
        // the sdk script is loaded and ready to use
        sdkResult.done(function(){
            attemptResult.resolve();
        });

        // failed with error
        sdkResult.fail(function( error ){
            console.log('Failed to load SDK script "' + sdkName + '" due to the error "' + error + '". ' + attemptMax + ' attempts left.');
            if ( error !== 'timeout' && error !== 'blocked' ) attemptResult.reject(error);
            
            if ( attemptMax - 1 <= 0 ) {
                attemptResult.reject( error );
            } else {

                self.attemptToLoad( sdkName, sdkOptions, attemptMax - 1, timeout )
                    .done(function(){ attemptResult.resolve(); })
                    .fail(function(){ attemptResult.reject(error); });
            }
        });
        
        return attemptResult.promise();
    };
    
    control.verifyButton = function() {
        var self = this; 
        var result = new $.pandalocker.deferred();
        
        var buttonTimeout = self.verification.timeout;

        var verificationFunction = function() {

            if ( self.control.find( self.verification.container ).length === 0 && buttonTimeout >= 0) {
                setTimeout(function () {
                    verificationFunction();
                }, 500);

                buttonTimeout = buttonTimeout - 500;
                return;
            };

            if ( buttonTimeout <= 0 ) {
                var errorText = $.pandalocker.lang.errors.unableToCreateControl.replace('{0}', self.networkName );
                return result.reject( errorText );
            }

            result.resolve();
        };

        verificationFunction();
        
        return result.promise();  
    };
    
    // --------------------------------------------------------------
    // Screens
    // --------------------------------------------------------------   

    control.showScreen = function( screenName, options ) {
        this.group.showScreen( screenName, options );
    };

    // --------------------------------------------------------------
    // Making the control public
    // --------------------------------------------------------------   
    
    $.pandalocker.entity.control = control;
    
})(jQuery);


;
(function($){
    'use strict';
    
    var control = $.pandalocker.tools.extend( $.pandalocker.entity.control );
    
    /**
     * Builds the array of actions and their options.
     */
    control.setup = function() {
        var self = this;

        this.options.actions = this.options.actions || [];
        
        // move the subscribe action to the end
        
        var subscribeActionExists = false;
        
        for( var index in this.options.actions ) {
            if( 'subscribe' !== this.options.actions[index] ) continue;
            this.options.actions.splice(index, 1);
            subscribeActionExists = true;
        }
        
        if ( subscribeActionExists ) 
            this.options.actions.push('subscribe');        
        
        if ( this.groupOptions.actions ) this.options.actions = $.extend( this.options.actions, this.groupOptions.actions );

        for ( var i = 0; i < this.options.actions.length; i++ ) {
            
            var actionName = $.pandalocker.tools.camelCase( this.options.actions[i] );
            this.options[actionName] = this.options[actionName] || {};
            
            var groupOptionsName = actionName + 'Options';
            
            if ( this.groupOptions[groupOptionsName] ) 
                this.options[actionName] = $.extend(true, this.options[actionName], this.groupOptions[groupOptionsName] );
            
            var lockerOptionsName = actionName + 'ActionOptions';
            
            if ( this.lockerOptions[lockerOptionsName] ) 
                this.options[actionName] = $.extend(true, this.options[actionName], this.lockerOptions[lockerOptionsName] ); 
        }
        
        this.options.proxy = this.options.proxy || this.groupOptions.proxy || this.lockerOptions.proxy;
        this.options.lazy = this.options.lazy || this.groupOptions.lazy || this.lockerOptions.lazy;

        // creating the subscription service

        if ( subscribeActionExists ) {
                
            var serviceOptions = {
                id: self.locker.id,
                proxy: self.lockerOptions.proxy,
                name: self.name,
                listId: self.options[actionName].listId,
                service: self.options[actionName].service,
                doubleOptin: self.options[actionName].doubleOptin,
                confirm: self.options[actionName].confirm,
                requireName: self.options[actionName].requireName || false
            };
            
            var service = new $.pandalocker.services.subscription( serviceOptions );
            this.subscriptionService = self.applyFilters('get-default-subscription-service', service );
        }
    };
    
    /**
     * Runs coherently each action 
     * which should be executed when the user is connected.
     */
    control.runActions = function( identityData, serviceData, changeScreen ) {
        var deferred = new $.Deferred();
        var self = this;     

        // in order to execute the actions only once
        if ( this._actionsDone ) return;
        this._actionsDone = true;
        
        var actions = this.options.actions.slice();
        
        if ( changeScreen ) this.showScreen('data-processing');

        // this function takes the next action from the queue and executes it, 
        // when the action is completed, takes the next one
        
        var runNextAction = function() {           
            var actionName = actions.shift();
            
            if ( !actionName ) { 
                deferred.resolve();
                self.unlock(); 
                return; 
            }

            var actionOptions = self.options[$.pandalocker.tools.camelCase( actionName )];

            var methodName = $.pandalocker.tools.camelCase( 'run-' + actionName + "-action" );
            if ( !self[methodName] ) { 
                deferred.reject();
                self._actionsDone = false;
                throw new Error("The action '" + methodName + "' not found.");
            }

            self[methodName]( identityData, serviceData, actionOptions, changeScreen, function( result ){

                if ( 'error' === result  ) { 
                    self.runHook('raw-error');
                    deferred.reject( result );
                    self._actionsDone = false;
                    return self.showScreen('default');
                }
                runNextAction();
            });
        };
        
        runNextAction();
        return deferred.promise();
    };

    /**
     * Runs the action to subscribe the user.
     */
    control.runSubscribeAction = function( identityData, serviceData, actionOptions, changeScreen, callback ) {
        var self = this;

        var subscribe = function() {
            
            if ( changeScreen ) self.showScreen('data-processing');   

            var result = self.subscriptionService.subscribe( identityData, serviceData );
            self._setupSubscriptionHooks( result, identityData );
            
            result.fail(function(){
                callback('error');
            });
        };
        
        if ( !identityData.email ) {
            
            return this.showScreen('enter-email', {
                header: $.pandalocker.lang.onestep_screen_title,
                message: $.pandalocker.lang.onestep_screen_instructiont,
                buttonTitle: $.pandalocker.lang.onestep_screen_button,
                note: $.pandalocker.tools.normilizeHtmlOption( self.options.noSpamText || self.groupOptions.text.noSpamText || $.pandalocker.lang.noSpam ),
                callback: function( email ){
                    identityData.email = email;
                    subscribe();
                }
            });
        };

        subscribe();
    };
    
    /**
     * Runs the action to sign up the user.
     */
    control.runSignupAction = function( identityData, serviceData, actionOptions, changeScreen, callback ) {
        var self = this;
        
        var signup = function() {
            
            if ( changeScreen ) self.showScreen('data-processing');   
            
            var dataToPass = {};
            dataToPass.opandaIdentityData = identityData;
            dataToPass.opandaHandler = 'signup';
            
            dataToPass = $.pandalocker.filters.run(self.locker.id + '.ajax-data', [dataToPass]);       
            dataToPass = $.pandalocker.filters.run(self.locker.id + '.signup.ajax-data', [dataToPass]);

            return $.ajax({
                type: "POST",
                dataType: "json",
                url: self.lockerOptions.proxy,
                data: dataToPass,
                success: function() {
                    callback();
                },
                error: function(response, type, errorThrown) {
                    if ( response && response.readyState < 4 ) return;

                    self.showScreen('default'); 
                    self.showError('Unable to sign in, the ajax error occurred.');
                    callback('error');

                    if ( !console || !console.log ) return;
                    console.log('Invalide ajax response:');
                    console.log(response.responseText);
                }
            });
        };
        
        if ( !identityData.email ) {
            
            return this.showScreen('enter-email', {
                header: $.pandalocker.lang.onestep_screen_title,
                message: $.pandalocker.lang.onestep_screen_instructiont,
                buttonTitle: $.pandalocker.lang.onestep_screen_button,
                note: $.pandalocker.tools.normilizeHtmlOption( self.options.noSpamText || self.groupOptions.text.noSpamText || $.pandalocker.lang.noSpam ),
                callback: function( email ){
                    identityData.email = email;
                    signup();
                }
            });
        };
        
        signup();
    };
    
    /**
     * Runs the action to catch the lead.
     */
    control.runLeadAction = function( identityData, serviceData, actionOptions, changeScreen, callback ) {
        var self = this;
        
        var catchLead = function() {
            
            if ( changeScreen ) self.showScreen('data-processing');  
            
            var dataToPass = {};
            dataToPass.opandaIdentityData = identityData;
            dataToPass.opandaHandler = 'lead';
            
            dataToPass = $.pandalocker.filters.run(self.locker.id + '.ajax-data', [dataToPass]);       
            dataToPass = $.pandalocker.filters.run(self.locker.id + '.lead.ajax-data', [dataToPass]);

            return $.ajax({
                type: "POST",
                dataType: "json",
                url: self.lockerOptions.proxy,
                data: dataToPass,
                success: function(data) {
                    callback();
                },
                error: function(response, type, errorThrown) {
                    if ( response && response.readyState < 4 ) return;

                    self.showScreen('default'); 
                    self.showError('Unable to sign in, the ajax error occurred.');
                    callback('error');

                    if ( !console || !console.log ) return;
                    console.log('Invalide ajax response:');
                    console.log(response.responseText);
                }
            });
        };
        
        if ( !identityData.email ) {

            return this.showScreen('enter-email', {
                header: $.pandalocker.lang.onestep_screen_title,
                message: $.pandalocker.lang.onestep_screen_instructiont,
                buttonTitle: $.pandalocker.lang.onestep_screen_button,
                note: $.pandalocker.tools.normilizeHtmlOption( self.options.noSpamText || self.groupOptions.text.noSpamText || $.pandalocker.lang.noSpam ),
                callback: function( email ){
                    identityData.email = email;
                    catchLead();
                }
            });
        };
        
        catchLead();
    };
    
    // ----------------------------------------------------------------
    // Subscription
    // ----------------------------------------------------------------

    control._checkWaitingSubscription = function() {
        if ( !this.subscriptionService || !this.subscriptionService.isWaitingSubscription() ) return;

        var identityData = this.subscriptionService.getWaitingIdentityData();

        var result = this.subscriptionService.waitSubscription( identityData );
        this._setupSubscriptionHooks( result, identityData );
        
        var self = this;
        this.showScreen('email-confirmation', {
            service: self.subscriptionService,
            email: identityData.email
        });
    };
    
    control._setupSubscriptionHooks = function( result, identityData ) {
        var self = this;
        
        result.done(function(){ self.unlock(); });

        result.fail(function( data ){
            
            self.runHook('raw-error');
   
            self.showNotice( data.error );
            self.showScreen('default');
            
            if ( data.detailed && console && console.log ) {
                console.log( data.detailed );
            }
        });
        
        result.always(function( data, ok ){
            self.subscriptionService._removeWaitingStatus();
        });
        
        result.progress( function( status ){
            if ( 'waiting-confirmation' === status ){}
            self.showScreen('email-confirmation', {
                service: self.subscriptionService,
                email: identityData.email
            });
        });
        
        return result;
    };

    // --------------------------------------------------------------
    // Making the control public
    // --------------------------------------------------------------   
    
    $.pandalocker.entity.actionControl = control;
    
})(jQuery);


;
(function($){
    'use strict';
    
    var group = {};
    
    /**
     * Default options.
     */
    group._defaults = {};
    
    /**
     * Inits the group.
     */
    group.init = function( locker, options ) {
        var self = this;
        
        this.locker = locker;
        this.lockerOptions = locker.options;  
        
        // stores the lang resources for the current lang scope
        this.lang = locker.lang;

        if ( !options ) options = {};

        var temp = $.extend(true, {}, this._defaults);
        this.options = $.extend(true, temp, options); 
 
        for (var prop in options) {
            if ( !options.hasOwnProperty(prop) ) continue;
            if ( !$.isArray(options[prop])) continue;
            this.options[prop] = options[prop];
        }

        this.isFirst = options.index === 1;
        this.isLast = options.index === this.lockerOptions.groups.order.length;
        this.isSingle = this.lockerOptions.groups.order.length === 1;
        
        if (typeof this.options.text !== "object") {
            this.options.text = { message: self.options.text };
        }

        if ( this.isFirst ) {
            if ( '' === this.options.text.header ) this.options.text.header = '';
            else this.options.text.header = this.options.text.header || this.lang.defaultHeader;
            
            if ( '' === this.options.text.message ) this.options.text.message = '';
            else this.options.text.message = this.options.text.message || this.lang.defaultMessage;
        }

        this.options.text.header = $.pandalocker.tools.normilizeHtmlOption ( this.options.text.header );
        this.options.text.message = $.pandalocker.tools.normilizeHtmlOption ( this.options.text.message );
        this.options.text.footer = $.pandalocker.tools.normilizeHtmlOption ( this.options.text.footer );

        // prepares separator options
        
        if ( false !== this.options.separator ) {
            
            var separator = $.isPlainObject( this.options.separator )
                ? this.options.separator
                : { type: 'line', 'title': self.options.separator };

            separator.type = separator.type || 'line';
            this.options.separator = separator;  
        }
        
        // continues processing with child methods

        if ( this.childInit ) this.childInit();
        if ( this.setup ) this.setup();
        if ( this.setupHooks ) this.setupHooks();
        if ( this.prepareOptions ) this.prepareOptions();
        
        try { 
            this.createControls();
        } catch(e) {
            if ( e.onpsl ) this.showError( this.name, e.message );
            else throw e;
        }
    };

    /**
     * Creates controls for the group.
     */
    group.createControls = function() {
        
        this.controls = [];

        for( var i = 0; i < this.options.order.length; i++ ) {  

            var controlName = this.options.order[i];
            if ( typeof controlName !== 'string' ) continue;
            
            if ( !$.pandalocker.controls[this.name][controlName] ) {
                throw new $.pandalocker.error('Control "' + controlName + '" not found in the group "' + this.name + '"');
            }
            
            var control = this.createControl(controlName);
            this.controls.push( control );
        }
    };
    
    /**
     * Creates a specified control.
     */
    group.createControl = function( controlName ) {
        var control = $.pandalocker.tools.extend( $.pandalocker.controls[this.name][controlName] );
        
        var optionsName = $.pandalocker.tools.camelCase( controlName );
        var controlOptions = this.options[optionsName] || {};
        
        control.init( this, controlOptions );
        return control;
    };
    
    /**
     * Requests the state of a locker.
     */
    group.requestState = function( callback ){
        
        var controlsCount = this.controls.length;
        var currentState = 'locked';

        for( var i = 0; i < this.controls.length; i++ ) {  
            this.controls[i].requestState(function( state ){
                controlsCount--;
                if ( 'unlocked' === state ) currentState = state;
                if ( controlsCount <= 0 ) callback( currentState );
            });
        }
    };
    
    /**
     * Checks wheither this group is ready for work.
     * For examplle, has any buttons available for the user to click.
     */
    group.canLock = function() {
        return true;
    };
    
    /**
     * Renders a group.
     */
    group.renderGroup = function( $holder ) {
        
        var $group = $("<div class='onp-sl-group onp-sl-" + this.name + "'></div>");
        $group.appendTo( $holder );
        
        var $innerWrap = $("<div class='onp-sl-group-inner-wrap'></div>");
        $innerWrap.appendTo( $group );
        
        if ( this.isFirst ) $group.addClass( 'onp-sl-first-group' );
        else if ( this.isLast ) $group.addClass( 'onp-sl-last-group' );
        else $group.addClass( 'onp-sl-middle-group' );
        
        $group.addClass( this.isSingle ? 'onp-sl-single-group' : 'onp-sl-not-single-group' );
        
        $group.addClass( 'onp-sl-group-index-' + this.options.index ); 

        this.element = $group;
        this.innerWrap = $innerWrap;
        
        this.renderSeparator();

        if ( this.options.text.header || this.options.text.message ) {
            var resultText = $("<div class='onp-sl-text'></div>").appendTo(this.innerWrap);
            
            if (this.options.text.header) 
                resultText.append(this.options.text.header.addClass('onp-sl-header onp-sl-strong').clone());
            
            if (this.options.text.message)
                resultText.append(this.options.text.message.addClass('onp-sl-message').clone()); 
                
        }

        this._isRendered = true;
        this.render( this.innerWrap );
    };

    /**
     * The child method which should be overwritten.
     */
    group.render = function(){
        this.renderControls( this.innerWrap  ); 
    };
    
    /**
     * Sends a signal to the locker that the content should be unlocked.
     */
    group.unlock = function( sender, sernderName, value ) {
        this.locker.unlock( sender, sernderName, value );
    };
    
    /**
     * Sets a new state for a given group control.
     */
    group.setState = function( state, senderType, sernderName ) {
        this.locker.setState( state, senderType || 'group', sernderName || this.name );
    }; 
    
    /**
     * Renders the group controls.
     */
    group.renderControls = function( $innerWrap ) {
        
        for( var i = 0; i < this.controls.length; i++ ) {  
            this.controls[i].renderControl( $innerWrap );
        }
    };
    
    group.showError = function( name, text ) {
        
        // if the group has been not yet rendered, 
        // then pass processing of the error to the locker
        
        if ( !this._isRendered ) {
            
            this.locker._showError( name, text );
        
        // if the group has been rendered,
        // then shows the error as a part of the group html
        
        } else {
            
            this.element.find('.onp-sl-group-error').remove();

            if ( this._currentErrorFor === name ) {

                this.element.find('.onp-sl-group-error').remove();
                this._currentErrorFor = null;

            } else {

                var $error = $("<div class='onp-sl-group-error'>" + text + "</div>");
                this.innerWrap.append( $error ); 

                this._currentErrorFor = name;    
            }
            
            this.runHook('size-changed');
        }
    };
    
    /**
     * Adds a CSS class to locker.
     * @returns {undefined}
     */
    group.addClassToLocker = function( className ) {
        this.locker._addClass( className );
    };
    
    // --------------------------------------------------------------
    // Notices
    // --------------------------------------------------------------   
    
    /**
     * Shows a notice.
     */
    group.showNotice = function( text, expires, callback ){
        
        this.element.find('.onp-sl-group-notice').remove();
        
        var $notice = $("<div class='onp-sl-group-notice'>" + text + "</div>").hide();
        this.innerWrap.append( $notice ); 
        $notice.fadeIn(500);
        
        if ( !expires ) expires = 7000;
        setTimeout(function(){
            if ( !$notice.length ) return;
            $notice.fadeOut( 800, function(){
                $notice.remove();
                callback && callback();
            } );
        }, expires);
    };
    
    // --------------------------------------------------------------
    // Separators
    // --------------------------------------------------------------
    
    /**
     * Renders a separator if needed.
     */
    group.renderSeparator = function() {
        
        // there's not any meaning to show the separator before first group
        if ( this.isFirst ) return;
        if ( this.options.separator === false ) return;
       
        var self = this;
        
        var options = this.options.separator;
        var type = options.type;
        
        this.element
            .addClass('onp-sl-has-separator')
            .addClass('onp-sl-has-' + type + '-separator');
        
        var $separator = $("<div class='onp-sl-group-separator onp-sl-" + type + "-separator'></div>");
        
        var titleTag = ( 'hiding-link' === type ) ? "<a href='#'></a>" : "<span></span>";
        var $text = $(titleTag).addClass('onp-sl-title').appendTo( $separator );
        
        $text.html( options.title || $.pandalocker.lang.misc_or );
        
        $separator.appendTo( this.innerWrap );
        
        if ( 'hiding-link' === type ) {
            this.element.addClass('onp-sl-separator-hides');
            
            var $container = $("<div class='onp-sl-hiding-link-container' style='display: none;'></div>");
            $container.appendTo( this.innerWrap );
            this.innerWrap = $container;
            
            $text.click(function(){
                self.element.removeClass('onp-sl-separator-hides');
                self.element.addClass('onp-sl-separator-shows');
                
                $separator.hide();
                $container.fadeIn(500);
                
                self.runHook('size-changed');
                return false;
            });
        }
    };
    
    // --------------------------------------------------------------
    // Events
    // --------------------------------------------------------------

    /**
    * Subscribes to the specified hook.
    */
    group.addHook = function( eventName, callback, priority ) {
        return this.locker.addHook( eventName, callback, priority );
    };

    /**
    * Runs the specified hook.
    */
    group.runHook = function( eventName, args ) {
        return this.locker.runHook( eventName, args );
    };

    /**
    * Subscribes to the specified hook.
    */
    group.addFilter = function( eventName, callback, priority ) {
        return this.locker.addFilter( eventName, callback, priority );
    };

    /**
    * Runs the specified hook.
    */
    group.applyFilters = function( eventName, input, args ) {
        return this.locker.applyFilters( eventName, input, args );
    };
    
    // --------------------------------------------------------------
    // Screens
    // --------------------------------------------------------------   

    group.showScreen = function( screenName, options ) {
        this.locker._showScreen( screenName, options );
    };
    
    group.registerScreen = function( screenName, factory ) {
        this.locker._registerScreen( screenName, factory );
    };
    
    $.pandalocker.entity.group = group;

})(jQuery);


;
(function($){
    'use strict';
    
    var group = $.pandalocker.tools.extend( $.pandalocker.entity.group );

    /**
     * Default options.
     */
    group._defaults = {
        
        // common url to like/share
        url: null,

        // horizontal or vertical
        layout: 'horizontal',
        
        // adds the covers of the buttons
        flip: false,

        // an order of the buttons, available buttons:
        // -
        // twitter: twitter-tweet, twitter-follow
        // facebook: facebook-like, facebook-share
        // google: google-plus, google-share
        // -
        order: [

            "vk-like",
            "vk-share",
            "vk-subscribe",
            "ok-share",
            "youtube-subscribe",

            "twitter-tweet",
            "facebook-like",
            "google-plus"
        ],

        // hide or show counters for the buttons
        counters: true,

        // Facebook Options
        facebook: {

            // sdk version to load (v1.0, v2.0)
            version: 'v2.5',

            like: {
                title: $.pandalocker.lang.socialButtons.facebookLike
            },
			subscribe: {
				title: $.pandalocker.lang.socialButtons.facebookLike
			},
            share: {
                title: $.pandalocker.lang.socialButtons.facebookShare
            }
        },

        // Twitter Options
        twitter: {

            tweet: {
                title: $.pandalocker.lang.socialButtons.twitterTweet
            },
            follow: {
                title: $.pandalocker.lang.socialButtons.twitterFollow
            }
        },

        // Google Options
        google: {

            plus: {
                title: $.pandalocker.lang.socialButtons.googlePlus
            },
            share: {
                title: $.pandalocker.lang.socialButtons.googleShare
            }
        }, 
        
        // Youtube Options
        youtube: {
            title: $.pandalocker.lang.socialButtons.youtubeSubscribe
        },
        
        // --
        // VKontakte Options
        vk: {               

            like: {
                title: $.pandalocker.lang.socialButtons.vkLike
            },

            share: {
                title: $.pandalocker.lang.socialButtons.vkShare
            },

            subscribe: {
                title: $.pandalocker.lang.socialButtons.vkSubscribe
            }
        },

        // --
        // Odnoklassniki Options
        ok: {

            share: {
                title: $.pandalocker.lang.socialButtons.okShare
            }
        },

        // --
        // Mail Options
        mail: {

            share: {
                title: $.pandalocker.lang.socialButtons.mailShare
            }
        },
        // --
        // LinkedIn Options
        linkedin: {

            // - Separeted options for each buttons.

            share: {
                title: $.pandalocker.lang.socialButtons.linkedinShare 
            }
        }
    };

    /**
     * The name of the group.
     */
    group.name = "social-buttons";
    
    /**
     * Prepares the group options.
     */
    group.prepareOptions = function() {
        
        this.options.lang = this.locker.options.lang;

        if ( 'horizontal' !== this.options.layout && 'vertical' !== this.options.layout ) {
            this.options.layout = 'horizontal';
        }
        
        // remove a google share button for mobile devices
        /**
        if ( $.pandalocker.tools.isTabletOrMobile() ) {
            var googleIndex = $.inArray("google-share", this.options.order);   
            if (googleIndex >= 0) this.options.order.splice(googleIndex, 1);
        }
        */
       
        this.options.url = this.options.url || this.locker.options.url;

        // adapter for the old version of the social locker

        // for social buttons
        if ( this.locker.options.buttons ) {
            if ( this.locker.options.buttons.order ) this.options.order = this.locker.options.buttons.order;
            if ( typeof this.locker.options.buttons.counters !== "undefined" ) this.options.counters = this.locker.options.buttons.counters;
        }

        // for social keys
        if ( this.locker.options.facebook ) this.options.facebook = $.extend(  true, this.options.facebook, this.locker.options.facebook );
        if ( this.locker.options.twitter ) this.options.twitter = $.extend(  true, this.options.twitter, this.locker.options.twitter );
        if ( this.locker.options.google ) this.options.google = $.extend(  true, this.options.google, this.locker.options.google );
        if ( this.locker.options.linkedin ) this.options.linkedin = $.extend(  true, this.options.linkedin, this.locker.options.linkedin );
        if ( this.locker.options.youtube ) this.options.youtube =  $.extend(  true, this.options.youtube, this.locker.options.youtube );

        if ( this.locker.options.vk ) this.options.vk =  $.extend(  true, this.options.vk, this.locker.options.vk );
        if ( this.locker.options.ok ) this.options.ok =  $.extend(  true, this.options.ok, this.locker.options.ok );
        if ( this.locker.options.mail ) this.options.mail =  $.extend(  true, this.options.mail, this.locker.options.mail );
    };
    
    /**
     * Renders the group.
     * @returns {undefined}
     */
    group.render = function() {

        this.element.addClass( this.options.counters  ? 'onp-sl-has-counters' : 'onp-sl-no-counters');
        this.element.addClass( 'onp-sl-' + this.options.layout );
        this.element.addClass( 'onp-sl-lang-' + this.options.lang );

        this.renderControls( this.innerWrap  ); 
    };
    
    /**
     * Creates a specified control.
     */
    group.createControl = function( controlName ) {
        
        var control = $.pandalocker.tools.extend( $.pandalocker.controls[this.name][controlName] );
        
        var parts = controlName.split('-');
        var networkName = parts.length === 2 ? parts[0] : null;
        var buttonName = parts.length === 2 ? parts[1] : parts[0];
        
        var controlOptions = {};

        if ( networkName  ) {
            if ( this.options[networkName] ) controlOptions = $.extend({}, this.options[networkName]);
            if ( this.options[networkName][buttonName] ) controlOptions = $.extend(controlOptions, this.options[networkName][buttonName] );
        } else {
            if ( this.options[buttonName] ) controlOptions = $.extend(controlOptions, this.options[buttonName] );                    
        }


        var networkOptions = networkName ? this.options[networkName] : {};

        networkOptions.lang = this.options.lang;
        networkOptions.counters = this.options.counters;
        networkOptions.url = networkOptions.url || this.options.url;
  
        control.init( this, controlOptions, networkOptions );
        return control;
    },
    
    /**
     * Checks wheither this group is ready for work.
     */
    group.canLock = function() {

        // unlock the locker if no buttons are defined
        if (this.options.order.length === 0) {
            return false;
        }
        
        return true;
    };

    $.pandalocker.groups["social-buttons"] = group;
    
})(jQuery);;
(function($){
    'use strict';

    var socialButton = $.pandalocker.tools.extend( $.pandalocker.entity.control );
    
    /**
     * The social buttons additionally have to get the networks option.
     * So we overwrite the original init method.
     */
    socialButton.init = function( group, options, networkOptions ) {
        this.networkOptions = networkOptions;

        var parts = this.name.split('-');

        this.networkName = this.sdk ? this.sdk : parts.length === 2 ? parts[0] : null;
        this.buttonName = parts.length === 2 ? parts[1] : parts[0];

        $.pandalocker.entity.control.init.call( this, group, options );
        
        if ( this.networkName ) {
            this._ssIdentity = "page_" + $.pandalocker.tools.hash(this.url) + "_hash_" + this.networkName + "-" + this.buttonName;   
        } else {
            this._ssIdentity = "page_" + $.pandalocker.tools.hash(this.url) + "_hash_" + this.buttonName; 
        }

		/** ------------------------------------------------------------------------- **/
		//	Если у нас одна кнопка и замок вызывает ошибку, открываем его.
		//	Если кнопки вызвали ошибку, скрываем их.
		//	Хук работает только для фронтенда, поэтому проверяем опцию appPublic
		/** ------------------------------------------------------------------------- **/

		this.addHook('control-error', function(locker, buttonName, groupName, message){
			var order = locker.options.socialButtons && locker.options.socialButtons.order;

			if( !order || !order.length ) {
				order = locker.options.buttons && locker.options.buttons.order;
			}

			if(	order && order.length && locker.options.appPublic ) {
				if( $.inArray(buttonName, order) === -1 )
					return;

				console.group ( '%c[Error]: Возникла ошибка при инициализации кнопки.', "color: red;" );
				console.log ( '%c[Button]: ' + buttonName, "color: blue;" );
				console.log ( '%c[Group]: ' + groupName, "color: blue;" );
				console.log ( '%c[Mesage]: ' + message, "color: green;" );

				if ( order.length <= 1 ) {
					if ( order[0] === buttonName ) {
						order[0] === buttonName && locker.unlock && locker.unlock ( "error" );
						console.log ( '%c[Event]: Замок был открыт из-за того, что кнопка ' + buttonName + ' вызвала ошибку.', "color:#EF94F2;" );
					}
					return;
				}

				var interationCount = 0,
				timer = setInterval ( function () {
					var control = $ ( locker.locker ).find ( '.onp-sl-' + buttonName );

					if ( control.length || interationCount > 10 ) {
						control.fadeOut ();
						clearInterval ( timer );
					}
					interationCount++;
				}, 500 );


				var index = order.indexOf( buttonName );

				if ( index !== -1 ) {
					console.log ( '%c[Event]: Кнопка ' + buttonName + ' была скрыта из-за возникновения ошибки.', "color:#EF94F2;" );
					order.splice( index, 1 );
				}

				console.groupEnd();
			}
		});
		/** ------------------------------------------------------------------------- **/
    },
    
    /**
     * The funtions which returns an URL to like/share for the button.
     * Uses the options and a current location to determine the URL.
     */
    socialButton._extractUrl = function() {
        return $.pandalocker.tools.URL.normalize( this.options.url || this.networkOptions.url || window.location.href );
    };
    
    /**
     * Shows the control in the specified holder.
     */
    socialButton.render = function( $holder ) {
        var self = this;

        if ( this.networkName )
            this.control.addClass('onp-sl-' + this.networkName );
        
        this.container = $("<div class='onp-sl-social-button onp-sl-social-button-" + this.name + "'></div>");
        this.container.appendTo( $holder );

        if ( !this._hasError() ) {
            
            this._setLoadingState();
            
            var render = function(){

                var sdkResult = self.requireSdk( self.networkName, self.networkOptions );

                // error fired
                sdkResult.fail(function( error ){
                    self._removeLoadingState();
                    self.showError( error );
                });

                // loaded successfully
                sdkResult.done(function(){

                    self.setupEvents();
                    self.renderButton( self.container );

                    // waiting creating a button   
                    self.verifyButton()
                        .always(function(){ self._removeLoadingState(); })
                        .fail(function( error ){ self.showError( error ); });      
                });
            };

            if ( this.locker.options.lazy ) {
                this.addHook('raw-impress', function(){
                    if ( self._rendered ) return;
                    self._rendered = true;
                    render();
                });
            } else {
                render();
            }
        }

        // adds support for the flip effect if it's needed
        this._addFlipEffect();
    };

    
    /**
     * Adds the Flip Effect.
     */
    socialButton._addFlipEffect = function() {
        var $control = this.control;
        var $innerWrap = this.innerWrap;
        
        var flipEffect = this.group.options.flip;
        var flipSupport = $.pandalocker.tools.has3d();

        // addes the flip effect
        (flipEffect && flipSupport && $control.addClass("onp-sl-flip")) || $control.addClass("onp-sl-no-flip");
        if (!flipEffect) return true;

        var title = this.options.title || (this.networkName 
            ? $.pandalocker.lang[this.networkName + "_" + this.buttonName]
            : $.pandalocker.lang[this.networkName]);

        var overlay = $("<a href='#'></a>")
              .addClass("onp-sl-button-overlay") 

              .append($("<div class='onp-sl-overlay-back'></div>"))
              .append(
               $("<div class='onp-sl-overlay-front'></div>")
                    .append($("<div class='onp-sl-overlay-icon'></div>"))
                    .append($("<div class='onp-sl-overlay-line'></div>"))               
                    .append($("<div class='onp-sl-overlay-text'>" + title + "</div>"))
               )
              .append($("<div class='onp-sl-overlay-header'></div>"));

        overlay.prependTo($innerWrap);
        
        if ( !flipSupport ) { 
            $control.hover(
                function () {
                    var overlay = $(this).find(".onp-sl-button-overlay");
                    overlay.stop().animate({ opacity: 0 }, 200, function () {
                        overlay.hide();
                    });
                },
                function () {
                    var overlay = $(this).find(".onp-sl-button-overlay").show();
                    overlay.stop().animate({ opacity: 1 }, 200);
                }
            );
        }

        // if it's a touch device
        if ($.pandalocker.isTouch()) {

            // if it's a touch device and flip effect enabled.
            if (flipSupport) {

                overlay.click(function () {
  
                    if ($control.hasClass('onp-sl-flip-hover')) {
                        $control.removeClass('onp-sl-flip-hover');
                    } else {
                        $('.onp-sl-flip-hover').removeClass('onp-sl-flip-hover');
                        $control.addClass('onp-sl-flip-hover');
                    }

                    return false;
                });

            // if it's a touch device and flip effect is not enabled.
            } else {

                overlay.click(function () {
                    var overlay = $(this);
                    overlay.stop().animate({ opacity: 0 }, 200, function () {
                        overlay.hide();
                    });

                    return false;
                });
            }
        } 

        // every next button has the zindex less a previos button
        
        if ( !this.group._buttonsZIndex ) this.group._buttonsZIndex = 54;
        this.group._buttonsZIndex = this.group._buttonsZIndex - 4;
        var zIndex = this.group._buttonsZIndex;
        
        $control.css('z-index', zIndex);
        
        if ( overlay ) {
            overlay.css('z-index', zIndex);
            overlay.find('.onp-sl-overlay-front').css('z-index', 1);
            overlay.find('.onp-sl-overlay-back').css('z-index', -1);  
            overlay.find('.onp-sl-overlay-header').css('z-index', 1 );                  
        }
    };

    
    /**
     * Returns an indentity for the state storage.
     */
    socialButton._getStorageIdentity = function() {
        return this._ssIdentity; 
    };
    
    /**
     * Options to verify that the button has been rendered.
     */
    socialButton.verification = {
        container: 'iframe',
        timeout: 5000
    };

    $.pandalocker.entity.socialButton = socialButton;
    
})(jQuery);;
/*!
 * Facebook SDK Connector
 * Copyright 2014, OnePress, http://byonepress.com
*/
(function ($) {
    'use strict';

    if (!$.onepress) $.onepress = {};
    if (!$.pandalocker.sdk) $.pandalocker.sdk = {};

    $.pandalocker.sdk.facebook = $.pandalocker.sdk.facebook || {
        
        // a name of a social network
        name: 'facebook',
        
        // a script to load (v1.0)
        url1: '//connect.facebook.net/{lang}/all.js',
        
        // a script to load (v2.0)
        url2: '//connect.facebook.net/{lang}/sdk.js',    
        
        // a script id to set
        scriptId: 'facebook-jssdk',

        // a timeout to load
        timeout: 10000,
        
        /**
         * Returns true if an sdk is currently loaded.
         * 
         * @since 1.5.5
         * @returns boolean
         */
        isLoaded: function () {
            return (typeof (window.FB) === "object");
        },
        
        /**
         * Creates fb-root element before calling a Facebook sdk.
         * 
         * @since 1.5.5
         * @returns void
         */
        prepare: function () {

            // root for facebook sdk
            $("#fb-root").length === 0 && $("<div id='fb-root'></div>").appendTo($("body"));

            // sets sdk language
            var lang = (this.options && this.options.lang) || "en_US";

            this.url1 = this.url1.replace("{lang}", lang);
            this.url2 = this.url2.replace("{lang}", lang);
            
            this.url = this.options.version === 'v1.0' ? this.url1 : this.url2;

            var checker = function(e){
				try {
					if ( !e && !e.data ) return;
					if (typeof e.data !== 'string') return;

					if( e.data.indexOf('edge.create') !== -1 ) {

						var likeBtn = $.pandalocker.data && $.pandalocker.data.__facebookLikeButton;

						if( likeBtn ) {
							likeBtn.parent()
								.removeClass('onp-sl-fb-like-alert-confirmation-border');

							likeBtn.closest ( '.onp-sl-control-inner-wrap' )
								.find('.onp-sl-fb-like-alert-confirmation-hint' )
								.remove('.onp-sl-fb-like-alert-confirmation-hint');

							likeBtn.add( likeBtn.parent() )
								.width(
									likeBtn.data('default-width')
										? likeBtn.data('default-width')
										: likeBtn.parent().width()
								)
								.height(
									likeBtn.data('default-height')
										? likeBtn.data('default-height')
										: likeBtn.parent().height()
								);

							$( document ).trigger ( 'onp-sl-facebook-like', [
								$.pandalocker.data.__facebookLikeButton.data('href')
							] );

							$.pandalocker.tools.debugger(
								{
									buttons: {
										facebook: {
											like: {
												facebookLikeUrl: $.pandalocker.data.__facebookLikeButton.data('href'),
												postMessage: e.data
											}
										}
									}
								}
							);

						}
					}

				} catch(error) {
					return false;
				}
            };

            window.addEventListener 
                ? window.addEventListener("message", checker, false) 
                : window.attachEvent("onmessage", checker);

        },
        
        _setup: false,
        
        /**
         * Executed when SDK is loaded.
         */
        setup: function() {
            if ( this._setup ) return;
            var self = this;
            
            window.FB.init({
                appId: (self.options && self.options.appId) || null,
                status: true,
                cookie: true,
                xfbml: true,
                version: self.options.version
            });

            window.FB.Event.subscribe('edge.create', function (url) {
                $(document).trigger('onp-sl-facebook-like', [url]);

				$.pandalocker.tools.debugger(
					{
						buttons: {
							facebook: {
								like: {
									event: 'edge.create',
									eventUrl: url
								}
							}
						}
					}
				);
            });

			/*window.FB.Event.subscribe('edge.remove', function (url) {
				$(document).trigger('onp-sl-facebook-like', [url]);
			});*/

            // the initialization is executed only one time.
            // any others attempts will call an empty function.
            window.FB.init = function () { };
            $(document).trigger(self.name + '-init');
            
            this._setup = true;
        },
        
        /**
         * Creates subscribers for Facebook evetns.
         * 
         * @returns void
         */
        createEvents: function () {
            var self = this;
            var isLoaded = this.isLoaded();

            if (isLoaded) {
                self.setup();
            } else {
                if (window.fbAsyncInit) var predefined = window.fbAsyncInit;
                window.fbAsyncInit = function () {
                    self.setup(); predefined && predefined();
                    window.fbAsyncInit = function () { };
                };
            }
        }
    };

})(jQuery);;
/*!
 * Twitter SDK Connector
 * Copyright 2014, OnePress, http://byonepress.com
*/
(function ($) {
    'use strict';

    if (!$.onepress) $.onepress = {};
    if (!$.pandalocker.sdk) $.pandalocker.sdk = {};

    $.pandalocker.sdk.twitter = $.pandalocker.sdk.twitter || {
        
        // a name of a social network
        name: 'twitter',
        // a script to load
        url: '//platform.twitter.com/widgets.js',
        // a script id to set
        scriptId: 'twitter-wjs',
        // a timeout to load
        timeout: 10000,
        
        /**
         * Returns true if an sdk is currently loaded.
         * 
         * @since 1.5.5
         * @returns boolean
         */
        isLoaded: function () {
            return (typeof (window.__twttrlr) !== "undefined");
        },

        /**
         * Creates subscribers for Twitter events.
         * 
         * @returns void
         */
        createEvents: function () {
            var self = this;
            var isLoaded = this.isLoaded();
            
            
            var load = function () {
                
                /*
                if ( $.pandalocker.browser.msie && ( $.pandalocker.browser.version >= 8 ) ) { 
                    window.twttr.events.bind('click', function (event) {
                        
                        setTimeout(function(){
                            $(document).trigger('onp-sl-twitter-tweet', [event]);
                        }, 6000);
                        
                        setTimeout(function(){
                            $(document).trigger('onp-sl-twitter-follow', [event]);
                        }, 3000);
                    });  
                }

                window.twttr.events.bind('tweet', function (event) {
                    $(document).trigger('onp-sl-twitter-tweet', [event]);
                });
                window.twttr.events.bind('follow', function (event) {
                    $(document).trigger('onp-sl-twitter-follow', [event]);
                });
                 */
                
                $(document).trigger(self.name + '-init');
            };

            if (isLoaded) { load(); return; }

            if (!window.twttr) window.twttr = {};
            if (!window.twttr.ready) window.twttr = $.extend(window.twttr, { _e: [], ready: function (f) { this._e.push(f); } });
            
            twttr.ready(function (twttr) { load(); });
        },

        prepare: function() {

            var checker = function(e){

                if ( !e && !e.data ) return;
                if (typeof e.data !== 'string') return;            

                if ( e.data.indexOf(':["tweet"') !== -1 ) return $(document).trigger('onp-sl-twitter-tweet');
                if ( e.data.indexOf(':["follow"') !== -1 ) return $(document).trigger('onp-sl-twitter-follow');                
            };

            window.addEventListener 
                ? window.addEventListener("message", checker, false) 
                : window.attachEvent("onmessage", checker);

        }
    };

})(jQuery);;
/*!
 * Google SDK Connector
 * Copyright 2014, OnePress, http://byonepress.com
*/
(function ($) {
    'use strict';

    if (!$.onepress) $.onepress = {};
    if (!$.pandalocker.sdk) $.pandalocker.sdk = {};

    $.pandalocker.sdk.google = $.pandalocker.sdk.google || {
        
        // a name of a social network
        name: 'google',
        // a script to load
       // url: '//apis.google.com/js/plusone.js',
        url: '//apis.google.com/js/platform.js',
        // a script id to set
        scriptId: 'google-jssdk',
        // a timeout to load
        timeout: 10000,
        
        /**
         * Returns true if an sdk is currently loaded.
         * 
         * @since 1.5.5
         * @returns boolean
         */
        isLoaded: function () {
            return (typeof (window.gapi) === "object");
        },

        /**
         * Creates a function for Google callbacks.
         * 
         * @since 1.5.5
         * @returns void
         */
        prepare: function () {
            var self = this;
            self.notAuthed = false;
            
            // sets sdk language
            var lang = (this.options && this.options.lang) || "en";
            window.___gcfg = window.___gcfg || { lang: lang };

            window.OPanda_GooglePlusOne_Callback = function (data) {
                if (data.state === "on") $(document).trigger('onp-sl-google-plus', [data.href]);
            };
            
            window.OPanda_GoogleShare_StartInteraction = function (data) {
                $.pandalocker.data.__googleShareUrl = data.id;
            };    
            
            if ( !$.pandalocker.tools.isTabletOrMobile() ) {
                
                var checker = function(e) {
					try {
						if ( !e && !e.data ) return;

						if (typeof e.data !== 'string') return;
						if ( e.data.indexOf('oauth2relay') !== -1 ) return;

						if ( e.data.indexOf('::drefresh') !== -1 ) {
							self.notAuthed = true;
							return;
						}

						if ( e.data.indexOf('::_g_wasClosed') !== -1 || e.data.indexOf('::_g_closeMe') !== -1 ) {
							if ( self.notAuthed ) { self.notAuthed = false; return; }
							$(document).trigger('onp-sl-google-share');
						}

						var gRestyleDataStr = e.data.replace(/!_/, '' ),
							gRestyleDataToJson = JSON.parse(gRestyleDataStr ),
							frameId = gRestyleDataToJson.f;

						if( e.data.indexOf('"eventType":"subscribe"') !== -1 ) {
							$(document).trigger('onp-sl-youtube-subscribe', frameId);
						}

						/*if( e.data.indexOf('"eventType":"unsubscribe"') !== -1 ) {
						 $(document).trigger('onp-sl-youtube-subscribe', frameId);
						 }*/

						//Фикс для кнопки youtube, после авторизации пользователя кнопка не хочет работать,
						//решение обновить страницу после авторизации.
						if( e.data.indexOf('::_g_closeMe') !== -1 ) {
							if( $('iframe#' + frameId).attr('src').indexOf('youtube.com') !== -1 ) {
								location && location.reload();
							}
						}
					} catch(error) {
						return false;
					}
                };

                window.addEventListener 
                    ? window.addEventListener("message", checker, false) 
                    : window.attachEvent("onmessage", checker); 
            }
        }
    };

})(jQuery);;
/*!
 * LinkedIn SDK Connector
 * Copyright 2014, OnePress, http://byonepress.com
*/
(function ($) {
    'use strict';

    if (!$.onepress) $.onepress = {};
    if (!$.pandalocker.sdk) $.pandalocker.sdk = {};

    $.pandalocker.sdk.linkedin = $.pandalocker.sdk.linkedin || {
        
        // a name of a social network
        name: 'linkedin',
        // a script to load
        url: '//platform.linkedin.com/in.js',
        // a script id to set
        scriptId: 'linkedin-jssdk',
        // a timeout to load
        timeout: 10000,
        
        /**
         * Returns true if an sdk is currently loaded.
         * 
         * @since 1.5.5
         * @returns boolean
         */
        isLoaded: function () {
            return (typeof (window.IN) === "object");
        },

        /**
         * Creates callback for linkedin.
         * 
         * @since 1.5.5
         * @returns void
         */
        prepare: function () {

            window.OPanda_LinkedinShare_Callback = function (data) {
                $(document).trigger('onp-sl-linkedin-share', [data]);
            };

            // #SLJQ-26: A fix for the LinkedIn button.
            // Saves a link to the current share windlow.
            
            var funcOpen = window.open;
            window.open = function(url,name,params){

                var winref = funcOpen(url,name,params);
                if ( !winref ) return winref;
                
                var windowName = name || winref.name;
                if ( !windowName ) return winref;
                if ( windowName.substring(0,10) !== "easyXDM_IN" ) return winref;
                
                $.pandalocker.sdk.linkedin._activePopup = winref;
            };
        }
    };

})(jQuery);;
/*!
 * Twitter SDK Connector
 * Copyright 2014, OnePress, http://byonepress.com
*/
(function ($) {
    'use strict';

    if (!$.onepress) $.onepress = {};
    if (!$.pandalocker.sdk) $.pandalocker.sdk = {};

    $.pandalocker.sdk.ok = $.pandalocker.sdk.ok || {
        name: 'ok',
        url: '//connect.ok.ru/connect.js',
        scriptId: 'ok-jssdk',
        hasParams: true,
        isRender: true,
        // a timeout to load
        timeout: 10000,
        
        isLoaded: function () {
            return (typeof (window.OK) === "object");
        },
    
        createEvents: function () {
            var self = this;           
            var isLoaded = this.isLoaded();
            
            var load = function () {
                $(document).trigger(self.name + '-init');                             
            };
            
            if (isLoaded) { load(); return; }
                      
            $(document).bind('ok-script-loaded', function(){
                load();
            });
        }

    };

})(jQuery);;
/*!
 * Vkontakte SDK Connector
 * Copyright 2016, OnePress, http://byonepress.com
 */
(function ($) {
    'use strict';

    if (!$.onepress) $.onepress = {};
    if (!$.pandalocker.sdk) $.pandalocker.sdk = {};

    $.pandalocker.sdk.vk = $.pandalocker.sdk.vk || {
        name: 'vk',

        url: '//vk.com/js/api/openapi.js',

        scriptId: 'vk-jssdk',

        hasParams: true,

        isRender: true,

        // a timeout to load
        timeout: 10000,

        isLoaded: function () {
            return ( window.VK && window.VK.Cookie && typeof (window.VK.Cookie) === "object" );
        },

        prepare: function () {
            $("#vk_api_transport").length == 0 && $('<div id="vk_api_transport"></div>').appendTo($("body"));
        },

        createEvents: function () {
            var self = this;
            var isLoaded = this.isLoaded();

            var load = function () {
                $(document).trigger(self.name + '-init');
            };

            if (isLoaded) { load(); return; }

            if ( window.vkAsyncInit )
                var predefined = window.vkAsyncInit;

            window.vkAsyncInit = function () {
                load();
                predefined && predefined();
                window.vkAsyncInit = function () {};
            };
        }
    };
})(jQuery);;
/*!
 * Mail SDK Connector
 * Copyright 2014, OnePress, http://byonepress.com
 */
(function ($) {
    'use strict';

    if (!$.onepress) $.onepress = {};
    if (!$.pandalocker.sdk) $.pandalocker.sdk = {};

    $.pandalocker.sdk.mail = $.pandalocker.sdk.mail || {
        name: 'mail',

        url: '//connect.mail.ru/js/loader.js',

        scriptId: 'mail-jssdk',

        hasParams: true,

        isRender: true,

        // a timeout to load
        timeout: 10000,

        isLoaded: function () {
            return ( window.mailru && typeof (window.mailru) === "object" );
        },

        prepare: function () {},

        createEvents: function () {
            var self = this;
            var isLoaded = this.isLoaded();

            var load = function () {
                $(document).trigger(self.name + '-init');
            };

            if (isLoaded) { load(); return; }

            $(document).bind('mail-script-loaded', function(){
                load();
            });
        }
    };
})(jQuery);;
/*!
 * Facebook Like Button
 * Copyright 2016, OnePress, http://byonepress.com
 */
(function ( $ ) {
	'use strict';

	if ( !$.pandalocker.data ) $.pandalocker.data = {};
	$.pandalocker.data.__facebookLikeButton = null;

	var button = $.pandalocker.tools.extend ( $.pandalocker.entity.socialButton );

	button.name = "facebook-like";

	button._defaults = {

		// URL to like/share
		url:           null,

		// Button layout, available: standart, button_count, box_count.
		// By default 'standard'.
		layout:        'button_count',
		// Button container width in px, by default 450.
		width:         null,
		// The verb to display in the button. Only 'like' and 'recommend' are supported. By default 'like'.
		verbToDisplay: "like",
		// The color scheme of the plugin. By default 'light'.
		colorScheme:   "light",
		// The font of the button. By default 'tahoma'.
		font:          'tahoma',
		// A label for tracking referrals.
		ref:           null

		// #SLJQ-29: turn on this option if you see the
		// "confim link" after click the Like button.
		//theConfirmIssue: false
	};

	button.prepareOptions = function () {
		this.url = this._extractUrl ();

		if ( "vertical" === this.groupOptions.layout ) {
			this.options.layout = 'box_count';
		} else {
			if ( !this.groupOptions.counters ) {
				this.options.layout = 'button';
			}
		}
	};

	/**
	 * Setups hooks.
	 */
	button.setupHooks = function () {
		var self = this;

		this.addHook ( 'before-show-content', function () {
			self._stopTrackIFrameSizes ();
		} );
	};

	/**
	 * Setups events.
	 */
	button.setupEvents = function () {
		var self = this;

		$ ( document ).bind ( 'onp-sl-facebook-like', function ( e, url ) {
			if ( self.url !== $.pandalocker.tools.URL.normalize ( url ) ) {
				return;
			}
			self.unlock ( "button", self.name, self.url );
		} );
	};

	/**
	 * Renders the button.
	 */
	button.renderButton = function ( $holder ) {
		var self = this;
		this.button = $ ( "<div></div>" ).appendTo ( $holder );

		this.fbAlertConfirmation = $ ( '<div class="onp-sl-fb-like-alert-confirmation-hint">' +
		'Чтобы открыть замок, пожалуйста, нажмите кнопку "подтвердить".' +
		'</div>' );
		this.button.closest ( '.onp-sl-control-inner-wrap' ).append ( this.fbAlertConfirmation );

		this.button.attr ( "data-show-faces", false );
		this.button.attr ( "data-send", false );
		this.button.attr ( "data-href", this.url );
		this.options.font && this.button.attr ( "data-font", this.options.font );
		this.options.colorScheme && this.button.attr ( "data-colorscheme", this.options.colorScheme );
		this.options.ref && this.button.attr ( "data-ref", this.options.ref );
		this.options.width && this.button.attr ( "data-width", this.options.width );
		this.options.layout && this.button.attr ( "data-layout", this.options.layout );
		this.options.verbToDisplay && this.button.attr ( "data-action", this.options.verbToDisplay );

		this.button.addClass ( 'fb-like' );

		window.FB.XFBML.parse ( $holder[0] );

		self._startTrackIFrameSizes ();

		//Подгоняем ширину контейнера кнопки, под ширину кнопки
		if ( !this.groupOptions.counters ) {
			return;
		}

		var timerInteration = 0, normalizeWidthTimer = setInterval ( function () {
			var $iframe = self.button.find ( "iframe" );

			if ( !$iframe.length ) {
				return;
			}

			var buttonDefaultWidth = parseInt ( self.button.parent().css ( 'width' ) )
					? parseInt ( self.button.parent().css ( 'width' ) )
					: self.button.parent().width(),

				cssHeightFrame = parseInt( $iframe[0].style.height )
					? parseInt ( $iframe[0].style.height )
					: $iframe.height(),

				cssWidthFrame = parseInt( $iframe[0].style.width )
					? parseInt ( $iframe[0].style.width )
					: $iframe.width();

			if ( cssWidthFrame
				&& ((cssWidthFrame < 200)
				&& (buttonDefaultWidth < cssWidthFrame)) ) {
				self.button.add( self.button.parent () ).width( cssWidthFrame + 2 );
			}

			if ( timerInteration > 10 ) {
				self.button.data('default-height', cssHeightFrame)
					.data('default-width', cssWidthFrame);

				clearInterval ( normalizeWidthTimer );
			}

			timerInteration++;
		}, 500 );

	};

	// --------------------------------------------------------------
	// Tracking changes the iframe size for more quickly unlocking
	// --------------------------------------------------------------

	button._startTrackIFrameSizes = function () {

		// #SLJQ-29: don't use the way based on measuring the frame size
		// to check whether the user clicked the button
		//if ( this.options.theConfirmIssue ) return;

		var self = this;
		this._trackIFrameTimer = null;

		var interationTimer = 0;
		var buttonClick = false;

		this.button.hover (
			function () {

				$.pandalocker.data.__facebookLikeButton = $(this);

				var $iframe = self.control.find ( "iframe" );

				if ( !$iframe.length || self._trackIFrameTimer ) {
					return;
				}

				var isConfirmationButton, oldCssWidth, interationTimer = 0;
				self._trackIFrameTimer = setInterval ( function () {

					var cssHeight = parseInt ( $iframe[0].style.height )
						|| $iframe.height (),
						cssWidth = parseInt ( $iframe[0].style.width )
							|| $iframe.width (),

					isConfirmationButton = cssHeight == 14 || cssHeight == 34;

					if ( isConfirmationButton ) {
						self._stopTrackIFrameSizes ();
						self._trackIFrameTimer = null;

						self.fbAlertConfirmation.show();
						self.button.parent().addClass( 'onp-sl-fb-like-alert-confirmation-border' );
						self.button.add( self.button.parent () )
							.width(cssWidth)
							.height(cssHeight);


						if( $.pandalocker.tools.isMobile()
							&& ( (navigator.userAgent.indexOf('FBMD/iPad') + 1)
							|| navigator.userAgent.indexOf('FBSN/iPhone') + 1 )
						) self.unlock ( "error" );

					}

					if ( interationTimer >= 100 && buttonClick ) {
						self._stopTrackIFrameSizes();
					}

					interationTimer++;
				}, 10 );
			},
			function () {
				setTimeout ( function () {
					self._stopTrackIFrameSizes ();
					self._trackIFrameTimer = null;
				}, 2000 );
			}
		);
	},

		button._stopTrackIFrameSizes = function () {
			if ( this._trackIFrameTimer ) {
				clearInterval ( this._trackIFrameTimer );
			}
		};

	$.pandalocker.controls["social-buttons"]["facebook-like"] = button;

}) ( jQuery );;
/*!
 * Facebook Share Button
 * Copyright 2014, OnePress, http://byonepress.com
*/
(function ($) {
    'use strict';

    var button = $.pandalocker.tools.extend( $.pandalocker.entity.socialButton );

    button.name = "facebook-share";

    button._defaults = {

        // URL to share
        url: null,
             
        // button_count, button, box_count
        layout: 'button_count',
        // set to 'none' to hide the count box
        count: 'standard',
        // Language of the button labels. By default en_US.
        lang: 'en_US',
        // Button container width in px, by default 450.
        width: null,
        
        // if set, then use the Share Dialog
        shareDialog: false,
        
        // data to share
        name: null,
        caption: null,
        description: null,
        image: null,

        // unlock event
        unlock: null
    };

    button.prepareOptions = function() {
        this.url = this._extractUrl();
        
        if( !this.options.appId || this.options.appId == "117100935120196" ) {
            this.showError( $.pandalocker.lang.errors.emptyFBAppIdError );
            return false;
        }

        if ( "vertical" === this.groupOptions.layout ) {
            this.options.layout = 'box_count';
        } else {
            if ( !this.groupOptions.counters ) {
                this.options.layout = 'button';
            }
        }
    };
        
    button.setupEvents = function () {
        var self = this;

        $(document).bind('onp-sl-facebook-share', function (e, url) {
            if ( self.url !== $.pandalocker.tools.URL.normalize( url ) ) return;
            self.unlock("button", self.name, self.url );
        });
    };
        
    button.renderButton = function( $holder ) {
        
        var self = this;

        this.button = $("<div></div>").appendTo( $holder );

        this.button.attr("data-href", this.url);
        if (this.options.width) this.button.attr("data-width", this.options.width);
        if (this.options.layout) { 
            this.button.attr("data-layout", this.options.layout); 
            this.button.attr("data-type", this.options.layout); 
        }

        var overlay = $("<div class='onp-sl-facebook-share-overlay'></div>").appendTo( $holder );

		//Подгоняем ширину контейнера кнопки, под ширину кнопки
		if ( this.groupOptions.counters ) {
			var timerInteration = 0, normalizeWidthTimer = setInterval ( function () {
				var $iframe = self.button.find ( "iframe" );

				if ( !$iframe.length ) {
					return;
				}

				var buttonDefaultWidth = parseInt ( self.button.parent ().css ( 'width' ) )
					? parseInt ( self.button.parent ().css ( 'width' ) )
					: self.button.parent ().width ();

				var cssWidthFrame = parseInt ( $iframe[0].style.width )
					? parseInt ( $iframe[0].style.width )
					: $iframe.width ();

				if ( cssWidthFrame < 200 && ( buttonDefaultWidth < cssWidthFrame ) ) {
					self.button.add ( self.button.parent () ).width ( cssWidthFrame + 2 );
				}

				if ( timerInteration > 10 ) {
					clearInterval ( normalizeWidthTimer );
				}

				timerInteration++;
			}, 500 );
		}

        if ( self.options.shareDialog ) {

            overlay.click(function(){
                FB.ui(
                    {
                        method: 'share',
                        href: self.url,
                        display: 'popup'
                    },
                    function(response) {
                        console && console.log && console.log('AX12:');
                        console && console.log && console.log(response);
                        
                        if ( $.pandalocker.tools.isTabletOrMobile() && typeof response === "undefined" || response === null  ) {
                            $(document).trigger('onp-sl-facebook-share', [self.url]);
                            return;
                        }
                        
                        if ( typeof response === "undefined" || response === null ) return;
                        if ( typeof response === "object" && response.error_code && response.error_code > 0 ) return; 
                    
                        $(document).trigger('onp-sl-facebook-share', [self.url]);
                    }
                );                
                return false;
            }); 
            
        } else {

            overlay.click(function(){
                FB.ui(
                {
                     method: 'feed',
                     name: self.options.name,
                     link: self.url,
                     picture: self.options.image,
                     caption: self.options.caption,
                     description: self.options.description
                },
                function(response) {
                    console && console.log && console.log('AX12:');
                    console && console.log && console.log(response);
                    
                    if ( $.pandalocker.tools.isTabletOrMobile() && typeof response === "undefined" || response === null  ) {
                        $(document).trigger('onp-sl-facebook-share', [self.url]);
                        return;
                    }
                        
                    if ( typeof response === "undefined" || response === null )return;
                    if ( typeof response === "object" && response.error_code && response.error_code > 0 ) return;       
                    
                    $(document).trigger('onp-sl-facebook-share', [self.url]);
                }
                );                
                return false;
            });
        }

        this.button.addClass('fb-share-button');  
        window.FB.XFBML.parse($holder[0]);
    };
    
    $.pandalocker.controls["social-buttons"]["facebook-share"] = button;
    
})(jQuery);;
/*!
 * Twitter Tweet
 * Copyright 2014, OnePress, http://byonepress.com
*/
(function ($) {
    'use strict';
    
    if ( !$.pandalocker.data ) $.pandalocker.data = {};
    
    $.pandalocker.data.__tweetedUrl = null;
    $.pandalocker.data.__tweetWindow = null;
    
    var button = $.pandalocker.tools.extend( $.pandalocker.entity.socialButton );

    button.name = "twitter-tweet";

    button.verification = {
        container: 'iframe',
        timeout: 600000
    };
    
    button._defaults = {
        
        // if true, checks wheither the user tweeted
        doubleCheck: false,
        
        // URL of the page to share.
        url: null,

        // Default Tweet text
        text: null,
        // Screen name of the user to attribute the Tweet to
        via: null,
        // Related accounts
        related: null,
        // Count box position (none, horizontal, vertical)
        count: 'horizontal',
        // The language for the Tweet Button
        lang: 'en',
        // URL to which your shared URL resolves
        counturl: null,
        // The size of the rendered button (medium, large)
        size: 'medium'
    };

    button.prepareOptions = function() {

        if (!this.options.url && !this.networkOptions.url && $("link[rel='canonical']").length > 0)
            this.options.url = $("link[rel='canonical']").attr('href');

        this.url = this._extractUrl();
        
        if ( "vertical" === this.groupOptions.layout ) {
            this.showError( $.pandalocker.lang.errors.unsupportedTwitterTweetLayout );
        } else {
            if ( !this.groupOptions.counters ) {
                this.options.count = 'none';
            }
        }
        
        if ( this.groupOptions.lang ) {
            var langParts = this.groupOptions.lang.split('_');
            this.options.lang = langParts[0];
        }
        
        if ( !this.options.text ) {
            var $title = $("title");
            
            if ( $title.length > 0 ) {
                this.options.text = $($title[0]).text();
            } else {
                this.options.text = "";
            }
        }
    };
        
    button.setupEvents = function () {
        var self = this;

        $(document).bind('onp-sl-twitter-tweet', function () {
            if ( self.url !== $.pandalocker.data.__tweetedUrl ) return;
            
            if ( $.pandalocker.data.__tweetWindow && $.pandalocker.data.__tweetWindow.close ) $.pandalocker.data.__tweetWindow.close();
            $.pandalocker.data.__tweetWindow = null;
            
            self.unlock("button", self.name, self.url );
        });
    };
 
    button.renderButton = function( $holder ) {
        var self = this;

        this.button = $('<a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>').appendTo( $holder );
        this.button.attr("data-url", this.url);

        this.button.attr("data-show-count", this.options.showCount);
        if (this.options.via) this.button.attr("data-via", this.options.via);
        if (this.options.text) this.button.attr("data-text", this.options.text);
        if (this.options.lang) this.button.attr("data-lang", this.options.lang);
        if (this.options.hashtags) this.button.attr("data-hashtags", this.options.hashtags);
        if (this.options.size) this.button.attr("data-size", this.options.size);
        if (this.options.dnt) this.button.attr("data-dnt", this.options.dnt);
        
        var overlay = $("<div class='onp-sl-feature-overlay'></div>").appendTo( $holder );
        
        overlay.click(function(){
            var result = self.tweet( self.options.doubleCheck );
            result.done(function(){
                $(document).trigger('onp-sl-twitter-tweet', [self.url]);
            });
        });
            
        // our original markup will be fully replaced with the iframe created 
        // by Twitter, so we cannot to bind the data required to verify 
        // tweeting on the button, we need to bind this data on the parent element
        
        $holder.data('url-to-verify', self.url);

        var attemptCounter = 5;

        // Chrome fix
        // If there is SDK script on the same page that is loading now when a tweet button will not appear.
        // Setup special timeout function what will check 5 times when we can render the twitter button.
        var timoutFunction = function () {
            if ($holder.find('iframe').length > 0) return;

            if (window.twttr.widgets && window.twttr.widgets.load) {
                window.twttr.widgets.load($holder[0]);
            } else {
                if (attemptCounter <= 0) return;
                attemptCounter--;

                setTimeout(function () {
                    timoutFunction();
                }, 1000);
            }
        };

        timoutFunction();
    };
    
    button.tweet = function( doubleCheck ) {
        
        var self = this;
        var def = $.Deferred();
        
        // tweet through oauth
        
        if ( doubleCheck ) {
            
            this.connect( function( data ){

                var tweetResult = self.tweet( false );
                
                tweetResult.done( function() {
                    var checkResult = self.checkTweet( self.url );
                    
                    checkResult.done( function(){
                        def.resolve();
                    });
                    
                    checkResult.fail(function(){
                        self.showNotice( $.pandalocker.lang.errors.tweetNotFound );
                    });
                });
            });
 
            return def;
        }
        
        // tweet through popup

        var args = [];

        if ( self.options.text ) {
            var safeText = encodeURI( self.options.text );
            safeText = safeText.replace(/#/g, '%23');
            safeText = safeText.replace(/\|/g, "-");
            safeText = safeText.replace(/\&/g, "%26");
            args.push(['text', safeText]);
        }

        if ( self.options.hashtags ) args.push(['hashtags', self.options.hashtags]);
        if ( self.options.via ) args.push(['via', self.options.via]);
        if ( self.options.related ) args.push(['via', self.options.related]);

        args.push(['url', self.url]);
        $.pandalocker.data.__tweetedUrl = self.url;

        var intentUrl = $.pandalocker.tools.URL()
            .scheme('http')
            .host('twitter.com')
            .path('/intent/tweet')
            .query(args)
            .toString();
    
        var width = 550;
        var height = 420;

        var x = screen.width ? (screen.width/2 - width/2 + $.pandalocker.tools.findLeftWindowBoundry()) : 0;
        var y = screen.height ? (screen.height/2 - height/2 + $.pandalocker.tools.findTopWindowBoundry()) : 0;

        if ( $.pandalocker.data.__twitterAuth && $.pandalocker.data.__twitterAuth.closed === false ) {
            $.pandalocker.data.__twitterAuth.updateState( intentUrl, width, height, x, y );
           
            $.pandalocker.data.__tweetWindow = $.pandalocker.data.__twitterAuth;
            $.pandalocker.data.__twitterAuth = null;
            
        } else {
            $.pandalocker.data.__tweetWindow = window.open(intentUrl, "TwitterTweetWindow", "width=" + width + ",height=" + height + ",left="+x+",top="+y);
        }

        setTimeout(function(){

            var pollTimer = setInterval(function() {
                if ( !$.pandalocker.data.__tweetWindow || $.pandalocker.data.__tweetWindow.closed !== false ) {
                    clearInterval(pollTimer);
                    def.resolve();
                }
            }, 200);
        }, 200);

        return def.promise();
    };
    
    /**
     * Connects the user via Faceboook.
     */
    button.connect = function( callback ) {
        var self = this;
        
        if ( $.pandalocker.data.twitterOAuthReady ) {
            
            if ( $.pandalocker.data.__twitterAuthIdentityData ) {
                callback( $.pandalocker.data.__twitterAuthIdentityData, self._getServiceData() );
            } else {
                
                this._identify( function( identityData ){
                    callback( identityData, self._getServiceData() );
                });     
            }
            
        } else {
            
            // The fix for the issue #BIZ-41:
            // removes the proxy URL from the options because it fires the errors on some website

            var dataToSend = {
                'opandaHandler': 'twitter',
                'opandaRequestType': 'init',
                'opandaKeepOpen': true,
                'opandaReadOnly': true
            };

            var visitorId = $.pandalocker.tools.cookie( 'opanda_twid' );
            if ( visitorId && visitorId !== 'null' ) dataToSend['opandaVisitorId'] = visitorId;
            
            var url = self.options.proxy;
            
            for ( var prop in dataToSend ) {
                if ( !dataToSend.hasOwnProperty(prop) ) continue;
                url = $.pandalocker.tools.updateQueryStringParameter( url, prop, dataToSend[prop] );
            }

            self._trackWindow('opandaHandler=twitter', function(){

                setTimeout( function(){
                    if ( $.pandalocker.data.twitterOAuthReady ) return;

                    self.runHook('raw-social-app-declined');
                    self.showNotice( $.pandalocker.lang.errors_not_signed_in );
                }, 500);
            });
            
            var width = 500;
            var height = 610;

            var x = screen.width ? (screen.width/2 - width/2 + $.pandalocker.tools.findLeftWindowBoundry()) : 0;
            var y = screen.height ? (screen.height/2 - height/2 + $.pandalocker.tools.findTopWindowBoundry()) : 0;
            
            $.pandalocker.data.__twitterAuth = window.open( url,
                "Twitter Tweet",
                "width=" + width + ",height=" + height + ",left="+x+",top="+y+",resizable=yes,scrollbars=yes,status=yes"
            );

            window.OPanda_TwitterOAuthCompleted = function( visitorId ){

                $.pandalocker.data.twitterOAuthReady = true;
                self._saveVisitorId( visitorId );
                self.connect( callback );
            };
            
             window.OPanda_TwitterOAuthDenied = function( visitorId ){

                self.runHook('raw-social-app-declined');
                self.showNotice( $.pandalocker.lang.errors_not_signed_in );
                self._saveVisitorId( visitorId );
            };       
        }
    };
    
    /**
     * Saves a visitor ID.
     */
    button._saveVisitorId = function( visitorId ) {
        
        this._visitorId = visitorId;
        $.pandalocker.data.__twitterVisitorId = visitorId; 
        $.pandalocker.tools.cookie( 'opanda_twid', visitorId, { expires: 1000, path: "/" } );
    };
    
    /**
     * Puts together service data required for the future requests.
     */
    button._getServiceData = function() {
        var self = this;
        return { visitorId: $.pandalocker.data.__twitterVisitorId };
    };
    
    /**
     * Identify the user.
     */
    button._identify = function( callback ) {
        var self = this;
        
        var req = $.ajax({
            type: "POST",
            dataType: "json",
            url: self.options.proxy,
            data: {
                'opandaHandler': 'twitter',
                'opandaRequestType': 'user_info',
                'opandaVisitorId': $.pandalocker.data.__twitterVisitorId,
                'opandaReadOnly': true
            },
            success: function(data){
                
                console.log(data);
                
                if ( ( !data || data.error || data.errors ) && console && console.log ) {
                    console.log( 'Unable to get the user data: ' + req.responseText );   
                }
                
                var identity = {};
                identity.displayName = data.screen_name;
                identity.twitterUrl = 'https://twitter.com/' + data.screen_name;
                
                if ( data.profile_image_url ) {
                    identity.image = data.profile_image_url.replace('_normal', '');
                }
                
                $.pandalocker.data.__twitterAuthIdentityData = identity;                
                callback( identity );
            },
            error: function() {
                console && console.log && console.log( 'Unable to get the user data: ' + req.responseText );
                callback( {} );
            }
        });
    };
    
    button.checkTweet = function() {
        
        var self = this;
        var def = $.Deferred();
        
        var req = $.ajax({
            type: "POST",
            dataType: "json",
            url: self.options.proxy,
            data: {
                'opandaHandler': 'twitter',
                'opandaRequestType': 'get_tweets',
                'opandaVisitorId': $.pandalocker.data.__twitterVisitorId,
                'opandaReadOnly': true
            },
            success: function(data){
                
                if ( ( !data || data.error || data.errors ) && console && console.log ) {
                    console.log( 'Unable to get the user data: ' + req.responseText );   
                }
                
                for (var i = 0; i < data.length; i++) {
                    if ( !data[i].entities ) continue;
                    
                    for (var n = 0; n < data[i].entities.urls.length ; n++) {
                        if ( !data[i].entities.urls[n] ) continue;
                        
                        if ( data[i].entities.urls[n].expanded_url === self.url ) {
                            def.resolve();
                            return;
                        }
                    }
                    
                }
                
                def.reject();
            },
            error: function() {
                console && console.log && console.log( 'Unable to get the user data: ' + req.responseText );
                callback( {} );
            }
        });
        
        return def.promise();
    };
    
    $.pandalocker.controls["social-buttons"]["twitter-tweet"] = button;
    
})(jQuery);;
/*!
 * Twitter Follow
 * Copyright 2014, OnePress, http://byonepress.com
*/
(function ($) {
    'use strict';
    
    if ( !$.pandalocker.data ) $.pandalocker.data = {};
    $.pandalocker.data.__followedUrl = null;
    $.pandalocker.data.__followWindow = null;
    
    var button = $.pandalocker.tools.extend( $.pandalocker.entity.socialButton );

    button.name = "twitter-follow";
    
    button.verification = {
        container: 'iframe',
        timeout: 600000
    };
    
    button._defaults = {
        
        // if true, checks wheither the user tweeted
        doubleCheck: false,
        
        // URL of the page to share.
        url: null,
        
        // The user's screen name shows up by default, but you can opt not to 
        // show the screen name in the button. 
        hideScreenName: false,
        // Followers count display
        showCount: true,
        // The language for the Tweet Button
        lang: 'en',
        // The size of the rendered button (medium, large)
        size: 'medium'
    };

    button.prepareOptions = function() {

        if ( !this.options.url || this.options.url.indexOf("twitter") === -1 ) {
            this.showError( $.pandalocker.lang.errors.emptyTwitterFollowUrlError );
            return false;
        }
        
        this.url = this._extractUrl();
        
        if ( "vertical" === this.groupOptions.layout ) {
            this.showError( $.pandalocker.lang.errors.unsupportedTwitterFollowLayout );
        } else {
            if ( !this.groupOptions.counters ) {
                this.options.showCount = false;
            }
        }
        
        if ( this.groupOptions.lang ) {
            var langParts = this.groupOptions.lang.split('_');
            this.options.lang = langParts[0];
        }
    };
        
    button.setupEvents = function () {
        var self = this;

        $(document).bind('onp-sl-twitter-follow', function (e, url) {
            if ( self.url !== $.pandalocker.data.__followedUrl ) return;
            
            if ( $.pandalocker.data.__followWindow && $.pandalocker.data.__followWindow.close ) $.pandalocker.data.__followWindow.close();
            $.pandalocker.data.__followWindow = null;
            
            self.unlock("button", self.name, self.url );
        });
    };
        
    button.renderButton = function( $holder ) {
        var self = this;

        this.button = $('<a href="https://twitter.com/share" class="twitter-follow-button">Follow</a>').appendTo( $holder );
        this.button.attr('href', this.url);
        
        this.button.attr("data-show-count", this.options.showCount);
        if (this.options.showCount) this.button.attr("data-show-count", this.options.showCount); 
        if (this.options.lang) this.button.attr("data-lang", this.options.lang);
        if (this.options.alignment) this.button.attr("data-alignment", this.options.alignment);
        if (this.options.size) this.button.attr("data-size", this.options.size);
        if (this.options.dnt) this.button.attr("data-dnt", this.options.dnt);
        if (this.options.hideScreenName) this.button.attr("data-show-screen-name", false);

        var overlay = $("<div class='onp-sl-feature-overlay'></div>").appendTo( $holder );
        
        overlay.click(function(){
            
            var result = self.follow( self.options.doubleCheck );
            result.done(function(){
                $(document).trigger('onp-sl-twitter-follow', [self.url]);
            });

            return false;
        }); 

        // our original markup will be fully replaced with the iframe created 
        // by Twitter, so we cannot to bind the data required to verify 
        // tweeting on the button, we need to bind this data on the parent element
        
        $holder.data('url-to-verify', self.url);

        var attemptCounter = 5;

        // Chrome fix
        // If there is SDK script on the same page that is loading now when a tweet button will not appear.
        // Setup special timeout function what will check 5 times when we can render the twitter button.
        var timoutFunction = function () {
            if ($holder.find('iframe').length > 0) return;

            if (window.twttr.widgets && window.twttr.widgets.load) {
                window.twttr.widgets.load($holder[0]);
            } else {
                if (attemptCounter <= 0) return;
                attemptCounter--;

                setTimeout(function () {
                    timoutFunction();
                }, 1000);
            }
        };

        timoutFunction();
    };
    
    button.follow = function( doubleCheck ) {
        
        var self = this;
        var def = $.Deferred();
        
        // follow through oauth
        
        if ( doubleCheck ) {
            
            this.connect( function( data ){

                var followResult = self.follow( false );
                
                followResult.done( function() {
                    var checkResult = self.checkFollower( self.url );
                    
                    checkResult.done( function(){
                        def.resolve();
                    });
                    
                    checkResult.fail(function(){
                        self.showNotice( $.pandalocker.lang.errors.followingNotFound );
                    });
                });
            });
 
            return def;
        }
        
        // follow through popup

        var args = [];
                
        $.pandalocker.data.__followedUrl = self.url;
        
        var parts = self.url.split('/');
        self.screenName = parts[parts.length-1];
                
        args.push(['screen_name', self.screenName]);

        var intentUrl = $.pandalocker.tools.URL()
            .scheme('http')
            .host('twitter.com')
            .path('/intent/follow')
            .query(args)
            .toString();
    
        var width = 550;
        var height = 530;

        var x = screen.width ? (screen.width/2 - width/2 + $.pandalocker.tools.findLeftWindowBoundry()) : 0;
        var y = screen.height ? (screen.height/2 - height/2 + $.pandalocker.tools.findTopWindowBoundry()) : 0;

        if ( $.pandalocker.data.__twitterAuth && $.pandalocker.data.__twitterAuth.closed === false ) {
            $.pandalocker.data.__twitterAuth.updateState( intentUrl, width, height, x, y );
           
            $.pandalocker.data.__followWindow = $.pandalocker.data.__twitterAuth;
            $.pandalocker.data.__twitterAuth = null;
            
        } else {
            $.pandalocker.data.__followWindow = window.open(intentUrl, "TwitterFollowWindow", "width=" + width + ",height=" + height + ",left="+x+",top="+y);
        }

        setTimeout(function(){

            var pollTimer = setInterval(function() {
                if ( !$.pandalocker.data.__followWindow || $.pandalocker.data.__followWindow.closed !== false ) {
                    clearInterval(pollTimer);
                    def.resolve();
                }
            }, 200);
        }, 200);

        return def.promise();
    };
    
    /**
     * Connects the user via Faceboook.
     */
    button.connect = function( callback ) {
        var self = this;
        
        if ( $.pandalocker.data.twitterOAuthReady ) {
            
            if ( $.pandalocker.data.__twitterAuthIdentityData ) {
                callback( $.pandalocker.data.__twitterAuthIdentityData, self._getServiceData() );
            } else {
                
                this._identify( function( identityData ){
                    callback( identityData, self._getServiceData() );
                });     
            }
            
        } else {
            
            // The fix for the issue #BIZ-41:
            // removes the proxy URL from the options because it fires the errors on some website

            var dataToSend = {
                'opandaHandler': 'twitter',
                'opandaRequestType': 'init',
                'opandaKeepOpen': true,
                'opandaReadOnly': true
            };

            var visitorId = $.pandalocker.tools.cookie( 'opanda_twid' );
            if ( visitorId && visitorId !== 'null' ) dataToSend['opandaVisitorId'] = visitorId;
            
            var url = self.options.proxy;
            
            for ( var prop in dataToSend ) {
                if ( !dataToSend.hasOwnProperty(prop) ) continue;
                url = $.pandalocker.tools.updateQueryStringParameter( url, prop, dataToSend[prop] );
            }

            self._trackWindow('opandaHandler=twitter', function(){

                setTimeout( function(){
                    if ( $.pandalocker.data.twitterOAuthReady ) return;

                    self.runHook('raw-social-app-declined');
                    self.showNotice( $.pandalocker.lang.errors_not_signed_in );
                }, 500);
            });

            var width = 500;
            var height = 610;

            var x = screen.width ? (screen.width/2 - width/2 + $.pandalocker.tools.findLeftWindowBoundry()) : 0;
            var y = screen.height ? (screen.height/2 - height/2 + $.pandalocker.tools.findTopWindowBoundry()) : 0;
            
            $.pandalocker.data.__twitterAuth = window.open( url,
                "Twitter Follow",
                "width=" + width + ",height=" + height + ",left="+x+",top="+y+",resizable=yes,scrollbars=yes,status=yes"
            );

            window.OPanda_TwitterOAuthCompleted = function( visitorId ){

                $.pandalocker.data.twitterOAuthReady = true;
                self._saveVisitorId( visitorId );
                self.connect( callback );
            };
            
             window.OPanda_TwitterOAuthDenied = function( visitorId ){

                self.runHook('raw-social-app-declined');
                self.showNotice( $.pandalocker.lang.errors_not_signed_in );
                self._saveVisitorId( visitorId );
            };       
        }
    };
    
    /**
     * Saves a visitor ID.
     */
    button._saveVisitorId = function( visitorId ) {
        
        this._visitorId = visitorId;
        $.pandalocker.data.__twitterVisitorId = visitorId;
        $.pandalocker.tools.cookie( 'opanda_twid', visitorId, { expires: 1000, path: "/" } );
    };
    
    /**
     * Puts together service data required for the future requests.
     */
    button._getServiceData = function() {
        var self = this;
        return { visitorId: $.pandalocker.data.__twitterVisitorId };
    };
    
    /**
     * Identify the user.
     */
    button._identify = function( callback ) {
        var self = this;
        
        var req = $.ajax({
            type: "POST",
            dataType: "json",
            url: self.options.proxy,
            data: {
                'opandaHandler': 'twitter',
                'opandaRequestType': 'user_info',
                'opandaVisitorId': $.pandalocker.data.__twitterVisitorId,
                'opandaReadOnly': true
            },
            success: function(data){
                
                console.log(data);
                
                if ( ( !data || data.error || data.errors ) && console && console.log ) {
                    console.log( 'Unable to get the user data: ' + req.responseText );   
                }
                
                var identity = {};
                identity.displayName = data.screen_name;
                identity.twitterUrl = 'https://twitter.com/' + data.screen_name;
                
                if ( data.profile_image_url ) {
                    identity.image = data.profile_image_url.replace('_normal', '');
                }
                
                $.pandalocker.data.__twitterAuthIdentityData = identity;                
                callback( identity );
            },
            error: function() {
                console && console.log && console.log( 'Unable to get the user data: ' + req.responseText );
                callback( {} );
            }
        });
    };
    
    button.checkFollower = function() {
        
        var self = this;
        var def = $.Deferred();
        
        var req = $.ajax({
            type: "POST",
            dataType: "json",
            url: self.options.proxy,
            data: {
                'opandaHandler': 'twitter',
                'opandaRequestType': 'get_followers',
                'opandaSceenName': self.screenName,
                'opandaVisitorId': $.pandalocker.data.__twitterVisitorId,
                'opandaReadOnly': true
            },
            success: function(data){
                
                if ( ( !data || data.error || data.errors ) && console && console.log ) {
                    console.log( 'Unable to get the user data: ' + req.responseText );   
                }
                if ( data[0] ) {
                    for ( var i = 0; i < data[0].connections.length; i++ ) {
                    
                        if ( data[0].connections[i] === 'following' ) {
                            def.resolve();
                            return;
                        }
                    }
                } 
                
                def.reject();
            },
            error: function() {
                console && console.log && console.log( 'Unable to get the user data: ' + req.responseText );
                callback( {} );
            }
        });
        
        return def.promise();
    };
    
    $.pandalocker.controls["social-buttons"]["twitter-follow"] = button;
    
})(jQuery);;
/*!
 * Google +1
 * Copyright 2014, OnePress, http://byonepress.com
*/
(function ($) {
    'use strict';

    var button = $.pandalocker.tools.extend( $.pandalocker.entity.socialButton );

    button.name = "google-plus";

    button._defaults = {

        // URL to plus one
        url: null,

        // Language of the button labels. By default en-US.
        // https://developers.google.com/+/plugins/+1button/#available-languages
        lang: 'en-US',
        // small, medium, standard, tall (https://developers.google.com/+/plugins/+1button/#button-sizes)
        size: 'medium',
        // Sets the annotation to display next to the button.
        annotation: null,
        // Button container width in px, by default 450.
        width: null,
        // Sets the horizontal alignment of the button assets within its frame.
        align: "left",
        // Sets the preferred positions to display hover and confirmation bubbles, which are relative to the button.
        // comma-separated list of top, right, bottom, left
        expandTo: "",
        // To disable showing recommendations within the +1 hover bubble, set recommendations to false.    
        recommendations: true
    };

    button.prepareOptions = function() {
        this.url = this._extractUrl();

        if ( "vertical" === this.groupOptions.layout ) {
            this.options.size = 'tall';
        } else {
            if ( !this.groupOptions.counters ) {
                this.options.annotation = 'none';
            }
        } 
    };
        
    button.setupEvents = function () {
        var self = this;
        
        $(document).bind('onp-sl-google-plus', function (e, url) {
            if ( self.url !== $.pandalocker.tools.URL.normalize( url ) ) return;
            self.unlock("button", self.name, self.url );
        });
    };
        
    button.renderButton = function( $holder ) {
        var self = this;
        
        this.button = $("<div></div>").appendTo( $holder );

        this.button.attr("data-href", this.url);
        if (this.options.size) this.button.attr("data-size", this.options.size);
        if (this.options.annotation) this.button.attr("data-annotation", this.options.annotation);
        if (this.options.align) this.button.attr("data-align", this.options.align);
        if (this.options.expandTo) this.button.attr("data-expandTo", this.options.expandTo);
        if (this.options.recommendations) this.button.attr("data-recommendations", this.options.recommendations);

        this.button.attr("data-callback", "OPanda_GooglePlusOne_Callback");
        this.button.addClass('g-plusone');
        
        setTimeout(function () {
            window.gapi.plusone.go( $holder[0] );
        }, 100);
    };
    
    $.pandalocker.controls["social-buttons"]["google-plus"] = button;
    
})(jQuery);;
/*!
 * Google Share
 * Copyright 2014, OnePress, http://byonepress.com
*/
(function ($) {
    'use strict';
    
    if ( !$.pandalocker.data ) $.pandalocker.data = {};
    $.pandalocker.data.__googleShareUrl = null;
    
    var button = $.pandalocker.tools.extend( $.pandalocker.entity.socialButton );

    button.name = "google-share";

    button._defaults = {

        // URL to plus one
        url: null,

        // Language of the button labels. By default en-US.
        // https://developers.google.com/+/plugins/+1button/#available-languages
        lang: 'en-US',
        // small, medium, standard, tall (https://developers.google.com/+/plugins/+1button/#button-sizes)
        size: null,
        // Sets the annotation to display next to the button.
        annotation: 'bubble',
        // Button container width in px, by default 450.
        width: null,
        // Sets the horizontal alignment of the button assets within its frame.
        align: "left",
        // Sets the preferred positions to display hover and confirmation bubbles, which are relative to the button.
        // comma-separated list of top, right, bottom, left
        expandTo: "",
        // To disable showing recommendations within the +1 hover bubble, set recommendations to false.    
        recommendations: true
    };

    button.prepareOptions = function() {
        this.url = this._extractUrl();
        
        if ( "vertical" === this.groupOptions.layout ) {
            this.options.annotation = 'vertical-bubble';
        } else {
            if ( !this.groupOptions.counters ) {
                this.options.annotation = 'none';
            }
        }
    };
        
    button.setupEvents = function () {
        var self = this;

        $(document).bind('onp-sl-google-share', function (e, url) {
            var urlToCompore = url || $.pandalocker.data.__googleShareUrl;
            if ( self.url !== $.pandalocker.tools.URL.normalize( urlToCompore ) ) return;
            self.unlock("button", self.name, self.url );
        });          

        /**
        $(document).bind('onp-sl-google-share-opened', function (e, url) {
            if ( self.url !== $.pandalocker.tools.URL.normalize( url ) ) return;

            self._maxPopupHeight = 0;
            self._heightChecker = setInterval(function(){
                var height = $(".goog-bubble-content").height();
                if ( height > self._maxPopupHeight ) self._maxPopupHeight = height;
            }, 300);
        });        

        $(document).bind('onp-sl-google-share-closed', function (e, url) {
            if ( self.url !== $.pandalocker.tools.URL.normalize( url ) ) return;

            if ( self._maxPopupHeight > 250 ) self.unlock("button", self.name, self.url );
            if ( self._heightChecker ) clearInterval( self._heightChecker );
            self._heightChecker = null;
        });  
        */
    };
        
    button.renderButton = function( $holder ) {
        var self = this;
        
        this.button = $("<div></div>").appendTo( $holder );

        this.button.attr("data-href", this.url);
        if (this.options.size) this.button.attr("data-size", this.options.size);
        if (this.options.annotation) this.button.attr("data-annotation", this.options.annotation);
        if (this.options.align) this.button.attr("data-align", this.options.align);
        if (this.options.expandTo) this.button.attr("data-expandTo", this.options.expandTo);
        if (this.options.recommendations) this.button.attr("data-recommendations", this.options.recommendations);

        this.button.attr("data-onstartinteraction", "OPanda_GoogleShare_StartInteraction");
        this.button.attr("data-onendinteraction", "OPanda_GoogleShare_EndInteraction");
        
        this.button.addClass('g-plus').attr('data-action', 'share');
            
        setTimeout(function () {
            window.gapi.plus.go( $holder[0] );
        }, 100);

        // for mobile devices
        if ( $.pandalocker.tools.isTabletOrMobile() ) {
               
            var overlay = $("<div class='onp-sl-feature-overlay'></div>").appendTo( $holder );

            overlay.click(function(){

                var args = [];

                args.push(['url', self.url]);

                var intentUrl = $.pandalocker.tools.URL()
                    .scheme('https')
                    .host('plus.google.com')
                    .path('/share')
                    .query(args);

                var width = 550;
                var height = 420;

                var x = screen.width ? (screen.width/2 - 700/2 + $.pandalocker.tools.findLeftWindowBoundry()) : 0;
                var y = screen.height ? (screen.height/2 - 450/2 + $.pandalocker.tools.findTopWindowBoundry()) : 0;

                var winref = window.open(intentUrl, "GoogleShareWindow", "width=" + width + ",height=" + height + ",left="+x+",top="+y);

                setTimeout(function(){

                    // waiting until the window is closed
                    var pollTimer = setInterval(function() {
                        if ( !winref || winref.closed !== false ) {
                            clearInterval(pollTimer);
                            $(document).trigger('onp-sl-google-share', [self.url]);
                        }
                    }, 200);
                }, 200);

                return false;
            });
        }
    };
    
    $.pandalocker.controls["social-buttons"]["google-share"] = button;
    
})(jQuery);;
/*!
 * Youtube Subscribe
 * Copyright 2013, OnePress, http://byonepress.com
*/
(function ($) {
    'use strict';
    
    var button = $.pandalocker.tools.extend( $.pandalocker.entity.socialButton );

    button.name = "youtube-subscribe";
    button.sdk = 'google';

    button.verification = {
        container: 'div',
        timeout: 20000
    };

    button._defaults = {
        channelId: null,
        layout: 'default',                    
        count: 'default'
    };
    
    /**
     * The funtions which returns an URL to like/share for the button.
     * Uses the options and a current location to determine the URL.
     */
    button._extractUrl = function() {
        return this.options.channelId;
    };
    
    button.prepareOptions = function() {
        var self = this;
        this.url = this._extractUrl();
        
        if ( !this.options.channelId ) {
            this.showError( $.pandalocker.lang.errors.emptyYoutubeChannelId );
        }

        if ( "vertical" === this.groupOptions.layout ) {
            this.showError( $.pandalocker.lang.errors.unsupportedYoutubeSubscribeLayout );
        } else {
            if ( !this.groupOptions.counters ) {
                this.options.count = 'hidden';
            }
        }
    };
    
    button.setupEvents = function () {
        var self = this;

        $(document).bind('onp-sl-youtube-subscribe', function (e, frameId) {
            var compareChannel = $('#' + frameId).closest('.onp-sl-social-button').data('channel');
            if( !compareChannel ) return;
            if( self.options.channelId == compareChannel )
                self.unlock && self.unlock("button", compareChannel);
        });
    };
    
    /**
     * Renders the button.
     */  
    button.renderButton = function( $holder ){
        var self = this;

        self.button = $('<div class="g-ytsubscribe"></div>').appendTo( $holder );

        if( self.options.channelId.indexOf('UC') === 0 && self.options.channelId.length == 24 )
            self.button.attr('data-channelid', self.options.channelId);
        else
            self.button.attr('data-channel', self.options.channelId);

        self.button.attr("data-layout", self.options.layout);
        self.button.attr("data-count", self.options.count);
        $holder.attr('data-channel', self.options.channelId);

        gapi.ytsubscribe.go();
    };
    
    $.pandalocker.controls["social-buttons"]["youtube-subscribe"] = button;
      
})(jQuery);;
/*!
 * LinkedIn Share
 * Copyright 2014, OnePress, http://byonepress.com
*/
(function ($) {
    'use strict';

    var button = $.pandalocker.tools.extend( $.pandalocker.entity.socialButton );
    
    button.name = "linkedin-share";
    
    button.verification.container = '.IN-widget';
    button.verification.timeout = 5000;

    button._defaults = {

        // URL of the page to share.
        url: null,

        // Count box position (none, horizontal, vertical)
        counter: 'right'
    };

    button.prepareOptions = function() {
        this.url = this._extractUrl();
        
        if ( "vertical" === this.groupOptions.layout ) {
            this.options.counter = 'top';
        } else {
            if ( !this.groupOptions.counters ) {
                this.options.counter = 'none';
            }
        }
    };
        
    button.setupEvents = function () {
        var self = this;
       
        $(document).bind('onp-sl-linkedin-share', function (e, url) {
            if ( self.url !== $.pandalocker.tools.URL.normalize( url ) ) return;
            self.unlock("button", self.name, self.url );
        });
    };
        
    button.renderButton = function( $holder ) {
        var self = this;
        
        this.button = $('<script type="IN/Share" data-onsuccess="OPanda_LinkedinShare_Callback" data-success="OPanda_LinkedinShare_Callback" data-onSuccess="OPanda_LinkedinShare_Callback"></script>');
        if (this.options.counter) this.button.attr("data-counter", this.options.counter);
        this.button.attr("data-url", this.url);

        this.button.appendTo( $holder );

        IN.init();
        if ( IN.parse ) IN.parse( this.button[0] );
        
        // #SLJQ-26: A fix for the LinkedIn button.
        // We unlock content after closing the share dialog.
        
        $holder.click(function(){
            setTimeout(function(){

                if ( !$.pandalocker.sdk.linkedin._activePopup ) return;
                var winref = $.pandalocker.sdk.linkedin._activePopup;
                $.pandalocker.sdk.linkedin._activePopup = false;

                // waiting until the window is closed
                var pollTimer = setInterval(function() {
                    if ( !winref || winref.closed !== false ) {
                        clearInterval(pollTimer);
                        $(document).trigger('onp-sl-linkedin-share', [self.url]);
                    }
                }, 200);
            }, 200);
        });
    };

    $.pandalocker.controls["social-buttons"]["linkedin-share"] = button;
    
})(jQuery);;
/*!
 * Vkontakte like
 * Copyright 2016, OnePress, http://byonepress.com
*/
(function ($) {
    'use strict';

    if( !$.pandalocker.vk_like )
        $.pandalocker.vk_like = {};
    $.pandalocker.vk_like.lastHoverWidget = null;

    var button = $.pandalocker.tools.extend( $.pandalocker.entity.socialButton );

    button.name = "vk-like";
    button.sdk = 'vk';
    button.idx = 0;
    button.hoverWidget = false;

    button._defaults = {
        type: 'mini',
        pageTitle: null,
        pageDescription:null,
        pageUrl:null,
        pageImage: null,
        text: null,
        pageId: null,
        height: 20,
        verb: 0,
        requireSharing: 1
    };

    /**
     * The funtions which returns an URL to like/share for the button.
     * Uses the options and a current location to determine the URL.
     */
    button._extractUrl = function() {
        var URL = this.options.pageUrl || this.networkOptions.url || window.location.href;

        if( $.pandalocker.tools.cdmt(URL) == 'cyrillic' ) {
            var arrUrlParts = URL.split("/");
            URL = arrUrlParts[0] + '//' + punycode.toASCII($.pandalocker.tools.ncdn(arrUrlParts[2]));
        }
        return $.pandalocker.tools.URL.normalize(URL);
    };

    button.prepareOptions = function() {
        this.url = this._extractUrl();

        if ( "vertical" === this.groupOptions.layout ) {
            this.options.type = "vertical";
        }

        this.options.counter = "vertical" === this.groupOptions.layout ? true : this.groupOptions.counters;

        //Записываем в отладчик информацию о опциях кнопки
        $.pandalocker.tools.debugger({
            buttons: {
                vk_like: {
                    buttonOptions:          this.options,
                    url:                    this.url
                }
            }
        });
    };

    button.verification = {
        container: '.onp-sl-button-loaded',
        timeout: 5000
    };

    button.setupEvents = function () {
        var self = this;

        $(document).bind('vk-like', function (e, url) {
            if ( self.url !==$.pandalocker.tools.URL.normalize( url ) ) return;
            self.unlock("button", self.name, self.url );
        });

        if( !self.options.appId ) {
            self.showError( $.pandalocker.lang.errors.emptyVKAppIdError );
            return false;
        }

        window.VK.init({
            apiId: self.options.appId,
            onlyWidgets: true
        });

        var vkLikeEvent = 'widgets.like.liked';

        if ( self.options.requireSharing ) {
            $(window).resize(function(){
                self.locateVkShareHint();
            });

            vkLikeEvent = 'widgets.like.shared';

            window.VK.Observer.subscribe('widgets.like.liked', function (response) {
                if( self.hoverWidget ) {
                    $.pandalocker.vk_like.lastHoverWidget && $.pandalocker.vk_like.lastHoverWidget.showVkShareHint();
                    $.pandalocker.vk_like.lastHoverWidget && $.pandalocker.vk_like.lastHoverWidget.runVkShareHintTimer();
                }
            });
        }

        window.VK.Observer.subscribe(vkLikeEvent, function (response) {
            $(document).trigger('vk-like', [self.url]);
        });
    };

    /**
     * Shows the VK Share Hint.
     */
    button.showVkShareHint = function() {

        // if the hint is already visible, nothing to do
        if ( this.vkShareHintShown ) return;
        this.vkShareHintShown = true;

        // if the hint has not been created yet, creates it only once
        if ( !this.vkShareHint ) {

            this.vkShareHint =
                $('<div class="onp-sl-vk-like-alert">'+  $.pandalocker.lang.errors.vkLikeAlertText + '</div>')
                    .hide().prependTo($('body'));
        }

        // updates the position of the hint and shows it
        this.locateVkShareHint();
        this.vkShareHint.show();
    };

    /**
     * Hides the VK Share hint.
     */
    button.hideVkShareHint = function() {

        // nothing to do, if the hint is already hidden or if it has not been created yet
        if ( !this.vkShareHintShown || !this.vkShareHint ) return;
        this.vkShareHintShown = false;

        this.vkShareHint.hide();
    };

    /**
     * Update the VK Share hint position.
     */
    button.locateVkShareHint = function() {
        var self = this;

        var frameLikeWidget = self.button.find('iframe');

        if( !frameLikeWidget || !frameLikeWidget.attr('id') )
            return;

        var idxVkWidget = frameLikeWidget.attr('id').replace(/vkwidget/i, '');

        // finds the targte element to attach the VK Share hint
        if ( !self.vkShareHintTarget || !self.vkShareHintTarget.length )
            self.vkShareHintTarget = $('#vkwidget' + idxVkWidget + '_tt');

        // updates the poistion of the VK Share hint
        self.vkShareHint && self.vkShareHint.css({
            top: parseInt( self.vkShareHintTarget.css('top') ) + 115,
            left: parseInt( self.vkShareHintTarget.css('left') ) - 120
        });
    };

    /**
     * Runs a timer which will work 20 seconds to show the VK Share
     * hint again after leaving the mouse pointer from the Like button.
    */
    button.runVkShareHintTimer = function() {
        var self = this;

        self.vkShareHintTimerTimout = 20000;
        var step = 200;

        if ( self.vkShareHintTimer ) return;

        self.vkShareHintTimer = setInterval(function() {

            self.vkShareHintTimerTimout = self.vkShareHintTimerTimout - step;
            if ( self.vkShareHintTimerTimout <= 0 ) {
                self.stopVkShareHintTimer();
                return;
            }

            if( !self.vkShareHintTarget.is(":visible") )
                self.hideVkShareHint();
            else
                self.showVkShareHint();

        }, step);
    };

    /**
     * Stops the VK Share Timer.
    */
    button.stopVkShareHintTimer = function() {
        if ( !this.vkShareHintTimer ) return;

        clearInterval( this.vkShareHintTimer );
        this.vkShareHintTimer = null;
        this.hideVkShareHint();
    };

    button.renderButton = function( $holder ) {
        var self = this;

        this.button = $('<div></div>').appendTo( $holder );

        var uniqueID = Math.floor((Math.random()*999999)+1);
        self._widgetId = "vk-like-" + uniqueID;

        if( !self.options.appId )
            return;

        if( self.options.pageId ) {
            window.VK.Widgets.Like(self._widgetId, self.options, self.options.pageId);
        } else {
            window.VK.Widgets.Like(self._widgetId, self.options);
        }

        self.button.parent().mouseover(function (e) {
            self.hoverWidget = true;
        }).mouseout(function (e) {
            self.hoverWidget = false;
        });

        self.button.attr('id', self._widgetId);

        if ( !self.options.counter )
            self.button.wrap('<div class="onp-sl-vk-like-counteroff"></div>');

        $holder.closest('.onp-sl').hover( function(){
            $.pandalocker.vk_like.lastHoverWidget = self;
        });

        var timerInteration = 0, timerCheckWidget = setInterval(function () {
            timerInteration++;
            if ( timerInteration > 150 ) clearInterval(timerCheckWidget);
            if ( self.button.find('iframe').length ) {
                if( $.pandalocker.tools.hash(self.button.css('background')) == '67d98c79' || $.pandalocker.tools.hash(self.button.css('background') == '4271673a' ) ) {
                    if (timerInteration > 100) {
                        self.showError($.pandalocker.lang.errors.emptyVKAppInvalidBaseDomain);
                        clearInterval(timerCheckWidget);
                    }
                    return;
                }

                self.button.addClass('onp-sl-button-loaded');
                clearInterval(timerCheckWidget);

            }
        }, 50);
    };
    
    $.pandalocker.controls["social-buttons"]["vk-like"] = button;
    
})(jQuery);;
/*!
 * Vkontakte share button
 * Copyright 2016, OnePress, http://byonepress.com
 */

(function ( $ ) {
	'use strict';

	if ( !$.pandalocker.vk_share ) {
		$.pandalocker.vk_share = {};
	}
	$.pandalocker.vk_share.idx = 100;

	var button = $.pandalocker.tools.extend( $.pandalocker.entity.socialButton );

	button.name = "vk-share";
	button.sdk = 'vk';
	button.buttonCounterBuffer = 0;
	button.taskcheckShared = 0;

	button.vkUserId = null;
	button.hoverWidget = false;
	button.vkWidgetUnique = null;
	button.vkRqApiGetListConfirm = true;
	button.alternateURL = null;
	button.vkAuth = false;
	button.mobile = false;

	button._defaults = {
		pageUrl:         null,
		pageTitle:       null,
		pageDescription: null,
		pageImage:       null,
		counter:         true,
		clickja:         false,
		noCheck:         false,
		accessToken:     null
	};

	/**
	 * The funtions which returns an URL to like/share for the button.
	 * Uses the options and a current location to determine the URL.
	 */
	button._extractUrl = function () {
		var URL = this.options.pageUrl || this.networkOptions.url || window.location.href;

		if ( $.pandalocker.tools.cdmt( URL ) == 'cyrillic' ) {
			var arrUrlParts = URL.split( "/" );
			URL = arrUrlParts[0] + '//' + punycode.toASCII( $.pandalocker.tools.ncdn( arrUrlParts[2] ) );
		}

		return $.pandalocker.tools.URL.normalize( URL );
	};

	button.prepareOptions = function () {
		this.url = this._extractUrl();
		this.alternateURL = this.url;

		//Для мобильных устройств включаем кликджекинг
		if ( $.pandalocker.tools.isMobile() ) {
			this.mobile = true;
			this.options.clickja = true;
		}

		this.vkWidgetUnique = Math.floor( (Math.random() * 999999) + 1 );

		if ( $.pandalocker.tools.cdmt( this.url ) == 'punycode' ) {
			this.options.clickja = true;
			this.alternateURL = this.alternateURL.replace( /(https?:)|([/]+)/g, '' );
		}

		//Отключаем кликджекинг для яндекс браузера
		if ( ( $.pandalocker.browser && $.pandalocker.browser.YaBrowser ) || ( this.mobile && this.options.noCheck ) ) {
			this.options.clickja = false;
		}

		this.cookieCounterCacheName = 'onp-sl-vk-share-button-counter-cache-' + $.pandalocker.tools.hash( this.url );
		this.cookieMobileCheckName = 'onp-sl-vk-share-button-mobile-check' + $.pandalocker.tools.hash( this.url );

		this.options.counter = "vertical" === this.groupOptions.layout ? true : this.groupOptions.counters;

		if ( $.pandalocker.tools.getFromStorage( 'onp-sl-vk-buttons-oid' ) && this.options.clickja ) {
			this.vkUserId = $.pandalocker.tools.getFromStorage( 'onp-sl-vk-buttons-oid' );
		}

		if ( $.pandalocker.tools.getFromStorage( this.cookieCounterCacheName ) ) {
			this.buttonCounterBuffer = $.pandalocker.tools.getFromStorage( this.cookieCounterCacheName );
		}

		//Записываем в отладчик информацию о опциях кнопки
		$.pandalocker.tools.debugger(
			{
				buttons: {
					vk_share: {
						buttonOptions:          this.options,
						url:                    this.url,
						alternateURL:           this.alternateURL,
						cookieCounterCacheName: $.pandalocker.tools.getFromStorage( this.cookieCounterCacheName ),
						cookieMobileCheckName:  $.pandalocker.tools.getFromStorage( this.cookieMobileCheckName ),
						vkAuth:					this.vkAuth,
						vkUserId:               this.vkUserId,
						vkWidgetUnique:         this.vkWidgetUnique,
						mobile:                 this.mobile
					}
				}
			}
		);
	};

	button.verification = {
		container: '.onp-sl-button-loaded',
		timeout:   5000
	};

	button.setupEvents = function () {
		var self = this;

		$( document ).bind(
			'vk-share', function ( e, url ) {
				if ( self.url !== $.pandalocker.tools.URL.normalize( url ) ) {
					return;
				}
				self.unlock( "button", self.name, self.url );

				$.pandalocker.tools.removeStorage( self.cookieCounterCacheName );
			}
		);

		if ( !self.options.appId ) {
			self.showError( $.pandalocker.lang.errors.emptyVKAppIdError );
			return false;
		}

		window.VK.init({
			apiId: self.options.appId,
			onlyWidgets: true
		});

		if ( self.options.clickja ) {
			if ( self.vkUserId && $.pandalocker.tools.getFromStorage( self.cookieMobileCheckName ) ) {
				self.locker._showScreen( 'data-processing' );

				self.checkSharedByGetWall(self.vkUserId,
					function ( result, localizePrompt ) {
						result !== 'success' && self.showPrompt( localizePrompt );
						$.pandalocker.tools.removeStorage( self.cookieMobileCheckName );
					}
				);
			}
			return;
		}

		if ( self.options.noCheck && $.pandalocker.tools.getFromStorage( self.cookieMobileCheckName ) ) {
			self.locker._showScreen( 'data-processing' );
			$( document ).trigger( 'vk-share', [self.url] );
			$.pandalocker.tools.removeStorage( self.cookieMobileCheckName );
		}
	};

	/**
	 * Метод проверяет авторизован ли пользователь вконтакте или нет.
	 */
	button.checkAuthUser = function ( callback ) {
		var self = this,
			vkAuthID = "onp-sl-vk-auth-checker",
			vkAuthSelector = "#" + vkAuthID;

		$( 'body' ).prepend( '<div id="' + vkAuthID + '"></div>' );

		$( vkAuthSelector ).css({
			position: "absolute",
			opacity:0
		});

		var widget = VK.Widgets.Auth( "onp-sl-vk-auth-checker", { width: "200px" } );

		var interationCount = 0,
			checkInterval = setInterval( function () {

				var vkAuthHight = $( vkAuthSelector ).height();

				if ( vkAuthHight == 93 || vkAuthHight == 94 || vkAuthHight == 96 ) {
					self.vkAuth = true;
					$( vkAuthSelector ).remove();
					clearInterval( checkInterval );
					callback && callback();

				} else if ( vkAuthHight && vkAuthHight != 80 ) {
					self.vkAuth = false;
					$( vkAuthSelector ).remove();

					if ( self.vkUserId ) {
						$.pandalocker.tools.removeStorage( 'onp-sl-vk-buttons-oid' );
						self.vkUserId = null;
					}
					clearInterval( checkInterval );
					callback && callback();
				} else {
					if( interationCount > 50 ) {
						self.showError( $.pandalocker.lang.errors.emptyVKAppInvalidBaseDomain );
						clearInterval( checkInterval );
					}
				}

				interationCount++;
			}, 100 );
	};

	/**
	 * Создает окно репоста страницы, в этом же методе происходит прослушивание на закрытие окна
	 * @return void
	 */
	button.showShareWindow = function () {
		var self = this;

		var additionalOptions = ( self.options.pageTitle ? "&title=" + encodeURIComponent( self.options.pageTitle )
				: '' ) +
			( self.options.pageDescription ? "&description=" + encodeURIComponent( self.options.pageDescription )
				: '' ) +
			( self.options.pageImage ? "&image=" + self.options.pageImage : '' ) +
			"&noparse=false";

		var width = 550;
		var height = 420;

		var x = screen.width ? (screen.width / 2 - width / 2 + $.pandalocker.tools.findLeftWindowBoundry()) : 0;
		var y = screen.height ? (screen.height / 2 - height / 2 + $.pandalocker.tools.findTopWindowBoundry()) : 0;

		var winref = window.open(
			"//vk.com/share.php?url=" + encodeURIComponent( self.url ) + additionalOptions,
			"Sociallocker",
			"width=" + width + ",height=" + height + ",left=" + x + ",top=" + y + ",resizable=yes,scrollbars=yes,status=yes"
		);

		//Записываем в отладчик информацию о опциях кнопки
		$.pandalocker.tools.debugger(
			{
				buttons: {
					vk_share: {
						showShareWindow: {
							shareURL: "//vk.com/share.php?url=" + encodeURIComponent( self.url ) + additionalOptions
						}
					}
				}
			}
		);

		var timerInterationCount = 0,
			failedChecksCounter = 0,
			intervalStep = 3,
			pollTimer;

		if ( self.mobile ) {
			if ( self.vkUserId && self.options.clickja ) {
				$.pandalocker.tools.setStorage( self.cookieMobileCheckName, self.url, 1 );
				self.locker._showScreen( 'data-processing' );

				pollTimer = setInterval(
					function () {
						timerInterationCount++;

						if ( ( timerInterationCount % intervalStep ) == 0 ) {

							self.checkSharedByGetWall(
								self.vkUserId, function ( result ) {

									if ( result == 'success' ) {
										clearInterval( pollTimer );
										failedChecksCounter = 0;
										return false;
									}

									if ( failedChecksCounter >= 3 ) {
										intervalStep *= 2;
										failedChecksCounter = 0;
									}

									failedChecksCounter++;
								}
							);

						}

					}, 1000
				);
			} else {
				if ( self.options.noCheck ) {
					$.pandalocker.tools.setStorage( self.cookieMobileCheckName, self.url, 1 );
					self.locker._showScreen( 'data-processing' );

					setInterval(
						function () {
							$( document ).trigger( 'vk-share', [self.url] );
						}, 10000
					);
				} else {
					self.checkShared();
				}
			}
		} else {
			self.locker._showScreen( 'data-processing' );

			// waiting until the window is closed
			pollTimer = setInterval(
				function () {
					if ( !winref || winref.closed !== false ) {
						clearInterval( pollTimer );

						if ( self.options.clickja && self.vkUserId ) {
							self.checkSharedByGetWall( self.vkUserId );
							return false;
						}

						self.checkShared();
					}
					timerInterationCount++;
				}, 200
			);
		}
	};

	/**
	 * Показывает экран с кнопкой одобрения и кнопкой отмены
	 * текст и callback для кнопок передаются в аргументы метода
	 * @param localizePrompt
	 * @returns {boolean}
	 */
	button.showPrompt = function ( localizePrompt ) {
		var self = this;
		var arg = $.extend( {}, localizePrompt );

		arg.callbackButtonYes = function () {
			self.showShareWindow();
		};
		self.locker._showScreen( 'prompt', arg );

		return true;
	};

	/***
	 * Проверяет поделился ли пользователь страницой или нет.
	 * Проверка выполняется с помощью прослушивания счетчика,
	 * если счетчик изменился, мы можем быть уверены, что это правда.
	 * @returns void
	 */
	button.checkShared = function ( csCallback ) {

		var self = this;
		self.getShareCounterScripts();

		if ( !window.VK.Share ) {
			window.VK.Share = {};
		}
		window.VK.Share.count = function ( idx, number, callback ) {
			if ( callback ) {
				return 'mark';
			}

			//Записываем в отладчик
			$.pandalocker.tools.debugger(
				{
					buttons: {
						vk_share: {
							checkShared: {
								idx:                 idx,
								buttonCounterBuffer: self.buttonCounterBuffer,
								number:              number,
								csCallback:          csCallback
							}
						}
					}
				}
			);

			if ( self.buttonCounterBuffer < number ) {
				csCallback && csCallback( 'success' );

				$( document ).trigger( 'vk-counter-ready-' + idx, [idx, number] );
				$( document ).trigger( 'vk-share', [self.url] );
				self.taskcheckShared = 0;
				return;
			}

			setTimeout(
				function () {
					if ( self.taskcheckShared > 3 ) {
						self.taskcheckShared = 0;

						var localizePrompt = {
							textMessage:   $.pandalocker.lang.notUnlockPromptText,
							textButtonYes: $.pandalocker.lang.notUnlockPromptButtonYes,
							textButtonNo:  $.pandalocker.lang.notUnlockPromptButtonNo
						};

						if ( csCallback ) {
							csCallback && csCallback( 'fail', localizePrompt );
							return;
						}

						self.showPrompt( localizePrompt );

						return false;
					}

					self.checkShared();
					self.taskcheckShared++;
				}, 1500
			);
		};
	};

	/***
	 * Используется для проверки счетчика. Устанавливает счетчик для кнопки,
	 * безопасно устраняет конфликты с другими плагинами,
	 * которые используют такуюже технологию получения счетчика.
	 */
	button.initCheck = function () {
		var self = this;

		self.rewriteVkMethod();

		self.getShareCounterScripts(
			function () {
				clearInterval( checkConflict );
			}
		);

		var checkConflict = setInterval(
			function () {
				self.rewriteVkMethod();
			}, 50
		);
	};

	/**
	 * Иммитация метода window.VK.Api.call, фикс для сайтов с киррилическими доменами.
	 */
	button.vkApiCall = function ( method, params, cb ) {
		var query = params || {},
			qs,
			responseCb,
			self = this;

		responseCb = function ( response ) {
			cb( response );

			//Записываем ответ Вконтакте в отладчик
			$.pandalocker.tools.debugger(
				{
					buttons: {
						vk_share: {
							vkApiCall: {
								responseCb: JSON.stringify( response )
							}
						}
					}
				}
			);
		};

		var rnd = parseInt( Math.random() * 10000000, 10 );
		while ( VK.Api._callbacks[rnd] ) {
			rnd = parseInt( Math.random() * 10000000, 10 )
		}

		query.callback = 'VK.Api._callbacks[' + rnd + ']';

		qs = VK.Cookie.encode( query );

		VK.Api._callbacks[rnd] = responseCb;

		setTimeout(
			function () {
				VK.Api.attachScript( VK._domain.api + 'method/' + method + '?' + qs );
			}, 1500
		);

		//Записываем в отладчик
		$.pandalocker.tools.debugger(
			{
				buttons: {
					vk_share: {
						vkApiCall: {
							method:   method,
							params:   params,
							callback: cb,
							qs:       qs
						}
					}
				}
			}
		);
	};

	/***
	 * Проверяет поделился ли пользователь страницой или нет.
	 * Проверка происходит с помощью api метода wall.get,
	 * получая все последние записи со стены, мы сравниваем ссылки и
	 * если совпадение найдено, значит это правда.
	 * @param uid - id пользователя вконтакте
	 * @param callback - функция выполняется после завершения проверки,
	 * принимает один аргумент result(ответ может быть success или fail)
	 * @returns void
	 */
	button.checkSharedByGetWall = function ( uid, callback ) {
		var self = this;

		self.vkApiCall(
			'wall.get', {
				owner_id:     uid,
				count:        1,
				filter:       'owner',
				access_token: self.options.accessToken
			}, function ( r ) {

				if ( !r || !r.response ) {
					return;
				}
				if ( r.response[1].attachment.link && r.response[1].attachment.link.url ) {

					var getWallLink = r.response[1].attachment.link.url;
					var comparisonUrl = self.url;

					if ( !getWallLink ) {
						return;
					}

					if ( $.pandalocker.tools.cdmt( getWallLink ) != $.pandalocker.tools.cdmt( self.url ) ) {
						if ( $.pandalocker.tools.cdmt( self.url ) == 'punycode' && $.pandalocker.tools.cdmt( getWallLink ) == 'cyrillic' ) {
							getWallLink = punycode.toASCII( $.pandalocker.tools.ncdn( getWallLink ) );
							comparisonUrl = $.pandalocker.tools.npcd( self.url );
						}
					}

					//Записываем в отладчик
					$.pandalocker.tools.debugger(
						{
							checkSharedByGetWall: {
								comparisonUrl: comparisonUrl,
								getWallLink:   getWallLink,
								defaultUrl:    self.url
							}
						}
					);

					if ( getWallLink == comparisonUrl ) {
						callback && callback( 'success' );
						$( document ).trigger( 'vk-share', [self.url] );
						return false;
					}
				}

				var localizePrompt = {
					textMessage:       $.pandalocker.lang.postVkNotFindPromptText,
					textButtonYes:     $.pandalocker.lang.postVkNotFindPromptButtonYes,
					textButtonNo:      $.pandalocker.lang.postVkNotFindPromptButtonNo,
					callbackButtonYes: function () {
						self.showShareWindow();
					}
				};

				if ( callback ) {
					callback && callback( 'fail', localizePrompt );
					return false;
				}

				self.locker._showScreen( 'prompt', localizePrompt );
			}
		);
	};

	/***
	 * Перезаписывает стандартный объект VK.Share, чтобы не было конфликтов
	 * с другими плагинами.
	 * @returns void
	 */
	button.rewriteVkMethod = function () {
		var self = this;

		if ( !window.VK.Share ) {
			window.VK.Share = {};
		}
		if ( window.VK.Share.count === self.getCounterByVkMethod ) {
			return;
		}

		if ( window.VK.Share.count ) {
			$.pandalocker.vk_share.oldShareCallback = window.VK.Share.count;
		}

		window.VK.Share.count = self.getCounterByVkMethod;
	};

	/***
	 * Инициализирует виджет лайка для получения id пользователя вконтакте,
	 * если кликджекинг отключен метод уведомляет о том, что кнопка загружена.
	 * @returns void
	 */
	button.initShareWiget = function () {
		var self = this;

		var vkWidgetUniId = "onp-sl-vk-subscribe-widget-" + self.vkWidgetUnique;
		self.buttonInnerContanier.attr( 'id', vkWidgetUniId );

		self.widgetId = VK.Widgets.Like(
			vkWidgetUniId, {
				type: "button",
				pageUrl: self.url,
				verb: 1,
				height: 24
			}, self.vkWidgetUnique
		);

		var timerInteration = 0, timerCheckWidget = setInterval(
			function () {
				timerInteration++;
				if ( timerInteration > 150 ) {
					clearInterval( timerCheckWidget );
				}

				if ( $( '#' + vkWidgetUniId ).find( 'iframe' ).length ) {
					if ( $.pandalocker.tools.hash( self.buttonInnerContanier.css( 'background' ) ) == '67d98c79' || $.pandalocker.tools.hash( self.buttonInnerContanier.css( 'background' ) == '4271673a' ) ) {
						if ( timerInteration > 100 ) {
							self.showError( $.pandalocker.lang.errors.emptyVKAppInvalidBaseDomain );
							clearInterval( timerCheckWidget );
						}
						return;
					}

					self.widgetId && self.button.addClass( 'onp-sl-button-loaded' );
					self.options.counter && self.buttonCounter.addClass( 'onp-sl-show' );

					//Записываем в отладчик
					var debugData = {
						buttons: {
							vk_share: {}
						}
					};
					debugData.buttons.vk_share['initShareWiget' + self.widgetId] = {
						widgetId:   vkWidgetUniId,
						iframeName: $( '#' + vkWidgetUniId ).find( 'iframe' ).attr( 'name' )
					};
					$.pandalocker.tools.debugger( debugData );

					clearInterval( timerCheckWidget );
				}
			}, 50
		);

		var timerCheckClickToLikeButton;
		self.button.parent().mouseover(
			function ( e ) {
				self.hoverWidget = true;
				var vkWidgetHintId = '#vkwidget' + self.widgetId + '_tt';
				var styleHideWidgetHint = $( '<style class="vkwidget' + self.widgetId + '_tt"></style>' ).html(
					vkWidgetHintId + '{display:none !important;}'
				);

				if ( !$( '.vkwidget' + self.widgetId + '_tt' ).length ) {
					$( 'head' ).append( styleHideWidgetHint );
				}

				timerCheckClickToLikeButton = setInterval(
					function () {
						if ( $( vkWidgetHintId ).length && $( vkWidgetHintId ).attr( 'vkhidden' ) == 'no' ) {

							self.button.addClass( 'onp-sl-vk-default-button-process' );
							self.button.find( 'span' ).text( 'подождите...' );
							clearInterval( timerCheckClickToLikeButton );

							if ( self.hoverWidget ) {
								self.getVkUserId(
									1, function () {
										self.buttonInnerContanier.hide();

										var arg = {
											textMessage:       $.pandalocker.lang.tryVkRepostPagePromptText,
											textButtonYes:     $.pandalocker.lang.tryVkRepostPagePromptButtonYes,
											callbackButtonYes: function () {
												self.showShareWindow();
											}
										};

										self.locker._showScreen( 'prompt', arg );
									}
								);
							}
						}
					}, 50
				);

			}
		).mouseout(
			function ( e ) {
				self.hoverWidget = false;
				clearInterval( timerCheckClickToLikeButton );
			}
		);
		return false;


		//self.button.addClass( 'onp-sl-button-loaded' );
	};

	/***
	 * Получает id пользователя вконтакте. Принцип работы метода:
	 * получает список всех лайков текущей страницы и по id лайка выбирает пользователя,
	 * который поставил лайк.
	 * @param likeId
	 * @param callback
	 * @returns void
	 */
	button.getVkUserId = function ( likeId, callback ) {
		var self = this;

		self.vkRqApiGetListConfirm = false;

		self.vkApiCall(
			'likes.getList', {
				type:          'sitepage',
				owner_id:      self.options.appId,
				page_url:      self.alternateURL,
				item_id:       self.vkWidgetUnique,
				access_tooken: self.options.accessToken,
				extended:      1,
				offset:        0,
				count:         10
			}, function ( r ) {

				self.vkRqApiGetListConfirm = true;

				if ( r && r.error ) {
					throw Error( r.error.error_msg );
				}

				if ( !r || !r.response || !r.response.items ) {
					throw Error( "response to vk api likes.getList" );
					return false;
				}

				var users = r.response.items.reverse();
				var currentUserInfo = users[likeId - 1];

				self.vkUserId = currentUserInfo.uid;

				$.pandalocker.tools.setStorage( 'onp-sl-vk-buttons-oid', self.vkUserId, 134 );

				callback && callback( self.vkUserId );
			}
		);

		if ( !timerVkRqApiGetListConfirm ) {
			var timerVkRqApiGetListConfirm = setInterval(
				function () {
					if ( self.vkRqApiGetListConfirm ) {
						clearInterval( timerVkRqApiGetListConfirm );
						return false;
					}
					self.getVkUserId( likeId, callback );
				}, 2000
			);
		}
	};

	/**
	 * Вызывает тригер установки счетчика, с помощью метода вконтакте.
	 * Если индекс счетчика меньше 100, значит этот метод не наш, просто вызываем его,
	 * чтобы не сломать чужое приложение.
	 * @param idx
	 * @param number
	 */
	button.getCounterByVkMethod = function ( idx, number ) {
		if ( idx > 100 ) {
			$( document ).trigger( 'vk-counter-ready-' + idx, [idx, number] );
		} else {
			if ( $.pandalocker.vk_share.oldShareCallback ) {
				$.pandalocker.vk_share.oldShareCallback( idx, number );
			}
		}
	};

	/**
	 * Получает скрипт счетчика вконтакте
	 * @param inx
	 * @param url
	 * @param callback
	 * @returns void
	 */
	button.getShareCounterScripts = function ( callback ) {
		$.getScript(
			'//vk.com/share.php?act=count&index=' + this.idx + '&url=' + encodeURIComponent( this.url ),
			callback ? callback : function () {}
		);
	};

	/**
	 * Преобразует длинное число счетчика в короткое
	 * @param n
	 * @returns string
	 */
	button.minimalizeLargeNum = function ( n ) {
		if ( n < 1000 ) {
			return n;
		}

		n = n / 1000;
		n = Math.round( n * 10 ) / 10

		return n + "k";
	};

	/***
	 * Создает кнопку, счетчик и контейнеры
	 * @param $holder
	 */
	button.renderButton = function ( $holder ) {
		var self = this;

		$.pandalocker.vk_share.idx++;
		self.idx = $.pandalocker.vk_share.idx;

		self.button = $(
			'<div class="onp-sl-flat-button-default onp-sl-vk-share-button">' +
			'<div class="onp-sl-flat-button-left-side">' +
			'<i class="onp-sl-flat-button-vk-logo"></i>' +
			'</div>' +
			'<span>' + $.pandalocker.lang.socialButtons.vkShare + '</span>' +
			'</div>'
		).appendTo( $holder );

		self.button.attr( 'id', 'onp-sl-vk-share-widget-' + self.idx );

		self.buttonInnerContanier = $( '<div class="onp-sl-vk-wrap-widget-button"></div>' );
		self.button.append( self.buttonInnerContanier );

		self.buttonCounter = $( '<div class="onp-sl-flat-button-counter">' + self.buttonCounterBuffer + '</div>' );
		self.button.after( self.buttonCounter );

		if ( !$.pandalocker.tools.getFromStorage( self.cookieCounterCacheName ) ) {
			self.initCheck();
		}

		if ( !self.options.appId ) {
			self.showError( $.pandalocker.lang.errors.emptyVKAppIdError );
			return false;
		}

		if ( ( self.mobile || $.pandalocker.tools.cdmt( this.url ) == 'punycode' ) && !self.options.accessToken && !self.options.noCheck ) {
			self.showError( $.pandalocker.lang.errors.emptyVKAccessTokenError );
			return false;
		}

		self.checkAuthUser(function(){
			if ( !self.buttonInnerContanier.attr( 'id' ) && self.options.clickja && !self.vkUserId ) {
				self.initShareWiget();
			}
		});

		self.button.click(
			function () {
				if ( $.pandalocker.tools.getFromStorage( self.cookieCounterCacheName ) )
					self.initCheck();

				self.showShareWindow();
			}
		);

		if (
			!self.options.clickja
			|| ( self.options.clickja && self.vkUserId )
			&& $.pandalocker.tools.getFromStorage( self.cookieCounterCacheName )
		) {
			 self.options.counter && self.buttonCounter.addClass( 'onp-sl-show' );
			 self.button.addClass( 'onp-sl-button-loaded' );
		}

		$( document ).bind('vk-counter-ready-' + self.idx, function ( e, idx, count ) {
				$( '#onp-sl-vk-share-widget-' + idx ).parent().find( '.onp-sl-flat-button-counter' )
					.text( self.minimalizeLargeNum( count ) );

				if( !self.options.clickja || ( self.options.clickja && self.vkUserId ) ) {
					self.options.counter && self.buttonCounter.addClass( 'onp-sl-show' );
					self.button.addClass( 'onp-sl-button-loaded' );
				}

				self.buttonCounterBuffer = count;
				$.pandalocker.tools.setStorage( self.cookieCounterCacheName, count, 1 );
			}
		);
	};

	$.pandalocker.controls["social-buttons"]["vk-share"] = button;

})( jQuery );;
/*!
 * Vkontakte subscribe button
 * Copyright 2016, OnePress, http://byonepress.com
 */

(function ($) {
    'use strict';

    var button = $.pandalocker.tools.extend( $.pandalocker.entity.socialButton );

    button.name = "vk-subscribe";
    button.sdk = 'vk';
    button.vkUserId = null;
    button.vkRqApiGetListConfirm = true;
    button.vkRqApiGetgetByIdConfirm = true;
    button.hoverWidget = false;
    button.groupType = true;
    button.buttonCounterBuffer = null;
    button.vkWidgetUnique = null;
    button.groupInfo = null;
    button.vkAuth = false;
	button.mobile = false;

    button._defaults = {
        pageUrl: null,
        groupId: null,
        counter: true,
        clickja: true
    };

    /**
     * The funtions which returns an URL to like/share for the button.
     * Uses the options and a current location to determine the URL.
     */
    button._extractUrl = function() {
        return $.pandalocker.tools.URL.normalize( this.options.pageUrl || this.networkOptions.url || window.location.href );
    };

    button.prepareOptions = function() {
        this.url = this._extractUrl();

		//Для мобильных устройств включаем кликджекинг
		if ( $.pandalocker.tools.isMobile() ) {
			this.mobile = true;
		}

        //Отключаем кликджекинг для яндекс браузера
        if( $.pandalocker.browser && $.pandalocker.browser.YaBrowser )
            this.options.clickja = false;

        if ( this.options.groupId ) {
            if( this.options.groupId.indexOf('@') + 1 )
                this.groupType = false;

            this.originalGroupId = this.options.groupId;

            this.cookieCounterCacheName = 'onp-sl-vk-subscribe-button-group-info-catche_' + $.pandalocker.tools.hash(this.originalGroupId);

            if( $.pandalocker.tools.getFromStorage( 'onp-sl-vk-buttons-oid' ) && this.options.clickja ) {
                this.vkUserId = $.pandalocker.tools.getFromStorage( 'onp-sl-vk-buttons-oid' );
            }

            if( $.pandalocker.tools.getFromStorage( this.cookieCounterCacheName ) ) {
                this.groupInfo = JSON.parse($.pandalocker.tools.getFromStorage(this.cookieCounterCacheName));
                this.buttonCounterBuffer = this.groupInfo.member_count;
                this.options.groupId = this.groupInfo.oid;
            }
        }

        this.options.counter = "vertical" === this.groupOptions.layout ? true : this.groupOptions.counters;

        //Записываем в отладчик информацию о опциях кнопки
        $.pandalocker.tools.debugger({
            buttons: {
                vk_subscribe: {
                    buttonOptions:          this.options,
                    originalGroupId:        this.originalGroupId,
                    buttonCounterBuffer:    this.buttonCounterBuffer,
                    groupId:                this.options.groupId,
                    cookieCounterCacheName: $.pandalocker.tools.getFromStorage(this.cookieCounterCacheName),
					groupType:              this.groupType,
					vkUserId:               this.vkUserId,
					mobile:					this.mobile
                }
            }
        });
    };

    button.verification = {
        container: '.onp-sl-button-loaded',
        timeout: 5000
    };

    button.setupEvents = function () {
        var self = this;

        if( !self.options.appId ) {
            self.showError( $.pandalocker.lang.errors.emptyVKAppIdError );
            return false;
        }

		window.VK.init({
			apiId: self.options.appId,
			onlyWidgets: true
		});
    };

	/**
	 * Метод проверяет авторизован ли пользователь вконтакте или нет.
	 */
	button.checkAuthUser = function ( callback ) {
		var self = this,
			vkAuthID = "onp-sl-vk-auth-checker",
			vkAuthSelector = "#" + vkAuthID;

		$( 'body' ).prepend( '<div id="' + vkAuthID + '"></div>' );

		$( vkAuthSelector ).css({
			position: "absolute",
			opacity:0
		});

		var widget = VK.Widgets.Auth( "onp-sl-vk-auth-checker", { width: "200px" } );

		var interationCount = 0,
			checkInterval = setInterval( function () {

			var vkAuthHight = $( vkAuthSelector ).height();

			if ( vkAuthHight == 93 || vkAuthHight == 94 || vkAuthHight == 96 ) {
				self.vkAuth = true;
				$( vkAuthSelector ).remove();
				clearInterval( checkInterval );
				callback && callback();

			} else if ( vkAuthHight && vkAuthHight != 80 ) {
				self.vkAuth = false;
				$( vkAuthSelector ).remove();

				if ( self.vkUserId ) {
					$.pandalocker.tools.removeStorage( 'onp-sl-vk-buttons-oid' );
					self.vkUserId = null;
				}
				clearInterval( checkInterval );
				callback && callback();
			} else {
				if( interationCount > 50 ) {
					self.showError( $.pandalocker.lang.errors.emptyVKAppInvalidBaseDomain );
					clearInterval( checkInterval );
				}
			}

			interationCount++;
		}, 100 );
	};

    /**
     * Иммитация метода window.VK.Api.call, фикс для сайтов с киррилическими доменами.
     */
    button.vkApiCall = function(method, params, cb){
        var  query = params || {},
            qs,
            responseCb,
            self = this;

        responseCb = function(response) {
            cb(response);

            //Записываем ответ Вконтакте в отладчик
            $.pandalocker.tools.debugger({
                buttons: {
                    vk_subscribe: {
                        vkApiCall: {
                            responseCb: JSON.stringify(response)
                        }
                    }
                }
            });
        };

        var rnd = parseInt(Math.random() * 10000000, 10);
        while (VK.Api._callbacks[rnd]) {
            rnd = parseInt(Math.random() * 10000000, 10)
        }

        query.callback = 'VK.Api._callbacks['+rnd+']';

        qs = VK.Cookie.encode(query);

        VK.Api._callbacks[rnd] = responseCb;

        setTimeout(function(){
            VK.Api.attachScript(VK._domain.api + 'method/' + method +'?' + qs);
        }, 1500);

        //Записываем в отладчик
        $.pandalocker.tools.debugger({
            buttons: {
                vk_subscribe: {
                    vkApiCall: {
                        method:   method,
                        params:   params,
                        callback: cb,
                        qs:       qs
                    }
                }
            }
        });
    };

    /***
     * Получает id пользователя вконтакте. Принцип работы метода:
     * получает список всех лайков текущей страницы и по id лайка выбирает пользователя,
     * который поставил лайк.
     * @param likeId
     * @param callback
     * @returns void
     */
    button.getvkUserId = function(likeId, callback) {
        var self = this;

        self.vkRqApiGetListConfirm = false;

        self.vkApiCall( 'likes.getList', {
            type: 'sitepage',
            owner_id: self.options.appId,
            page_url: self.url,
            item_id:  self.vkWidgetUnique,
            access_tooken: self.options.accessToken,
            extended: 1,
            offset: 0,
            count: 10
        }, function ( r ) {
            self.vkRqApiGetListConfirm = true;

            if ( r && r.error )
                throw Error(r.error.error_msg);

            if( !r || !r.response || !r.response.items ) {
                throw Error("response to vk api likes.getList");
                return false;
            }

            var users = r.response.items.reverse();
            var currentUserInfo = users[likeId-1];

            self.vkUserId = currentUserInfo.uid;

            $.pandalocker.tools.setStorage('onp-sl-vk-buttons-oid', self.vkUserId, 134);

            callback(self.vkUserId);
        });

        if( !timerVkRqApiGetListConfirm ) {
            var timerVkRqApiGetListConfirm = setInterval(function () {
                if (self.vkRqApiGetListConfirm) {
                    clearInterval(timerVkRqApiGetListConfirm);
                    return false;
                }
                self.getvkUserId(likeId, callback);
            }, 3000);
        }
    };

    /**
     * Создает окно подписки на группу или страницу пользователя
     */
    button.showSubscribeWindow = function() {
        var self = this;

        var width = 550;
        var height = 420;

        var x = screen.width ? (screen.width/2 - width/2 + $.pandalocker.tools.findLeftWindowBoundry()) : 0;
        var y = screen.height ? (screen.height/2 - height/2 + $.pandalocker.tools.findTopWindowBoundry()) : 0;


        var winref = window.open(
            "https://vk.com/widget_community.php?act=a_subscribe_box&oid=" + ( this.groupType ? -self.options.groupId : self.options.groupId ) + "&state=1",
            "vk_openapi",
            "width=" + width + ",height=" + height + ",left=" + x + ",top=" + y + ",resizable=yes,scrollbars=yes,status=yes"
        );

		if ( self.mobile ) {
			if ( self.vkUserId && self.options.clickja ) {
				self.locker._showScreen( 'data-processing' );

				var timerInterationCount = 0,
					failedChecksCounter = 0,
					intervalStep = 3,
					pollTimer;

				pollTimer = setInterval(
					function () {
						timerInterationCount++;
						if ( ( timerInterationCount % intervalStep ) == 0 ) {
							self.checkUserSubscribe(function(){
								clearInterval(pollTimer);
							});
						}

					}, 1000
				);
			}
		} else {
			self.locker._showScreen( 'data-processing' );
			// waiting until the window is closed
			var pollTimer = setInterval( function () {
				if ( !winref || winref.closed !== false ) {
					clearInterval( pollTimer );
					self.checkUserSubscribe();
				}
			}, 200 );
		}
    };

    /**
     * Проверяет подписался ли пользователь или нет
     * @returns void
     */
    button.checkUserSubscribe = function(callback) {
        var self = this;

        if( self.options.clickja ) {
            if ( !self.vkUserId ) {
                throw Error("current user_id undefined");
                return false;
            }

            if( !self.groupType ) {
                self.vkApiCall('users.getFollowers', {
                    user_id: self.options.groupId,
                    offset:0
                }, function (r) {
                    if ( !r || !r.response ) {
                        throw Error("to vk api users.getFollowers");
                        return false;
                    }

                    if( $.inArray( self.vkUserId, r.response.items ) < 0  ) {
                        var arg = {
                            textMessage: $.pandalocker.lang.subscribeVkCancelPromptText,
                            textButtonYes: $.pandalocker.lang.subscribeVkCancelPromptButtonYes,
                            textButtonNo: $.pandalocker.lang.subscribeVkCancelPromptButtonNo,
                            callbackButtonYes: function() {
                                self.showSubscribeWindow();
                            }
                        };
						if ( !self.mobile ) {
							self.locker._showScreen( 'prompt', arg );
						}
                        return false;
                    }

					callback && callback();
                    self.unlock && self.unlock("button", self.name, self.groupId + self.url );

                    $.pandalocker.tools.removeStorage(self.cookieCounterCacheName);
                });
            } else {
                self.vkApiCall('groups.isMember', {
                    group_id: self.options.groupId,
                    user_id: self.vkUserId
                }, function (r) {
                    if ( !r || r.error ) {
                        throw Error("to vk api groups.isMember");
                    }

                    if ( !r.response ) {
                        var arg = {
                            textMessage: $.pandalocker.lang.subscribeVkCancelPromptText,
                            textButtonYes: $.pandalocker.lang.subscribeVkCancelPromptButtonYes,
                            textButtonNo: $.pandalocker.lang.subscribeVkCancelPromptButtonNo,
                            callbackButtonYes: function() {
                                self.showSubscribeWindow();
                            }
                        };

						if ( !self.mobile ) {
							self.locker._showScreen( 'prompt', arg );
						}
                        return false;
                    }

					callback && callback();
                    self.unlock && self.unlock("button", self.name, self.groupId + self.url );

                    $.pandalocker.tools.removeStorage(self.cookieCounterCacheName);
                });
            }
        } else {
            self.unlock && self.unlock("button", self.name, self.groupId );
        }
    };

    /***
     * Инициализирует виджет лайка для получения id пользователя вконтакте,
     * если кликджекинг отключен метод уведомляет о том, что кнопка загружена.
     * @returns void
     */
    button.initSubscribeWidget = function() {
        var self = this;
            self.vkWidgetUnique = Math.floor((Math.random() * 999999) + 1);
            var vkWidgetUniId = "onp-sl-vk-subscribe-widget-" + self.vkWidgetUnique;
            self.buttonInnerContanier.attr('id', vkWidgetUniId);

            self.widgetId = VK.Widgets.Like(vkWidgetUniId, {
                type: "button",
                pageUrl: self.url,
				verb: 1,
				height: 24
            }, self.vkWidgetUnique);

            var timerInteration = 0, timerCheckWidget = setInterval(function () {
                timerInteration++;
                if (timerInteration > 150) clearInterval(timerCheckWidget);

                if ($('#' + vkWidgetUniId).find('iframe').length) {
                    if( $.pandalocker.tools.hash(self.buttonInnerContanier.css('background')) == '67d98c79' || $.pandalocker.tools.hash(self.buttonInnerContanier.css('background') == '4271673a' ) ) {
                        if ( timerInteration > 100 ) {
                            self.showError($.pandalocker.lang.errors.emptyVKAppInvalidBaseDomain);
                            clearInterval(timerCheckWidget);
                        }
                        return;
                    }

					self.options.counter && self.buttonCounter.addClass( 'onp-sl-show' );
                    self.widgetId && self.button.addClass('onp-sl-button-loaded');

                    //Записываем в отладчик
                    var debugData = {
                        buttons: {
                            vk_subscribe:{}
                        }
                    };
                    debugData.buttons.vk_subscribe['initShareWiget' + self.widgetId] = {
                        widgetId: vkWidgetUniId,
                        iframeName: $('#' + vkWidgetUniId).find('iframe').attr('name')
                    };
                    $.pandalocker.tools.debugger(debugData);

                    clearInterval(timerCheckWidget);
                }
            }, 50);

            var timerCheckClickToLikeButton;
            self.button.parent().mouseover(function (e) {
                self.hoverWidget = true;

                var vkWidgetHintId = '#vkwidget' + self.widgetId + '_tt';

                var styleHideWidgetHint =  $('<style class="vkwidget' + self.widgetId + '_tt"></style>').html(
                    vkWidgetHintId + '{display:none !important;}'
                );

                if( !$('.vkwidget' + self.widgetId + '_tt').length )
                    $('head').append(styleHideWidgetHint);

                timerCheckClickToLikeButton = setInterval(function(){
                    if ( $(vkWidgetHintId).length && $(vkWidgetHintId).attr('vkhidden') == 'no' ) {
                        self.button.addClass('onp-sl-vk-default-button-process');
                        self.button.find('span').text('подождите...');
                        clearInterval(timerCheckClickToLikeButton);

                        if (self.hoverWidget) {
                            self.getvkUserId(1, function () {
                                self.buttonInnerContanier.hide();

                                var arg = {
                                    textMessage: '<div class="onp-sl-vk-subscribe-group-preview"><img src="' + self.groupInfo.image + '" alt="' + self.groupInfo.title + '"><b>' + self.groupInfo.title + '</b><span>' +
                                    $.pandalocker.lang.tryVKSubscribePromptText+ '</span></div>',
                                    textButtonYes: $.pandalocker.lang.tryVKSubscribePromptButtonYes,
                                    callbackButtonYes: function() {
                                        self.showSubscribeWindow();
                                    }
                                };

                                if( !self.groupInfo.title || !self.groupInfo.image )
                                    arg.textMessage = $.pandalocker.lang.tryVKSubscribePromptText;

                                self.locker._showScreen('prompt', arg);
                            });
                        }
                    }
                },50);

            }).mouseout(function (e) {
                self.hoverWidget = false;
                clearInterval(timerCheckClickToLikeButton);
            });

            return false;
    };

    /**
     * Устанавливает счетчик для кнопки
     * @return void
     */
    button.setGroupCounter = function() {
		var self = this;
        if( this.buttonCounterBuffer )
            this.buttonCounter.text( this.minimalizeLargeNum(this.buttonCounterBuffer) );

		if( !self.options.clickja || (self.options.clickja && self.vkUserId) ) {
			this.options.counter && this.buttonCounter.addClass( 'onp-sl-show' );
			this.button.addClass( 'onp-sl-button-loaded' );
		}

		this.checkAuthUser(function(){
			if( !self.buttonInnerContanier.attr('id') && self.options.clickja && !self.vkUserId ) {
				self.initSubscribeWidget();
			}
		});
    };

    /**
     * Получает количество пользователей в группе или в подписчиках страницы,
     * и обновляет значения счетчика
     * @param callback
     * @return void
     */
    button.updateApiGroupOptions = function( callback ) {
        var self = this;

        self.vkRqApiGetgetByIdConfirm = false;

        if( !this.groupType ) {
            self.vkApiCall('users.get', {
                user_ids: self.options.groupId.replace('@', ''),
                fields: 'followers_count, photo_100'
            }, function (r) {
                self.vkRqApiGetgetByIdConfirm = true;

                if ( r && r.error ) {
                    if( r.error.error_code == 113 ) {
                        self.showError(
							$.pandalocker.lang.errors.subscribeToUserIdNotFound.replace(
								new RegExp("{vk_user_id}",'g'), self.options.groupId
							)
						);
                        return;
                    }

					self.showError(r.error.error_msg);
                    return;
                }
                
                if ( !r || !r.response ) {
					//console.log('%c[Error]: Ошибка при запросе к vk api user.get', "color: red;");
                    self.showError($.pandalocker.lang.errors.invalidVKGroupIdError);
                }
                self.groupInfo = {
                    title:        r.response[0].first_name + ' ' + r.response[0].last_name,
                    image:        r.response[0].photo_100,
                    oid:          parseInt(r.response[0].uid),
                    member_count: parseInt(r.response[0].followers_count)
                };

                self.buttonCounterBuffer = parseInt(r.response[0].followers_count);
                self.options.groupId = parseInt(r.response[0].uid);

                $.pandalocker.tools.setStorage(self.cookieCounterCacheName, JSON.stringify(self.groupInfo), 2);

                self.setGroupCounter();
                callback && callback();
            });
        } else {
            self.vkApiCall('groups.getById', {
                group_id: self.options.groupId,
                fields: 'members_count'
            }, function (r) {
                self.vkRqApiGetgetByIdConfirm = true;

                if ( r && r.error ) {
                    if( r.error.error_code == 100 ) {
                        self.showError(
							$.pandalocker.lang.errors.subscribeToGroupIdNotFound.replace(
								new RegExp("{vk_group_id}",'g'), self.options.groupId
							)
						);
                        return;
                    }

					self.showError(r.error.error_msg);
					return;
                }

                if ( !r || !r.response ) {
					//console.log('%c[Error]: Ошибка при запросе к vk api groups.getById', "color: red;");
                    self.showError( $.pandalocker.lang.errors.invalidVKGroupIdError );
                }

                self.groupInfo = {
                    title:        r.response[0].name,
                    image:        r.response[0].photo_medium,
                    oid:          parseInt(r.response[0].gid),
                    member_count: parseInt(r.response[0].members_count)
                };

                self.buttonCounterBuffer = parseInt(r.response[0].members_count);
                self.options.groupId = parseInt(r.response[0].gid);

                $.pandalocker.tools.setStorage(self.cookieCounterCacheName, JSON.stringify(self.groupInfo), 2);

                self.setGroupCounter();
                callback && callback();
            });
        }

        //Автодозвон если первый раз callback не был выполнен
        var timerVkRqApiGetgetByIdConfirm = setInterval(function(){
            if( !self.vkRqApiGetgetByIdConfirm ) {
                self.updateApiGroupOptions(callback);
                return false;
            }
            clearInterval(timerVkRqApiGetgetByIdConfirm);
        },3000);
    };

    /**
     * Преобразует длинное число счетчика в короткое
     * @param n
     * @returns string
     */
    button.minimalizeLargeNum = function(n) {
        if( n < 1000 ) return n;

        n = n / 1000;
        n = Math.round(n*10)/10

        return n + "k";
    };

    /***
     * Создает кнопку, счетчик и контейнеры
     * @param $holder
     */
    button.renderButton = function( $holder ) {
        var self = this;

        self.button = $('<div class="onp-sl-flat-button-default onp-sl-vk-subscribe-button">'+
        '<div class="onp-sl-flat-button-left-side">' +
        '<i class="onp-sl-flat-button-vk-logo"></i>' +
        '</div>' +
        '<span>' + $.pandalocker.lang.socialButtons.vkSubscribe + '</span></div>').appendTo( $holder );

        self.buttonInnerContanier = $('<div class="onp-sl-vk-wrap-widget-button"></div>');
        self.button.append(self.buttonInnerContanier);

        self.buttonCounter = $( '<div class="onp-sl-flat-button-counter">-</div>');
        self.button.after(self.buttonCounter);

        if( !self.options.appId ) {
            self.showError( $.pandalocker.lang.errors.emptyVKAppIdError );
            return false;
        }

        if( !self.options.accessToken ) {
            self.showError( $.pandalocker.lang.errors.emptyVKAccessTokenError );
            return false;
        }

        if( !self.options.groupId ) {
            self.showError( $.pandalocker.lang.errors.emptyVKGroupIdError );
            return false;
        }

        self.button.click(function () {
            self.showSubscribeWindow();
            return false;
        });

        if( !$.pandalocker.tools.getFromStorage(self.cookieCounterCacheName) ) {
            self.updateApiGroupOptions();
            return false;
        }

        self.setGroupCounter();
    };

    $.pandalocker.controls["social-buttons"]["vk-subscribe"] = button;

})(jQuery);;
/*!
 * Odnoklassniki share button
 * Copyright 2016, OnePress, http://byonepress.com
 */

(function ($) {
    'use strict';

    var button = $.pandalocker.tools.extend( $.pandalocker.entity.socialButton );

    button.name = "ok-share";
    button.sdk = 'ok';

    button._defaults = {
        url: null,
        style: {
            width: 120,
            height: 30,
            st: 'rounded',
            sz: 20,
            ck: 1
        },
        counter: true
    };

    button._extractUrl = function() {
        var URL = this.options.url || this.networkOptions.url || window.location.href;

        if( $.pandalocker.tools.cdmt(URL) == 'cyrillic' ) {
            var arrUrlParts = URL.split("/");
            URL = arrUrlParts[0] + '//' + punycode.toASCII($.pandalocker.tools.ncdn(arrUrlParts[2]));
        }

        return $.pandalocker.tools.URL.normalize(URL);
    };

    button.prepareOptions = function() {
        this.url = this._extractUrl();

        if ( "vertical" === this.groupOptions.layout ) {
            this.options.style.vt = 1;
            this.options.style.width = 70;
            this.options.style.height = 50;
        }

        this.options.counter = "vertical" === this.groupOptions.layout ? true : this.groupOptions.counters;
    };

    button.verification = {
        container: 'iframe',
        timeout: 10000
    };

    button.setupEvents = function () {};

    button.onShare = function(e) {
        if (!e.originalEvent.origin || e.originalEvent.origin.indexOf('ok') === -1) return;
        var args = e.originalEvent.data.split("$");

        if (args[0] === "ok_shared") {
            this.unlock("button", this.name, this.url );
        }
    };

    button.renderButton = function( $holder ) {
        var self = this;
        var uniqueID = "onp-sl-ok-share-" + Math.floor((Math.random() * 999999) + 1);

        self.button = $('<div></div>').appendTo($holder);
        self.button.attr('id', uniqueID);

        if ( !this.options.counter ) {
            self.options.style.width = 70;
            self.options.style.nc = 1;
        }

        var checkFrameTimer = setInterval(function () {
            if ($("#" + uniqueID).length) {
                window.OK.CONNECT.insertShareWidget(uniqueID, self.url, JSON.stringify(self.options.style));
                clearInterval(checkFrameTimer);
                return false;
            }
        }, 1000);


        $(window).on('message onmessage',  function(e){
            self.onShare(e);
        });
    };

    $.pandalocker.controls["social-buttons"]["ok-share"] = button;

})(jQuery);;
/*!
 * Mail share button
 * Copyright 2016, OnePress, http://byonepress.com
 */

(function ($) {
    'use strict';

    if( !$.pandalocker.mail_share )
        $.pandalocker.mail_share = {};

    var button = $.pandalocker.tools.extend( $.pandalocker.entity.socialButton );

    button.name = "mail-share";
    button.sdk = 'mail';
    button.buttonCounterBuffer = 0;
    button.taskcheckShared = 0;
    button.useButtonFrameId = null;

    button._defaults = {
        pageUrl: null,
        pageTitle: null,
        pageDescription: null,
        pageImage: null,
        counter: true,
        clickja: true
    };

    /**
     * The funtions which returns an URL to like/share for the button.
     * Uses the options and a current location to determine the URL.
     */
    button._extractUrl = function() {
        var URL = this.options.pageUrl || this.networkOptions.url || window.location.href;

        if( $.pandalocker.tools.cdmt(URL) == 'cyrillic' ) {
            var arrUrlParts = URL.split("/");
            URL = arrUrlParts[0] + '//' + punycode.toASCII($.pandalocker.tools.ncdn(arrUrlParts[2]));
        }

        return $.pandalocker.tools.URL.normalize(URL);
    };

    button.prepareOptions = function() {
        //Отключаем кликджекинг для яндекс браузера
        if( $.pandalocker.browser && $.pandalocker.browser.YaBrowser )
            this.options.clickja = false;

        this.url = this._extractUrl();
        this.options.counter = "vertical" === this.groupOptions.layout ? true : this.groupOptions.counters;
    };

    button.verification = {
        container: '.onp-sl-button-loaded',
        timeout: 5000
    };

    button.setupEvents = function () {
        var self = this;

        /*$(document).bind('opn-sl-mail-share', function (e, frameId) {
            if( !frameId ) return;
            var compareUrl = $('#' + frameId).closest('.onp-sl-social-button').data('url');
            if ( self.url !== $.pandalocker.tools.URL.normalize( compareUrl ) ) return;
            self.unlock("button", self.name, self.url );
        });*/
    };

    /**
     * Создает окно репоста страницы, в этом же методе происходит прослушивание на закрытие окна
     * @return void
     */
    button.showShareWindow = function() {
        var self = this;

        var additionalOptions = ( self.options.pageTitle ? "&title=" + encodeURIComponent(self.options.pageTitle) : '' ) +
            ( self.options.pageDescription ? "&description=" + encodeURIComponent(self.options.pageDescription) : '' ) +
            ( self.options.pageImage ? "&image_url=" + self.options.pageImage : '' );

        var width = 550;
        var height = 420;

        var x = screen.width ? (screen.width/2 - width/2 + $.pandalocker.tools.findLeftWindowBoundry()) : 0;
        var y = screen.height ? (screen.height/2 - height/2 + $.pandalocker.tools.findTopWindowBoundry()) : 0;

        var winref = window.open(
            "//connect.mail.ru/share?url=" + encodeURIComponent(self.url) + additionalOptions,
            "Sociallocker",
            "width=" + width + ",height=" + height + ",left=" + x + ",top=" + y + ",resizable=yes,scrollbars=yes,status=yes"
        );

        // waiting until the window is closed
        var timerInterationCount = 0,
            pollTimer = setInterval( function () {
                if ( !winref || winref.closed !== false ) {
                    clearInterval( pollTimer );
                    self.checkShared();
                }

                timerInterationCount++;
                if( timerInterationCount <= 1 )
                    self.locker._showScreen('data-processing'/*, {
                        screenText: 'Идет обработка данных, пожалуйста, подождите...<br><em>Если всплывающее окно не закрылось автоматически, сделайте это вручную!</em>'
                    }*/);

            }, 200 );
    };

    /***
     * Проверяет поделился ли пользователь страницой или нет.
     * Проверка выполняется с помощью прослушивания счетчика,
     * если счетчик изменился, мы можем быть уверены, что это правда.
     * @returns void
     */
    button.checkShared = function(callback) {
        var self = this;
        self.getShareCounterScripts(function(count){

            if ( self.buttonCounterBuffer < count ) {
                self.unlock("button", self.name, self.url );
                self.taskcheckShared = 0;
                self.buttonCounterBuffer = count;
                callback && callback('success');
                return false;
            }

            setTimeout( function () {
                if ( self.taskcheckShared > 3 ) {
                    self.taskcheckShared = 0;

                    var localizePrompt = {
                        textMessage: $.pandalocker.lang.notUnlockPromptText,
                        textButtonYes: $.pandalocker.lang.notUnlockPromptButtonYes,
                        textButtonNo: $.pandalocker.lang.notUnlockPromptButtonNo
                        /*callbackScreenLoad: function(e) {

                            var button = e.find( '.onp-sl-prompt-button-yes');
                            button.wrapInner('<span></span>');
                            var mailButtonWidgetWrap = $('<div class="onp-sl-mail-button-widget"></div>');
                            mailButtonWidgetWrap.data('url', self.url);
                            button.append(mailButtonWidgetWrap);

                            var additionalOptions = ( self.options.pageTitle ? "&title=" + encodeURIComponent(self.options.pageTitle) : '' ) +
                                ( self.options.pageDescription ? "&description=" + encodeURIComponent(self.options.pageDescription) : '' ) +
                                ( self.options.pageImage ? "&imageurl=" + self.options.pageImage : '' );

                            var mailWidgetLink = $('<a target="_blank" class="mrc__plugin_uber_like_button" href="http://connect.mail.ru/share?url=' + encodeURIComponent(self.url) + additionalOptions +'" data-mrc-config="{\'cm\' : \'2\', \'sz\' : \'30\', \'st\' : \'3\', \'tp\' : \'mm\'}">Нравится</a>');

                            var defaultButtonData = {
                                cm: '2',
                                sz: '30',
                                st: '3',
                                tp: 'mm'
                            };

                            mailButtonWidgetWrap.attr('data-mrc-config', JSON.stringify(defaultButtonData));
                            mailButtonWidgetWrap.append(mailWidgetLink);


                            mailru && mailru.loader && mailru.loader.require('api', function(){
                                mailru.plugin.init();
                            });

                            var checker = function(e){
                                if ( !e && !e.data ) return;

                                if( typeof e.data === "string" && e.data.indexOf('event=plugin.liked') !== -1 ) {
                                    var re = /wid%3D([0-9]+)/i;
                                    var currentWidgetFrameId = e.data.match(re);
                                    self.useButtonFrameId = currentWidgetFrameId[1];

                                    var promptBox = $('#' + currentWidgetFrameId[1]).closest('.onp-sl-prompt');

                                    promptBox.find('.onp-sl-prompt-text').html($.pandalocker.lang.mailRepostConfirmPromptText);
                                    promptBox.find('.onp-sl-prompt-button-yes > span').text($.pandalocker.lang.mailRepostConfirmPromptProcessButtonYes);
                                    promptBox.find('.onp-sl-prompt-button-no').hide();
                                }

                                if( typeof e.data === "string" && e.data.indexOf('event=plugin.closeComment') !== -1 ) {

                                    var compareUrl = $('#' + self.useButtonFrameId).closest('.onp-sl-mail-button-widget').data('url');
                                    if ( self.url !== $.pandalocker.tools.URL.normalize( compareUrl ) ) return;
                                    self.unlock("button", self.name, self.url );
                                }

                                if( typeof e.data === "string" && e.data.indexOf('event=plugin.unliked') !== -1 ) {
                                    var re = /wid%3D([0-9]+)/i;
                                    var currentWidgetFrameId = e.data.match(re);
                                    var promptBox = $('#' + currentWidgetFrameId[1]).closest('.onp-sl-prompt');

                                    promptBox.find('.onp-sl-prompt-text').html($.pandalocker.lang.mailRepostConfirmPromptText);
                                    promptBox.find('.onp-sl-prompt-button-yes > span').text($.pandalocker.lang.mailRepostConfirmPromptButtonYes);
                                    promptBox.find('.onp-sl-prompt-button-no').hide();
                                }
                            };

                            window.addEventListener
                                ? window.addEventListener("message", checker, !1)
                                : window.attachEvent("onmessage", checker);
                        }*/
                    };

                    callback && callback('fail', localizePrompt);

                    /*if( self.options.clickja ) {
                        self.locker._showScreen('prompt', localizePrompt);
                        return false;
                    }*/

                    self.locker._showScreen('prompt', {
                        textMessage: $.pandalocker.lang.mailCanNotOpenLockerPromptText,
                        textButtonNo: $.pandalocker.lang.mailCanNotOpenLockerPromptButtonNo
                    });

                    //console.log('fail');
                    return false;
                }

                self.checkShared();
                self.taskcheckShared++;
            }, 1500 );
        });
    };

    /**
     * Устанавливает счетчик
     * @return void
    */
    button.setButtonCounter = function(count) {
        this.buttonCounter.text( this.minimalizeLargeNum( count ) );
        this.options.counter && this.buttonCounter.addClass( 'onp-sl-show' );
        this.button.addClass( 'onp-sl-button-loaded');
    };

    /**
     * Обновляет счетчик и буферизует его
     * @param callback
     * @return void
     */
    button.updateCounter = function() {
        var self = this;
        this.getShareCounterScripts(function(count){
            self.buttonCounterBuffer = count;
            self.setButtonCounter(count);
        });
    };

    /**
     * Получает скрипт счетчика вконтакте
     * @param inx
     * @param url
     * @param callback
     * @returns void
     */
    button.getShareCounterScripts = function ( callback ) {
        var self = this;
        $.getJSON('//connect.mail.ru/share_count?url_list=' + encodeURIComponent(self.url) + '&callback=1&func=?', function (data, textStatus) {
            var url = ($.pandalocker.tools.cdmt(self.url) == 'cyrillic') ? punycode.toASCII( $.pandalocker.tools.ncdn(self.url) ) : self.url;
            var shares = data && data[url] && data[url].shares || "0";
            callback && callback(shares);
        });
    };

    /**
     * Преобразует длинное число счетчика в короткое
     * @param n
     * @returns string
     */
    button.minimalizeLargeNum = function ( n ) {
        if ( n < 1000 ) return n;

        n = n / 1000;
        n = Math.round( n * 10 ) / 10

        return n + "k";
    };

    button.renderButton = function( $holder ) {
        var self = this;

        self.button = $('<div class="onp-sl-flat-button-default onp-sl-mail-share-button">'+
            '<div class="onp-sl-flat-button-left-side">' +
            '<i class="onp-sl-mail-share-logo"></i>' +
            '</div>' +
            '<span>' + $.pandalocker.lang.socialButtons.vkShare + '</span>'+
            '</div>'
        ).appendTo( $holder );

        self.buttonCounter = $( '<div class="onp-sl-flat-button-counter">-</div>');
        self.button.after(self.buttonCounter);

        self.button.click(function(){
            self.updateCounter();
            self.showShareWindow();
        });

        self.updateCounter();
    };

    $.pandalocker.controls["social-buttons"]["mail-share"] = button;

})(jQuery);;
(function($){
    'use strict';
    
    var group = $.pandalocker.tools.extend( $.pandalocker.entity.group );

    /**
     * Default options.
     */
    group._defaults = {
             
        // the default order of the buttons
        order: ["facebook", "twitter", "google"],

        // Facebook Options
        facebook: {
            
            // sdk version to load (v1.0, v2.0)
            version: 'v2.5'
        },

        // Twitter Options
        twitter: {},

        // Google Options
        google: {},   
 
        // LinkedIn Options
        linkedin: {}
    };

    /**
     * The name of the group.
     */
    group.name = "connect-buttons";
    
    group.setup = function() {
        var self = this;
        
        if ( !this.isFirst ) {
            this.options.text.message =  this.options.text.message || $.pandalocker.lang.connectButtons.defaultMessage ;
            this.options.text.message = $.pandalocker.tools.normilizeHtmlOption ( this.options.text.message );
        } 
    };
    
    $.pandalocker.groups["connect-buttons"] = group;
    
})(jQuery);;
(function($){
    'use strict';

    var button = $.pandalocker.tools.extend( $.pandalocker.entity.actionControl );
    
    /**
     * The main control tag.
     */
    button.tag = '<a href="#"></a>';

    /**
     * Shows the control in the specified holder.
     */
    button.render = function( $holder ) {
        var self = this;
        this.sdk = this.sdk || this.name;
        
        this.control.addClass('onp-sl-button');
        
        this.icon = $("<div class='onp-sl-icon'></div>");
        this.icon.appendTo( $holder );
        
        this.container = $("<div class='onp-sl-connect-button onp-sl-social-button-" + this.name + "'></div>");
        this.container.appendTo( $holder );

        if ( !this._hasError() ) {
            
            this._lockLoadingState();
            
            var render = function() {
              
                var sdkResult = self.requireSdk( self.sdk, self.options );

                // error fired
                sdkResult.fail(function( error ){
                    self._unlockLoadingState();
                    self.showError( error );
                });

                sdkResult.done(function(){
                    if ( self.setupEvents ) self.setupEvents();
                    self.renderButton( self.container );
                });
            };
            
            if ( this.locker.options.lazy ) {

                this.addHook('raw-impress', function(){
                    
                    if ( self._rendered ) return;
                    self._rendered = true;
                    render();
                })
            } else {
                render();
            }
        }
 
        this.handleClick();
        this._checkWaitingSubscription();
    };
    
    button.processButtonTitle = function( template, name ) {
        var title = template.replace('{long}', $.pandalocker.lang.signin_long);
        title = title.replace('{short}', $.pandalocker.lang.signin_short);
        title = title.replace('{name}', name);
        return title;
    };
    
    /**
     * Handles a click on the connect button.
     */
    button.handleClick = function() {
        var self = this;

        this.control.click(function(){
            self.runHook('raw-interaction');

            if ( self._hasError() || self._isLoading() ) return;
            
            self.connect( function( identityData, serviceData ){
                self.runActions( identityData, serviceData, true );
            });
            
            return false;
        });
    };
    
    button._lockLoadingState = function() {
        this._setLoadingState('connect-button');
    };
    
    button._unlockLoadingState = function() {
        this._removeLoadingState('connect-button');
    };

    /**
     * This method should be overwritten.
     */
    button.connect = function() {
        throw new Error("The control should implement the method 'connect'"); 
    };

    /**
     * Returns an indentity for the state storage.
     */
    button._getStorageIdentity = function() {
        return "opanda_" + $.pandalocker.tools.hash(this.name) + "_hash_" + this.name;
    };

    $.pandalocker.entity.connectButton = button;
    
})(jQuery);;
/*
 * Facebook Connect
 * Copyright 2014, OnePress, http://byonepress.com
*/
(function ($) {
    'use strict';

    var button = $.pandalocker.tools.extend( $.pandalocker.entity.connectButton );

    /**
     * The button name.
     */
    button.name = "facebook";

    /**
     * The dafault options.
     */
    button._defaults = {

    };
    
    /**
     * Prepares options before starting usage of the button.
     */
    button.prepareOptions = function() {
        
        this.permissions = ['public_profile', 'email'];

        // permissions which have not been yet granted (including the declined)
        this.restPermissions = this.permissions;
        
        // permissions which were declined
        this.declinedPermissions = [];
    };

    /**
     * Renders the button.
     */
    button.renderButton = function( $holder ) {
        var self = this;
        
        var longText = this.processButtonTitle(this.lang.viaSignInLong, $.pandalocker.lang.signin_facebook_name);
        var shortText = this.processButtonTitle(this.lang.viaSignInShort, $.pandalocker.lang.signin_facebook_name);
        
        this.longTitle = $("<span class='onp-sl-long'>" + longText + "</span>").appendTo( $holder );
        this.shortTtle = $("<span class='onp-sl-short'>" + shortText + "</span>").appendTo( $holder );
        
        var loadingTimeout = this.groupOptions.loadingTimeout || 20000;
        var theAppIsValid = false;
        
        setTimeout(function(){
            if ( theAppIsValid ) return;
            self.showError( $.pandalocker.lang.errors.invlidFacebookAppId ); 
        }, loadingTimeout);
        
        this._getLoginStatus(function(){
            theAppIsValid = true;
            self._unlockLoadingState();
        });
    };

    /**
     * Connects the user via Faceboook.
     */
    button.connect = function( callback ) {
        var self = this;
        
        // the user is already connected and granted all the needed permissions
        if ( 'connected' === self._status && !this.restPermissions.length ) {
            return this._identify( function( identityData ){
                callback( identityData, self._serviceData );
            });
        };

        // sets the permissions we need to ask
        var requestOptions = {
            scope: self.restPermissions.join(',')
        };
        
        // if some of permissions were declined, ask for them again
        if ( self.declinedPermissions.length > 0 ) {
            requestOptions.auth_type = 'rerequest';
        }
        
        var loggedIn = false;
        
        self._trackWindow('facebook.com/dialog/oauth', function(){
            
            setTimeout( function(){
                if ( loggedIn ) return;
                
                self.runHook('raw-social-app-declined');
                self.showNotice($.pandalocker.lang.errors_not_signed_in);
            }, 500);
        });

        // try to login if the user is not connected yet
        FB.login(function( response ) {
            loggedIn = true;
            
            self._checkPermissions( response, function(){
                
                // shows a message that the user are not authorized the app
                if ( 'connected' !== self._status ) {
                    self.runHook('raw-social-app-declined');
                    
                    self.showNotice($.pandalocker.lang.errors_not_signed_in);
                    return;
                }
                
                // shows a message that the user has not granted all the permissions required
                if ( self.restPermissions.length ) {
                    self.runHook('raw-social-app-declined');
                    
                    self.showNotice( 
                        $.pandalocker.lang.res_errors_not_granted
                            .replace('{permissions}', self.restPermissions.join(', '))
                    );
                    return;
                };
     
                return self._identify( function( identityData ){
                    callback( identityData, self._serviceData );
                });
            });
        }, requestOptions);
    };
    
    /**
     * Gets the current login status, including permissions.
     */
    button._getLoginStatus = function( onComplete ) {
        var self = this;
        
        FB.getLoginStatus(function( response ) {
            self._checkPermissions( response, onComplete );
        });
    };
    
    /**
     * Checks which permissions should be granted.
     */
    button._checkPermissions = function( response, onComplete ) {
        var self = this;
        
        this._status = response.status;  
        this._serviceData = response;
        
        if ( !response || 'connected' !== this._status ) {
            if ( onComplete ) onComplete();
            return;
        };

        FB.api('/me/permissions', function(response) {
            if ( !response || !response.data ) return;
            
            // new format
            if ( response.data[0] && !response.data[0].permission && !response.data[0].status ) {

                var granted = [];
                var declined = [];

                for(var perm in response.data[0]) {

                    if ( response.data[0][perm] ) {
                            granted.push(perm);
                    } else {
                            declined.push(perm);
                    }
                }

            // old format
            } else {

                var declined = $.grep( response.data, function( a ) { return a.status !== 'granted'; });
                var granted = $.grep( response.data, function( a ) { return a.status == 'granted'; });

                declined = $.map( declined, function( n, i ) { return n.permission; });
                granted = $.map( granted, function( n, i ) { return n.permission; });
            }
            
            self.restPermissions = $.pandalocker.tools.diffArrays( self.permissions, granted );
            self.declinedPermissions = $.pandalocker.tools.unionArrays( self.restPermissions, declined );
            
            if ( onComplete ) onComplete();
        });
    };

    /**
     * Identify the user.
     */
    button._identify = function( callback ) {
        
        FB.api('/me?fields=email,first_name,last_name,gender,link', function( data ) {

            var identity = {};
            if ( !data ) return callback( identity );
            
            identity.source = "facebook";
            identity.email = data.email;
            identity.displayName = data.first_name + " " + data.last_name;
            identity.name = data.first_name;
            identity.family = data.last_name;
            identity.gender = data.gender;
            identity.facebookUrl = data.link;
            identity.image = 'https://graph.facebook.com/' + data.id + '/picture?type=large';
            identity.social = true;
            
            callback( identity );
        });
    };

    // ----------------------------------------------------------------
    // Actions linked with connection
    // ----------------------------------------------------------------

    $.pandalocker.controls["connect-buttons"]["facebook"] = button;
    
})(jQuery);;
/*
 * Facebook Connect
 * Copyright 2014, OnePress, http://byonepress.com
*/
(function ($) {
    'use strict';

    var button = $.pandalocker.tools.extend( $.pandalocker.entity.connectButton );

    /**
     * The button name.
     */
    button.name = "google";
    
    /**
     * The SDK name to load.
     */
    button.sdk = 'google-client';

    /**
     * The dafault options.
     */
    button._defaults = {

    };
    
    /**
     * Prepares options before starting usage of the button.
     */
    button.prepareOptions = function() {
        
        if ( !this.options.clientId ) {
            this.showError( $.pandalocker.lang.connectButtons.google.clientIdMissed );
            return;
        }
        
        this.permissions = ['https://www.googleapis.com/auth/userinfo.profile'];
        this.permissions.push( 'https://www.googleapis.com/auth/userinfo.email' );
        
        if ( $.inArray( 'youtube-subscribe', this.options.actions ) !== -1 ) {
            this.permissions.push( 'https://www.googleapis.com/auth/youtube' );

            if ( !this.options.youtubeSubscribe || !this.options.youtubeSubscribe.channelId ) {
                return this.showError( $.pandalocker.lang.connectButtons.errorYouTubeChannelMissed );
            }
        }        
        
        // permissions which have not been yet granted (including the declined)
        this.restPermissions = this.permissions;
        
        // permissions which were declined
        this.declinedPermissions = [];
    };

    /**
     * Renders the button.
     */
    button.renderButton = function( $holder ) {
        
        var longText = this.processButtonTitle(this.lang.viaSignInLong, $.pandalocker.lang.signin_google_name);
        var shortText = this.processButtonTitle(this.lang.viaSignInShort, $.pandalocker.lang.signin_google_name);
        
        this.longTitle = $("<span class='onp-sl-long'>" + longText + "</span>").appendTo( $holder );
        this.shortTtle = $("<span class='onp-sl-short'>" + shortText + "</span>").appendTo( $holder );

        this._unlockLoadingState();
    };

    /**
     * Connects the user via Faceboook.
     */
    button.connect = function( callback ) {
        var self = this;
        var loggedIn = false;

        // sets the permissions we need to ask
        var requestOptions = {
            callback: function( response ){

                if ( 'immediate_failed' === response.error ) return;
                loggedIn = true;
                
                if ( !response || !response['status']['signed_in'] ) {
                    self.runHook('raw-social-app-declined');
                    
                    self.showNotice($.pandalocker.lang.errors_not_signed_in);
                    return;
                }

                return self._identify( function( type, result ){

                    if ( 'error' === type ) {
                        self.showNotice( $.pandalocker.lang.connectButtons.google.unexpectedError.replace('{0}', result ));
                        return;
                    }

                    callback( result, response );
                }); 
            }
        };
        
        requestOptions.clientid = this.options.clientId;
        requestOptions.cookiepolicy = 'single_host_origin';
        requestOptions.scope = this.permissions.join(' ');

        if ( this.options.share ) {
            var activityType = $.pandalocker.tools.capitaliseFirstLetter( this.options.share.type || 'add' );
            requestOptions.requestvisibleactions = 'http://schema.org/' + activityType + 'Action';
        }

        self._trackWindow('google.com/o/oauth2', function(){
            
            setTimeout( function(){
                if ( loggedIn ) return;
                
                self.runHook('raw-social-app-declined');
                self.showNotice($.pandalocker.lang.errors_not_signed_in);
            }, 500);
        });

        console.log(requestOptions);
        gapi.auth.signIn(requestOptions);
    };

    /**
     * Identify the user.
     */
    button._identify = function( callback ) {

        gapi.client.load('plus', 'v1').then(function(){
            
            gapi.client.plus.people.get({
                'userId': 'me'
            }).then(function(data) {

                var identity = {};
                if ( !data || !data.result ) return callback( 'error', identity );
                
                identity.source = "google";
                identity.email = data.result.emails && data.result.emails[0] && data.result.emails[0].value;
                identity.displayName = data.result.displayName;
                identity.name = data.result.name && data.result.name.givenName;
                identity.family = data.result.name && data.result.name.familyName;
                identity.gender = data.result.gender;
                identity.googleUrl = data.result.url;
                identity.social = true;
            
                if ( data.result.image && data.result.image.url ) {
                    identity.image = data.result.image.url.replace(/\?sz=\d+/gi, '');
                }

                callback( 'success', identity );
                
            }, function(reason) {
                callback( 'error', reason.result.error.message );
            });            
        });
    };
    
    button.runYoutubeSubscribeAction = function( identityData, serviceData, actionOptions, changeScreen, callback ) {
        var self = this;
        
        gapi.client.load('youtube', 'v3', function() {

            var request = gapi.client.youtube.subscriptions.insert({
                 part: 'snippet',
                 resource: {
                     snippet: {
                         resourceId: {
                             kind: 'youtube#channel',
                             channelId: self.options.youtubeSubscribe.channelId
                         }
                     }
                 }
            });

            request.execute(function(response) {
                
                if ( response && response.error ) {
                    
                    // ignores if the user is already subscribed
                    if ( response.error.data && response.error.data[0] && response.error.data[0].reason === "subscriptionDuplicate" ) {
                        callback();
                        return;
                    }
                    
                    console && console.log && console.log(response);
                    self.showError( response.error.message );
                    callback('error');
                       
                    return;
                }
           
                self.runHook('got-youtube-subscriber', [response]);
                callback();
            });
           
        });
    };
    
    // ----------------------------------------------------------------
    // Actions linked with connection
    // ----------------------------------------------------------------

    $.pandalocker.controls["connect-buttons"]["google"] = button;
    
})(jQuery);;
/*
 * Facebook Twitter
 * Copyright 2014, OnePress, http://byonepress.com
*/
(function ($) {
    'use strict';

    var button = $.pandalocker.tools.extend( $.pandalocker.entity.connectButton );

    /**
     * The button name.
     */
    button.name = "twitter";

    /**
     * The dafault options.
     */
    button._defaults = {

    };
    
    /**
     * Renders the button.
     */
    button.prepareOptions = function( $holder ) {
        
        if ( !this.options.proxy ) {
            this.showError( $.pandalocker.lang.connectButtons.twitter.proxyEmpty );
            return;
        }

	    console.log(this.options.actions);
        
        if ( $.inArray( 'follow', this.options.actions ) !== -1 ) {

            if ( !this.options.follow || !this.options.follow.user ) {
                return this.showError( $.pandalocker.lang.connectButtons.errorTwitterUserMissed );
            }
        }    
        
        if ( $.inArray( 'tweet', this.options.actions ) !== -1 ) {
    
            if ( !this.options.tweet || !this.options.tweet.message ) {
                return this.showError( $.pandalocker.lang.connectButtons.errorTwitterMessageMissed );
            }  
        }
    }; 
        
    /**
     * Renders the button.
     */
    button.renderButton = function( $holder ) {
        var self = this;
        
        var longText = this.processButtonTitle(this.lang.viaSignInLong, $.pandalocker.lang.signin_twitter_name);
        var shortText = this.processButtonTitle(this.lang.viaSignInShort, $.pandalocker.lang.signin_twitter_name);
        
        this.longTitle = $("<span class='onp-sl-long'>" + longText + "</span>").appendTo( $holder );
        this.shortTtle = $("<span class='onp-sl-short'>" + shortText + "</span>").appendTo( $holder );
        
        self._unlockLoadingState();
    };

    /**
     * Connects the user via Faceboook.
     */
    button.connect = function( callback ) {
        var self = this;
        
        if ( $.pandalocker.data.twitterOAuthReady ) {
            
            this._identify( function( identityData ){
                callback( identityData, self._getServiceData() );
            });
            
        } else {
            
            // The fix for the issue #BIZ-41:
            // removes the proxy URL from the options because it fires the errors on some website
            
            var optionsToPass = $.extend( true, {}, self.options );
            delete optionsToPass['proxy'];
            
            var dataToSend = {
                'opandaHandler': 'twitter',
                'opandaRequestType': 'init',
                'opandaTwitterOptions': JSON.stringify( optionsToPass )
            };

            var visitorId = $.pandalocker.tools.cookie( 'opanda_twid' );
            if ( visitorId && visitorId !== 'null' ) dataToSend['opandaVisitorId'] = visitorId;
            
            var url = self.options.proxy;
            
            for ( var prop in dataToSend ) {
                if ( !dataToSend.hasOwnProperty(prop) ) continue;
                url = $.pandalocker.tools.updateQueryStringParameter( url, prop, dataToSend[prop] );
            }
            
            self._trackWindow('opandaHandler=twitter', function(){

                setTimeout( function(){
                    if ( $.pandalocker.data.twitterOAuthReady ) return;

                    self.runHook('raw-social-app-declined');
                    self.showNotice( $.pandalocker.lang.errors_not_signed_in );
                }, 500);
            });

            var apiTwitterAuth = window.open( url,
                "Twitter Sign-In",
                "width=500,height=450,resizable=yes,scrollbars=yes,status=yes"
            );

            window.OPanda_TwitterOAuthCompleted = function( visitorId ){

                $.pandalocker.data.twitterOAuthReady = true;
                self._saveVisitorId( visitorId );
                self.connect( callback );
            };
            
             window.OPanda_TwitterOAuthDenied = function( visitorId ){

                self.runHook('raw-social-app-declined');
                self.showNotice( $.pandalocker.lang.errors_not_signed_in );
                self._saveVisitorId( visitorId );
            };           
        }
    };
    
    /**
     * Saves a visitor ID.
     */
    button._saveVisitorId = function( visitorId ) {
        
        this._visitorId = visitorId;
        $.pandalocker.tools.cookie( 'opanda_twid', visitorId, { expires: 1000, path: "/" } );
    };
    
    /**
     * Puts together service data required for the future requests.
     */
    button._getServiceData = function() {
        var self = this;
        return { visitorId: self._visitorId };
    };
    
    /**
     * Identify the user.
     */
    button._identify = function( callback ) {
        var self = this;
        
        var req = $.ajax({
            type: "POST",
            dataType: "json",
            url: self.options.proxy,
            data: {
                'opandaHandler': 'twitter',
                'opandaRequestType': 'user_info',
                'opandaVisitorId': self._visitorId
            },
            success: function(data){

                if ( ( !data || data.error || data.errors ) && console && console.log ) {
                    console.log( 'Unable to get the user data: ' + req.responseText );   
                }
                
                var identity = {};
                if ( !data ) return callback( identity );
     
                if ( data.name ) {
                    var parts = data.name.split(' ', 2);
                    if ( parts.length === 2 ) {
                        identity.name = parts[0];
                        identity.family = parts[1];   
                    } else {
                        identity.name = data.name; 
                    }
                } else {
                    identity.name = data.name;   
                }
                
                identity.source = "twitter";
                identity.email = data.email;
                identity.displayName = data.screen_name;
                identity.twitterUrl = 'https://twitter.com/' + data.screen_name;
                
                if ( data.profile_image_url ) {
                    identity.image = data.profile_image_url.replace('_normal', '');
                }
                
                callback( identity );
            },
            error: function() {
                console && console.log && console.log( 'Unable to get the user data: ' + req.responseText );
                callback( {} );
            }
        });
    };
    
    /**
     * Runs the Follow action.
     */
    button.runFollowAction = function( identityData, serviceData, actionOptions, changeScreen, callback ) {
        var self = this;
        
        var dataToPass = {
            'opandaHandler': 'twitter',
            'opandaRequestType': 'follow',
            'opandaVisitorId': self._visitorId,
            'opandaFollowTo': actionOptions.user,
            'opandaNotifications': actionOptions.notifications,               
        };
            
        dataToPass = $.pandalocker.filters.run(self.locker.id + '.ajax-data', [dataToPass]);   
        dataToPass = $.pandalocker.filters.run(self.locker.id + '.twitter-follow.ajax-data', [dataToPass]); 
        
        var req = $.ajax({
            type: "POST",
            dataType: "json",
            url: self.options.proxy,
            data: dataToPass
        });
        
        req.success(function( data ){
            
            if ( ( !data || data.error || data.errors ) && console && console.log ) {
                console.log( 'Unable to follow: ' + req.responseText );   
            }
                
            if ( data && data.error ) {
                self.showScreen('default');
                self.showNotice('Unable to perform the follow action due to the error: ' + data.error);
                return;
            }
            
            callback();
        });
        
        req.error(function(){
            
            self.showScreen('default');
            self.showNotice('Unable to perform the follow action due to the unexpected error. See the logs for more details.');
            console && console.log && console.log( 'Unable to follow: ' + req.responseText );
        });   
    };
    
    /**
     * Runs the Tweet action.
     */
    button.runTweetAction = function( identityData, serviceData, actionOptions, changeScreen, callback ) {
        var self = this;
        
        var dataToPass = {
            'opandaHandler': 'twitter',
            'opandaRequestType': 'tweet',
            'opandaVisitorId': self._visitorId,
            'opandaTweetMessage': actionOptions.message
        };
            
        dataToPass = $.pandalocker.filters.run(self.locker.id + '.ajax-data', [dataToPass]);   
        dataToPass = $.pandalocker.filters.run(self.locker.id + '.twitter-tweet.ajax-data', [dataToPass]); 
        
        var req = $.ajax({
            type: "POST",
            dataType: "json",
            url: self.options.proxy,
            data: dataToPass
        });
        
        req.success(function( data ){
            
            if ( ( !data || data.error || data.errors ) && console && console.log ) {
                console.log( 'Unable to tweet: ' + req.responseText );   
            }
            
            if ( data && data.error ) {
                
                self.showScreen('default');
                self.showNotice('Unable to perform the tweet action due to the error: ' + data.error);
                return;
            }
            
            callback();
        });
        
        req.error(function(){
            
            self.showScreen('default');
            self.showNotice('Unable to perform the tweet action due to the unexpected error. See the logs for more details.');
            console && console.log && console.log( 'Unable to follow: ' + req.responseText );
        });   
    };
    
    $.pandalocker.controls["connect-buttons"]["twitter"] = button;
    
})(jQuery);;
/*
 * Vk connect
 * Copyright 2016, OnePress, http://byonepress.com
 */
(function ( $ ) {
	'use strict';

	var button = $.pandalocker.tools.extend( $.pandalocker.entity.connectButton );

	/**
	 * The button name.
	 */
	button.name = "vk";

	/**
	 * The dafault options.
	 */
	button._defaults = {};

	/**
	 * Renders the button.
	 */
	button.prepareOptions = function ( $holder ) {

		//Записываем в отладчик
		$.pandalocker.tools.debugger(
			{
				vk: {
					connect: {
						options: this.options
					}
				}
			}
		);

		if ( !this.options.proxy ) {
			this.showError( $.pandalocker.lang.connectButtons.vk.proxyEmpty );
			return;
		}

		if ( !this.options.appId ) {
			this.showError( $.pandalocker.lang.connectButtons.vk.appIdMissed );
			return;
		}

		this.scope = "email";
	};

	button.setupEvents = function () {
		var self = this;

		VK.init(
			{
				apiId: this.options.appId
			}
		);
	}

	/**
	 * Renders the button.
	 */
	button.renderButton = function ( $holder ) {
		var self = this;

		var longText = this.processButtonTitle( this.lang.viaSignInLong, $.pandalocker.lang.signin_vk_name );
		var shortText = this.processButtonTitle( this.lang.viaSignInShort, $.pandalocker.lang.signin_vk_name );

		this.longTitle = $( "<span class='onp-sl-long'>" + longText + "</span>" ).appendTo( $holder );
		this.shortTtle = $( "<span class='onp-sl-short'>" + shortText + "</span>" ).appendTo( $holder );

		self._unlockLoadingState();
	};

	/**
	 * Connects the user via Vk.
	 */
	button.connect = function ( callback ) {
		var self = this;

		if ( $.pandalocker.data.VkOAuthReady ) {

			this._identify(
				function ( identityData ) {
					callback( identityData, self._getServiceData() );
				}
			);

		} else {
			var width = 700;
			var height = 420;

			var x = screen.width ? (screen.width / 2 - width / 2 + $.pandalocker.tools.findLeftWindowBoundry()) : 0;
			var y = screen.height ? (screen.height / 2 - height / 2 + $.pandalocker.tools.findTopWindowBoundry()) : 0;

			var dataToSend = {
				opandaHandler: 'vk'
			};

			var url = self.options.proxy;
			for ( var prop in dataToSend ) {
				if ( !dataToSend.hasOwnProperty( prop ) ) {
					continue;
				}
				url = $.pandalocker.tools.updateQueryStringParameter( url, prop, dataToSend[prop] );
			}

			self._trackWindow(
				'opandaHandler=vk', function () {

					setTimeout(
						function () {
							if ( $.pandalocker.data.VkOAuthReady ) {
								return;
							}

							self.runHook( 'raw-social-app-declined' );
							self.showNotice( $.pandalocker.lang.errors_not_signed_in );
						}, 500
					);
				}
			);

			window.open(
				"//oauth.vk.com/authorize?client_id=" + self.options.appId + "&display=page&redirect_uri=" + url + "&scope=" + self.scope + "&response_type=code&v=5.50",
				"Vkontakte Sign-in",
				"width=" + width + ",height=" + height + ",left=" + x + ",top=" + y + ",resizable=yes,scrollbars=yes,status=yes"
			);

			window.OPanda_VkOAuthCompleted = function ( d ) {
				var requestData = JSON.parse( d );

				$.pandalocker.tools.setStorage( 'onp-sl-vk-buttons-oid', requestData['user_id'], 134 );

				self._accessToken = requestData['access_token'];
				self._uid = requestData['uid'];
				self._email = requestData['email'] ? requestData['email'] : null;

				$.pandalocker.data.VkOAuthReady = true;

				//Записываем в отладчик
				$.pandalocker.tools.debugger(
					{
						vk: {
							connect: {
								OPanda_VkOAuthCompleted: requestData
							}
						}
					}
				);

				self.connect( callback );
			};

			window.OPanda_VkOAuthDenied = function ( d ) {
				var requestData = JSON.parse( d );

				self.runHook( 'raw-social-app-declined' );
				self.showNotice( $.pandalocker.lang.errors_not_signed_in );

				//Записываем в отладчик
				$.pandalocker.tools.debugger(
					{
						vk: {
							connect: {
								OPanda_VkOAuthDenied: requestData
							}
						}
					}
				);
			};
		}
	};

	/**
	 * Puts together service data required for the future requests.
	 */
	button._getServiceData = function () {
		var self = this;
		return {
			accessToken: self._accessToken,
			uid:         self._uid,
			email:       self._email
		};
	};

	/**
	 * Identify the user.
	 */
	button._identify = function ( callback ) {
		var self = this;

		VK.api(
			'users.get', {
				access_token: self._accessToken,
				fields:       'photo_200'
			}, function ( data ) {
				if ( data.response ) {

					var identity = {};

					if ( ( !data || data.error || data.errors ) && console && console.log ) {
						console.log( 'Unable to get the user data: ' + data.error.error_msg );
						callback( identity );
					}

					if ( !data.response[0] ) {
						callback( identity );
					}

					identity.source = "vk";
					identity.email = self._email;
					identity.displayName = data.response[0].first_name + " " + data.response[0].last_name;
					identity.name = data.response[0].first_name;
					identity.family = data.response[0].last_name;
					identity.vkUrl = 'https://vk.com/id' + data.response[0].uid;
					identity.social = true;

					if ( data.response[0] && data.response[0].photo_200 ) {
						identity.image = data.response[0].photo_200;
					}

					//Записываем в отладчик
					$.pandalocker.tools.debugger({
						vk: {
							connect: {
								identity: identity
							}
						}
					});

					callback( identity );
				}
			}
		);
	};

	$.pandalocker.controls["connect-buttons"]["vk"] = button;

})( jQuery );;
/*
 * Facebook LinkedIn
 * Copyright 2014, OnePress, http://byonepress.com
*/
(function ($) {
    'use strict';

    var button = $.pandalocker.tools.extend( $.pandalocker.entity.connectButton );

    /**
     * The button name.
     */
    button.name = "linkedin";
    
    /**
     * The dafault options.
     */
    button._defaults = {

    };
    
    /**
     * Prepares options before starting usage of the button.
     */
    button.prepareOptions = function() {
        
        if ( !this.options.clientId ) {
            this.showError( $.pandalocker.lang.connectButtons.linkedin.clientIdMissed );
            return;
        }     
    };
        
    /**
     * Renders the button.
     */
    button.renderButton = function( $holder ) {
        var self = this;
        
        var longText = this.processButtonTitle(this.lang.viaSignInLong, $.pandalocker.lang.signin_linkedin_name);
        var shortText = this.processButtonTitle(this.lang.viaSignInShort, $.pandalocker.lang.signin_linkedin_name);
        
        this.longTitle = $("<span class='onp-sl-long'>" + longText + "</span>").appendTo( $holder );
        this.shortTtle = $("<span class='onp-sl-short'>" + shortText + "</span>").appendTo( $holder );

        self._unlockLoadingState();
    };
    
    button.connect = function( callback ) {
        var self = this;
        
        if ( $.pandalocker.data.linkedInOAuthReady ) {
            
            this._identify( function( identityData ){
                callback( identityData, self._getServiceData() );
            });
            
        } else {
            
            // The fix for the issue #BIZ-41:
            // removes the proxy URL from the options because it fires the errors on some website
            
            var optionsToPass = $.extend( true, {}, self.options );
            delete optionsToPass['proxy'];
            
            var dataToSend = {
                'opandaHandler': 'linkedin',
                'opandaRequestType': 'init',
                'opandaLinkedinOptions': JSON.stringify( optionsToPass )
            };

            var url = self.options.proxy;
            
            for ( var prop in dataToSend ) {
                if ( !dataToSend.hasOwnProperty(prop) ) continue;
                url = $.pandalocker.tools.updateQueryStringParameter( url, prop, dataToSend[prop] );
            }
            
            self._trackWindow('opandaHandler=linkedin', function(){

                setTimeout( function(){
                    if ( $.pandalocker.data.linkedInOAuthReady ) return;

                    self.runHook('raw-social-app-declined');
                    self.showNotice( $.pandalocker.lang.errors_not_signed_in );
                }, 500);
            });

            var apiLinkedInAuth = window.open( url,
                "LinkedIn Sign-In",
                "width=500,height=450,resizable=yes,scrollbars=yes,status=yes"
            );

            window.OPanda_LinkedInOAuthCompleted = function( accessToken ){

                $.pandalocker.data.linkedInOAuthReady = true;
                self._accessToken = accessToken;
                
                self.connect( callback );
            };
            
             window.OPanda_LinkedInOAuthDenied = function(){

                self.runHook('raw-social-app-declined');
                self.showNotice( $.pandalocker.lang.errors_not_signed_in );
            };           
        }
    };

    /**
     * Puts together service data required for the future requests.
     */
    button._getServiceData = function() {
        var self = this;
        return { accessToken: self._accessToken };
    };
    
    /**
     * Identify the user.
     */
    button._identify = function( callback ) {
        var self = this;

        var req = $.ajax({
            type: "POST",
            dataType: "json",
            url: self.options.proxy,
            data: {
                'opandaHandler': 'linkedin',
                'opandaRequestType': 'user_info',
                'opandaAccessToken': self._accessToken
            },
            success: function(data){
                
                if ( ( !data || data.error || data.errors ) && console && console.log ) {
                    console.log( 'Unable to get the user data: ' + req.responseText );   
                }

                var identity = {};

                if ( !data  ) return callback( identity );

                identity.source = "linkedin";
                identity.email = data.emailAddress;
                identity.displayName = data.firstName + " " + data.lastName;
                identity.name = data.firstName;
                identity.family = data.lastName;
                identity.linkedinUrl = data.publicProfileUrl;            
                identity.social = true;

                if ( data.pictureUrls && data.pictureUrls.values ) {
                    identity.image = data.pictureUrls.values[0];  
                }
                
                callback( identity );
            },
            error: function() {
                console && console.log && console.log( 'Unable to get the user data: ' + req.responseText );
                callback( {} );
            }
        });
    };
    
    $.pandalocker.controls["connect-buttons"]["linkedin"] = button;
    
})(jQuery);;
/*
 * Google Client SDK
 * Copyright 2014, OnePress, http://byonepress.com
*/
(function ($) {
    'use strict';

    if (!$.onepress) $.onepress = {};
    if (!$.pandalocker.sdk) $.pandalocker.sdk = {};

    $.pandalocker.sdk.googleClient = $.pandalocker.sdk.googleClient || {
        
        // a name of a social network
        name: 'google-client',
        // a script to load
        url: '//apis.google.com/js/client:platform.js?onload=OPanda_GoogleClient_Callback',
        // a script id to set
        scriptId: 'google-client-jssdk',
        // a timeout to load
        timeout: 10000,
        
        /**
         * Returns true if an sdk is currently loaded.
         * 
         * @since 1.5.5
         * @returns boolean
         */
        isLoaded: function () {
            return ( window.gapi && typeof (window.gapi.auth) === "object");
        },

        /**
         * Creates a function for Google callbacks.
         */
        prepare: function () {
            var self = this;
            window.OPanda_GoogleClient_Callback = function(){
                $(document).trigger(self.name + "-script-loaded");
            };
        }
    };   
})(jQuery);;
/*
 * LinkedIn SDK Connector
 * Copyright 2014, OnePress, http://byonepress.com
*/
(function ($) {
    'use strict';

    if (!$.onepress) $.onepress = {};
    if (!$.pandalocker.sdk) $.pandalocker.sdk = {};

    $.pandalocker.sdk.linkedinConnect = $.pandalocker.sdk.linkedinConnect || {
        
        // a name of a social network
        name: 'linkedin-connect',
        // a script to load
        url: '//platform.linkedin.com/in.js?async=true',
        // a script id to set
        scriptId: 'linkedin-jssdk',
        // a timeout to load
        timeout: 10000,
        
        /**
         * Returns true if an sdk is currently loaded.
         * 
         * @since 1.5.5
         * @returns boolean
         */
        isLoaded: function () {
            return (typeof (window.IN) === "object");
        },

        /**
         * Creates callback for linkedin.
         * 
         * @since 1.5.5
         * @returns void
         */
        prepare: function () {

            window.OPanda_LinkedinShare_Callback = function (data) {
                $(document).trigger('onp-sl-linkedin-share', [data]);
            };

            // #SLJQ-26: A fix for the LinkedIn button.
            // Saves a link to the current share windlow.
            
            
            /*var funcOpen = window.open;
            window.open = function(url,name,params){
                console.log(name);
                var winref = funcOpen(url,name,params);
                if ( !winref ) return winref;
                
                var windowName = name || winref.name;
                if ( !windowName ) return winref;
                if ( windowName.substring(0,10) !== "easyXDM_IN" ) return winref;
                
                $.pandalocker.sdk.linkedin._activePopup = winref;
            }*/
            
        }, 
        
        /**
         * Creates subscribers for Linkedin evetns.
         * 
         * @returns void
         */
        createEvents: function () {
            var self = this;
            var isLoaded = this.isLoaded();
            
            var load = function () {

                window.IN.init({
                    api_key: self.options.apiKey
                });

                // the initialization is executed only one time.
                // any others attempts will call an empty function.
                window.IN.init = function () { };
                $(document).trigger(self.name + '-init');
            };

            if (isLoaded) { load(); return; }
            
            $(document).bind(self.name + '-script-loaded', function() {
                load();             
            });            
        }
    };

})(jQuery);;
(function($){
    'use strict';
    
    var group = $.pandalocker.tools.extend( $.pandalocker.entity.group );

    /**
     * Default options.
     */
    group._defaults = {
        
        // an order of the buttons
        order: ["form"],
        
        text: $.pandalocker.lang.subscription.defaultText,
        
        separator: {
            type: 'hiding-link',
            title: $.pandalocker.lang.misc_or_enter_email
        }
        
    };

    /**
     * The name of the group.
     */
    group.name = "subscription";
      
    $.pandalocker.groups["subscription"] = group;
    
})(jQuery);;
(function($){
    'use strict';

    var form = $.pandalocker.tools.extend( $.pandalocker.entity.actionControl );
    
    form.name = "form";
    
    /**
     * The dafault options.
     */
    form._defaults = {
        type: 'email-form',
        fields: null,
        unlocksPerPage: false
    };
    
    /**
     * Builds the subscription options and create the subscription service.
     */
    form.setup = function() {
        var self = this;

        if ( !this.options.actions || this.options.actions.length === 0 ) {
            this.options.actions = ['subscribe'];
        }

        $.pandalocker.entity.actionControl.setup.apply( this );

        this.options.requireName = this.options.requireName || 
            ( this.options['subscribe'] && this.options['subscribe'].requireName );
    
        this.advancedValidation = true;

        if ( 'email-form' === this.options.type ) {
            this.advancedValidation = false;
            
            this.options.fields = [{
                'id': 'email',
                'type': 'email',
                'placeholder': $.pandalocker.lang.errors_empty_email,
                'req': true
            }];
        
        } else if ( 'name-email-form' === this.options.type ) {
            this.advancedValidation = true;
            
            this.options.fields = [
                {
                    'id': 'fullname',
                    'type': 'text',
                    'placeholder': $.pandalocker.lang.misc_enter_your_name,
                    'req': true
                },{
                    'id': 'email',
                    'type': 'email',
                    'placeholder': $.pandalocker.lang.misc_enter_your_email,
                    'req': true
                }
            ]; 
        }
    };

    form._memorize = function( name, value ) {
        var cookieName = 'opanda_' + name; 

        if ( localStorage && localStorage.setItem ) {
            try {
                localStorage.setItem( cookieName, value );  
            } catch(e) {
                $.pandalocker.tools.cookie( cookieName, value, { expires: 365, path: "/" });
            }
        } else {
            $.pandalocker.tools.cookie( cookieName, value, { expires: 365, path: "/" });
        }
    };
    
    form._getFromMemory = function( name ) {
        var cookieName = 'opanda_' + name; 
        
        var result = localStorage && localStorage.getItem && localStorage.getItem( cookieName );
        if ( !result ) result = $.pandalocker.tools.cookie( cookieName );
        return result;
    };
    
    /**
     * Submits the form.
     */
    form.submit = function() {
        var self = this;
        
        if ( !this.validate() ) return false;

        if ( this.options.preview ) {
            
            console.log( this.getValues() );
        
            this.showNotice(
                ( window.bizpanda && window.bizpanda.res && window.bizpanda.res['subscription-preview-mode'] )
                || "The locker is in the preview mode. The subscription does not work here." );
            return;
        }
        
        var buttonText = this.$button.text();
        this.$button.addClass('load').prop('disabled', true);
        this.$button.html('&nbsp;');

        var result = self.runActions( this.getValues(), {} );

        result.fail(function(){ 
            self.$button.removeClass('load').removeProp('disabled');
            self.$button.text(buttonText);
        });
    };
    
    // -----------------------------------------------------------
    // Getting values
    // -----------------------------------------------------------
    
    form.getValues = function() {
        var self = this;
        var fields = this.options.fields;
        
        var values = {};
        
        $.each( fields, function(i, field){
            if ( !field.id ) return;
            values[field.id] = self.getFieldValue( field );   
        });

        return values;
    };
    
    form.getFieldValue = function( field ) {
        
        var type = field.type;

        var result = $.pandalocker.hooks.run('get-field-value-' + type, [field]);
        if ( typeof result !== 'undefined' ) return result;

        if ( field.id === 'email' ) {
            this._memorize('email', $.trim( field._$input.val() ) );
        } else if ( field.id === 'fullname' ) {
            this._memorize('fullname', $.trim( field._$input.val() ) );
        }
        
        var typeName = $.pandalocker.tools.capitaliseFirstLetter( $.pandalocker.tools.camelCase( type ) );
        var method = 'get' + typeName + 'Value';

        if ( this[method] ) {
            return this[method]( field );
        } else {
            if ( field._$input ) return $.trim( field._$input.val() );
            return null;
        }
    };
    
    form.getDateValue = function( field ) {
        if ( $.pandalocker.tools.isTabletOrMobile() ) return $.trim( field._$input.val() );
        return field._$input.data('value');
    };    
    
    form.getCheckboxValue = function( field ) {
        return field._$input.is(":checked") ? field.onValue : field.offValue;
    };
    
    // -----------------------------------------------------------
    // Validation
    // -----------------------------------------------------------
    
    /**
     * Validates the form.
     */
    form.validate = function() {
        var self = this;
        var fields = this.options.fields;
        
        var isValid = true;
        
        $.each( fields, function(i, field){

            if ( self.advancedValidation && field._$input ) {

                field._$input.bind('change keyup blur', function(){
                    self.validateField( field );
                });
            }
            
            if ( self.validateField( field ) ) return;            
            isValid = false;
        });

        return isValid;
    };
    
    form.validateField = function( field ) {
        var type = field.type;
        this.hideValidationErrors( field );

        var result = $.pandalocker.hooks.run('validate-field-' + type, [field]);
        if ( typeof result !== 'undefined' ) return result;
        
        var typeName = $.pandalocker.tools.capitaliseFirstLetter( $.pandalocker.tools.camelCase( type ) );
        var method = 'validate' + typeName;
        
        var res = this[method] ? this[method]( field ) : true;
        
        // custom validation
        
        if ( res && field.validation ) {
            var value = $.trim( field._$input.val() );

            var expression = null;
            var validationError = field.validationError;
            
            if ( field.validation instanceof RegExp ) {
                expression = field.validation;
            } else {
                
                var regexp = new RegExp('^\/.*?\/[ims]*$');

                if ( regexp.test(field.validation) ) {
                    
                    eval('expression = ' + field.validation);
                    
                } else if ( 'month/year' === field.validation ) {

                    expression = /^\d\d\/\d\d\d\d$/;
                    var parts = value.split("/");

                    if ( parts.length < 2 ) {
                        this.showValidationError( field, $.pandalocker.lang.errors_invalid_date );
                        return false;
                    }

                    var month = parseInt( parts[0] );
                    var year = parseInt( parts[1] );

                    if ( month < 1 || month > 12) {
                        this.showValidationError( field, $.pandalocker.lang.errors_invalid_month );
                        return false;
                    }

                } else if ( 'month' === field.validation ) {

                    var month = parseInt( value );
                    if ( month < 1 || month > 12) {
                        this.showValidationError( field, $.pandalocker.lang.errors_invalid_month );
                        return false;
                    }

                } else if ( 'year' === field.validation ) {
                    expression = /^\d\d\d\d$/;
                } else {
                    expression = new RegExp( field.validation );
                }
            
            }

            if ( expression && !expression.test( value )  ) {
                this.showValidationError( field, validationError ? validationError: $.pandalocker.lang.errors_invalid_value );
                return false;
            }
        }
        
        this.runHook('size-changed');
        return res;
    };
    
    form.validateText = function( field, errorText ) {

        var value = $.trim( field._$input.val() );

        if( field.req && ( !value || !value.length ) ) {

            if ( "fullname" === field.id ) {
                errorText = $.pandalocker.lang.errors_empty_name;
            } else if ( "email" === field.id ) {
                errorText = $.pandalocker.lang.errors_empty_email;     
            }
            
            this.showValidationError( field, errorText ? errorText : $.pandalocker.lang.errors_empty_field );
            return false;
        }

        return true;
    };
    
    form.validateHidden = function( field, errorText ) {
        return true;
    }; 
    
    form.validateDate = function( field ) {
        
        var resuslt = this.validateText( field );
        if ( !resuslt ) return resuslt;
        
        return true;
    };
    
    form.validateEmail = function( field ) {
        
        var resuslt = this.validateText( field );
        if ( !resuslt ) return resuslt;
        
        var value = $.trim( field._$input.val() );
        
        if( !$.pandalocker.tools.isValidEmailAddress( value ) ) {
            this.showValidationError( field, $.pandalocker.lang.errors_inorrect_email );
            return false;
        }
        
        return true;
    };

    form.validatePhone = function( field ) {
        return this.validateText( field );
    };
    
    form.validateUrl = function( field ) {
        var resuslt = this.validateText( field );
        if ( !resuslt ) return resuslt;
        
        var value = $.trim( field._$input.val() );
        
        if( !$.pandalocker.tools.isValidUrl( value ) ) {
            this.showValidationError( field, 'Please enter a valid URL.' );
            return false;
        }
        
        return true;
    };
    
    form.validateBirthday = function( field ) {
        
        var resuslt = this.validateText( field );
        if ( !resuslt ) return resuslt;
        
        var value = $.trim( field._$input.val() );
        var parts = value.split("/");
        
        if ( parts.length < 2 ) {
            this.showValidationError( field, 'Please enter a valid date.' );
            return false;
        }
        
        var month = parseInt( parts[1] );
        var day = parseInt( parts[0] );
        
        if ( field.maskPlaceholder === 'mm/dd' ) {
            var month = parseInt( parts[0] );
            var day = parseInt( parts[1] );
        }
        
        if ( day < 1 || day > 31 ) {
            this.showValidationError( field, 'Please enter a valid date.' );
            return false;
        }

        if ( month < 1 || month > 12) {
            this.showValidationError( field, 'Please enter a valid date.' );
            return false;
        }
        
        return true;
    };
    
    form.validateInteger = function( field ) {
        var resuslt = this.validateText( field );
        if ( !resuslt ) return resuslt;
        
        var value = $.trim( field._$input.val() );
        if ( !value && !field.req ) return true;
        
        value = parseInt( value );

        if ( isNaN(value) ) {
            this.showValidationError( field, 'Please enter an integer number.' );
            return false;
        }
        
        if( field.min && value < field.min ) {
            this.showValidationError( field, 'Please enter a number greater than or equal to {0}.'.replace('{0}', field.min) );
            return false;
        }
        
        if( field.max && value > field.max ) {
            this.showValidationError( field, 'Please enter a number less than or equal to {0}.'.replace('{0}', field.max) );
            return false;
        }
        
        return true;
    };
    
    form.validateCheckbox = function( field ) {

        var isChecked = field._$input.is(":checked");
        
        if( field.req && !isChecked ) {
            this.showValidationError( field, 'Please mark this checkbox to continue.' );
            return false;
        }

        return true;
    };
    
    form.showValidationError = function( field, text ) {
        var $wrap = field._$wrap;
        var self = this;
        
        if ( this.advancedValidation ) {

            var $error = $('<div class="onp-sl-validation-error"></div>').html(text);
            $wrap.append( $error );

            $wrap.addClass('onp-sl-error-state');
            
        } else {
            if ( this._validationErrorShown ) return;
            
            this._validationErrorShown = true;
            this.showNotice( text, function(){
                self._validationErrorShown = false;
            } );
        }
    };
    
    form.hideValidationErrors = function( field ) {
        if ( !this.advancedValidation ) return;
        
        var $wrap = field._$wrap;

        $wrap.find(".onp-sl-validation-error").remove();
        $wrap.removeClass('onp-sl-error-state');
    };
    
    // -----------------------------------------------------------
    // Rendering
    // -----------------------------------------------------------
            
    /**
     * Shows the control in the specified holder.
     */
    form.render = function( $holder ) {
        var self = this;
        
        if ( this.options.fields && this.options.fields.length > 1 ) {
            this.addClassToLocker('onp-sl-custom-form');
        }
        
        var fields = this.options.fields;

        for ( var i in fields ) {
            if ( !fields.hasOwnProperty(i) ) continue;
                
            var field = fields[i];
            field._$input = this.renderField( $holder, field );
        }
        
        $holder.find("input").keypress(function(e) {
            if(e.which !== 13) return;
            self.control.find('.onp-sl-submit').click();
        });

        this.$button = this.renderSubmitButton( $holder );
        this._checkWaitingSubscription();
    };
    
    form.renderSubmitButton = function( $holder ) {
        var self = this;
        
        var buttonText = this.options.buttonText || this.groupOptions.text.buttonText || this.lang.btnSubscribe;
        var noSpam = $.pandalocker.tools.normilizeHtmlOption( this.options.noSpamText || this.groupOptions.text.noSpamText || $.pandalocker.lang.noSpam );
        
        var $wrap = $("<div></div>")
                .addClass('onp-sl-field')
                .addClass('onp-sl-field-submit');
        
        var $field = $("<button class='onp-sl-button onp-sl-form-button onp-sl-submit'>" + buttonText + "</button>");
        if ( this.group.isFirst ) $field.addClass('onp-sl-button-primary');
        $field.appendTo($wrap);  
        
        noSpam.addClass('onp-sl-note').addClass('onp-sl-nospa');
        noSpam.appendTo( $wrap );
        
        $field.click(function(){
            self.submit();
            return false;
        });
        
        $wrap.appendTo( $holder );
        return $field;
    };
    
    /**
     * Renders a field.
     */
    form.renderField = function( $holder, field ) {
        var type = field.type;
        var id = field.id;
        
        var $wrap = $("<div class='onp-sl-field'></div>");
        field._$wrap = $wrap;
        
        if ( id ) $wrap.addClass('onp-sl-field-' + id);
        if ( type ) $wrap.addClass('onp-sl-field-' + type);
        
        if ( field.title && type !== 'hidden' ) {
            var $title = $("<div class='onp-sl-field-title'></div>");
            $title.html(field.title);
            $title.appendTo($wrap);
        }

        $wrap.appendTo($holder);
        
        var $input = $("<div class='onp-sl-field-control'></div>");
        $input.appendTo($wrap);

        var $result = $.pandalocker.hooks.run('render-' + type, [$holder, field]); 
        if ( $result ) return $result;

        var typeName = $.pandalocker.tools.capitaliseFirstLetter( $.pandalocker.tools.camelCase( type ) );
        var method = 'render' + typeName;

        if ( !this[method] ) return this.showError('Cannot render a field of the type "' + type + '".');;
        var $field = this[method]( $input, field );

        if ( field.id === 'email' ) {
            $field.val( this._getFromMemory('email' ) );
        } else if ( field.id === 'fullname' ) {
            $field.val( this._getFromMemory('fullname' ) );
        }
        
        return $field;
    };
    
    form.renderEmail = function( $holder, field ) {
        return this.renderText( $holder, field, 'text', 'email' );
    };
    
    form.renderPhone = function( $holder, field ) {
        return this.renderText( $holder, field, 'text', 'phone' );
    };
    
    form.renderUrl = function( $holder, field ) {
        return this.renderText( $holder, field, 'text', 'website' );
    };
    
    form.renderInteger = function( $holder, field ) {
        return this.renderText( $holder, field, 'text', 'interger' );
    };
    
    form.renderHidden = function( $holder, field ) {
        
        var $field = $("<input type='hidden' id='onp-sl-input-" + field.id + "' />");
        if ( field.value ) $field.attr('value', field.value );
        
        $field.appendTo($holder);
        return $field;
    };
    
    form.renderBirthday = function( $holder, field ) {
        
        if ( !field.mask ) field.mask = '99/99';
        if ( !field.maskPlaceholder ) field.maskPlaceholder = 'dd/mm';
        
        return this.renderText( $holder, field, 'text', 'birthday' );
    };    
    
    form.renderDate = function( $holder, field ) {
        if ( $.pandalocker.tools.isTabletOrMobile() ) return this.renderText( $holder, field, 'date' );  
 
        var $field = this.renderText( $holder, field, 'text' );  
        
        if ( !window.Pikaday ) 
            return this.showError('Unable to create a field of the type "date" due to the lib Pikaday not found.');
        
        $field.attr('readOnly', 'true');
        
        var picker = new Pikaday({ 
            field: $field[0], 
            container: $holder[0], 
            format: 'DD MMM YYYY',
            onSelect: function() {
                $field.data('value', this.getMoment().format('YYYY-MM-DD'));
            }
        });
        
        return $field;
    };

    form.renderText = function( $wrap, field, inputType, name ) {

        if ( field.icon ) {
            var position = field.iconPosition || 'right';
            if ( position !== 'none' ) {
                var $icon = $("<i class='onp-sl-icon'></i>").addClass(field.icon);
                if ( position === 'right') $icon.addClass('onp-sl-icon-append');
                else $icon.addClass('onp-sl-icon-prepend');
                $icon.appendTo($wrap);
            }
        }
        
        if ( !inputType ) inputType = 'text';
        if ( field.password ) inputType = 'password';

        var $field = $("<input type='" + inputType + "' class='onp-sl-input' id='onp-sl-input-" + field.id + "' />");
        if ( field.placeholder ) $field.attr('placeholder', field.placeholder );
        if ( field.value ) $field.attr('value', field.value );
        if ( name ) $field.attr('name', name );
        
        if ( field.mask ) {
            if ( !$.mask ) return this.showError('Unable to create a masked input, the lib not found');
            
            var options = {};
            if ( field.maskPlaceholder ) options.placeholder = field.maskPlaceholder;            
            $field.mask( field.mask, options );
        }

        $field.appendTo($wrap);
        return $field;
    };
    
    form.renderCheckbox = function( $wrap, field ) {
        
        var $label = $("<label></lable>");
        
        var $input = $("<input type='checkbox' />");  
        $input.appendTo($label);
        
        if ( field.markedByDefault ) {
            $input.attr('checked', 'checked');
        }
        
        var $checkbox = $("<span class='onp-sl-checkbox' id='onp-sl-input-" + field.id + "' />");
        $checkbox.appendTo($label);
        
        var $span = $("<span></span>");
        if ( field.description ) $span.html( field.description );
        $span.appendTo($label);

        $label.appendTo($wrap);
        return $input;
    };
    
    form.renderDropdown = function( $wrap, field ) {
        
        var $select = $("<select class='onp-sl-input onp-sl-dropdown'></select>");
        var $picker = $("<i></i>");
        
        for ( var i in field.choices ) {
            
            var $option = $("<option></option>")
                .attr('value', field.choices[i])
                .text(field.choices[i]);
        
            $option.appendTo( $select );            
        }
        
        $select.appendTo( $wrap );
        $picker.appendTo( $wrap );  
        
        return $select;
    };
    
    form.renderSeparator = function( $holder, field ) {
        return null;
    }; 
    
    form.renderHtml = function( $holder, field ) {
        $holder.html( field.html );
        return null;
    }; 
    
    
    form.renderLabel = function( $holder, field ) {
        $holder.html( field.text );
        return null;
    }; 
    
    /**
     * Returns an indentity for the state storage.
     */
    form._getStorageIdentity = function() {
        var identity = "";
        
        if ( this.options.unlocksPerPage ) {
            var url = $.pandalocker.tools.URL.normalize( this.options.url || window.location.href );
            identity = "opanda_" + $.pandalocker.tools.hash(url) + "_hash_"  + this.name;
        } else {
            identity = "opanda_" + $.pandalocker.tools.hash(this.options.listId + this.options.service) + "_hash_" + this.name;
        }
        
        identity = $.pandalocker.filters.run( 'subscription-form-get-storage-identity', [identity]);
        return identity;
    };

    $.pandalocker.controls["subscription"]["form"] = form;
    
})(jQuery);;
/*
 * Panda Lockers
 * Copyright 2016, OnePress, http://byonepress.com
*/

(function ($) {
    'use strict';
    if ($.fn.pandalocker) return;

    $.pandalocker.widget("pandalocker", {

        options: {},

        // The variable stores a current locker state.
        _isLocked: false,
        
        // Defauls option's values.
        _defaults: {

			// Если установлено true, приложение является публичным
			// Для публичный приложений в случае ошибки, если кнопка будет одна
			// замок будет всегда открываться, чтобы не ограничивать доступ для пользователей.
			// Также для публичных приложений все кнопки с ошибками, если их больше одной
			// скрываются, а ошибки кнопок выводятся в консоли браузера.
			appPublic: false,

            // Text above the locker buttons.
            text: {
                header: null,
                message: null
            },

            // Theme applied to the locker
            theme: {
                name: "starter"
            },

            // Optional. If set true, show credential link
            credential: false,
            
            // The language of the locker
            lang: 'en_US',
            
            // The groups of controls which will be available for the user.
            groups: {
                order: ['social-buttons'],
                union: 'or'
            },
            
            // shows the terms
            terms: false,
            privacyPolicy: false,
            termsPopup: false,        
            
            // The options of the Connect Buttons.
            connectButtons: {},
            
            // The options of the Social Buttons.
            socialButtons: {},
            
            // Sets overlap for the locked content.
            // false = mode:none
            overlap: {

                // Possible modes:
                // - full: hides the content, and show the locker instead (classic)
                // - transparence: transparent overlap
                // - blurring: to blur locked content
                mode: "full",
                
                // Using only if the mode is set to 'transparence' or 'blurring'
                // Defines the position of the locker. Possible values:
                // middle, top, scroll
                position: 'middle',
                
                // blur intensity (works only with the 'blue' mode)
                intensity: 5,
                
                // the alternative mode which will be applied if the browser doesn't support the blurring effect
                altMode: 'transparence'
            },

            // Extra class
            cssClass: null,

            // Sets whether the locker keep the state of always appears
            demo: false,
            
            // Turns on the highlight effect
            highlight: true,
            
            // Optional. If set true, the locker will generate events for the Google Analytics.
            googleAnalytics: false,
            
            // --
            // Locker functionality.
            locker: {
                // if true, the locker will work as classic social buttons
                off: false,
                
                // if true, the locker waits until the user click all the available buttons.
                stepByStep: false,

                // Sets whether a user may remove the locker by a cross placed at the top-right corner.
                close: false,

                // Sets a timer interval to unlock content when the zero is reached.
                // If the value is 0, the timer will not be created. 
                timer: 0,

                // Sets whether the locker appears for mobiles devides.
                mobile: true,

                // Optional. If false, the content will be unlocked forever, else will be 
                // unlocked for the given number of seconds.
                expires: false,

                // Optional. Forces to use cookies instead of a local storage
                useCookies: false,
                
                // Optional. Allows to bind lockers into one group.
                // If one of lockers in the given scope are unlocked, all others will be unlocked too.
                scope: false,
                
                // Optional. Timeout for loading of the social scripts.
                loadingTimeout: 1000,
                
                // Optional. If on, the locker will protect your content 
                // against browser extensions which remove the lock automatically.
                tumbler: true,

                // Optional. Check interval for the Tumbler, 500 is good.
                tumblerInterval: 500,
                
                // Options. Set what to do if the buttons are not available (blocked by Avast or AdBlock).
                naMode: 'show-error',
                
                // conditions that determine whether the locker has to be displayed
                visibility: []
            },
            
            subscribeActionOptions: {},

            // -
            // Content that will be showen after unlocking.
            content: null,
            
            // -
            // Default proxy
            proxy: null
        },
        
        getState: function() {
            return this._isLocked ? "locked" : "unlocked";
        },

        /**
        * Creates a new locker. 
        */
        _create: function () {
            var self = this;
            this.id = this.options.id || this._generteId();

            this._prepareOptions();
            this._setupVariables();
            
            this._initExtras();
            this._initHooks();
 
            this._initGroups();
            this._initScreens();
            
            this._setupVisitorId();
            
            this.runHook('init');

            
            if ( !this._canLock() ) return;

            this.requestState(function( state ){
                'locked' === state ? self._lock() : self._unlock("provider");
            });
        },
        
        /**
         * Generates an uniqure id for the locker.
         */
        _generteId: function()
        {
            var text = "";
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

            for( var i=0; i < 5; i++ )
                text += possible.charAt(Math.floor(Math.random() * possible.length));

            return text;
        },
        
        /**
        * Prepares options before start.
        */
        _prepareOptions: function () {
            var self = this;
            
            var defaults = $.extend(true, {}, this._defaults);
            defaults = this.applyFilters('filter-default-options', defaults );
            
            if ( this.options.theme && !$.isPlainObject( this.options.theme ) ) {
                this.options.theme = { name: self.options.theme };
            }
            
            if ( typeof this.options.theme !== "object" ) {
                this.options.theme = {name: self.options.theme};
            }
            
            var theme = this.options.theme.name || this._defaults.theme;

            // some themes also have defaults options,
            // merging the global default option with the theme default options
            if ($.pandalocker.themes[theme]) {
                defaults = $.extend(true, {}, defaults, $.pandalocker.themes[theme]);
            }
  
            // now merges with the options specified by a user
            var options = $.extend(true, defaults, this.options);

            // normalizes options

            if ( $.isArray( options.groups ) ) {
                options.groups = $.extend(true, {}, defaults.groups, {order: options.groups});
            }

            options.locker.timer = parseInt(options.locker.timer);
            if (options.locker.timer === 0) options.locker.timer = null;

            this.options = this.applyFilters('filter-options', options );

            // ie 10-11 fix (they doesn't support the blur filter)
            if ( 'blurring' === this.options.overlap.mode && !$.pandalocker.tools.supportBlurring() ) {
                this.options.overlap.mode = this.options.overlap.altMode;
            }
        },
        
        /**
         * Sets variables used in various parts of the plugin code.
         */
        _setupVariables: function() {
            
            // the css class of the theme
            this.style = "onp-sl-" + this.options.theme.name;
            
            // should we use one of advanced overlay modes?
            this.overlap = ( this.options.overlap.mode === 'full' ) ? false : this.options.overlap.mode;
            
            // groups union
            this.groupUnion = this.options.groups.union;
            
            // the default namespace of language resources
            // detects which the group is primary and select situable lables
            
            if ( this.options.groups.order.length > 0 ) {
                
                switch ( this.options.groups.order[0] ) {
                    case 'connect-buttons':
                        this.lockerType = 'signin-locker';
                        this.langScope = 'signinLocker';
                    break;
                    case 'subscription':
                        this.lockerType = 'email-locker';
                        this.langScope = 'emailLocker';
                    break;
                    default:
                        this.lockerType = 'social-locker';
                        this.langScope = 'socialLocker';
                    break;
                }
            }
            
            // stores the lang resources for the current lang scope
            this.lang = $.pandalocker.lang.scopes[this.langScope];
        },
        
        /**
         * Inits extras.
         */
        _initExtras: function() {

            for ( var i in $.pandalocker.extras ) {
                if ( !$.pandalocker.extras.hasOwnProperty(i) ) continue;
                if ( !$.pandalocker.extras[i].init ) continue;
                
                $.pandalocker.extras[i].init.apply(this);
            }
        },
        
        /**
         * Inits extras.
         */
        _initHooks: function() {
            var self = this;
            
            var intercationAccounted = false;
            var errorAccounted = false;
            var socialAppDeclineAccounted = false;    
            var getImpress = false;
            
            this.addHook('raw-interaction', function(){
                if ( !getImpress ) return;
                
                if ( intercationAccounted ) return;
                intercationAccounted = true;
                self.runHook('interaction');
            });
            
            this.addHook('raw-error', function(){
                if ( !getImpress ) return;
                
                if ( errorAccounted ) return;
                errorAccounted = true;
                self.runHook('error');
            }); 
            
            this.addHook('raw-impress', function(){
                if ( self._currentScreenName !== 'default' ) return;
                getImpress = true;
                self.runHook('impress');
            });
            
            this.addHook('raw-social-app-declined', function(){
                if ( !getImpress ) return;

                if ( socialAppDeclineAccounted ) return;
                socialAppDeclineAccounted = true;
                self.runHook('social-app-declined');
            });
        },        
        
        /**
         * Inits control groups.
         */
        _initGroups: function() {
            this._groups = [];

            for( var i = 0; i < this.options.groups.order.length; i++ ) {
                var groupName = this.options.groups.order[i];
                
                var optionsName = $.pandalocker.tools.camelCase( groupName );
                var groupOptions = this.options[optionsName] || {};
     
                if ( i == 0 ) groupOptions.text = this.options.text;

                if ( !$.pandalocker.groups[groupName] ) {
                    this._showError( 'core', 'The control group "' + groupName + '" not found.');
                    return;
                }
                
                var group = $.pandalocker.tools.extend( $.pandalocker.groups[groupName] );
                
                groupOptions.index = parseInt(i) + 1;
                group.init( this, groupOptions );
                
                this._groups[i] = group;
            }
        },
        
        /**
         * Setups an unique visitor id.
         */
        _setupVisitorId: function() {
            
            this.vid = $.pandalocker.tools.getValue("opanda_vid");
            if ( !this.vid ) {
                this.vid = $.pandalocker.tools.guid();   
                $.pandalocker.tools.saveValue("opanda_vid", this.vid, 365);
            }
        },

        /**
         * Checks if the content should be locked or not. 
         * Some options can forbid to lock content for a given user.
         * 
         * @since 4.0.0
         */
        _canLock: function() {
            
            // don't show a locker in ie7
            if ($.pandalocker.browser.msie && parseInt($.pandalocker.browser.version, 10) === 7) {
                this._unlock("ie7"); return false;
            }
            
            // checks the visability options
            if ( this.options.locker.visibility ) {
                var checker = new $.pandalocker.services.visibility();
                if ( !checker.canLock( this.options.locker.visibility ) ) {
                    this._unlock("visibility"); 
                    return false;
                }
            }

            
            // check mobile devices
            if (!this.options.locker.mobile && $.pandalocker.tools.isMobile() ) {
                this._unlock("mobile"); return false;
            }
            
            // checks if the groups containing buttons can be used 
            // to lock, e.g. the group may have no buttons to use, 
            // then it's not possible to use this group
            
            var invalidGroups = 0;
            
            for( var i = 0; i < this._groups.length; i++ ) {
                if ( this._groups[i].canLock() ) continue;

                if ( 'or' === this.groupUnion ) { 
                    this._unlock("group"); 
                    return false; 
                } else {
                    invalidGroups++;
                }
            }

            if ( invalidGroups === this._groups.length ) {
                this._unlock("group");
                return false;
            }
            
            return true;
        },
        
        /**
         * Requests the state of a locker.
         */
        requestState: function( callback ) {
            var self = this;
            
            // the default state-checking function,
            // which is run always the last
            
            var defaultFunction = function( localCallback ){
                
                var groupsCount = self._groups.length;
                var currentState = 'locked';
                
                for ( var i = 0; i < self._groups.length; i++ ) {
                    self._groups[i].requestState(function( state ){
                        groupsCount--;
                        if ( 'unlocked' === state ) currentState = state;
                        if ( groupsCount <= 0 ) localCallback( currentState );
                    });
                } 
            };
            
            var checkFunctions = [];
            
            checkFunctions = this.applyFilters('functions-requesting-state', checkFunctions);
            checkFunctions.push( defaultFunction );

            var runNextCheckFunction = function() {      
                
                var check = checkFunctions.shift();
                if ( !check ) return callback('locked');
                
                check(function( state ){
                    
                    // if the function returned one of the states, breaks the loop
                    if ( state === 'unlocked' ) return callback( state );
                    
                    // else call the next check function
                    runNextCheckFunction();
                });
            };

            runNextCheckFunction(); 
        },
        
        /**
         * Seta a given state.
         * 
         * @argument {string} sate A state (locked, unlocked).
         * @argument {string} senderType A sender type (e.g. button, group).
         * @argument {string} senderName A sender name (e.g. facebook-like).
         */
        setState: function( state, senderType, senderName ) {
            
            // notifies about changing the state
            this.runHook('state-changed', [state, senderType, senderName]);
        },
        
        /**
         * Returns a state storge.
         */
        _getStateStorage: function() {
            if ( this._stateStorage ) return this._stateStorage;
            this._stateStorage = this.applyFilters('get-default-state-storage', new $.pandalocker.storages.defaultStateStorage( this ) );
            return this._stateStorage;
        },

        /**
        * Sets an error state.
        */
        _showError: function ( sender, text) {
            this._error = true;
            this._errorText = text;

            this.locker && this.locker.hide();

            this.element.html("<strong>[Error]: " + text + "</strong>");
            this.element.show().addClass("onp-sl-locker-error");
            
            this.runHook('size-changed');
        },
        
        // --------------------------------------------------------------------------------------
        // Hooks & Filters
        // --------------------------------------------------------------------------------------
        
        /**
        * Subscribes to the specified hook.
        */
        addHook: function( eventName, callback, priority, global ) {
            $.pandalocker.hooks.add( this.id + '.' + eventName, callback, priority );
            if ( global ) $.pandalocker.hooks.add( eventName, callback, priority );
        },
        
        /**
        * Runs the specified hook.
        */
        runHook: function( eventName, args, global ) {
            if ( !args ) args = [];
            args.unshift( this );
            
            // filters api
            $.pandalocker.hooks.run( this.id + '.' + eventName, args );
            if ( global ) $.pandalocker.hooks.run( eventName, args );
            
            // jquery api
            this.element.trigger('opanda-' + eventName, args);
            
            // global api
            var globalArgs = args.slice();
            
            var identity = {};
            identity.lockId = this.id;
            identity.visitorId = this.vid;       
            identity.locker = this.locker;
            identity.content = this.element;
            globalArgs.unshift( identity );

            $.pandalocker.hooks.run( 'opanda-' + eventName, globalArgs );
        },
        
        /**
        * Subscribes to the specified hook.
        */
        addFilter: function( eventName, callback, priority, global ) {
            $.pandalocker.filters.add( this.id + '.' + eventName, callback, priority );
        },
        
        /**
        * Runs the specified hook.
        */
        applyFilters: function( eventName, input, args, global ) {
            if ( !args ) args = [];
            if ( !$.isArray( args )) args = [args];

            args.unshift( this );
            args.unshift( input );
            
            // filters api
            var result = $.pandalocker.filters.run( this.id + '.' + eventName, args );
            args[0] = result;
            
            if ( global ) result = $.pandalocker.filters.run( eventName, args );
            return result;
        },
        
        // --------------------------------------------------------------
        // Screens
        // --------------------------------------------------------------   

        /**
         * Stores HTML markup of the screens.
         */
        screens: {},
        
        /**
         * Stores factories of the screens.
    */
        _screenFactory: {},

        /**
         * Shows the screen.
         */
        _showScreen:function( screenName, options ) {
            // if the screen has not been registered, fires an exception
            if ( !this._screenFactory[screenName] && !this.screens[screenName] )
                throw new $.pandalocker.error('The screen "' + screenName + '" not found in the group "' + this.name + '"');
            
            var self = this;
            this._currentScreenName = screenName;

            // shows a screen if it was already created
            this.innerWrap.find('.onp-sl-screen').hide();

            if ( this.screens[screenName] ) {
                this.screens[screenName].show();
                self.runHook('size-changed');
                return;
            }

            // if not, then creates via the screen factory
            var screen = $("<div class='onp-sl-screen onp-sl-non-default-screen onp-sl-screen-" + screenName + "'></div>").appendTo(this.innerWrap).hide();
            this.screens[screenName] = this._screenFactory[screenName]( screen, options );

            screen.fadeIn(300, function(){
                self.runHook('size-changed');
            });
        },
        
        /**
         * Registers a new screen.
         */
        _registerScreen: function( screenName, factory ) {
            this._screenFactory[screenName] = factory;
        },
        
        _initScreens: function() {
            var self = this;
            this._currentScreenName = 'default';
            
            // SCREEN: Enter Email
            
            this._registerScreen('enter-email',
                function( $holder, options ) {
                    
                    var $text = $('<div class="onp-sl-text"></div>');
                    $holder.append($text);
                    
                    if ( options.header ) {
                        var $header = $('<div class="onp-sl-header onp-sl-strong">' + options.header + '</div>');
                        $text.append($header);
                    }
                    
                    if ( options.message ) {
                        var $message = $('<div class="onp-sl-message">' + options.message + '</div>');
                        $text.append($message);
                    }
                    
                    var $controlWrap = $('<div class="onp-sl-control"></div>');
                    $holder.append( $controlWrap );
                    
                    var fields = {};
                    
                    fields['email'] = {name: 'email', type: 'text', placeholder: $.pandalocker.lang.misc_enter_your_email};
                    fields['submit'] = {name: 'submit', type: 'submit', title: options.buttonTitle };
        
                    for( var name in fields ) {
                        var type = fields[name].type;
                        var title = fields[name].title;

                        var value = fields[name].value || ( options.fields && options.fields[name] && options.fields[name].value );

                        var $wrap = $("<div></div>")
                                .addClass('onp-sl-field')
                                .addClass('onp-sl-field-' + name)
                                .addClass('onp-sl-field-type-' + type);

                        if ( 'text' === type || 'email' === type ) {

                            var $field = $("<input type='" + type + "' name='" + name + "' class='onp-sl-input' id='onp-sl-input-" + name + "' />");
                            if ( fields[name].placeholder) $field.attr('placeholder', fields[name].placeholder );
                            if ( value) $field.attr('value', value );

                            $field.appendTo($wrap);
                        }

                        if ( 'submit' === type ) {                
                            var $field = $("<button class='onp-sl-button onp-sl-form-button onp-sl-submit'>" + title + "</button>");
                            $field.addClass('onp-sl-button-primary');
                            $field.appendTo($wrap);
                        }

                        $wrap.appendTo($controlWrap);            
                    }   
                    
                    if ( options.note ) {
                        var $note = $("<div class='onp-sl-note onp-sl-nospam'></div>").html( options.note );
                        $note.appendTo( $wrap );   
                    }
                    
                    $holder.find('.onp-sl-submit').click(function(){
                        
                        var showNotice = function( text, expires ){

                            $holder.find('.onp-sl-group-notice').remove();

                            var $notice = $("<div class='onp-sl-group-notice'>" + text + "</div>").hide();
                            $holder.append( $notice ); 
                            $notice.fadeIn(500);

                            if ( !expires ) expires = 7000;
                            setTimeout(function(){
                                if ( !$notice.length ) return;
                                $notice.fadeOut( 800, function(){
                                    $notice.remove();
                                } );
                            }, expires);
                        };

                        var $button = $(this);
                        var email = $.trim( $holder.find('#onp-sl-input-email').val() );

                        if( !email || !email.length ) {
                            showNotice( $.pandalocker.lang.errors_empty_email );
                            return;
                        } else if( !$.pandalocker.tools.isValidEmailAddress( email ) ) {
                            showNotice( $.pandalocker.lang.errors_inorrect_email );
                            return;
                        }            

                        if ( options.callback ) options.callback( email );
                     });
                }
            );
    
            // SCREEN: Data Processing
            
            this._registerScreen('data-processing',
                function( $holder, options ) { 
                    
                    $holder.append( $("<div class='onp-sl-process-spin'></div>") );
                    $holder.append( $("<div class='onp-sl-processing-sreen-text'>" + ( options && options.screenText || $.pandalocker.lang.misc_data_processing ) + "</div>") );
                }
            );

            // SCREEN: Prompt

            this._registerScreen('prompt',
                function( $holder, options ) {

                    var promtHtmlObj = $(
                        '<div class="onp-sl-prompt">' +
                        '<div class="onp-sl-prompt-text">' + options.textMessage + '</div>' +
                        '<div class="onp-sl-prompt-buttons"><button class="onp-sl-prompt-button-yes">' + options.textButtonYes + '</button>' +
                        '<button class="onp-sl-prompt-button-no">' + options.textButtonNo + '</button></div>' +
                        '</div>'
                    );

                    !options.textButtonYes && promtHtmlObj.find( '.onp-sl-prompt-button-yes' ).hide();
                    !options.textButtonNo && promtHtmlObj.find( '.onp-sl-prompt-button-no' ).hide();

                    $holder.append(promtHtmlObj);

                    $holder.closest('.onp-sl-social-locker').find('.onp-sl-cross').hide();

                    promtHtmlObj.find( '.onp-sl-prompt-button-yes' ).click( function () {
                        options.callbackButtonYes && options.callbackButtonYes();
                        return false;
                    } );

                    promtHtmlObj.find( '.onp-sl-prompt-button-no' ).click( function () {
                        options.callbackButtonNo && options.callbackButtonNo();
                        self._showScreen('default');
                        $holder.closest('.onp-sl-social-locker').find('.onp-sl-cross').show();
                        return false;
                    } );

                    options.callbackScreenLoad && options.callbackScreenLoad(promtHtmlObj);
                }
            );
    
            // SCREEN: Email Confirmation
            
            this._registerScreen('email-confirmation', 
                function( $holder, options ) {                    
  
                    // shows the message
  
                    var $message = $('<div class="onp-sl-screen-message"></div>');
                    
                    var $strong = $("<div class='onp-sl-header'></div>").html( $.pandalocker.lang.confirm_screen_title );        
                    var $text = $("<div class='onp-sl-message'></div>");
                    
                    var $line1 = $('<p></p>').html($.pandalocker.lang.confirm_screen_instructiont.replace( '{email}', '<strong>' + options.email + '</strong>' + ' <a href="#" class="onp-sl-cancel">' + $.pandalocker.lang.confirm_screen_cancel + '</a>'  ));
                    var $line2 = $('<p class="onp-sl-highlight"></p>').html($.pandalocker.lang.confirm_screen_note1);
                    var $line3 = $('<p class="onp-sl-note"></p>').html($.pandalocker.lang.confirm_screen_note2 );                    
                    
                    var $cancel = $line1.find('.onp-sl-cancel');
                    $cancel.click(function(){
                         options.service.cancel();
                         self._showScreen('default');
                         return false;
                    }); 
                    
                    $text.append($line1);
                    $text.append($line2);
                    
                    $message.append( $strong );            
                    $message.append( $text );
                    
                    $holder.append( $message );
                    
                    // show the button 'Check Email Box'
                    
                    var emailParts = options.email.split('@');
                    var emailService = null;

                    if ( emailParts[1].indexOf("gmail") >= 0 ) {
                        emailService = {
                            url: 'https://mail.google.com/mail/?tab=wm',
                            icon: '0px 0px',
                            title: 'Gmail'
                        };
                    } else if ( emailParts[1].indexOf("yahoo") >= 0 ) {
                         emailService = {
                            url: 'https://mail.yahoo.com/',
                            icon: '0px -70px',
                            title: 'Yahoo!'
                        }; 
                    } else if ( emailParts[1].indexOf("hotmail") >= 0 ) {
                         emailService = {
                            url: 'https://hotmail.com/',
                            icon: ' 0px -140px',
                            title: 'Hotmail'
                        }; 
                    } else if ( emailParts[1].indexOf("outlook") >= 0 ) {
                         emailService = {
                            url: 'http://www.outlook.com/',
                            icon: ' 0px -140px',
                            title: 'Outlook'
                        }; 
                    }                    

                    if ( emailService ) {
                        var $checkEmail =  $('<a class="onp-sl-button onp-sl-form-button onp-sl-form-button-sm onp-sl-open"></a>').html( $.pandalocker.lang.confirm_screen_open.replace('{service}', emailService.title));
                        $checkEmail.attr('href', emailService.url);
                        $checkEmail.attr('target', '_blank');
                        
                        if ( emailService.icon ) {
                            $checkEmail.addClass('onp-sl-has-icon');
                            var $icon = $('<i class="onp-sl-icon"></i>').prependTo( $checkEmail );
                            $icon.css('background-position', emailService.icon);
                        }
                        
                        var $checkEmailWrap = $("<div class='onp-sl-open-button-wrap'></div>");
                        $checkEmailWrap.append($checkEmail);
                        
                        $holder.append( $checkEmailWrap );
                    }
                    
                    $holder.append($line3);
                }
            );
        },               
        
        // --------------------------------------------------------------------------------------
        // Lock/Unlock content.
        // --------------------------------------------------------------------------------------

        _lock: function ( sender ) {
            var self = this;

            if ( this._isLocked ) return;
            if ( !this._markupIsCreated ) this._createMarkup();

            if ( !this.overlap ) {

                this.element.hide();
                this.locker.fadeIn(1000);

            } else {

                this.overlapLockerBox.fadeIn(1000, function(){ self._updateLockerPosition(); });
                self._updateLockerPosition();
            }

            this._isLocked = true;
            
            this.runHook('lock');            
            this.runHook('locked');
            
            setTimeout(function(){            
                self._startTrackVisability();  
            }, 1500);
        },

        _unlock: function ( sender, sernderName, value ) {
            var self = this;

            // returns if we have turned off the locker
            if ( this.options.locker.off ) return;

            if (!this._isLocked) {
                this.runHook('cancel', [sender]);  
                this._showContent( sender === "button" ); 
                return false; 
            }

            this._showContent(true);
            this._isLocked = false;
            
            this.runHook('unlock', [sender, sernderName, value]);  
            this.runHook('unlocked', [sender, sernderName, value]);
        },

        lock: function ( sender ) {
            this._lock( sender || "api" );
        },

        unlock: function ( sender, sernderName, value ) {
            this._unlock( sender || "api", sernderName, value );
        },

        // --------------------------------------------------------------------------------------
        // Markups and others.
        // --------------------------------------------------------------------------------------

        /**
        * Creates the plugin markup.
        */
        _createMarkup: function () {
            var self = this;
            
            this._loadFonts();
            
            var element = (this.element.parent().is('a')) ? this.element.parent() : this.element;
            element.addClass("onp-sl-content");

            var browser = ($.pandalocker.browser.mozilla && 'mozilla') ||
                          ($.pandalocker.browser.opera && 'opera') ||
                          ($.pandalocker.browser.webkit && 'webkit') || 'msie';

            this.locker = $("<div class='onp-sl onp-sl-" + browser + "'></div>");
            this.outerWrap = $("<div class='onp-sl-outer-wrap'></div>").appendTo(this.locker);
            this.innerWrap = $("<div class='onp-sl-inner-wrap'></div>").appendTo(this.outerWrap);

            if( this.options.credential ) {
				if( $.inArray('subscription', this.options.groups.order) + 1 ) {
					$($.pandalocker.lse.cllk('optinpanda')).appendTo( this.locker );
				} else {
					$($.pandalocker.lse.cllk('sociallocker')).appendTo( this.locker );
				}

                this.innerWrap.addClass("onp-sl-wrap-elevated");
            }
            
            var screen = $("<div class='onp-sl-screen onp-sl-screen-default'></div>").appendTo(this.innerWrap);
            this.screens['default'] = this.defaultScreen = screen;
            
            this.locker.addClass(this.style);         
            this.locker.addClass('onp-sl-' + this.lockerType);
            this.locker.addClass('onp-sl-' + this.options.groups.order[0] + '-frist');

            this.locker.addClass( this.options.groups.order.length === 1 ? 'onp-sl-contains-single-group' : 'onp-sl-contains-many-groups' );

            for ( var index = 0; index < this.options.groups.order.length; index++ ) {
                this.locker.addClass( 'onp-sl-' + this.options.groups.order[index] + '-enabled' );
            }

            $.pandalocker.isTouch()
                ? this.locker.addClass('onp-sl-touch')
                : this.locker.addClass('onp-sl-no-touch');

            if ( this.options.cssClass ) this.locker.addClass( this.options.cssClass );
            
            // - classic mode
            // when we use the classic mode, we just set the display property of the locked content
            // to "none", then add the locker after the locked content.
            if ( !this.overlap ) {
               
                this.locker.hide();
                this.locker.insertAfter( element ); 
                
            // - overlap mode  
            // when we use the overlap mode, we put the locker inside the locked content,
            // then set the locker position to "absolute" and postion to "0px 0px 0px 0px".
            } else {
                           
                element.addClass("onp-sl-overlap-mode");
                
                var displayProp = this.element.css("display");
                
                // creating content wrap if it's needed
                var $containerToTrackSize = element;
                if ( 
                    this.overlap === 'blurring' ||
                    element.is("img") || element.is("iframe") || element.is("object") || 
                    ( displayProp !== "block" && displayProp !== "inline-block" ) ) {
                
                    $containerToTrackSize = $('<div class="onp-sl-content-wrap"></div>')
                    $containerToTrackSize.insertAfter( element );
                    $containerToTrackSize.append( element );

                    var originalMargin = element.css('margin');
                    $containerToTrackSize.css({'margin': originalMargin});
                    element.css({'margin': '0'});
                    
                    self.addHook('unlock', function(){
                        $containerToTrackSize.css({'margin': originalMargin});
                    });
                }
                
                element.show();
                this.element.show();
                
                // creating another content which will be blurred
                if ( this.overlap === 'blurring' ) {  
                    this.blurArea = $("<div class='onp-sl-blur-area'></div>");
                    this.blurArea.insertAfter( element );
                    this.blurArea.append( element );
                    element = this.blurArea;
                }
                
                var positionProp = $containerToTrackSize.css("position");
                if ( positionProp === 'static' ) $containerToTrackSize.css("position", 'relative');
                
                var innerFrame = ( element.is("iframe") && element ) || element.find("iframe");
                if ( innerFrame.length === 1 && innerFrame.css('position') === 'absolute'  ){
                    
                    var skip = ( !element.is(innerFrame) && !innerFrame.parent().is(element) && innerFrame.parent().css('position') === 'relative' );
                    if ( !skip ) {
                        
                        $containerToTrackSize.css({
                            'position': 'absolute',
                            'width': '100%',
                            'height': '100%',
                            'top': innerFrame.css('top'),
                            'left': innerFrame.css('left'),
                            'right': innerFrame.css('right'),
                            'bottom': innerFrame.css('bottom'),
                            'margin': innerFrame.css('margin')
                        });

                        innerFrame.css({
                            'top': 0,
                            'left': 0,
                            'right': 0,
                            'bottom': 0,
                            'margin': 'auto'
                        });      
                    }
                }
				
                // creating other markup for the overlap
                this.overlapLockerBox = $("<div class='onp-sl-overlap-locker-box'></div>").hide();
                this.overlapLockerBox.addClass('onp-sl-position-' + this.options.overlap.position);
                this.overlapLockerBox.append( this.locker );

                this.overlapBox = $("<div class='onp-sl-overlap-box'></div>");
                this.overlapBox.append( this.overlapLockerBox ); 
                this.overlapBox.addClass("onp-sl-" + this.overlap + "-mode");
                this.overlapBox.addClass(this.style + "-theme");
                
                var $overlapBackground = $("<div class='onp-sl-overlap-background'></div>");
                this.overlapBox.append( $overlapBackground ); 
                
                $containerToTrackSize.append( this.overlapBox );
                this.containerToTrackSize = $containerToTrackSize;
                
                if ( this.overlap === 'blurring' ) {
                                    
                    var intensity = ( this.options.overlap && this.options.overlap.intensity ) || 5;
                    this.blurArea = this.blurArea.Vague({
                        intensity: intensity,
                        forceSVGUrl: false
                    });
                    this.blurArea.blur();
                }
                
                $(window).resize(function(){
                    self._updateLockerPosition();
                });
                
                this.addHook('size-changed', function(){
                    self._updateLockerPosition();
                });

                if ( this.options.overlap.position === 'scroll') {
                    $(window).scroll(function(){
                        self._updateLockerPositionOnScrolling();
                    });  
                }         
            }
            
            this._markupIsCreated = true;
            this.runHook('markup-created');
            
            // tracks interactions, we need these hooks to track how 
            // many users interacted with the locker any way
            
            this.locker.click(function(){
                self.runHook('raw-interaction');
            });
            
            this._isLockerVisible = this.locker.is(":visible");
            if ( !this._isLockerVisible ) {
                this.options.lazy = true;
            }
            
            // locked created here, now we can create other elements
            
            // creates markup for buttons
            for ( var i = 0; i < this._groups.length; i++ ) {
                this._groups[i].renderGroup( screen );
            }
            
            // Terms & Conditions and Privacy Policy
            if ( this.options.terms || this.options.privacyPolicy ) this._createTerms();

            // close button and timer if needed
            this.options.locker.close && this._createClosingCross();
            this.options.locker.timer && this._createTimer();
            
            /**
            var serviceOptions = {
                id: self.id,
                proxy: self.options.proxy,
                name: self.options.subscribeActionOptions.name,
                listId: self.options.subscribeActionOptions.listId,
                service: self.options.subscribeActionOptions.service,
                doubleOptin: self.options.subscribeActionOptions.doubleOptin,
                confirm: self.options.subscribeActionOptions.confirm,
                requireName: self.options.subscribeActionOptions.requireName
            };

            var service = new $.pandalocker.services.subscription( serviceOptions );
        
            this._showScreen('email-confirmation', {
                email: 'fff',
                service: service
            }); */
        },
        
        /**
         * Adds a CSS class.
         */
        _addClass: function( className ) {
            this.locker.addClass( className );
        },
        
        /**
         * Loads fonts if needed.
         */
        _loadFonts: function() {
            if ( !this.options.theme.fonts || !this.options.theme.fonts.length ) return;
            
            var protocol = (("https:" === document.location.protocol) ? "https" : "http");
            var base = protocol + '://fonts.googleapis.com/css';
            
            for( var i = 0; i < this.options.theme.fonts.length; i++ ) {    
                var fontData = this.options.theme.fonts[i];
                
                var family = fontData.name;
                if ( fontData.styles && fontData.styles.length ) {
                    family = family + ":" + fontData.styles.join(",");
                }
                
                var url = $.pandalocker.tools.updateQueryStringParameter(base, 'family', family);
                
                if ( fontData.subset && fontData.subset.length ) {
                    url = $.pandalocker.tools.updateQueryStringParameter(url, 'subset', fontData.subset.join(",") );  
                }
                
                var hash = $.pandalocker.tools.hash( url );
                if ( $("#onp-sl-font-" + hash ).length > 0 ) continue;
                    
                $('<link id="onp-sl-font-' + hash + '" rel="stylesheet" type="text/css" href="'+url+'" >').appendTo("head");
            }
        },

        /**
         * Updates the locker position for various overlap modes.
         */
        _updateLockerPosition: function() {
            if ( !this.overlap ) return;

            var self = this;
            
             
            // updates the content size if the locker is bigger then the content
            var contentHeight = this.containerToTrackSize.outerHeight();
            
            if ( typeof this.contentMinTopMargin == "undefined" ) {
                this.contentMinTopMargin = parseInt( this.containerToTrackSize.css('marginTop') );
            }
            
            if ( typeof this.contentMinBottomMargin == "undefined" ) {
                this.contentMinBottomMargin = parseInt( this.containerToTrackSize.css('marginBottom') );
            }
            
            var lockerHeight = this.locker.outerHeight();

            if ( contentHeight < lockerHeight ) {
   
                var value = parseInt( ( lockerHeight - contentHeight ) / 2 ) + 20;
                var topMargin =  this.contentMinTopMargin < value ? value : this.contentMinTopMargin;
                var bottomMargin =  this.contentMinBottomMargin < value ? value : this.contentMinBottomMargin;

                this.containerToTrackSize.css({
                    'marginTop': topMargin + "px",
                    'marginBottom': bottomMargin + "px"
                });
            }
            
            // updates the locker position
            
            if ( this.options.overlap.position === 'top' || this.options.overlap.position === 'scroll' ) {     
                
                var boxWidth = this.overlapBox.outerWidth();
                var lockerWidth = this.locker.outerWidth();
                
                var boxHeight = this.overlapBox.outerHeight();
                
                var offset = this.options.overlap.offset;
                
                if ( !offset ) {
                    var offset = Math.floor( ( boxWidth - lockerWidth ) / 2 );
                    if ( offset <= 10 ) offset = 10;
                }
            
                if ( offset * 2 + lockerHeight > boxHeight ) {
                    var offset = Math.floor( ( boxHeight - lockerHeight ) / 2 );
                }

                this.overlapLockerBox.css('marginTop', offset + 'px' ) ;
                
                if ( this.options.overlap.position === 'scroll' ) {
                    this._baseOffset = offset;
                    this._updateLockerPositionOnScrolling();
                }
            }
            
            if ( this.options.overlap.position === 'middle' ) {
                this.overlapLockerBox.css('marginTop', '-' + Math.floor( this.overlapLockerBox.innerHeight() / 2 ) + 'px' ) ;
                return;
            }
        },
        
        /**
         * Updates the locker position on scrolling.
         */
        _updateLockerPositionOnScrolling: function () {
            
            var boxOffset = this.overlapBox.offset();
            var contentTopBorder = boxOffset.top;
            var contentLeftBorder = boxOffset.left;
            var contentBottomBorder = boxOffset.top + this.overlapBox.outerHeight();
            
            var boxWidth = this.overlapBox.outerWidth();
                
            var boxHeight = this.overlapBox.outerHeight();
            var lockerHeight = this.locker.outerHeight();

            if ( this._baseBoxOffset * 2 + lockerHeight + 10 >= boxHeight ) return;
      
            var scrollTop = $(document).scrollTop();
            
            var shift = 20;
            
            if ( scrollTop + lockerHeight + this._baseOffset * 2 + shift > contentBottomBorder ) {
                
                this.overlapLockerBox
                    .css('position', 'absolute')
                    .css('top', 'auto')
                    .css('left', '0px')
                    .css('width', 'auto') 
                    .css('bottom', this._baseOffset + 'px')
                    .css('margin-top', '0px');
            
                return;
            }
            
            if ( scrollTop + shift > contentTopBorder ) {
                
                this.overlapLockerBox
                    .css('position', 'fixed')
                    .css('top', this._baseOffset + shift + 'px')
                    .css('left', contentLeftBorder + 'px')
                    .css('width', boxWidth + 'px')
                    .css('bottom', 'auto') 
                    .css('margin-top', '0px');
            
                return;
            } 

            this.overlapLockerBox
                .css('position', 'absolute')
                .css('top', '0px')
                .css('left', '0px')
                .css('bottom', 'auto')
                .css('width', 'auto') 
                .css('margin-top', this._baseOffset + 'px');
        },
        
        /**
         * Fires the hook when the locker gets visible in the current viewport.
         */
        _startTrackVisability: function() {
            var self = this;

            var el = this.locker[0];

            if ( !el.getBoundingClientRect ) {
                this.runHook('raw-impress');
            } 
            
            var windowHeight = $(window).height();
            var windowWidth = $(window).width();

            var checkVisability = function(){

                if ( !el ) {
                    self._stopTrackVisability();
                    return;
                }

                var rect = el.getBoundingClientRect();

                var heightHalf = rect.height / 2;
                var windowHalf = rect.width / 2;

                // if we can see a half of the locker in the current view post, notify about that
                if ( rect.top + heightHalf > 0 && rect.bottom - heightHalf <= windowHeight &&
                     rect.left + windowHalf && rect.right - windowHalf <= windowWidth ) {

                    self.runHook('raw-impress');
                    self._stopTrackVisability();
                }
            };

            $(window).bind('resize.visability.opanda_' + self.id, function(){
                windowHeight = $(window).height();
                windowWidth = $(window).width();
            });

            $(window).bind('resize.visability.opanda_' + self.id + ' scroll.visability.opanda_' + self.id, function(e){
                checkVisability();
            });
            
            // if the locker is not visible, binds to click events to catch
            // the moment when it gets visible
            
            if ( !this._isLockerVisible ) {
                
                $("a, button").add($(document)).bind('click.visability.opanda', function(){
                    setTimeout(function(){ checkVisability(); }, 200);
                });  

                this.addHook('raw-impress', function(){
                    self._isLockerVisible = true;
                    $("a, button").add($(document)).unbind('click.visability.opanda');
                });
            }
            
            checkVisability();
        },
        
        _stopTrackVisability: function() {
            $(window).unbind('.visability.opanda_' + this.id);
        },
        
        // --------------------------------------------------------------------------------------
        // Close Cross
        // --------------------------------------------------------------------------------------  
        
        /**
         * Creates the markup for the close icon.
         */
        _createClosingCross: function () {
            var self = this;

            $("<div class='onp-sl-cross' title='" + $.pandalocker.lang.misc_close + "' />")
                .prependTo(this.locker)
                .click(function () {
                    if (!self.close || !self.close(self)) self._unlock("cross", true);
                });
        },
        
        // --------------------------------------------------------------------------------------
        // Timer
        // --------------------------------------------------------------------------------------  
        
        /**
         * Creates the markup for the timer.
         */
        _createTimer: function () {

            this.timer = $("<span class='onp-sl-timer'></span>");
            var timerLabelText = $.pandalocker.lang.misc_or_wait;
            
            timerLabelText = timerLabelText.replace('{timer}', $("<span class='onp-sl-timer-counter'>" + this.options.locker.timer + "</span>")[0].outerHTML);
            
            this.timerLabel = $("<span class='onp-sl-timer-label'></span>").html(timerLabelText).appendTo(this.timer);
            this.timerCounter = this.timerLabel.find('.onp-sl-timer-counter');
                    
            this.timer.appendTo(this.locker);

            this.counter = this.options.locker.timer;
            this._kickTimer();
        },
        
        /**
         * Executes one timer step.
         */
        _kickTimer: function () {
            var self = this;

            setTimeout(function () {

                if (!self._isLocked) return;

                self.counter--;
                if (self.counter <= 0) {
                    self._unlock("timer");
                } else {
                    self.timerCounter.text(self.counter);

                    // Opera fix.
                    if ($.pandalocker.browser.opera) {
                        var box = self.timerCounter.clone();
                        box.insertAfter(self.timerCounter);
                        self.timerCounter.remove();
                        self.timerCounter = box;
                    }

                    self._kickTimer();
                }
            }, 1000);
        },
        
        // --------------------------------------------------------------------------------------
        // Terms & Conditions / Privacy Policy
        // -------------------------------------------------------------------------------------- 
        
        _createTerms: function() {
            this.locker.addClass('onp-sl-has-terms');
            
            this.terms = $("<div class='onp-sl-terms'></div>").appendTo( this.defaultScreen );
            this.termsInnerWrap = $("<div class='onp-sl-terms-inner-wrap'></div>").appendTo( this.terms  );
            
            var text = $.pandalocker.lang.misc_your_agree_with;
            var links = '';
            
            if ( this.options.terms ) {
                
                links = $("<a target='_black' class='onp-sl-link'>" + $.pandalocker.lang.misc_terms_of_use + "</a>")
                    .attr('href', this.options.terms)[0].outerHTML;
            }

            if ( this.options.privacyPolicy ) {
                
                if ( this.options.terms ) links = links + ", ";
                links = links + $("<a target='_black' class='onp-sl-link'>" + $.pandalocker.lang.misc_privacy_policy + "</a>")
                    .attr('href', this.options.privacyPolicy)[0].outerHTML;
            }
            
            if ( links ) text = text.replace('{links}', links);
            this.termsInnerWrap.html(text);
            
            if ( this.options.termsPopup ) {
                var popupWidth = this.options.termsPopup.width || 550;
                var popupHeight = this.options.termsPopup.height || 400;         
                        
                this.termsInnerWrap.find('.onp-sl-link').click(function(){
                    var url = $(this).attr('href');
                    window.open(url, 'bizpanda_policies', "width=" + popupWidth + ",height=" + popupHeight + ",resizable=yes,scrollbars=yes");
                    return false;
                });
            }
        },
        
        // --------------------------------------------------------------------------------------
        // Displaying content
        // --------------------------------------------------------------------------------------        
        
        _showContent: function (useEffects) {
            var self = this;
            
            this.runHook('before-show-content');
            
            var effectFunction = function () {
                
                if ( self.overlap ) {
                    if ( self.overlapBox ) self.overlapBox.hide();
                    if ( self.blurArea ) self.blurArea.unblur();
                } else {
                    if (self.locker) self.locker.hide();    
                }
                
                if (self.locker) self.locker.hide();
                
                if (!useEffects) { 
                    self.element.show();
                } else {
                    self.element.fadeIn(1000, function () {
                        self.options.highlight && self.element.effect && self.element.effect('highlight', { color: '#fffbcc' }, 800);
                    });
                }

                self.runHook('after-show-content');
            };

            if (!this.options.content) {
                effectFunction();

            } else if (typeof this.options.content === "string") {
                this.element.html(this.options.content);
                effectFunction();

            } else if (typeof this.options.content === "object" && !this.options.content.url) {
                this.element.append(this.options.content.clone().show());
                effectFunction();

            } else if (typeof this.options.content === "object" && this.options.content.url) {

                var ajaxOptions = $.extend(true, {}, this.options.content);

                var customSuccess = ajaxOptions.success;
                var customComplete = ajaxOptions.complete;
                var customError = ajaxOptions.error;

                ajaxOptions.success = function (data, textStatus, jqXHR) {

                    !customSuccess ? self.element.html(data) : customSuccess(self, data, textStatus, jqXHR);
                    effectFunction();
                };

                ajaxOptions.error = function (jqXHR, textStatus, errorThrown) {

                    self._showError( 'ajax', "An error is triggered during the ajax request! Text: " + textStatus + " " + errorThrown);
                    customError && customError(jqXHR, textStatus, errorThrown);
                };

                ajaxOptions.complete = function (jqXHR, textStatus) {

                    customComplete && customComplete(jqXHR, textStatus);
                };

                $.ajax(ajaxOptions);

            } else {
                effectFunction();
            }
        }
    });
    
    $.fn.sociallocker = function( options ) {
        return $(this).pandalocker(options);
    };

})(jQuery);
