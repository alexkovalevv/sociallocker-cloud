<?php
use \yii\helpers\ArrayHelper;
?>
<!DOCTYPE html>
<html>
<head>
  <title>Vk like button</title>
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
      VK.init({
          apiId: 5337425,
          onlyWidgets: true
      });

      VK.Widgets.Like('onp-vk-like', {
          type: '<?=ArrayHelper::getValue($options, 'type');?>',
          width: '<?=ArrayHelper::getValue($options, 'width');?>',
          height: '<?=ArrayHelper::getValue($options, 'height');?>',
          verb: '<?=ArrayHelper::getValue($options, 'verb');?>',
          pageTitle: '<?=ArrayHelper::getValue($options, 'pageTitle');?>',
          pageDescription: '<?=ArrayHelper::getValue($options, 'pageDescription');?>',
          pageUrl: '<?=ArrayHelper::getValue($options, 'pageUrl');?>',
          pageImage: '<?=ArrayHelper::getValue($options, 'pageImage');?>'
      });

      var postMessageData = {
              onpwgt: {
                  button: {
                      name: 'vk-like'
                  }
              }
          },
          hoverWidget = false;

      window.onload = function(){

          /*var counter = <?=ArrayHelper::getValue($options, 'counter');?>;

          if( !counter ) {
              document.getElementById('onp-vk-like-button-cotanier').className = 'counter-off';
          }*/

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

      var checkIframeCreateTimer = setInterval(function () {
          if (document.getElementById('onp-vk-like').getElementsByTagName('iframe')) {
              clearInterval(checkIframeCreateTimer);
              postMessageData.onpwgt.button['event'] = 'loaded';
              window.parent.postMessage(JSON.stringify(postMessageData), '*');
          }
      }, 50);

      var vkShareHint = {
          /**
           * Shows the VK Share Hint.
           */
          show: function () {

              // if the hint is already visible, nothing to do
              if (this.elementShown) return;
              this.elementShown = true;

              // if the hint has not been created yet, creates it only once
              if (!this.element) {
                  this.element = document.createElement('div');
                  this.element.className = "onp-vk-like-alert";
                  this.element.innerText = "Чтобы разблокировать, нажмите сюда";
                  document.body.insertBefore(this.element, document.body.childNodes[0]);
              }

              // updates the position of the hint and shows it
              this.locate();
              this.element.style.display = "block";
          },

          /**
           * Hides the VK Share hint.
           */
          hide: function () {

              // nothing to do, if the hint is already hidden or if it has not been created yet
              if (!this.elementShown || !this.element) return;
              this.elementShown = false;

              this.element.style.display = "none";
          },

          /**
           * Update the VK Share hint position.
           */
          locate: function () {
              var self = this;

              var frameLikeWidget = document.getElementById('onp-vk-like').getElementsByTagName('iframe')[0];

              if (!frameLikeWidget || !frameLikeWidget.getAttribute('id'))
                  return;

              var idxVkWidget = frameLikeWidget.getAttribute('id').replace(/vkwidget/i, '');

              // finds the targte element to attach the VK Share hint
              if ( !self.target ) {
                  self.target = document.getElementById('vkwidget' + idxVkWidget + '_tt');
              }

              // updates the poistion of the VK Share hint
              self.element.style.top = (parseInt(self.target.style.top) + 115) + "px";
              self.element.style.left = (parseInt(self.target.style.left) + 5)  + "px";
          },

          /**
           * Runs a timer which will work 20 seconds to show the VK Share
           * hint again after leaving the mouse pointer from the Like button.
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
           * Stops the VK Share Timer.
           */
          stop: function () {
              if (!this.elementTimer) return;

              clearInterval(this.elementTimer);
              this.elementTimer = null;
              this.hide();
          },

          isHidden: function(el) {
              var style = window.getComputedStyle(el);
              return (style.display === 'none')
          }
      }
  </script>
</head>
<body>
<div id="onp-vk-like-button-cotanier">
    <div id="onp-vk-like"></div>
</div>
</body>
</html>