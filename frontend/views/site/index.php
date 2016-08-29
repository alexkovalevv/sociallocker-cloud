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

        <script>
            function listener(event) {
                console.log(event.data);
            }

            if (window.addEventListener) {
                window.addEventListener("message", listener);
            } else {
                // IE8
                window.attachEvent("onmessage", listener);
            }
        </script>

        <div style="display:inline-block;position:relative; width:130px; height: 40px;">
            <iframe name="asfdf23432" style="position: absolute; top:0; left:0; z-index:1;"
                    src="http://sociallocker-service.dev/lockers/frontend/button?name=facebook-like&locker_id=22"
                    frameborder="0" scrolling="no" width="200" height="50">
            </iframe>
        </div>
        <div style="display:inline-block;position:relative; width:130px; height: 40px;">
            <iframe name="gs4gdf54432" style="position: absolute; top:0; left:0; z-index:1;"
                    src="http://sociallocker-service.dev/lockers/frontend/button?name=facebook-share&locker_id=22"
                    frameborder="0" scrolling="no" width="200" height="50">
            </iframe>
        </div>
        <div style="display:inline-block;position:relative; width:85px; height: 50px;">
            <iframe name="3ffsdf23432" style="position: absolute; top:0; left:0; z-index:1;"
                src="http://sociallocker-service.dev/lockers/frontend/button?name=vk-like&locker_id=22"
                    frameborder="0" scrolling="no" width="300" height="300">
            </iframe>
        </div>

       <!-- <iframe name="3ddgfdf23432" style="position: relative; z-index:2;"
                src="http://sociallocker-service.dev/lockers/frontend/button?name=vk-subscribe&locker_id=22"
                frameborder="0" scrolling="no" width="160" height="60">
        </iframe>

        <iframe name="dfs4f23432" style="position: relative; z-index:2;"
                src="http://sociallocker-service.dev/lockers/frontend/button?name=vk-share&locker_id=22"
                frameborder="0" scrolling="no" width="160" height="60">
        </iframe> -->

        <script>
                var win1 = window.frames['asfdf23432'];
                document.getElementsByName('asfdf23432')[0].onload = function() {
                    var postMessageData = {
                        onpwgt_to: {
                            button: {
                                name: 'facebook-like',
                                href: 'http://ya.ru',
                                layout: 'box_count',
                                action: 'like',
                                size: 'small',
                                showFaces: 'false',
                                share:  'false'
                            }
                        }
                    };

                    win1.postMessage(JSON.stringify(postMessageData), '*');
                };

                var win2 = window.frames['gs4gdf54432'];
                document.getElementsByName('gs4gdf54432')[0].onload = function() {
                    var postMessageData = {
                        onpwgt_to: {
                            button: {
                                name: 'facebook-share',
                                href: 'http://ya.ru',
                                layout: 'box_count',
                                size: 'small',
                                shareDialog: 'false',
                                mobileIframe: 'false',
                                title: 'тест имя',
                                picture: null,
                                caption: 'тест короткое описание',
                                description: 'тест описание'

                            }
                        }
                    };

                    win2.postMessage(JSON.stringify(postMessageData), '*');
                };


                var win3 = window.frames['3ffsdf23432'];
                document.getElementsByName('3ffsdf23432')[0].onload = function() {
                    var postMessageData = {
                        onpwgt_to: {
                            button: {
                                name: 'vk-like',
                                pageUrl: 'http://ya.ru',
                                pageTitle: '',
                                pageDescription: '',
                                pageImage: '',
                                counter:  1,
                                type: 'vertical',
                                width: '350',
                                height: '22',
                                verb: '0'
                            }
                        }
                    };

                    win3.postMessage(JSON.stringify(postMessageData), '*');
                };

                /*var win4 = window.frames['3ddgfdf23432'];
                document.getElementsByName('3ddgfdf23432')[0].onload = function() {
                    var postMessageData = {
                        onpwgt_to: {
                            button: {
                                name: 'vk-subscribe',
                                groupId: 'vyishenebes',
                                layout: 'vertical',
                                counter:  1,
                                clickja:  1
                            }
                        }
                    };

                    win4.postMessage(JSON.stringify(postMessageData), '*');
                };

                var win5 = window.frames['dfs4f23432'];
                document.getElementsByName('dfs4f23432')[0].onload = function() {
                    var postMessageData = {
                        onpwgt_to: {
                            button: {
                                name: 'vk-share',
                                pageUrl: 'http://ya.ru',
                                pageTitle: '',
                                pageDescription: '',
                                pageImage: '',
                                layout: 'vertical',
                                counter: 1,
                                clickja: 1,
                                noCheck: 0
                            }
                        }
                    };

                    win5.postMessage(JSON.stringify(postMessageData), '*');
                };*/
        </script>


        <p class="lead">You have successfully created your Yii-powered application.</p>

        <?php echo common\widgets\DbMenu::widget([
            'key'=>'frontend-index',
            'options'=>[
                'tag'=>'p'
            ]
        ]) ?>

    </div>

    <div class="body-content">

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
