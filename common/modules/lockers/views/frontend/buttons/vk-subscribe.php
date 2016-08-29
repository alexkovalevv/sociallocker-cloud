<?php
use \yii\helpers\ArrayHelper;

?>
<!DOCTYPE html>
<html>
<head>
  <title>Кнопка подписаться Вконтакте</title>
  <meta charset="utf-8" content="text/html">

  <style>
          body {
              margin: 0;
              padding: 0;
          }

          iframe[src*="act=a_stats_box"], .VKWidgetsLoader {
              display: none !important;
          }

          #btn {
              display: none;
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

          #btn-contanier.vertical #btn {
              margin-top:30px;
          }

          #btn.process {
              background: rgb(185, 185, 185);
          }

          #btn.loaded {
              display: inline-block;
          }

          #btn .btn-icon {
              display: block;
              background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABMAAAA7CAYAAACZr7GXAAAABGdBTUEAALGPC/xhBQAAArJJREFUWAntlrtrVEEUxrMxhUgiIiLRwlaEIIKN+IoaRG3UkKBWitj7DyiYf8A+VqKFVr7QYBElbQxGjeCjsfGFNr4WJfG1/r51Jpy9986ducTOHfj2nDnn+76dnb2zsx2NRuMe0LjVwSB2gtcqMH6Axa6+mXxORcZ+1XKDxrlm++/LOhFIR02tx9XuuNpb4pKckSNtMMILrnbW1HrID5n5kUIjX4R41ZF/EbcCazbM/JPrX/eaYIS4BtSd4D3xkcuz4WTQxDZQHc8q3XyC+N3l+gL2WF0wh3gK/HZCH1aTbAGfXUFxbdDENiDuALeB9ukDWKo+sR9oCzRGraadL2AH2Mw+8BC8A8fAUfAKTIG+StYIJoEfP0kEP6aqmvkn3xvY+KWKWSfk8RLBWEkv32IZK8FTuxyXPyAuyysiFUS94LkzUdBBXx6RhduIV4FnzmhFmJnYwagLLEqk/7c09kjf5Bj4CC6CbnAe6LfrBuhN3hzI/jIhbQ6dUTvil4h7txoqHZnm3RhYQb1WqzV/bQP9+bKO08v5WXHyorhcUGVl+4Duy6KhW6m/QBYuIdBvWNZQ/zMGw6qSDkLdm/6ak9FwCT3ewuAEeAMOx9ltxj/bATZ8N9CxEnbKmLgdXAaXwK6kN4M4COzQ36bTYNYWyYeihpBmMqLQ9HHMTAe9Dqk7RqQfPfA66DMJRqLcj/JY2Sbg/2aGPuI3GuujZiJA1JcQMpTRQJKRJyE4WGD4lVraY+GNfER4wBjKqPnM+X7liMFecBNsqyxuCxa+A9cmps9kXVQbn3zSmJ3T1dA6VFMvp7tyd3pEjayZ5r5nDb2Rei0aS25pmInlJBnpQxh9LvWG+gSlK/K7kXPIFGSSM4LTleElTYcGNo4EiX7pfnODxNSGNUzVlPK8YSmpSjP38FUQ/wFdLkenTFLauwAAAABJRU5ErkJggg==');
              background-position: 0px 0px;
              height: 8px;
              width: 14px;
              margin: 3px 0 0 1px;
          }

          #btn span {
              display: inline-block;
              padding: 0px;
          }

          #btn .btn-left-side {
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

          #btn:hover {
              box-shadow: inset 0 0 50px rgba(255, 255, 255, 0.1);
              -webkit-box-shadow: inset 0 0 50px rgba(255, 255, 255, 0.1);
              -moz-box-shadow: inset 0 0 50px rgba(255, 255, 255, 0.1);
          }

          #btn.confirmation {
              background: #8D969E;
          }

          #btn-counter {
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

          #btn-contanier.vertical #btn-counter {
              position:absolute;
              top:0; left:0;
              width:102px;
              margin-left:0;
          }

          #btn-counter.show {
              display: inline-block !important;
          }

          #btn-counter:after, #btn-counter:before {
              content: '';
              position: absolute;
              top: 50%;
              left: -12px;
              margin-top: -6px;
              border: 6px solid transparent;
              border-right-color: #608ab1;
              z-index: 1;
          }

          #btn-counter:before {
              display: block;
              margin-top: -5px;
              border: 5px solid transparent;
              left: -10px;
              border-right-color: #fff;
              z-index: 9;
          }

          #btn-contanier.vertical #btn-counter:after, #btn-contanier.vertical #btn-counter:before {
              bottom: -12px;
              top:auto;
              left: 80%;
              margin-top:0;
              margin-left: -6px;
              border: 6px solid transparent;
              border-top-color: #608ab1;
          }

          #btn-contanier.vertical #btn-counter:before {
              margin-left: -5px;
              border: 5px solid transparent;
              bottom: -10px;
              border-top-color: #fff;
          }

          .btn-clickja-verify {
              position: absolute !important;
              left: 0;
              top: 0;
              opacity: 0;
          }

          .btn-clickja-verify iframe {
              position: absolute;
              /*top:-190px; left:-30px;*/
              z-index: 9;
              opacity: 0;
              -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
          }
  </style>
  <script src="//vk.com/js/api/openapi.js" type="text/javascript"></script>

  <script type="text/javascript">
     'use strict';

     if( !VK || !VK.init ) {
         throw new Error('Не удалось загрузить sdk вконтакте.');
     }

     var postMessageData = {
         onpwgt: {
             button: {
                 name: 'vk-subsctibe'
             }
         }
     };

     /**
      * Объект кнопки subscribe.
      * Для инициализации кнопки используем метод init, метод init принимает в качестве аргумента
      * объект опций, которые получены с помощую прослушивания postMessage.
     */
     var subscribeButton = {
         userId: null,
         rqApiGetListConfirm: true,
         rqApiGetgetByIdConfirm: true,
         hoverWidget: false,
         groupType: true,
         counterBuffer: null,
         widgetUqNumber: null,
         groupInfo: null,
         isAuth: false,
         isMobile: false,

         options: {
             appId: '<?=ArrayHelper::getValue($options, 'appId');?>',
             accessToken: '<?=ArrayHelper::getValue($options, 'accessToken');?>',
             groupId: null,
             layout: 'horizontal',
             counter:  1,
             clickja:  1
         },

         /**
          * Инициализирует кнопку.
          * @param options - object набор опций
          * @return void
         */
         init: function (options) {
             var self = this;
             this.prepareOptions(options);
             this.setupEvents();
             this.create();
         },

         /**
          * Обрабатываем опции до их использования
          * @param options - object набор опций
          * @return void
         */
         prepareOptions: function (options) {

             this.options = extend({}, this.options, options);

             this.url = this.options.pageUrl;

             postMessageData.onpwgt.button['groupId'] = this.options.groupId;

             //Для мобильных устройств включаем кликджекинг
             if (isMobile()) {
                 this.isMobile = true;
             }

             if (navigator.userAgent.search(/YaBrowser/i) > 0) {
                 this.options.clickja = false;
             }

             if (this.options.groupId) {
                 if (this.options.groupId.indexOf('@') + 1)
                     this.groupType = false;

                 this.originalGroupId = this.options.groupId;

                 this.cookieCounterCacheName = 'vk_subscribe_btn_cache_' + hash(this.originalGroupId);

                 if ( getFromStorage('vk_user_id') && this.options.clickja ) {
                    this.userId = getFromStorage('vk_user_id');
                 }

                 if (getFromStorage(this.cookieCounterCacheName)) {
                     this.groupInfo = JSON.parse(getFromStorage(this.cookieCounterCacheName));
                     this.counterBuffer = this.groupInfo.member_count;
                     this.options.groupId = this.groupInfo.oid;
                 }

                 //this.options.counter = "vertical" === this.options.layout ? true : this.groupOptions.counters;
             }

         },

         /**
          * Устанавливаем события соц. сетей или те события, которые должны инициализироваться до создания кнопки.
          * @return void
         */
         setupEvents: function () {
             var self = this;

             if (!self.options.appId) {
                 throw new Error('Invalid app id');
             }

             window.VK.init({
                 apiId: self.options.appId,
                 onlyWidgets: true
             });
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
         getUserId: function (likeId, callback) {
             var self = this;

             self.rqApiGetListConfirm = false;

             self.vkApiCall('likes.getList', {
                 type: 'sitepage',
                 owner_id: self.options.appId,
                 page_url: self.url,
                 item_id: self.widgetUqNumber,
                 access_tooken: self.options.accessToken,
                 extended: 1,
                 offset: 0,
                 count: 10
             }, function (r) {
                 self.rqApiGetListConfirm = true;

                 if (r && r.error) {
                     throw Error(r.error.error_msg);
                 }

                 if (!r || !r.response || !r.response.items) {
                     throw Error("response to vk api likes.getList");
                 }

                 var users = r.response.items.reverse();
                 var currentUserInfo = users[likeId - 1];

                 self.userId = currentUserInfo.uid;
                 setStorage('vk_user_id', self.userId, 364);

                 callback(self.userId);
             });

             if (!timerrqApiGetListConfirm) {
                 var timerrqApiGetListConfirm = setInterval(function () {
                     if (self.rqApiGetListConfirm) {
                         clearInterval(timerrqApiGetListConfirm);
                         return false;
                     }
                     self.getUserId(likeId, callback);
                 }, 3000);
             }
         },

         /***
          * Инициализирует виджет лайка для получения id пользователя вконтакте,
          * если кликджекинг отключен метод уведомляет о том, что кнопка загружена.
          * @returns void
          */
         initSubscribeWidget: function () {
             var self = this;
             self.widgetUqNumber = Math.floor((Math.random() * 999999) + 1);
             var vkWidgetUniId = "btn-clickja-verify-" + self.widgetUqNumber;
             self.likeButtonContanier.id = vkWidgetUniId;

             self.widgetId = VK.Widgets.Like(vkWidgetUniId, {
                 type: "button",
                 pageUrl: self.url,
                 verb: 1,
                 height: 24
             }, self.widgetUqNumber);

             if (this.options.counter) {
                 this.buttonCounter.className += 'show';
             }

             if( self.widgetId ) {
                 this.button.className += ' loaded';

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
                 styleHideWidgetHint.innerHTML = "#" + vkWidgetHintId + '{display:none !important;}';

                 if( !document.getElementsByClassName('vkwidget' + self.widgetId + '_tt')[0] ) {
                     document.head.appendChild(styleHideWidgetHint);
                 }

                 timerCheckClickToLikeButton = setInterval(function () {
                     var elm = document.getElementById(vkWidgetHintId);

                     if( elm && elm.getAttribute('vkhidden') && elm.getAttribute('vkhidden') == 'no') {
                         self.button.className += ' process';
                         self.button.getElementsByTagName('span')[0].innerText = 'подождите...';

                         clearInterval(timerCheckClickToLikeButton);

                         if (self.hoverWidget) {
                             self.getUserId(1, function () {
                                 self.likeButtonContanier.style.display = "none";
                                 self.button.className = self.button.className.replace(/\sprocess/,'');

                                 self.button.getElementsByTagName('span')[0].innerText = 'поделиться';
                                 elm.remove();

                                 postMessageData.onpwgt.button['event'] = 'click';
                                 postMessageData.onpwgt.button['oid'] = self.userId;
                                 window.parent.postMessage(JSON.stringify(postMessageData), '*');

                                 clearInterval(timerCheckClickToLikeButton);
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
          * Создает окно подписки на группу или страницу пользователя
          */
         showSubscribeWindow: function () {
             var self = this;

             var width = 550;
             var height = 420;

             var x = screen.width ? (screen.width / 2 - width / 2 + findLeftWindowBoundry()) : 0;
             var y = screen.height ? (screen.height / 2 - height / 2 + findTopWindowBoundry()) : 0;


             var winref = window.open(
                 "https://vk.com/widget_community.php?act=a_subscribe_box&oid=" + ( this.groupType ? -self.options.groupId : self.options.groupId ) + "&state=1",
                 "vk_openapi",
                 "width=" + width + ",height=" + height + ",left=" + x + ",top=" + y + ",resizable=yes,scrollbars=yes,status=yes"
             );

             if (self.isMobile) {
                 if (self.userId && self.options.clickja) {
                     postMessageData.onpwgt.button['event'] = 'processing';
                     window.parent.postMessage(JSON.stringify(postMessageData), '*');

                     var timerInterationCount = 0,
                         failedChecksCounter = 0,
                         intervalStep = 3,
                         pollTimer;

                     pollTimer = setInterval(
                         function () {
                             timerInterationCount++;
                             if (( timerInterationCount % intervalStep ) == 0) {
                                 self.checkUserSubscribe(function () {
                                     clearInterval(pollTimer);
                                 });
                             }

                         }, 1000
                     );
                 }
             } else {
                 postMessageData.onpwgt.button['event'] = 'processing';
                 window.parent.postMessage(JSON.stringify(postMessageData), '*');

                 // waiting until the window is closed
                 var pollTimer = setInterval(function () {
                     if (!winref || winref.closed !== false) {
                         clearInterval(pollTimer);
                         self.checkUserSubscribe();
                     }
                 }, 200);
             }
         },

         /**
          * Проверяет подписался ли пользователь или нет
          * @returns void
          */
         checkUserSubscribe: function (callback) {
             var self = this;

             if (self.options.clickja) {
                 if (!self.userId) {
                     throw Error("Не установлен user_id");
                 }

                 if (!self.groupType) {
                     self.vkApiCall('users.getFollowers', {
                         user_id: self.options.groupId,
                         offset: 0
                     }, function (r) {
                         if (!r || !r.response) {
                             throw Error("Неудачный запрос к users.getFollowers");
                         }

                         if ($.inArray(self.userId, r.response.items) < 0) {

                             postMessageData.onpwgt.button['event'] = 'notsubscribe';
                             window.parent.postMessage(JSON.stringify(postMessageData), '*');
                             return false;
                         }

                         callback && callback();

                         postMessageData.onpwgt.button['event'] = 'subscribe';
                         window.parent.postMessage(JSON.stringify(postMessageData), '*');

                         removeStorage(self.cookieCounterCacheName);
                     });
                 } else {
                     self.vkApiCall('groups.isMember', {
                         group_id: self.options.groupId,
                         user_id: self.userId
                     }, function (r) {
                         if (!r || r.error) {
                             throw Error("Неудачный запрос к groups.isMember");
                         }

                         if (!r.response) {
                             postMessageData.onpwgt.button['event'] = 'notsubscribe';
                             window.parent.postMessage(JSON.stringify(postMessageData), '*');
                             return false;
                         }

                         callback && callback();

                         postMessageData.onpwgt.button['event'] = 'subscribe';
                         window.parent.postMessage(JSON.stringify(postMessageData), '*');

                         removeStorage(self.cookieCounterCacheName);
                     });
                 }
             } else {
                 postMessageData.onpwgt.button['event'] = 'subscribe';
                 window.parent.postMessage(JSON.stringify(postMessageData), '*');
             }
         },

         /**
          * Устанавливает счетчик для кнопки
          * @return void
          */
         setGroupCounter: function () {
             var self = this;
             if (this.counterBuffer) {
                 this.buttonCounter.innerText = this.minimalizeLargeNum(this.counterBuffer);
             }

             if (!self.options.clickja || (self.options.clickja && self.userId)) {
                 if (this.options.counter) {
                     this.buttonCounter.className += 'show';
                 }

                 this.button.className += ' loaded';

                 postMessageData.onpwgt.button['event'] = 'loaded';
                 window.parent.postMessage(JSON.stringify(postMessageData), '*');
             }

             if (!self.likeButtonContanier.id && self.options.clickja && !self.userId) {
                 self.initSubscribeWidget();
             }
         },

         /**
          * Получает количество пользователей в группе или в подписчиках страницы,
          * и обновляет значения счетчика
          * @param callback
          * @return void
          */
         updateApiGroupOptions: function (callback) {
             var self = this;

             self.rqApiGetgetByIdConfirm = false;

             if (!this.groupType) {
                 self.vkApiCall('users.get', {
                     user_ids: self.options.groupId.replace('@', ''),
                     fields: 'followers_count, photo_100'
                 }, function (r) {
                     self.rqApiGetgetByIdConfirm = true;

                     if (r && r.error) {
                         if (r.error.error_code == 113) {
                             throw new Error('Пользователь с таким id не найдет');
                         }

                         throw new Error(r.error.error_msg);
                         return;
                     }

                     if (!r || !r.response) {
                         throw new Error('Ошибка при запросе к vk api user.get');
                     }
                     self.groupInfo = {
                         title: r.response[0].first_name + ' ' + r.response[0].last_name,
                         image: r.response[0].photo_100,
                         oid: parseInt(r.response[0].uid),
                         member_count: parseInt(r.response[0].followers_count)
                     };

                     self.counterBuffer = parseInt(r.response[0].followers_count);
                     self.options.groupId = parseInt(r.response[0].uid);

                     setStorage(self.cookieCounterCacheName, JSON.stringify(self.groupInfo), 2);

                     self.setGroupCounter();
                     callback && callback();
                 });
             } else {
                 self.vkApiCall('groups.getById', {
                     group_id: self.options.groupId,
                     fields: 'members_count'
                 }, function (r) {
                     self.rqApiGetgetByIdConfirm = true;

                     if (r && r.error) {
                         if (r.error.error_code == 100) {
                             throw new Error('Группа с таким id не найдена');
                         }

                         throw new Error(r.error.error_msg);
                     }

                     if (!r || !r.response) {
                         throw new Error('Ошибка при запросе к vk api groups.getById');

                     }

                     self.groupInfo = {
                         title: r.response[0].name,
                         image: r.response[0].photo_medium,
                         oid: parseInt(r.response[0].gid),
                         member_count: parseInt(r.response[0].members_count)
                     };

                     self.counterBuffer = parseInt(r.response[0].members_count);
                     self.options.groupId = parseInt(r.response[0].gid);

                     setStorage(self.cookieCounterCacheName, JSON.stringify(self.groupInfo), 2);

                     self.setGroupCounter();
                     callback && callback();
                 });
             }

             //Автодозвон если первый раз callback не был выполнен
             var timerrqApiGetgetByIdConfirm = setInterval(function () {
                 if (!self.rqApiGetgetByIdConfirm) {
                     self.updateApiGroupOptions(callback);
                     return false;
                 }
                 clearInterval(timerrqApiGetgetByIdConfirm);
             }, 3000);
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

             this.button = document.getElementById('btn');
             this.likeButtonContanier = this.button.getElementsByClassName('btn-clickja-verify')[0];
             this.buttonCounter = document.getElementById('btn-counter');

             if( this.options.layout === 'vertical' ) {
                 this.button.parentNode.className = "vertical"
             }

             this.button.onclick = function () {

                 postMessageData.onpwgt.button['event'] = 'click';
                 postMessageData.onpwgt.button['oid'] = self.userId;
                 window.parent.postMessage(JSON.stringify(postMessageData), '*');

                 self.showSubscribeWindow();

                 return false;
             };

             if(!self.options.clickja || self.userId) {
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

     /**
      * Сливает список перечесленных объектов в один
      * @returns object
      */
     var extend = function (){
         for(var i=1; i<arguments.length; i++)
             for(var key in arguments[i])
                 if(arguments[i].hasOwnProperty(key))
                     arguments[0][key] = arguments[i][key];
         return arguments[0];
     };

     /**
      * Ишет границу окна слева
      * @returns integer
      */
     var findLeftWindowBoundry = function () {
         // In Internet Explorer window.screenLeft is the window's left boundry
         if (window.screenLeft)
             return window.screenLeft;
         // In Firefox window.screenX is the window's left boundry
         if (window.screenX)
             return window.screenX;
         return 0;
     };

     /**
      * Ишет границу окна сверху
      * @returns integer
      */
     var findTopWindowBoundry = function () {
         // In Internet Explorer window.screenLeft is the window's left boundry
         if (window.screenTop)
             return window.screenTop;
         // In Firefox window.screenY is the window's left boundry
         if (window.screenY)
             return window.screenY;
         return 0;
     };


     /**
      * Инициализация кнопки
      */
     window.onload = function () {
         function listener(event) {
             if( event.data.indexOf('onpwgt_to') === -1 ) return;
             var data = JSON.parse(event.data);
             if( data.onpwgt_to && data.onpwgt_to.button && data.onpwgt_to.button.name) {
                 if(data.onpwgt_to.button.name === 'vk-subscribe') {
                     subscribeButton.init(data.onpwgt_to.button);
                 }
             } else {
                 throw new Error('Переданые данные не соотвестуют формату.');
             }
         }

         if (window.addEventListener) {
             window.addEventListener("message", listener);
         } else {
             // IE8
             window.attachEvent("onmessage", listener);
         }
     };
  </script>
</head>
<body>
<div id="btn-contanier">
    <div id="btn">
        <div class="btn-left-side"><i class="btn-icon"></i></div>
        <span>подписаться</span>
        <div class="btn-clickja-verify"></div>
    </div>
    <div id="btn-counter">-</div>
</div>
</body>
</html>