<?php
/**
 * Мультимодель редактирования замков.
 * @author Alex Kovalev <alex.kovalevv@gmail.com>
 */

namespace backend\modules\lockers\models\lockers;

use Yii;
use yii\base\Exception;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use backend\modules\lockers\models\lockers\Lockers;
use common\base\MultiModel;


class LockersForm extends MultiModel
{

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
	/*public function mapLockerOptions() {
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
				'appId' => null,
				'lang'  => null,
				'version' => null,
				'like'  => [
					'url'   => 'facebook_like_url',
					'title' => 'facebook_like_title',
				],
				'share' => [
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
				'lang' => null,
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
				'appId' => null,
				'accessToken'  => null,
				'lang' => null,
				'like'      => [
					'pageTitle'       => 'vk_like_message_title',
					'pageDescription' => 'vk_like_message_description',
					'pageUrl'         => 'vk_like_url',
					'pageImage'       => 'vk_like_message_image',
					'text'            => 'vk_like_message_caption',
					'title'           => 'vk_like_title',
					'requireSharing'  => 'vk_like_require_sharing',
				],
				'share'     => [
					'pageUrl'         => 'vk_share_url',
					'pageTitle'       => 'vk_share_message_title',
					'pageDescription' => 'vk_share_description',
					'pageImage'       => 'vk_share_message_image',
					'title'           => 'vk_share_title'
				],
				'subscribe' => [
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

		return $this->recursivePushOptions($mapData);
	}

	/**
	 * Рекурсивно заполняет массив опций по карте
	 * @param $map - карта опций
	 *
	 * @return array - массив опций наложенных на карту
	 */
	/*protected function recursivePushOptions($map) {
		foreach( $map as $key => $val ) {
			if( !is_array($val) ) {
				if( !empty($val) ) {
					$map[$key] = isset($this->attributes[$val])
						? (( $this->attributes[$val] === "0" ||  $this->attributes[$val] === "1" ) ? (boolean)$this->attributes[$val] : $this->attributes[$val])
						: null;
				} else {
					$map[$key] = isset($this->attributes[$key])
						? (($this->attributes[$key] === "0" || $this->attributes[$key] === "1" ) ? (boolean)$this->attributes[$key] : $this->attributes[$key])
						: null;
				}
			} else {
				$map[$key] = $this->recursivePushOptions($map[$key]);
			}
		}
		return $map;
	}*/

	public function setMultiModel($model)
	{
		if( $model === null ) return false;

		foreach ($this->models as $k => $m ) {
			$m->attributes = ArrayHelper::merge($model->attributes,Json::decode($model->options));
		}

		return true;
	}


	/**
	 * Сохраянет данные текущей модели
	 * @param $type - передается тип замка в формате string
	 *
	 * @return bool|Exception
	 */
	public function saveMultiModel($type, $model = null, $runValidation = true) {

		if ($runValidation && !$this->validate()) {
			return false;
		}

		$optionFilter = ['title', 'header', 'message', 'type', 'status'];

		if( empty($model) ) $model = new Lockers();

		$data = [];
		foreach ($this->models as $k => $m ) {
			$data = array_merge($data, $m->attributes);
		}

		$model->title = $data['title'];
		$model->header = $data['header'];
		$model->message = $data['message'];
		$model->type = $type;
		$model->user_id = Yii::$app->user->identity->id;

		$locker_options = [];
		foreach( $data as $key => $attr ) {
			if( !in_array( $key, $optionFilter ) ) {
				$locker_options[$key] = $attr;
			}
		}

		$model->options = json_encode( $locker_options );

		if( !$model->save() ) {
			return new Exception( "Возникла ошибка при создание замка!" );
		}

		return true;
	}
}
