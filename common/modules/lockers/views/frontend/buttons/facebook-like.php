<?php
use \yii\helpers\ArrayHelper;
?>
<!DOCTYPE html>
<html>
<head>
  <title>Кнопка Facebook мне нравится</title>
  <meta charset="utf-8" content="text/html">

  <style>
        body{
            margin:0;
            padding:0;
        }
  </style>
  <script id="facebook-jssdk" src="//connect.facebook.net/ru_RU/sdk.js"></script>
  <script>
       if(!FB || !FB.init) {
         throw new Error('Не удалось загрузить sdk facebook.');
       }

        var postMessageData = {
            onpwgt: {
                button: {
                    name: 'fb-like'
                }
            }
        };

        window.onload = function(){

            function listener(event) {
                if( event.data.indexOf('onpwgt_to') === -1 ) return;

                var data = JSON.parse(event.data);
                if( data.onpwgt_to && data.onpwgt_to.button && data.onpwgt_to.button.name) {
                    if(data.onpwgt_to.button.name === 'facebook-like') {
                        var defaultOptions = {
                                href: null,
                                layout: 'button_count',
                                action: 'like',
                                size: 'small',
                                showFaces: 'false',
                                share:  'false'
                            },
                            options = extend({}, defaultOptions, data.onpwgt_to.button);

                        postMessageData.onpwgt.button['url'] = options.href;

                        var el = document.getElementsByClassName('fb-like')[0];

                        el.setAttribute('data-href', options.href);
                        el.setAttribute('data-layout', options.layout);
                        el.setAttribute('data-action', options.action);
                        el.setAttribute('data-size', options.size);
                        el.setAttribute('data-showFaces', options.showFaces);
                        el.setAttribute('data-share', options.share);

                        FB.init({
                            status: true,
                            cookie: true,
                            xfbml: true,
                            version    : 'v2.7'
                        });

                        FB.Event.subscribe('xfbml.render', function(response) {
                            postMessageData.onpwgt.button['event'] = 'loaded';
                            window.parent.postMessage(JSON.stringify(postMessageData), '*');
                        });

                        //FB.XFBML.parse();
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

            document.body.onmouseover = function (e) {
                postMessageData.onpwgt.button['event'] = 'mouseover';
                window.parent.postMessage(JSON.stringify(postMessageData), '*');
            };

            document.body.onmouseout = function (e) {
                postMessageData.onpwgt.button['event'] = 'mouseout';
                window.parent.postMessage(JSON.stringify(postMessageData), '*');
            };
        };

        window.FB.Event.subscribe('edge.create', function (url) {
            postMessageData.onpwgt.button['event'] = 'liked';
            postMessageData.onpwgt.button['url'] = url;
            window.parent.postMessage(JSON.stringify(postMessageData), '*');
        });

        window.FB.Event.subscribe('edge.remove', function (url) {
            postMessageData.onpwgt.button['event'] = 'unliked';
            postMessageData.onpwgt.button['url'] = url;
            window.parent.postMessage(JSON.stringify(postMessageData), '*');
        });


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
<div id="fb-root"></div>
<div class="fb-like"></div>
</body>
</html>