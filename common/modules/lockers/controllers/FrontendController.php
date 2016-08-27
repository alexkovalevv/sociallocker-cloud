<?php
/**
 * Контроллер управляет отображением замка на фронтенде пользователей.
 * @author Alex Kovalev <alex.kovalevv@gmail.com>
 */

namespace common\modules\lockers\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\modules\lockers\models\lockers\Lockers;
use common\modules\lockers\models\settings\Settings;


class FrontendController extends Controller
{
    /**
     * @return mixed
     */
    /*public function actionIndex()
    {
        $this->layout = '@frontend/views/layouts/_clear';

        $locker_id = Yii::$app->request->getQueryParam( 'locker_id' );

        if (empty( $locker_id )) {
            throw new NotFoundHttpException( 'Страница не найдена!' );
        }

        $model_lockers = Lockers::findModel( $locker_id );

        if (empty( $model_lockers )) {
            throw new NotFoundHttpException( 'Страница не найдена!' );
        }

        $locker_options = json_decode($model_lockers->options, true);
        $locker_options['title'] = $model_lockers->title;
        $locker_options['header'] = $model_lockers->header;
        $locker_options['message'] = $model_lockers->message;

        $locker_settings = Settings::get($model_lockers->user_id);

        $prepare_options = array_merge($locker_options, $locker_settings);
        $options = $this->mapLockerOptions($prepare_options);
        //var_dump($options);

        return $this->render( 'index', ['options' => Json::htmlEncode($options)] );
    }*/

    public function actionButton($name, $locker_id)
    {
        $this->layout = false;

        $params = $default_params = [];
        $get_params = Yii::$app->request->getQueryParams();

        foreach($get_params as $key => $param) {
            $params[$key] = urldecode($param);
            unset($get_params[$key]);
        }

        switch($name) {
            case 'facebook-like':
                $default_params = [
                    'href' => 'https://sociallocker.ru',
                    'layout' => 'box_count',
                    'action' => 'like',
                    'size'  => 'small',
                    'faces' => 'false',
                    'share' => 'false',
                    'counter' => 1,
                ];
                break;
            case 'vk-like':
                $default_params = [
                    'appId' => '5337425',
                    'pageUrl' => 'https://sociallocker.ru',
                    'counter' => 1,
                    'type' => 'mini',
                    'width' => '350',
                    'height'  => '22',
                    'verb' => '0',
                    'pageTitle' => '',
                    'pageDescription' => '',
                    'pageImage' => '',
                    'page_id' => ''
                ];
                break;
            case 'vk-subscribe':
                $default_params = [
                    'appId' => '5337425',
                    'accessToken' => 'eb29aae9f8a9d1b857dbf566aef1ed56eda31dd1b1933b65cd9f23b247778ac4b8b1292ff0ee6f86218c59087b48f',
                    'groupId' => 'vyishenebes',
                    'layout'  => 'horizontal',
                    'counter' => 1,
                    'clickja'  => 1,
                ];
                break;
            case 'vk-share':
                $default_params = [
                    'appId' => '5337425',
                    'accessToken' => 'eb29aae9f8a9d1b857dbf566aef1ed56eda31dd1b1933b65cd9f23b247778ac4b8b1292ff0ee6f86218c59087b48f',
                    'pageUrl' => 'http://ya.ru',
                    'layout'  => 'horizontal',
                    'counter' => 1,
                    'clickja'  => 1,
                    'noCheck' => 0,
                ];
                break;
        }

        $params = ArrayHelper::merge($default_params, $params);
        //xdebug_var_dump($params);

        // Фильтруем опции
        if( isset($params['counter']) && ($params['counter'] === false || is_null($params['counter'])) )
            $params['counter'] = 0;

        return $this->render('buttons/' . $name, ['options' => $params]);
    }


    /**
     * Возвращает массив опций отформатированных по модели
     * данных социального замка.
     * @return array
     */
    /*public function getLockerOptions() {
        return $this->mapLockerOptions();
    }*/

