<?php
/* @var $this yii\web\View */
$this->title = Yii::$app->name;
?>
<div class="site-index">

    <?php echo \common\widgets\DbCarousel::widget([
        'key'=>'index',
        'options' => [
            'class' => 'slide', // enables slide effect
        ],
    ]) ?>

    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <?php echo common\widgets\DbMenu::widget([
            'key'=>'frontend-index',
            'options'=>[
                'tag'=>'p'
            ]
        ]) ?>

    </div>

    <div class="body-content">
        <style>
            /*Stuff it here css*/

            body {
                font: normal normal 400 13px/170% Arial, Helvetica, sans-serif;
                padding: 0;
                margin: 0;
            }

            .onp-sl-control,
            .onp-sl-control .onp-sl-icon,
            .onp-sl-control .onp-sl-connect-button {
                -moz-box-sizing: border-box;
                box-sizing: border-box;
            }

            .onp-sl-button {
                background-color: #f1f1f1;
                padding: 0 5px;
                margin: 7px;
                position: relative;
                cursor: pointer;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                width: 170px;
                height: 50px;
                vertical-align: bottom;
            }

            .onp-sl-control:hover {
                background-color: #e5e5e5;
            }

            .onp-sl-short {
                display: none;
            }

            /*.onp-sl-state-loading,
            .onp-sl-state-error {
                position: relative;
                cursor: default !important;
            }

            .onp-sl-state-loading .onp-sl-icon,
            .onp-sl-state-loading .onp-sl-connect-button {
                display: none;
            }

            .onp-sl-state-error .onp-sl-icon,
            .onp-sl-state-error .onp-sl-connect-button {
                display: none;
            }

            .onp-sl-state-loading .onp-sl-control-inner-wrap {
                background: url("../img/button-loader-ffffff.gif") 50% 50% no-repeat;
            }

            .onp-sl-state-loading .onp-sl-control-inner-wrap {
                position: absolute;
                top: 0;
                bottom: 0;
                left: 0;
                right: 0;
            }

            .onp-sl-state-error .onp-sl-control-inner-wrap {
                position: relative;
                top: 50%;
                margin-top: -11px;
            }

            .onp-sl-state-error .onp-sl-control-inner-wrap .onp-sl-error-title {
                height: 22px !important;
                padding: 0px 10px !important;
                line-height: 22px !important;
                font-size: 14px !important;
                font-weight: normal !important;
            }*/

            .onp-sl-great-attractor .onp-sl-input,
            .onp-sl-great-attractor .onp-sl-button {
                border-radius: 3px;
            }

            .onp-sl-great-attractor .onp-sl-input {
                width: 100%;
                box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.1);
            }

            .onp-sl-great-attractor .onp-sl-button:hover {
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.12), inset 0 1px 1px rgba(255, 255, 255, 0.9);
                background: -moz-linear-gradient(top, #fefefe 0%, #f2f2f2 100%); /* FF3.6+ */
                background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #fefefe), color-stop(100%, #f2f2f2)); /* Chrome,Safari4+ */
                background: -webkit-linear-gradient(top, #fefefe 0%, #f2f2f2 100%); /* Chrome10+,Safari5.1+ */
                background: -o-linear-gradient(top, #fefefe 0%, #f2f2f2 100%); /* Opera 11.10+ */
                background: -ms-linear-gradient(top, #fefefe 0%, #f2f2f2 100%); /* IE10+ */
                background: linear-gradient(to bottom, #fefefe 0%, #f2f2f2 100%); /* W3C */
                filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fefefe', endColorstr='#f2f2f2', GradientType=0); /* IE6-9 */
            }

            .onp-sl-great-attractor .onp-sl-button,
            .onp-sl-great-attractor .onp-sl-button:disabled {
                color: #363636;
                font-weight: bold;
                text-shadow: 1px 1px 0 rgba(255, 255, 255, 0.6);
                box-shadow: 0 2px 1px rgba(0, 0, 0, 0.07), inset 0 1px 1px rgba(255, 255, 255, 0.9);
                background: #f0f0f0;
                border: 1px solid #c9c9c9;
                background: -moz-linear-gradient(top, #fcfcfc 0%, #f0f0f0 100%); /* FF3.6+ */
                background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #fcfcfc), color-stop(100%, #f0f0f0)); /* Chrome,Safari4+ */
                background: -webkit-linear-gradient(top, #fcfcfc 0%, #f0f0f0 100%); /* Chrome10+,Safari5.1+ */
                background: -o-linear-gradient(top, #fcfcfc 0%, #f0f0f0 100%); /* Opera 11.10+ */
                background: -ms-linear-gradient(top, #fcfcfc 0%, #f0f0f0 100%); /* IE10+ */
                background: linear-gradient(to bottom, #fcfcfc 0%, #f0f0f0 100%); /* W3C */
                filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fcfcfc', endColorstr='#f0f0f0', GradientType=0); /* IE6-9 */
                cursor: pointer;
            }

            .onp-sl-great-attractor .onp-sl-button:disabled {
                cursor: default;
            }

            .onp-sl-great-attractor .onp-sl-control {
                background-color: transparent;
                border-radius: 3px;
                padding: 0px;
                border: 0px;
                box-shadow: 0 3px 4px rgba(0, 0, 0, 0.03);
                color: #111;
            }

            .onp-sl-great-attractor .onp-sl-control:hover {
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.09);
                background-color: transparent;
            }

            .onp-sl-great-attractor .onp-sl-control:hover .onp-sl-short {
                display: inline;
            }

            .onp-sl-great-attractor .onp-sl-control:hover .onp-sl-long {
                display: none;
            }

            /*.onp-sl-great-attractor  .onp-sl-state-loading,
            .onp-sl-great-attractor  .onp-sl-state-error {
                background: #fff;
                box-shadow: none;
                border: 1px solid #f2f2f2;
            }
            .onp-sl-great-attractor  .onp-sl-state-loading:hover,
            .onp-sl-great-attractor  .onp-sl-state-error:hover {
                box-shadow: none;
            }*/

            /* :: Buttons, Icon :: */

            .onp-sl-great-attractor .onp-sl-icon {
                height: 50px;
                width: 5px;
                background-image: url('data:image/png;base64,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');
                background-repeat: no-repeat;
                background-position-y: 50%;
                position: absolute;
                top: 0px;
                bottom: 0px;
                border-top-left-radius: 3px;
                border-bottom-left-radius: 3px;
                -webkit-transition: width .3s;
                transition: width .3s;
            }

            .onp-sl-great-attractor .onp-sl-control:hover .onp-sl-icon {
                width: 40px;
            }

            .onp-sl-great-attractor .onp-sl-vk .onp-sl-icon  {
                background-position: -172px 16px;
                background-color: #6287AE;
                border: 1px solid #036a9e;
            }

            /* :: Buttons, Text :: */
            .onp-sl-great-attractor .onp-sl-connect-button {
                text-align: left;
                padding-left: 15px;
                position: absolute;
                top: 0px;
                left: 5px;
                right: 0px;
                bottom: 0px;
                font-size: 13px;
                line-height: 50px;
                font-weight: normal;
                background: #f0f0f0;
                border: 1px solid #c9c9c9;
                border-left: 0px;
                border-top-right-radius: 3px;
                border-bottom-right-radius: 3px;
                box-shadow: inset 0 1px 1px rgba(255, 255, 255, 0.9);
                overflow: hidden;
                white-space: nowrap;
                background: -moz-linear-gradient(top, #fdfdfd 0%, #f6f6f6 100%); /* FF3.6+ */
                background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #fdfdfd), color-stop(100%, #f6f6f6)); /* Chrome,Safari4+ */
                background: -webkit-linear-gradient(top, #fdfdfd 0%, #f6f6f6 100%); /* Chrome10+,Safari5.1+ */
                background: -o-linear-gradient(top, #fdfdfd 0%, #f6f6f6 100%); /* Opera 11.10+ */
                background: -ms-linear-gradient(top, #fdfdfd 0%, #f6f6f6 100%); /* IE10+ */
                background: linear-gradient(to bottom, #fdfdfd 0%, #f6f6f6 100%); /* W3C */
                filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fdfdfd', endColorstr='#f6f6f6', GradientType=0); /* IE6-9 */
                -webkit-transition: left .3s;
                transition: left .3s;
            }

            .onp-sl-great-attractor .onp-sl-control:hover .onp-sl-connect-button {
                left: 40px;
                background: #f9f9f9;
            }

        </style>
        <script src="//vk.com/js/api/openapi.js" type="text/javascript"></script>
        <script>
            //Stuff it here js

            var postMessageData = {
                    onpwgt: {
                        button: {
                            name: 'vk-connect',
                            iframe: window.name
                        }
                    }
                },
                oAuthReady = false;


            var vkConnect = {

                _defaults: {
                    proxy: 'http://sociallocker-service.dev/signin/connect/index',
                    checkUserProxy: 'http://sociallocker-service.dev/signin/connect/check-user-data',
                    appId: '5337425',
                    actions: []
                },

                init: function() {
                    this._prepareOptions();

                    VK.init({
                        apiId: this.options.appId
                    });

                    this._create();
                },

                /**
                 * Prepares options before starting usage of the button.
                 */
                _prepareOptions: function() {

                    this.options = this._extend({}, this._defaults, {});

                    if( !this.options.proxy ) {
                        throw new Error('Не указана опция proxy');
                    }

                    this.scope = "email";
                },

                /**
                 * Connects the user via Vk.
                 */
                _connect: function( callback ) {
                    var self = this;

                    if( oAuthReady ) {

                        this._identify(
                            function( identityData ) {
                                callback(identityData, self._getServiceData());
                            }
                        );

                    } else {
                        var width = 700;
                        var height = 420;

                        var x = screen.width
                            ? (screen.width / 2 - width / 2 + self._findLeftWindowBoundry())
                            : 0;
                        var y = screen.height
                            ? (screen.height / 2 - height / 2 + self._findTopWindowBoundry())
                            : 0;

                        var dataToSend = {
                            opandaHandler: 'vk'
                        };

                        var url = self.options.proxy;
                        for( var prop in dataToSend ) {
                            if( !dataToSend.hasOwnProperty(prop) ) {
                                continue;
                            }
                            url = self._updateQueryStringParameter(url, prop, dataToSend[prop]);
                        }

                        self._trackWindow('opandaHandler=vk', function() {
                            setTimeout(
                                function() {

                                    var XHR = ("onload" in new XMLHttpRequest()) ? XMLHttpRequest : XDomainRequest;
                                    var xhr = new XHR();

                                    xhr.open('POST', self.options.checkUserProxy, true);
                                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                    xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");

                                    xhr.onload = function() {
                                        console.log( this.responseText );
                                    };

                                    xhr.onerror = function() {
                                        console.log( 'Ошибка ' + this.status );
                                    };

                                    xhr.send("handler=vk");

                                    /*if( oAuthReady ) {
                                     return;
                                     }

                                     postMessageData.onpwgt.button['event'] = 'error';
                                     postMessageData.onpwgt.button['code'] = 'errors_not_signed_in';

                                     window.parent.postMessage(JSON.stringify(postMessageData), '*');*/
                                }, 500
                            );
                        });

                        var win = window.open("//oauth.vk.com/authorize?client_id=" + self.options.appId +
                            "&display=page&redirect_uri=" + url +
                            "&scope=" + self.scope +
                            "&response_type=code&v=5.50",
                            "Vkontakte Sign-in",
                            "width=" + width + ",height=" + height + ",left=" + x + ",top=" + y + ",resizable=yes,scrollbars=yes,status=yes"
                        );

                        /*window.OPanda_VkOAuthCompleted = function( d ) {
                         var requestData = JSON.parse(d);

                         self._setStorage('vk_user_id', requestData['user_id'], 134);
                         self._setStorage('vk_user_data', d, 134);

                         self._accessToken = requestData['access_token'];
                         self._uid = requestData['uid'];
                         self._email = requestData['email']
                         ? requestData['email']
                         : null;

                         oAuthReady = true;

                         self.connect(callback);
                         };

                         window.OPanda_VkOAuthDenied = function( d ) {
                         var requestData = JSON.parse(d);

                         postMessageData.onpwgt.button['event'] = 'error';
                         postMessageData.onpwgt.button['code'] = 'errors_not_signed_in';

                         window.parent.postMessage(JSON.stringify(postMessageData), '*');
                         };*/
                    }
                },

                /**
                 * Puts together service data required for the future requests.
                 */
                _getServiceData: function() {
                    var self = this;
                    return {
                        accessToken: self._accessToken,
                        uid: self._uid,
                        email: self._email
                    };
                },

                _create: function() {
                    var self = this;
                    document.getElementById('btn').onclick = function() {
                        self._connect(function( identityData, serviceData ) {

                            postMessageData.onpwgt.button['event'] = 'connect';
                            postMessageData.onpwgt.button['identify'] = identityData;
                            postMessageData.onpwgt.button['serviceData'] = serviceData;

                            delete postMessageData.onpwgt.button['error'];
                            delete postMessageData.onpwgt.button['code'];

                            console.log(JSON.stringify(postMessageData));

                            window.parent.postMessage(JSON.stringify(postMessageData), '*');
                        });
                    };
                },

                _trackWindow: function( urlPart, onCloseCallback ) {

                    var funcOpen = window.open;
                    window.open = function( url, name, params ) {

                        var winref = funcOpen(url, name, params);

                        if( !url ) return winref;
                        if( url.indexOf(urlPart) === -1 ) return winref;

                        var pollTimer = setInterval(function() {
                            if( !winref || winref.closed !== false ) {
                                clearInterval(pollTimer);
                                onCloseCallback && onCloseCallback();
                            }
                        }, 300);

                        return winref;
                    };
                },

                _updateQueryStringParameter: function (uri, key, value) {
                    var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
                    var separator = uri.indexOf('?') !== -1 ? "&" : "?";
                    if (uri.match(re)) {
                        return uri.replace(re, '$1' + key + "=" + value + '$2');
                    }
                    else {
                        return uri + separator + key + "=" + value;
                    }
                },

                /**
                 * Сливает список перечесленных объектов в один
                 * @returns object
                 */
                _extend: function() {
                    for( var i = 1; i < arguments.length; i++ )
                        for( var key in arguments[i] )
                            if( arguments[i].hasOwnProperty(key) ) {
                                arguments[0][key] = arguments[i][key];
                            }
                    return arguments[0];
                },

                /**
                 * Дабавляет метку или куку в локальное хранилище
                 * @param cookieName
                 * @param value
                 * @param expires
                 */
                _setStorage: function( cookieName, value, expires ) {
                    if( localStorage && localStorage.setItem ) {
                        try {
                            var unixtime = Math.round(+new Date() / 1000);
                            var str = {
                                data: value,
                                expires: expires * 86400 + unixtime
                            };
                            localStorage.setItem(cookieName, JSON.stringify(str));
                        }
                        catch( e ) {
                            cookie(cookieName, value, {
                                expires: expires,
                                path: "/"
                            });
                        }
                    } else {
                        cookie(cookieName, value, {
                            expires: expires,
                            path: "/"
                        });
                    }
                },

                /**
                 * Ишет границу окна слева
                 * @returns integer
                 */
                _findLeftWindowBoundry: function() {
                    // In Internet Explorer window.screenLeft is the window's left boundry
                    if( window.screenLeft ) {
                        return window.screenLeft;
                    }
                    // In Firefox window.screenX is the window's left boundry
                    if( window.screenX ) {
                        return window.screenX;
                    }
                    return 0;
                },

                /**
                 * Ишет границу окна сверху
                 * @returns integer
                 */
                _findTopWindowBoundry: function() {
                    // In Internet Explorer window.screenLeft is the window's left boundry
                    if( window.screenTop ) {
                        return window.screenTop;
                    }
                    // In Firefox window.screenY is the window's left boundry
                    if( window.screenY ) {
                        return window.screenY;
                    }
                    return 0;
                }
            };

            window.onload = function() {
                vkConnect.init();
            };
        </script>
        <div class="onp-sl-control-inner-wrap onp-sl-great-attractor">
            <a href="#" id="btn" class="onp-sl-control onp-sl-vk onp-sl-button">
                <div class="onp-sl-control-inner-wrap">
                    <div class="onp-sl-icon"></div>
                    <div class="onp-sl-connect-button onp-sl-social-button-vk">
                        <span class="onp-sl-long">Vkontakte</span>
                        <span class="onp-sl-short">Vkontakte</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
