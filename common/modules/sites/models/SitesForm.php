<?php
	/**
	 * Модель формы создания сайта
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */

	namespace common\modules\sites\models;

	use yii;
	use yii\base\Model;

	class SitesForm extends Model {

		const  STATUS_ACTIVE = 2;
		const  STATUS_DEACTIVE = 1;
		const  SELECTED = 2;
		const  NOT_SELECTED = 1;
		const  APPROVE = 2;
		const  NOT_APPROVE = 1;

		public $url;
		public $platform;


		public function rules()
		{
			return [
				[['url'], 'required'],
				[['url'], 'url']
			];
		}

		public function attributeLabels()
		{
			return [
				'url' => 'Адрес сайта'
			];
		}

		public function attributeHints()
		{
			return [
				'url' => 'Введите адрес вашего сайта. Например: http://site.com или https://shop.site.com',
			];
		}

		/**
		 * Получает сайт по Url
		 * @param $url
		 * @return array|null|yii\db\ActiveRecord
		 */
		public function getSiteByUrl($url)
		{
			$domain = parse_url($url, PHP_URL_HOST);

			$model = Sites::find()->where([
				'user_id' => Yii::$app->user->getId(),
				'domain' => $domain
			])->one();

			if( !empty($model) ) {
				return $model;
			}

			return null;
		}

		public function save($validate = false)
		{

			if( $validate && !$this->validate() ) {
				return false;
			}

			$model = $this->getSiteByUrl($this->url);

			if( !empty($model) ) {
				if( $model->status === self::STATUS_DEACTIVE ) {

					return $model;
				} else if( $model->status === self::STATUS_ACTIVE ) {
					$this->addError('url', 'Сайт с таким url уже был добавлен вами!');
					$this->validate(null, false);

					return false;
				}
			}

			$model = new Sites();
			$model->user_id = Yii::$app->user->getId();
			$model->url = $this->url;
			$model->domain = parse_url($this->url, PHP_URL_HOST);
			$model->status = self::STATUS_DEACTIVE;
			$model->selected = self::NOT_SELECTED;
			$model->approve = self::NOT_APPROVE;

			if( $model->save(true) ) {
				return $model;
			}

			return false;
		}
	}