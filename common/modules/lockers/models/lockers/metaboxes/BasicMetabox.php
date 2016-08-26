<?php
/**
 * Модели базовые настройки. Является частью мультимодели редактирования замков.
 * @author Alex Kovalev <alex.kovalevv@gmail.com> 
 */

namespace common\modules\lockers\models\lockers\metaboxes;

use Yii;
use yii\base\Model;

class BasicMetabox extends Model
{
	//Название замка
	public $title;

	//Заголовок внутри замка
	public $header;

	//Текстовое сообщение внутри замка
	public $message;

	//Тема для замка
	public $style;

	//Режим наложения
	public $overlap;

	//Позиция замка на слое
	public $overlap_position;

	public function rules()
	{
		return [
			[['title', 'header', 'message', 'style'], 'required'],
			[[
				 'title',
				 'header',
				 'message',
				 'style',
				 'overlap',
				 'overlap_position',
			], 'string'],
			['overlap', 'default', 'value' => 'full'],
			['overlap_position', 'default', 'value' => 'middle']
		];
	}

	public function attributeLabels() {
		return [
			'title'            => 'Название замка',
			'header'           => 'Заголовок',
			'message'          => 'Описание',
			'style'            => 'Выберите тему',
			'overlap'          => 'Выберите режим наложения',
			'overlap_position' => 'Позиция замка на слое',
		];
	}

	public function attributeHints() {
		return [
			'header'  => 'Введите заголовок, который привлекает внимание или призывает к действию. Вы можете оставить это поле пустым.',
			'message' => 'Введите основное сообщение, которое будет отображаться под заголовком.',
			'style'   => 'Выберите наиболее подходящую тему.',
			'overlap' => 'Выберите режим наложения'
		];
	}

	/**
	 * Значения полей по умолчанию. Если элемента массива не существует, то возвращается false или null.
	 * @return array
	 */
	public function attributeDefaults() {
        $locker_type = Yii::$app->request->getQueryParam('type', 'sociallocker');
        $locker_title = 'Новый черновик ';

        switch($locker_type) {
            case 'sociallocker':
                $locker_title .= 'социального замка';
                break;
            case 'signinlocker':
                $locker_title .= 'замка авторизации';
                break;
            case 'emaillocker':
                $locker_title .= 'email замка';
                break;
        }

        $locker_title .= ' (#'. rand(1,999) .')';

		return [
            'title'            => $locker_title,
			'header'           => 'Этот контент заблокирован!',
			'message'          => 'Пожалуйста, поддержите нас, нажмите на одну из социальных кнопок ниже, чтобы открыть контент.',
			'overlap'          => 'full',
			'overlap_position' => 'middle',
		];
	}
}
