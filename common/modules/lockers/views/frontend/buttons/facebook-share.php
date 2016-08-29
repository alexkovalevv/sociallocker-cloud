<?php
use \yii\helpers\ArrayHelper;
?>
<!DOCTYPE html>
<html>
<head>
  <title>Кнопка Facebook поделиться</title>
  <meta charset="utf-8" content="text/html">

  <style>
        body{
            margin:0;
            padding:0;
        }

        #fb-btn-wrap {
            position: relative;
        }

        #fb-btn-overlay {
            position: absolute;
            top: 0px;
            right: 0px;
            bottom: 0px;
            left: 0px;
            background-color: rgba(255,255,255,0);
            cursor: pointer;
            z-index: 20;
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
                    name: 'fb-share'
                }
            }
        };

        window.onload = function(){

            function listener(event) {
                if( event.data.indexOf('onpwgt_to') === -1 ) return;

                var data = JSON.parse(event.data);
                if( data.onpwgt_to && data.onpwgt_to.button && data.onpwgt_to.button.name) {
                    if(data.onpwgt_to.button.name === 'facebook-share') {
                        var defaultOptions = {
                                shareDialog: 0,
                                href: null,
                                layout: 'button_count',
                                size: 'small',
                                mobileIframe:  'false',
                                title: null,
                                picture: null,
                                caption: null,
                                description: null
                            },
                            options = extend({}, defaultOptions, data.onpwgt_to.button);

                        postMessageData.onpwgt.button['url'] = options.href;

                        var el = document.getElementsByClassName('fb-share-button')[0];

                        el.setAttribute('data-href', options.href);
                        el.setAttribute('data-layout', options.layout);
                        el.setAttribute('data-size', options.size);
                        el.setAttribute('data-mobile-iframe', options.mobileIframe);

                        FB.init({
                            appId: '<?=ArrayHelper::getValue($options, 'appId');?>',
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

                        var overlay = document.getElementById('fb-btn-overlay');

                        if ( options.shareDialog ) {
                            overlay.onclick = function(){
                                FB.ui(
                                    {
                                        method: 'share',
                                        href: options.href,
                                        display: 'popup'
                                    },
                                    function(response) {
                                        console && console.log && console.log('AX12:');
                                        console && console.log && console.log(response);

                                        if ( isTabletOrMobile() && typeof response === "undefined" || response === null  ) {
                                            postMessageData.onpwgt.button['event'] = 'share';
                                            window.parent.postMessage(JSON.stringify(postMessageData), '*');
                                            return;
                                        }

                                        if ( typeof response === "undefined" || response === null ) return;
                                        if ( typeof response === "object" && response.error_code && response.error_code > 0 ) return;

                                        postMessageData.onpwgt.button['event'] = 'share';
                                        window.parent.postMessage(JSON.stringify(postMessageData), '*');
                                    }
                                );
                                return false;
                            };

                        } else {

                            overlay.onclick = function(){
                                FB.ui(
                                    {
                                        method: 'feed',
                                        name: options.title,
                                        link: options.href,
                                        picture: options.image,
                                        caption: options.caption,
                                        description: options.description
                                    },
                                    function(response) {
                                        console && console.log && console.log('AX12:');
                                        console && console.log && console.log(response);

                                        if ( isTabletOrMobile() && typeof response === "undefined" || response === null  ) {
                                            postMessageData.onpwgt.button['event'] = 'share';
                                            window.parent.postMessage(JSON.stringify(postMessageData), '*');
                                            return;
                                        }

                                        if ( typeof response === "undefined" || response === null ) return;
                                        if ( typeof response === "object" && response.error_code && response.error_code > 0 ) return;

                                        postMessageData.onpwgt.button['event'] = 'share';
                                        window.parent.postMessage(JSON.stringify(postMessageData), '*');
                                    }
                                );
                                return false;
                            };
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

            document.body.onmouseover = function (e) {
                postMessageData.onpwgt.button['event'] = 'mouseover';
                window.parent.postMessage(JSON.stringify(postMessageData), '*');
            };

            document.body.onmouseout = function (e) {
                postMessageData.onpwgt.button['event'] = 'mouseout';
                window.parent.postMessage(JSON.stringify(postMessageData), '*');
            };
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
        * Returns true if a current user uses a mobile device or tablet device, else false.
        */
       var isTabletOrMobile = function () {
           if ((/webOS|iPhone|iPad|Android|iPod|BlackBerry/i).test(navigator.userAgent)) return true;
           return false;
       };
    </script>
</head>
<body>
<div id="fb-root"></div>
<div id="fb-btn-wrap">
    <div class="fb-share-button"></div>
    <div id='fb-btn-overlay'></div>
</div>

</body>
</html>