    /**
     * Собирает опции в массив по заранее установленной карте.
     * Карта опций основана на модели принимаемых данных в
     * jQuery версии социального замка.
     *
     * @return array - массив опций наложенных на карту
     */
    public function mapLockerOptions( $data )
    {
        $mapData = [
            'demo'  => 'always',
            'theme' => 'style',
        ];

        $mapData['text'] = [
            'header'  => null,
            'message' => null
        ];

        $mapData['overlap'] = [
            'mode'     => 'overlap',
            'position' => 'overlap_position'
        ];

        $mapData['effects'] = ['highlight' => null];

        $mapData['locker'] = [
            'timer'  => null,
            'close'  => null,
            'mobile' => null
        ];
        $mapData['socialButtons'] = [
            'counters' => null,
            'facebook' => [
                'appId'   => null,
                'lang'    => null,
                'version' => null,
                'like'    => [
                    'url'   => 'facebook_like_url',
                    'title' => 'facebook_like_title',
                ],
                'share'   => [
                    'shareDialog' => 'facebook_share_dialog',
                    'url'         => 'facebook_share_url',
                    'title'       => 'facebook_share_title',
                    'name'        => 'facebook_share_message_name',
                    'caption'     => 'facebook_share_message_caption',
                    'description' => 'facebook_share_message_description',
                    'image'       => 'facebook_share_message_image',
                ]
            ],
            'twitter'  => [
                'lang'   => null,
                'tweet'  => [
                    'url'         => 'twitter_tweet_url',
                    'text'        => 'twitter_tweet_text',
                    'title'       => 'twitter_tweet_title',
                    'doubleCheck' => 'twitter_tweet_auth',
                    'via'         => 'twitter_tweet_via'
                ],
                'follow' => [
                    'url'            => 'twitter_follow_url',
                    'title'          => 'twitter_follow_title',
                    'doubleCheck'    => 'twitter_follow_auth',
                    'hideScreenName' => 'twitter_follow_hide_name',
                ]
            ],
            'google'   => [
                //'lang' => null,
                'plus'  => [
                    'url'   => 'google_plus_url',
                    'title' => 'google_plus_title',
                ],
                'share' => [
                    'url'   => 'google_share_url',
                    'title' => 'google_share_title',
                ]
            ],
            'youtube'  => [
                'subscribe' => [
                    'channelId' => 'google_youtube_channel_id',
                    'title'     => 'google_youtube_title',
                ],
            ],
            'linkedin' => [
                'share' => [
                    'url'   => 'linkedin_share_url',
                    'title' => 'linkedin_share_title',
                ],
            ],
            'vk'       => [
                'appId'       => null,
                'accessToken' => null,
                'lang'        => null,
                'like'        => [
                    'pageTitle'       => 'vk_like_message_title',
                    'pageDescription' => 'vk_like_message_description',
                    'pageUrl'         => 'vk_like_url',
                    'pageImage'       => 'vk_like_message_image',
                    'text'            => 'vk_like_message_caption',
                    'title'           => 'vk_like_title',
                    'requireSharing'  => 'vk_like_require_sharing',
                ],
                'share'       => [
                    'pageUrl'         => 'vk_share_url',
                    'pageTitle'       => 'vk_share_message_title',
                    'pageDescription' => 'vk_share_description',
                    'pageImage'       => 'vk_share_message_image',
                    'title'           => 'vk_share_title'
                ],
                'subscribe'   => [
                    'groupId' => 'vk_subscribe_group_id',
                    'title'   => 'vk_subscribe_title',
                ]
            ],
            'ok'       => [
                'share' => [
                    'url'   => 'ok_share_url',
                    'title' => 'ok_share_title',
                ]
            ],
            'mail'     => [
                'share' => [
                    'pageUrl'         => 'mail_share_url',
                    'pageDescription' => 'mail_share_message_description',
                    'pageImage'       => 'mail_share_message_image',
                    'pageTitle'       => 'mail_share_message_title',
                    'title'           => 'mail_share_title'
                ],
            ]
        ];

        return $this->recursivePushOptions( $mapData, $data );
    }

    /**
     * Рекурсивно заполняет массив опций по карте
     *
     * @param $map - карта опций
     *
     * @return array - массив опций наложенных на карту
     */
    protected function recursivePushOptions( $map, $data  )
    {
        foreach ($map as $key => $val) {
            if (!is_array( $val )) {
                if (!empty( $val )) {
                    $map[$key] = isset($data[$val]) ? $data[$val] : null;
                } else {
                    $map[$key] = isset($data[$key]) ? $data[$key] : null;
                }
            } else {
                $map[$key] = $this->recursivePushOptions( $map[$key], $data );
            }
        }

        return $map;
    }
}
