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
        
        <iframe name="asfdf23432" src="http://sociallocker-service.dev/lockers/frontend/button?name=facebook-like&locker_id=22&href=https%3A%2F%2Fsociallocker.ru"
                frameborder="0" scrolling="no" width="80" height="40">
        </iframe>
        <div style="display:inline-block;position:relative; width:85px; height: 22px;">
            <iframe name="3ffsdf23432" style="position: absolute; top:0; left:0; z-index:1;"
                src="http://sociallocker-service.dev/lockers/frontend/button?name=vk-like&locker_id=22&href=https%3A%2F%2Fsociallocker.ru"
                    frameborder="0" scrolling="no" width="300" height="300">
            </iframe>
        </div>

        <iframe name="3ddgfdf23432" style="position: relative; z-index:2;" src="http://sociallocker-service.dev/lockers/frontend/button?name=vk-subscribe&locker_id=22"
                frameborder="0" scrolling="no" width="160" height="22">
        </iframe>

        <iframe name="dfs4f23432" style="position: relative; z-index:2;" src="http://sociallocker-service.dev/lockers/frontend/button?name=vk-share&locker_id=22"
                frameborder="0" scrolling="no" width="160" height="22">
        </iframe>

        <script>
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
                                layout: 'horizontal',
                                counter:  1,
                                type: 'mini',
                                width: '350',
                                height: '22',
                                verb: '0'
                            }
                        }
                    };

                    win3.postMessage(JSON.stringify(postMessageData), '*');
                };

                var win4 = window.frames['3ddgfdf23432'];
                document.getElementsByName('3ddgfdf23432')[0].onload = function() {
                    var postMessageData = {
                        onpwgt_to: {
                            button: {
                                name: 'vk-subscribe',
                                groupId: 'vyishenebes',
                                layout: 'horizontal',
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
                                layout: 'horizontal',
                                counter: 1,
                                clickja: 1,
                                noCheck: 0
                            }
                        }
                    };

                    win5.postMessage(JSON.stringify(postMessageData), '*');
                };
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
