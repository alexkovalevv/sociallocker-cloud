<?php
/**
 * Предоставляет возможность получить настройки замка по ключу или все сразу.
 * @author Alex Kovalev <alex.kovalevv@gmail.com>
 */
namespace backend\modules\lockers\components;

use yii\base\Component;
use yii\helpers\ArrayHelper;
use Yii;
use backend\modules\lockers\models\settings\Settings;


class LockersSettings extends Component
{
    /**
     * @var string префикс
     */
    public $cachePrefix = '_lockersSetting';
    /**
     * @var int время хранения кеша
     */
    public $cachingDuration = 60;

    /**
     * @var array values временное хранилище настроек
     */
    private $values = [];

    /**
     * @param $key
     * @param null $default
     * @param bool $cache
     * @param int|bool $cachingDuration
     * @return mixed|null
     */
    public function get($key, $default = null, $cache = true, $cachingDuration = false)
    {
	    $setting = new Settings();

        if ($cache) {
            $cacheKey = $this->getCacheKey($key);
            $value = ArrayHelper::getValue($this->values, $key, false) ?: Yii::$app->cache->get($cacheKey);
            if ($value === false) {
                if ($model = $setting->getModel()) {
	                foreach( json_decode($model->value) as $name => $val ) {
		                $this->values[$name] = $val;
		                Yii::$app->cache->set(
			                $this->getCacheKey($name),
			                $val,
			                $cachingDuration === false ? $this->cachingDuration : $cachingDuration
		                );
	                }

	                $value = isset($this->values[$key]) ? $this->values[$key] : $default;
                } else {
                    $value = $default;
                }
            }
        } else {
	        if($model = $setting->getModel()) {
		        $model_value = json_decode($model->value);
		        $value = isset($model_value[$key]) ? $model_value[$key] : $default;
	        } else {
		        $value = $default;
	        }
        }
        return $value;
    }

    /**
     * @param array $keys
     * @return array
     */
    public function getAll(array $keys)
    {
        $values = [];
        foreach ($keys as $key) {
            $values[$key] = $this->get($key);
        }
        return $values;
    }

    /**
     * @param $key
     * @param bool $cache
     * @return bool
     */
    public function has($key, $cache = true)
    {
        return $this->get($key, null, $cache) !== null;
    }

    /**
     * @param array $keys
     * @return bool
     */
    public function hasAll(array $keys)
    {
        foreach ($keys as $key) {
            if (!$this->has($key)) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param $key
     * @return array
     */
    protected function getCacheKey($key)
    {
        return [
            __CLASS__,
            $this->cachePrefix,
            $key
        ];
    }
}
