<?php
/**
 * @copyright Copyright &copy; Alexander Kovalev, sociallocker.ru, 2016
 * @package yii2-widgets
 * @version 1.3.1
 */
namespace backend\modules\lockers\widgets\vtabs;

use Yii;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Tabs;
use backend\modules\lockers\widgets\vtabs\VerticalTabsAssets;


class VerticalTabs extends Tabs
{

	/**
	 * @var array list of tabs in the tabs widget. Each array element represents a single
	 * tab with the following structure:
	 *
	 * - label: string, required, the tab header label.
	 * - encode: boolean, optional, whether this label should be HTML-encoded. This param will override
	 *   global `$this->encodeLabels` param.
	 * - headerOptions: array, optional, the HTML attributes of the tab header.
	 * - linkOptions: array, optional, the HTML attributes of the tab header link tags.
	 * - content: string, optional, the content (HTML) of the tab pane.
	 * - url: string, optional, an external URL. When this is specified, clicking on this tab will bring
	 *   the browser to this URL. This option is available since version 2.0.4.
	 * - options: array, optional, the HTML attributes of the tab pane container.
	 * - active: boolean, optional, whether this item tab header and pane should be active. If no item is marked as
	 *   'active' explicitly - the first one will be activated.
	 * - visible: boolean, optional, whether the item tab header and pane should be visible or not. Defaults to true.
	 * - items: array, optional, can be used instead of `content` to specify a dropdown items
	 *   configuration array. Each item can hold three extra keys, besides the above ones:
	 *     * active: boolean, optional, whether the item tab header and pane should be visible or not.
	 *     * content: string, required if `items` is not set. The content (HTML) of the tab pane.
	 *     * contentOptions: optional, array, the HTML attributes of the tab content container.
	 */
	public $items = [];
	/**
	 * @var array list of HTML attributes for the item container tags. This will be overwritten
	 * by the "options" set in individual [[items]]. The following special options are recognized:
	 *
	 * - tag: string, defaults to "div", the tag name of the item container tags.
	 *
	 * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
	 */
	public $itemOptions = [];
	/**
	 * @var array list of HTML attributes for the header container tags. This will be overwritten
	 * by the "headerOptions" set in individual [[items]].
	 * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
	 */
	public $headerOptions = [];
	/**
	 * @var array list of HTML attributes for the tab header link tags. This will be overwritten
	 * by the "linkOptions" set in individual [[items]].
	 * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
	 */
	public $linkOptions = [];
	/**
	 * @var boolean whether the labels for header items should be HTML-encoded.
	 */
	public $encodeLabels = true;
	/**
	 * @var string specifies the Bootstrap tab styling.
	 */
	public $navType = 'nav-tabs';
	/**
	 * @var boolean whether to render the `tab-content` container and its content. You may set this property
	 * to be false so that you can manually render `tab-content` yourself in case your tab contents are complex.
	 * @since 2.0.1
	 */
	public $renderTabContent = true;

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();
		Html::addCssClass($this->options, ['tabs-left']);
		Html::addCssStyle($this->options, ['width' => '200px']);
	}

	public function run()
	{
		parent::run();

		$this->registerPlugin('tab');
		$this->renderAssets();

		return Html::tag('div', $this->renderItems(), ['class' => 'onp-vertical-tabs']);;
	}

	public function renderAssets() {
		$view = $this->getView();
		VerticalTabsAssets::register($view);
	}


}