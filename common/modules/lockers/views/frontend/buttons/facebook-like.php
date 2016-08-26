<?php
use \yii\helpers\ArrayHelper;
?>
<!DOCTYPE html>
<html>
<head>
  <title>Facebook like button</title>
  <style>
        body{
            margin:0;
            padding:0;
        }
  </style>
  <script id="facebook-jssdk" src="//connect.facebook.net/ru_RU/sdk.js#xfbml=1&amp;version=v2.7"></script>
  <script>
    var postMessageData = {
        onpwgt: {
            button: {
                name: 'fb-like'
            }
        }
    };

    window.onload = function(){
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

    var checkIframeCreateTimer = setInterval(function () {
        if (document.getElementsByClassName('fb-like')[0].getElementsByTagName('iframe')) {
            clearInterval(checkIframeCreateTimer);
            postMessageData.onpwgt.button['event'] = 'loaded';
            window.parent.postMessage(JSON.stringify(postMessageData), '*');
        }
    }, 50);
    </script>
</head>
<body>
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<!-- Your like button code -->
<div class="fb-like"
     data-href="<?=ArrayHelper::getValue($options, 'href');?>"
     data-layout="<?=ArrayHelper::getValue($options, 'layout');?>"
     data-action="<?=ArrayHelper::getValue($options, 'action');?>"
     data-size="<?=ArrayHelper::getValue($options, 'size');?>"
     data-show-faces="<?=ArrayHelper::getValue($options, 'faces');?>"
     data-share="<?=ArrayHelper::getValue($options, 'share');?>">
</div>
</body>
</html>