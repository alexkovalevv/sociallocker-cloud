<?php
use \yii\helpers\ArrayHelper;
?>
<!DOCTYPE html>
<html>
<head>
  <title>Кнопка Вконтакте мне нравится</title>
  <meta charset="utf-8" content="text/html">

  <style>
        body{
            margin:0;
            padding:0;
        }
        iframe[src*="act=a_stats_box"], .VKWidgetsLoader {
            display:none !important;
        }

        #onp-vk-like-button-cotanier {
            width: 85px;
        }

        .onp-vk-like-alert {
            position:absolute;
            width:150px;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            background-color:#ff6e6e;
            font-family: tahoma, verdana, arial, sans-serif, Lucida Sans;
            font-size: 11px;
            line-height: 140%;
            color:#fff;
            padding:8px 10px;
            text-align:center;
            border-radius:5px;
            z-index:99999;
        }
        .onp-vk-like-alert:before {
            position:absolute;
            content: '';
            top:-25px; left:5px;
            width:32px; height:30px;
            background: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAjCAYAAAD17ghaAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAZRJREFUeNrEl79Kw1AUxuOtFDp10iVr165dhT6AD+AbOH1r36Bz6QN0dXISDAQKgYAgOAlOToKTIAhCphBP5ATj5Sa5uX+SD762ubdwfjm599yTk6IoAmMBgaUuRDCetuTwdKTg1+QN+XyMDFyS9+TnYLf7GBpgRb4hT8jHcmBIgAX5jjzj63hIgDPyPX+XysnpUAAzvvNFbeyB/DUEwISf+UoaT6sfvgH2vOplRUMAbHi/y8rIj74BrrjSqZQyhDeANfnQMn+sXwgPhaZc8dMxAORCo9In+ckHgFxogpbnn7sGUBWaJkXygPBUaNoy4BSgqdCo9P57BDsDAJoKTZMS1aAwDN5WaJoUuwEAugqN1v43AwCW9HnbUWhUeiW/2QEAIe/1ucHdx00TQjP4nIOHhks2MQcAppz2pWHw3DYDBz7hTPXCZ4ABALDls91GUdukaAlevb3YKukPAFRvL7bK+wMA9bcXW5Xt97c+AKDTVDhL/38AQLepcLYA/wCAPk2FrjK5/VIDAH2bij7pz7r+9CPAAD9tVvn+fcbdAAAAAElFTkSuQmCC') no-repeat;
        }

        /*.counter-off {
            width:50px;
        }*/
        /*.counter-off:after {
            content: '';
            position: absolute;
            top:0; left: 50px;
            height: 22px;
            width:100%;
            background: #fff;
            z-index: 99;
        }*/
  </style>
  <script src="//vk.com/js/api/openapi.js" type="text/javascript"></script>

  <script type="text/javascript">

      if( !VK || !VK.init ) {
          throw new Error('Не удалось загрузить sdk вконтакте.');
      }

      VK.init({
          apiId: '<?=ArrayHelper::getValue($options, 'appId');?>',
          onlyWidgets: true
      });

      var postMessageData = {
              onpwgt: {
                  button: {
                      name: 'vk-like'
                  }
              }
          },
          hoverWidget = false;


      VK.Observer.subscribe("widgets.like.liked", function () {
          if( hoverWidget ) {
              vkShareHint.show();
              vkShareHint.runTimer();
          }

          postMessageData.onpwgt.button['event'] = 'liked';
          window.parent.postMessage(JSON.stringify(postMessageData), '*');
      });

      VK.Observer.subscribe("widgets.like.unliked", function () {
          postMessageData.onpwgt.button['event'] = 'unliked';
          window.parent.postMessage(JSON.stringify(postMessageData), '*');
      });

      VK.Observer.subscribe("widgets.like.shared", function () {
          postMessageData.onpwgt.button['event'] = 'shared';
          window.parent.postMessage(JSON.stringify(postMessageData), '*');
      });

      VK.Observer.subscribe("widgets.like.unshared", function () {
          postMessageData.onpwgt.button['event'] = 'unshared';
          window.parent.postMessage(JSON.stringify(postMessageData), '*');
      });

      window.onload = function(){

          function listener(event) {
              if( event.data.indexOf('onpwgt_to') === -1 ) return;

              var data = JSON.parse(event.data);
              if( data.onpwgt_to && data.onpwgt_to.button && data.onpwgt_to.button.name) {
                  if(data.onpwgt_to.button.name === 'vk-like') {
                      var defaultOptions = {
                              pageUrl: null,
                              pageTitle: '',
                              pageDescription: '',
                              pageImage: '',
                              counter:  1,
                              type: 'mini',
                              width: '350',
                              height: '22',
                              verb: '0'
                          },
                          options = extend({}, defaultOptions, data.onpwgt_to.button);

                      postMessageData.onpwgt.button['url'] = options.pageUrl;

                      var widget = VK.Widgets.Like('onp-vk-like', options);

                      if( widget ) {
                          postMessageData.onpwgt.button['event'] = 'loaded';
                          window.parent.postMessage(JSON.stringify(postMessageData), '*');
                      }
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

          document.getElementById('onp-vk-like-button-cotanier').onmouseover = function (e) {
              hoverWidget = true;
              postMessageData.onpwgt.button['event'] = 'mouseover';
              window.parent.postMessage(JSON.stringify(postMessageData), '*');
          };

          document.getElementById('onp-vk-like-button-cotanier').onmouseout = function (e) {
              hoverWidget = false;
              postMessageData.onpwgt.button['event'] = 'mouseout';
              window.parent.postMessage(JSON.stringify(postMessageData), '*');
          };
      };

      var vkShareHint = {
          /**
           * Показывает подсказку "Рассказать друзьям".
           * @return void
           */
          show: function () {

              // если подсказка уже видимая, то ничего не делаем
              if (this.elementShown) return;
              this.elementShown = true;

              // если подсказка еще не создана, создаем ее и вставляем в документ
              if (!this.element) {
                  this.element = document.createElement('div');
                  this.element.className = "onp-vk-like-alert";
                  this.element.innerText = "Чтобы разблокировать, нажмите сюда";
                  document.body.insertBefore(this.element, document.body.childNodes[0]);
              }

              // Обновляем позицию подсказки и показываем ее
              this.locate();
              this.element.style.display = "block";
          },

          /**
           * Скрывает подсказку
           * @return void
           */
          hide: function () {

              // ничего не делаем, если подсказка уже скрыта или ее не существует
              if (!this.elementShown || !this.element) return;
              this.elementShown = false;

              this.element.style.display = "none";
          },

          /**
           * Обновляет позицию подсказки
           * @return void
           */
          locate: function () {
              var self = this;

              var frameLikeWidget = document.getElementById('onp-vk-like').getElementsByTagName('iframe')[0];

              if (!frameLikeWidget || !frameLikeWidget.getAttribute('id'))
                  return;

              var idxVkWidget = frameLikeWidget.getAttribute('id').replace(/vkwidget/i, '');


              if ( !self.target ) {
                  self.target = document.getElementById('vkwidget' + idxVkWidget + '_tt');
              }

              self.element.style.top = (parseInt(self.target.style.top) + 115) + "px";
              self.element.style.left = (parseInt(self.target.style.left) + 5)  + "px";
          },

          /**
           * Запуск таймера, который проверяет, каждые 20 сек видимость всплывающей подсказки вконтакте.
           * Если подсказка вконтакте видима, то делаем видимой и нашу подсказку, иначе скрываем.
           * @return void
           */
          runTimer: function () {
              var self = this;

              self.elementTimerTimout = 20000;
              var step = 200;

              if (self.elementTimer) return;

              self.elementTimer = setInterval(function () {
                  self.elementTimerTimout -= step;

                  if (self.elementTimerTimout <= 0) {
                      self.stop();
                      return;
                  }

                  if (self.isHidden(self.target)) {
                      self.hide();
                  } else {
                      self.show();
                  }
              }, step);
          },

          /**
           * Останавливаем таймер
           * @return void
           */
          stop: function () {
              if (!this.elementTimer) return;

              clearInterval(this.elementTimer);
              this.elementTimer = null;
              this.hide();
          },

          /**
           * Проверяем видимость элемента
           * @param el
           * @returns {boolean}
           */
          isHidden: function(el) {
              var style = window.getComputedStyle(el);
              return (style.display === 'none')
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
  </script>
</head>
<body>
<div id="onp-vk-like-button-cotanier">
    <div id="onp-vk-like"></div>
</div>
</body>
</html>