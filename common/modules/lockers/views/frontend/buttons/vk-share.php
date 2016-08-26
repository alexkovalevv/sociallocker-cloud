<?php
use \yii\helpers\ArrayHelper;

?>
<!DOCTYPE html>
<html>
<head>
  <title>Vk share button</title>
  <style>
        body {
            margin: 0;
            padding: 0;
        }

        iframe[src*="act=a_stats_box"], .VKWidgetsLoader {
            display:none !important;
        }

        /* Flat button default */
        .onp-flat-button-default {
            display: inline-block;
            position: relative;
            min-width: 10px;
            height: 20px;
            padding: 1px 10px 1px 0;
            margin-right: 1px;
            line-height: 1.5;
            font-family: tahoma, arial, verdana, sans-serif, Lucida Sans;
            text-shadow: none !important;
            font-size: 12px;
            color: #fff;
            background: #5F83AA;
            border-radius: 2px;
            -moz-border-radius: 2px;
            -webkit-border-radius: 2px;
            z-index: 1;
            cursor: pointer;
            text-align: left;
            white-space: nowrap;
            vertical-align: top;
            box-sizing: content-box;
        }

        .onp-flat-button-default.onp-vk-default-button-process {
            background: rgb(185, 185, 185);
        }

        .onp-flat-button-default.onp-button-loaded {
            display: inline-block;
        }

        .onp-flat-button-default .onp-flat-button-vk-logo {
            display: block;
            background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABMAAAA7CAYAAACZr7GXAAAABGdBTUEAALGPC/xhBQAAArJJREFUWAntlrtrVEEUxrMxhUgiIiLRwlaEIIKN+IoaRG3UkKBWitj7DyiYf8A+VqKFVr7QYBElbQxGjeCjsfGFNr4WJfG1/r51Jpy9986ducTOHfj2nDnn+76dnb2zsx2NRuMe0LjVwSB2gtcqMH6Axa6+mXxORcZ+1XKDxrlm++/LOhFIR02tx9XuuNpb4pKckSNtMMILrnbW1HrID5n5kUIjX4R41ZF/EbcCazbM/JPrX/eaYIS4BtSd4D3xkcuz4WTQxDZQHc8q3XyC+N3l+gL2WF0wh3gK/HZCH1aTbAGfXUFxbdDENiDuALeB9ukDWKo+sR9oCzRGraadL2AH2Mw+8BC8A8fAUfAKTIG+StYIJoEfP0kEP6aqmvkn3xvY+KWKWSfk8RLBWEkv32IZK8FTuxyXPyAuyysiFUS94LkzUdBBXx6RhduIV4FnzmhFmJnYwagLLEqk/7c09kjf5Bj4CC6CbnAe6LfrBuhN3hzI/jIhbQ6dUTvil4h7txoqHZnm3RhYQb1WqzV/bQP9+bKO08v5WXHyorhcUGVl+4Duy6KhW6m/QBYuIdBvWNZQ/zMGw6qSDkLdm/6ak9FwCT3ewuAEeAMOx9ltxj/bATZ8N9CxEnbKmLgdXAaXwK6kN4M4COzQ36bTYNYWyYeihpBmMqLQ9HHMTAe9Dqk7RqQfPfA66DMJRqLcj/JY2Sbg/2aGPuI3GuujZiJA1JcQMpTRQJKRJyE4WGD4lVraY+GNfER4wBjKqPnM+X7liMFecBNsqyxuCxa+A9cmps9kXVQbn3zSmJ3T1dA6VFMvp7tyd3pEjayZ5r5nDb2Rei0aS25pmInlJBnpQxh9LvWG+gSlK/K7kXPIFGSSM4LTleElTYcGNo4EiX7pfnODxNSGNUzVlPK8YSmpSjP38FUQ/wFdLkenTFLauwAAAABJRU5ErkJggg==');
            background-position: 0px 0px;
            height: 8px;
            width: 14px;
            margin: 3px 0 0 1px;
        }

        .onp-flat-button-default span {
            display: inline-block;
            padding: 0px;
        }

        .onp-flat-button-default .onp-flat-button-left-side {
            display: inline-block;
            width: 20px;
            height: 14px;
            float: left;
            border-right: 1px solid #87a2bf;
            border-right-color: rgba(255, 255, 255, 0.24);
            padding-left: 5px;
            padding-right: 1px;
            margin: 3px 8px 0 0;
            text-align: center;
            vertical-align: top;
            box-sizing: content-box;
        }

        .onp-flat-button-default:hover {
            box-shadow: inset 0 0 50px rgba(255, 255, 255, 0.1);
            -webkit-box-shadow: inset 0 0 50px rgba(255, 255, 255, 0.1);
            -moz-box-shadow: inset 0 0 50px rgba(255, 255, 255, 0.1);
        }

        #onp-flat-button-default-counter {
            position: relative;
            display: none;
            vertical-align: top;
            min-width: 15px;
            border: 1px solid #adbdcc;
            color: #55677d;
            -webkit-border-radius: 2px;
            -moz-border-radius: 2px;
            border-radius: 2px;
            cursor: pointer;
            padding: 4px 6px 4px;
            margin-left: 3px;
            font-family: tahoma, verdana, arial, sans-serif;
            font-size: 11px;
            text-align: center;
            line-height: 12px;
            background: #ffffff;
        }

        #onp-flat-button-default-counter.show {
            display: inline-block !important;
        }

        #onp-flat-button-default-counter:after, #onp-flat-button-default-counter:before {
            content: '';
            position: absolute;
            top: 50%;
            left: -12px;
            margin-top: -6px;
            border: 6px solid transparent;
            border-right-color: #608ab1;
            z-index: 1;
        }

        #onp-flat-button-default-counter:before {
            display: block;
            margin-top: -5px;
            border: 5px solid transparent;
            left: -10px;
            border-right-color: #fff;
            z-index: 9;
        }

        .onp-flat-button-default.onp-hold-confirmation {
            background: #8D969E;
        }

        .onp-vk-clickja-button {
            position:absolute !important;
            left:0; top:0;
            opacity: 0;
        }
        .onp-vk-clickja-button iframe {
            position:absolute;
            /*top:-190px; left:-30px;*/
            z-index:9;
            opacity:0;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
        }
  </style>
  <script src="//vk.com/js/api/openapi.js" type="text/javascript"></script>
  <script type="text/javascript">
     'use strict';

     var postMessageData = {
         onpwgt: {
             button: {
                 name: 'vk-share'
             }
         }
     };

     var shareButton = {
         buttonCounterBuffer: 0,
         taskcheckShared: 0,

         vkUserId: null,
         hoverWidget: false,
         vkWidgetUnique: null,
         vkRqApiGetListConfirm: true,
         alternateURL: null,
         vkAuth: false,
         mobile: false,

         options: {
             appId: '<?=ArrayHelper::getValue($options,'appId');?>',
             accessToken: '<?=ArrayHelper::getValue($options,'accessToken');?>',
             pageUrl: '<?=ArrayHelper::getValue($options,'pageUrl');?>',
             pageTitle: '<?=ArrayHelper::getValue($options,'pageTitle');?>',
             pageDescription: '<?=ArrayHelper::getValue($options,'pageDescription');?>',
             pageImage: '<?=ArrayHelper::getValue($options,'pageImage');?>',
             counter: '<?=ArrayHelper::getValue($options,'counter');?>',
             clickja: '<?=ArrayHelper::getValue($options,'clickja');?>',
             noCheck: '<?=ArrayHelper::getValue($options,'noCheck');?>'
         },

         init: function () {
             var self = this;
             this.prepareOptions();
             this.setupEvents();
             this.create();

             console.log('start');
         },

         prepareOptions: function () {
             this.url = this.options.pageUrl;

             //Для мобильных устройств включаем кликджекинг
             if (isMobile()) {
                 this.mobile = true;
                 this.options.clickja = true;
             }

             this.vkWidgetUnique = Math.floor((Math.random() * 999999) + 1);

             //Отключаем кликджекинг для яндекс браузера
             if (navigator.userAgent.search(/YaBrowser/i) > 0) {
                 this.options.clickja = false;
             }

             this.cookieCounterCacheName = 'onp-vk-share-button-counter-cache-' + $.pandalocker.tools.hash(this.url);
             this.cookieMobileCheckName = 'onp-vk-share-button-mobile-check' + $.pandalocker.tools.hash(this.url);

             if (getFromStorage('onp-vk-buttons-oid') && this.options.clickja) {
                 this.vkUserId = getFromStorage('onp-vk-buttons-oid');
             }

             if (getFromStorage(this.cookieCounterCacheName)) {
                 this.buttonCounterBuffer = getFromStorage(this.cookieCounterCacheName);
             }

             //this.options.counter = "vertical" === this.groupOptions.layout ? true : this.groupOptions.counters;
         },

         setupEvents: function () {
             var self = this;


             if (!self.options.appId) {
                 throw new Error("Не передан appi id");
             }

             window.VK.init({
                 apiId: self.options.appId,
                 onlyWidgets: true
             });

             /*if ( self.options.clickja ) {
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
              }*/

             /*if ( self.options.noCheck && $.pandalocker.tools.getFromStorage( self.cookieMobileCheckName ) ) {
              self.locker._showScreen( 'data-processing' );
              $( document ).trigger( 'vk-share', [self.url] );
              $.pandalocker.tools.removeStorage( self.cookieMobileCheckName );
              }*/
         },

         /**
          * Иммитация метода window.VK.Api.call, фикс для сайтов с киррилическими доменами.
          */
         vkApiCall: function (method, params, cb) {
             var query = params || {},
                 qs,
                 responseCb,
                 self = this;

             responseCb = function (response) {
                 cb(response);
             }

             var rnd = parseInt(Math.random() * 10000000, 10);
             while (VK.Api._callbacks[rnd]) {
                 rnd = parseInt(Math.random() * 10000000, 10)
             }

             query.callback = 'VK.Api._callbacks[' + rnd + ']';

             qs = VK.Cookie.encode(query);

             VK.Api._callbacks[rnd] = responseCb;

             setTimeout(function () {
                 VK.Api.attachScript(VK._domain.api + 'method/' + method + '?' + qs);
             }, 1500);
         },

         /***
          * Получает id пользователя вконтакте. Принцип работы метода:
          * получает список всех лайков текущей страницы и по id лайка выбирает пользователя,
          * который поставил лайк.
          * @param likeId
          * @param callback
          * @returns void
          */
         getvkUserId: function (likeId, callback) {
             var self = this;

             self.vkRqApiGetListConfirm = false;

             self.vkApiCall('likes.getList', {
                 type: 'sitepage',
                 owner_id: self.options.appId,
                 page_url: self.url,
                 item_id: self.vkWidgetUnique,
                 access_tooken: self.options.accessToken,
                 extended: 1,
                 offset: 0,
                 count: 10
             }, function (r) {
                 self.vkRqApiGetListConfirm = true;

                 if (r && r.error) {
                     throw Error(r.error.error_msg);
                 }

                 if (!r || !r.response || !r.response.items) {
                     throw Error("response to vk api likes.getList");
                 }

                 var users = r.response.items.reverse();
                 var currentUserInfo = users[likeId - 1];

                 self.vkUserId = currentUserInfo.uid;
                 setStorage('onp-vk-buttons-oid', self.vkUserId, 364);

                 callback(self.vkUserId);
             });

             if (!timerVkRqApiGetListConfirm) {
                 var timerVkRqApiGetListConfirm = setInterval(function () {
                     if (self.vkRqApiGetListConfirm) {
                         clearInterval(timerVkRqApiGetListConfirm);
                         return false;
                     }
                     self.getvkUserId(likeId, callback);
                 }, 3000);
             }
         },

         /**
          * Создает окно репоста страницы, в этом же методе происходит прослушивание на закрытие окна
          * @return void
          */
         showShareWindow: function () {
             var self = this;

             var additionalOptions = ( self.options.pageTitle
                     ? "&title=" + encodeURIComponent(self.options.pageTitle)
                     : '' ) +
                 ( self.options.pageDescription
                     ? "&description=" + encodeURIComponent(self.options.pageDescription)
                     : '' ) +
                 ( self.options.pageImage
                     ? "&image=" + self.options.pageImage
                     : '' ) + "&noparse=false";

             var width = 550;
             var height = 420;

             var x = screen.width ? (screen.width / 2 - width / 2 + findLeftWindowBoundry()) : 0;
             var y = screen.height ? (screen.height / 2 - height / 2 + findTopWindowBoundry()) : 0;

             var winref = window.open(
                 "//vk.com/share.php?url=" + encodeURIComponent(self.url) + additionalOptions,
                 "Sociallocker",
                 "width=" + width + ",height=" + height + ",left=" + x + ",top=" + y + ",resizable=yes,scrollbars=yes,status=yes"
             );

             var timerInterationCount = 0,
                 failedChecksCounter = 0,
                 intervalStep = 3,
                 pollTimer;

             if (self.mobile) {
                 if (self.vkUserId && self.options.clickja) {
                     $.pandalocker.tools.setStorage(self.cookieMobileCheckName, self.url, 1);
                     //self.locker._showScreen('data-processing');
                     postMessageData.onpwgt.button['event'] = 'processing';
                     window.parent.postMessage(JSON.stringify(postMessageData), '*');

                     pollTimer = setInterval(
                         function () {
                             timerInterationCount++;

                             if (( timerInterationCount % intervalStep ) == 0) {

                                 self.checkSharedByGetWall(
                                     self.vkUserId, function (result) {

                                         if (result == 'success') {
                                             clearInterval(pollTimer);
                                             failedChecksCounter = 0;
                                             return false;
                                         }

                                         if (failedChecksCounter >= 3) {
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
                     if (self.options.noCheck) {
                         setStorage(self.cookieMobileCheckName, self.url, 1);

                         postMessageData.onpwgt.button['event'] = 'processing';
                         window.parent.postMessage(JSON.stringify(postMessageData), '*');

                         setInterval(
                             function () {
                                 $(document).trigger('vk-share', [self.url]);
                             }, 10000
                         );
                     } else {
                         self.checkShared();
                     }
                 }
             } else {
                 postMessageData.onpwgt.button['event'] = 'processing';
                 window.parent.postMessage(JSON.stringify(postMessageData), '*');

                 // waiting until the window is closed
                 pollTimer = setInterval(
                     function () {
                         if (!winref || winref.closed !== false) {
                             clearInterval(pollTimer);

                             if (self.options.clickja && self.vkUserId) {
                                 self.checkSharedByGetWall(self.vkUserId);
                                 return false;
                             }

                             self.checkShared();
                         }
                         timerInterationCount++;
                     }, 200
                 );
             }
         },

         /***
          * Проверяет поделился ли пользователь страницой или нет.
          * Проверка выполняется с помощью прослушивания счетчика,
          * если счетчик изменился, мы можем быть уверены, что это правда.
          * @returns void
          */
         checkShared: function (csCallback) {

             var self = this;
             self.getShareCounterScripts();

             if (!window.VK.Share) {
                 window.VK.Share = {};
             }
             window.VK.Share.count = function (idx, number, callback) {
                 if (callback) {
                     return 'mark';
                 }

                 if (self.buttonCounterBuffer < number) {
                     csCallback && csCallback('success');

                     postMessageData.onpwgt.button['event'] = 'share';
                     postMessageData.onpwgt.button['url'] = self.url;
                     window.parent.postMessage(JSON.stringify(postMessageData), '*');

                     //$(document).trigger('vk-counter-ready', [number]);

                     self.taskcheckShared = 0;
                     return;
                 }

                 setTimeout(
                     function () {
                         if (self.taskcheckShared > 3) {
                             self.taskcheckShared = 0;

                             postMessageData.onpwgt.button['event'] = 'notshare';
                             postMessageData.onpwgt.button['url'] = self.url;
                             window.parent.postMessage(JSON.stringify(postMessageData), '*');

                             if (csCallback) {
                                 csCallback && csCallback('fail');
                                 return;
                             }

                             return false;
                         }

                         self.checkShared();
                         self.taskcheckShared++;
                     }, 1500
                 );
             };
         }

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
         checkSharedByGetWall: function (uid, callback) {
             var self = this;

             self.vkApiCall(
                 'wall.get', {
                     owner_id: uid,
                     count: 1,
                     filter: 'owner',
                     access_token: self.options.accessToken
                 }, function (r) {

                     if (!r || !r.response) {
                         return;
                     }
                     if (r.response[1].attachment.link && r.response[1].attachment.link.url) {

                         var getWallLink = r.response[1].attachment.link.url;

                         if (!getWallLink) {
                             return;
                         }

                         callback && callback('success');

                         postMessageData.onpwgt.button['event'] = 'share';
                         postMessageData.onpwgt.button['url'] = getWallLink;
                         window.parent.postMessage(JSON.stringify(postMessageData), '*');

                         return false;
                     }

                     postMessageData.onpwgt.button['event'] = 'notshare';
                     postMessageData.onpwgt.button['url'] = getWallLink;
                     window.parent.postMessage(JSON.stringify(postMessageData), '*');

                     if (callback) {
                         callback && callback('fail');
                         return false;
                     }
                 }
             );
         },

         /***
          * Инициализирует виджет лайка для получения id пользователя вконтакте,
          * если кликджекинг отключен метод уведомляет о том, что кнопка загружена.
          * @returns void
          */
         initShareWiget: function () {
             var self = this;

             self.vkWidgetUnique = Math.floor((Math.random() * 999999) + 1);
             var vkWidgetUniId = "onp-vk-clickja-button-" + self.vkWidgetUnique;
             self.likeButtonContanier.id = vkWidgetUniId;

             self.widgetId = VK.Widgets.Like(vkWidgetUniId, {
                 type: "button",
                 pageUrl: self.url,
                 verb: 1,
                 height: 24
             }, self.vkWidgetUnique);

             if (this.options.counter) {
                 this.buttonCounter.className += ' show';
             }

             if( self.widgetId ) {
                 this.buttonCounter.className += ' loaded';

                 postMessageData.onpwgt.button['event'] = 'loaded';
                 window.parent.postMessage(JSON.stringify(postMessageData), '*');
             }

             var timerCheckClickToLikeButton;

             document.body.onmouseover = function (e) {
                 self.hoverWidget = true;

                 postMessageData.onpwgt.button['event'] = 'mouseover';
                 window.parent.postMessage(JSON.stringify(postMessageData), '*');

                 var vkWidgetHintId = 'vkwidget' + self.widgetId + '_tt',
                     styleHideWidgetHint = document.createElement('style');

                 styleHideWidgetHint.className = "vkwidget" + self.widgetId + "_tt";
                 styleHideWidgetHint.innerHTML = vkWidgetHintId + '{display:none !important;}';

                 if( !document.getElementsByClassName('vkwidget' + self.widgetId + '_tt') ) {
                     document.head.insertAfter(styleHideWidgetHint, document.head.lastChild);
                 }

                 timerCheckClickToLikeButton = setInterval(function () {
                     var elm = document.getElementById(vkWidgetHintId);

                     if( elm && elm.getAttribute('vkhidden') && elm.getAttribute('vkhidden') == 'no') {
                         self.button.className += ' onp-vk-default-button-process';
                         self.button.getElementsByTagName('span').innerText = 'подождите...';

                         clearInterval(timerCheckClickToLikeButton);

                         if (self.hoverWidget) {
                             self.getvkUserId(1, function () {
                                 self.likeButtonContanier.style.display = "none";
                                 self.button.className = self.button.className.replace(/\sonp-vk-default-button-process/,'');
                                 elm.remove();

                                 postMessageData.onpwgt.button['event'] = 'click';
                                 postMessageData.onpwgt.button['oid'] = self.vkUserId;
                                 window.parent.postMessage(JSON.stringify(postMessageData), '*');
                             });
                         }
                     }
                 }, 50);

             };
             document.body.onmouseout = function (e) {
                 self.hoverWidget = false;

                 postMessageData.onpwgt.button['event'] = 'mouseout';
                 window.parent.postMessage(JSON.stringify(postMessageData), '*');

                 clearInterval(timerCheckClickToLikeButton);
             };

             return false;
         },

         /**
          * Устанавливает счетчик для кнопки
          * @return void
          */
         setCounter: function () {
             var self = this;
             if (this.buttonCounterBuffer) {
                 this.buttonCounter.innerText = this.minimalizeLargeNum(this.buttonCounterBuffer);
             }

             if (!self.options.clickja || (self.options.clickja && self.vkUserId)) {
                 if (this.options.counter) {
                     this.buttonCounter.className += ' show';
                 }

                 this.buttonCounter.className += ' loaded';

                 postMessageData.onpwgt.button['event'] = 'loaded';
                 window.parent.postMessage(JSON.stringify(postMessageData), '*');
             }

             if (!self.likeButtonContanier.id && self.options.clickja && !self.vkUserId) {
                 self.initSubscribeWidget();
             }
         },

         /**
          * Получает скрипт счетчика вконтакте
          * @param inx
          * @param url
          * @param callback
          * @returns void
          */
         getShareCounterScripts: function (callback) {
             var script = document.createElement('script');
             var prior = document.getElementsByTagName('script')[0];
             script.async = 1;
             prior.parentNode.insertBefore(script, prior);

             script.onload = script.onreadystatechange = function( _, isAbort ) {
                 if(isAbort || !script.readyState || /loaded|complete/.test(script.readyState) ) {
                     script.onload = script.onreadystatechange = null;
                     script = undefined;

                     if(!isAbort) { if(callback) callback(); }
                 }
             };

             script.src = '//vk.com/share.php?act=count&index=1&url=' + encodeURIComponent(this.url);
         },

         /**
          * Преобразует длинное число счетчика в короткое
          * @param n
          * @returns string
          */
         minimalizeLargeNum: function (n) {
             if (n < 1000) return n;

             n = n / 1000;
             n = Math.round(n * 10) / 10

             return n + "k";
         },

         create: function () {
             var self = this;

             if (!self.options.accessToken) {
                 throw new Error('Invalid access token');
             }

             if (!self.options.groupId) {
                 throw new Error('Invalid group id');
             }

             this.button = document.getElementById('onp-flat-button');
             this.likeButtonContanier = this.button.getElementsByClassName('onp-vk-clickja-button')[0];
             this.buttonCounter = document.getElementById('onp-flat-button-default-counter');

             this.button.onclick = function () {

                 postMessageData.onpwgt.button['event'] = 'click';
                 postMessageData.onpwgt.button['oid'] = self.vkUserId;
                 window.parent.postMessage(JSON.stringify(postMessageData), '*');

                 return false;
             };

             if (!self.options.clickja || self.vkUserId) {
                 document.body.onmouseover = function (e) {
                     self.hoverWidget = true;

                     postMessageData.onpwgt.button['event'] = 'mouseover';
                     window.parent.postMessage(JSON.stringify(postMessageData), '*');
                 };

                 document.body.onmouseout = function (e) {
                     self.hoverWidget = false;

                     postMessageData.onpwgt.button['event'] = 'mouseout';
                     window.parent.postMessage(JSON.stringify(postMessageData), '*');
                 };
             }


             if (!getFromStorage(self.cookieCounterCacheName)) {
                 self.updateApiGroupOptions();
                 return false;
             }

             self.setGroupCounter();
         }
     };

     window.onload = function () {
         shareButton.init();
     };

     /**
      * Возвращает true если пользователь зашел с мобильного усройства.
      * @return boolean
      */
     var isMobile = function () {
         if ((/webOS|iPhone|iPod|BlackBerry/i).test(navigator.userAgent)) return true;
         if ((/Android/i).test(navigator.userAgent) && (/Mobile/i).test(navigator.userAgent)) return true;
         return false;
     };

     /**
      * Кодирует строку по алгоритму md5.
      * @return string
      */
     var hash = function (str) {
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
      * Обертка для работы cookie.
      * @return mixed
      */
     var cookie = function (key, value, options) {
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

     /**
      * Дабавляет метку или куку в локальное хранилище
      * @param cookieName
      * @param value
      * @param expires
      */
     var setStorage = function (cookieName, value, expires) {
         if (localStorage && localStorage.setItem) {
             try {
                 var unixtime = Math.round(+new Date() / 1000);
                 var str = {
                     data: value,
                     expires: expires * 86400 + unixtime
                 };
                 localStorage.setItem(cookieName, JSON.stringify(str));
             }
             catch (e) {
                 cookie(cookieName, value, {expires: expires, path: "/"});
             }
         } else {
             cookie(cookieName, value, {expires: expires, path: "/"});
         }
     };

     /**
      * Получает метку или куку из локального хранилища
      * @param cookieName
      * @returns {string}
      */
     var getFromStorage = function (cookieName) {
         var result = localStorage && localStorage.getItem && localStorage.getItem(cookieName);
         if (result) {
             var unixtime = Math.round(+new Date() / 1000);
             result = JSON.parse(result);
             if (result.expires < unixtime) {
                 removeStorage(cookieName);
                 return null;
             }
             return result.data;
         } else {
             return cookie(cookieName) || null;
         }
     };

     /**
      * Удаляет метку или куку из локального хранилища
      * @param cookieName
      */
     var removeStorage = function (cookieName) {
         if (localStorage && localStorage.removeItem) {
             localStorage.removeItem(cookieName);
         } else {
             cookie(cookieName, null, {expires: 0, path: "/"});
         }
     };

     // Find Left Boundry of current Window
     var findLeftWindowBoundry = function () {
         // In Internet Explorer window.screenLeft is the window's left boundry
         if (window.screenLeft)
             return window.screenLeft;
         // In Firefox window.screenX is the window's left boundry
         if (window.screenX)
             return window.screenX;
         return 0;
     };

     // Find Left Boundry of current Window
     var findTopWindowBoundry = function () {
         // In Internet Explorer window.screenLeft is the window's left boundry
         if (window.screenTop)
             return window.screenTop;
         // In Firefox window.screenY is the window's left boundry
         if (window.screenY)
             return window.screenY;
         return 0;
     };
  </script>
</head>
<body>
    <div id="onp-flat-button" class="onp-flat-button-default onp-sl-vk-subscribe-button">
        <div class="onp-flat-button-left-side"><i class="onp-flat-button-vk-logo"></i></div>
        <span>поделиться</span>
        <div class="onp-vk-clickja-button"></div>
    </div>
    <div id="onp-flat-button-default-counter">-</div>
</body>
</html>