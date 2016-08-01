<?php
/**
 * Кнопка переключатель
 * @author    Alex Kovalevv <alex.kovalevv@gmail.com>
 * @copyright Copyright &copy; Alex Kovalev, sociallocker.ru, 2016
 * @package   yii2-widgets
 * @version   1.0.0
 */
namespace backend\modules\lockers\widgets\controls\switcher;

use Yii;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\InputWidget;


class SwitchControl extends InputWidget
{
    public $model;

    public $attribute;
    /**
     * @var array элементы массива, где label это текст кнопки, value - значение
     * пример использования:
     * 'items' => [['label' => 'Скрыть', 'value' => 'none'],['label' => 'Прозрачный слой', 'value' => 'opacity']]
     */
    public $items = [
        ['label' => 'Вкл.', 'value' => 1],
        ['label' => 'Выкл.', 'value' => 0]
    ];

    /**
     * @var $value значение поля
     */
    public $value;

    /**
     * @var string значение по умолчанию
     */
    public $default = false;

    public $options = [];

    /**
     * @var string события, выполняются во время переключения кнопок
     * Доступные события:
     * ['class-name' => ['1' =>'show', '0' => 'hide']]
     * Если значения 1 или 0 указанные в примере, совпадают со значением value кнопок,
     * то выполнитеся действие для указанного класса
     */
    public $events = [];

    public $itemsOptions = ['class' => 'btn btn-default'];

    public $contanierOptions = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->value = Html::getAttributeValue( $this->model, $this->attribute );

        if (( $this->value === '' || is_null( $this->value ) ) && !is_null( $this->default )) {
            $this->value = $this->default;
        }
    }

    public function run()
    {
        parent::run();
        echo $this->renderInput();
        SwitchControlAssets::register( $this->view );
    }

    protected function renderInput()
    {
        $output = '';
        foreach ($this->items as $item) {

            if (!is_array( $item )) {
                continue;
            }

            $value = ArrayHelper::getValue( $item, 'value', null );

            $this->options['value'] = $value;

            $checked = $value == $this->value;

            $input_name = Html::getInputName( $this->model, $this->attribute );
            $input = Html::radio( $input_name, $checked, $this->options );


            $label = ArrayHelper::getValue( $item, 'label' );
            $itemsOptions = ArrayHelper::merge( $this->itemsOptions, [] );

            if ($checked) {
                Html::addCssClass( $itemsOptions, 'active' );
            }

            $output .= Html::tag( 'div', $input . $label, $itemsOptions );

            $this->contanierOptions = ArrayHelper::merge( [
                'role'        => "group",
                'data-toggle' => 'buttons'
            ], $this->contanierOptions );

            Html::addCssClass($this->contanierOptions, 'btn-group wt-switch');
        }

        return Html::tag( 'div', $output, ArrayHelper::merge( $this->contanierOptions,
            empty( $this->events ) ? [] : ['data-events' => $this->events] ) );
    }
}
