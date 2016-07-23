<?php
namespace backend\modules\lockers\models\settings\forms;

use Yii;
use backend\modules\lockers\models\settings\SettingsForm;
use yii\base\Model;


/**
 * Create locker form
 */
class Terms extends Model
{

	public $terms_enabled;
	public $terms_of_use_text;
	public $privacy_policy_text;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['terms_of_use_text', 'privacy_policy_text'], 'string'],
			[['terms_enabled'], 'integer']
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'terms_enabled'       => 'Активировать Политику',
			'terms_of_use_text'   => 'Правила использования',
			'privacy_policy_text' => 'Политика конфиденциальности',
		];
	}

	public function attributeHints() {
		return [
			'terms_enabled'       => 'Если Вкл, будут показаны ссылки на условия использования и политику конфиденциальности вашего сайта для Замка авторизации и Email Замка.',
			'terms_of_use_text'   => 'Текст условия использования. Ссылка на этот текст будет показана внизу замка.',
			'privacy_policy_text' => 'Текст политика конфиденциальности. Ссылка на текст будет показана внизу замка.',
		];
	}

	/**
	 * Значения полей по умолчанию. Если элемента массива не существует, то возвращается false или null.
	 * @return array
	 */
	public function attributeDefaults() {
		return [
			'terms_enabled'       => true,
			'terms_of_use_text'   => file_get_contents( Yii::getAlias( '@lockers/content/terms-of-use-ru_RU.html' ) ),
			'privacy_policy_text' => file_get_contents( Yii::getAlias( '@lockers/content/privacy-policy-ru_RU.html' ) ),
		];
	}
}
