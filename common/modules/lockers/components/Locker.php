<?php
/**
 * Предоставляет возможность получить настройки замка по ключу и id или все сразу.
 * @author Alex Kovalev <alex.kovalevv@gmail.com>
 */
namespace common\modules\lockers\components;

use yii;
use yii\base\Component;
use yii\helpers\ArrayHelper;
use common\modules\lockers\models\lockers\Lockers;


class LockerMeta extends Component
{
    /**
     * @var string префикс
     */
    public $cachePrefix = '_lockerMeta';
    /**
     * @var int время хранения кеша
     */
    public $cachingDuration = 60;

    /**
     * @var array values временное хранилище настроек
     */
    private $values = [];

    /**
     * @param int $id
     * @param string $key
     * @param null $default
     * @param bool $cache
     * @param int|bool $cachingDuration
     * @return mixed|null
     */
    public function get($id, $key, $default = null, $cache = true, $cachingDuration = false)
    {
        if ($cache) {
            $cacheKey = $this->getCacheKey($id.$key);
            $value = ArrayHelper::getValue($this->values, $id.$key, false) ?: Yii::$app->cache->get($cacheKey);
            if ($value === false) {
                if ($model = Lockers::findOne($id)) {
	                foreach( json_decode($model->options) as $name => $val ) {
		                $this->values[$id.$name] = $val;
		                Yii::$app->cache->set(
			                $this->getCacheKey($id.$name),
			                $val,
			                $cachingDuration === false ? $this->cachingDuration : $cachingDuration
		                );
	                }

	                $value = isset($this->values[$id.$key]) ? $this->values[$id.$key] : $default;
                } else {
                    $value = $default;
                }
            }
        } else {
	        if($model = Lockers::findOne($id)) {
		        $model_value = json_decode($model->options);
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
    public function getAll($id, array $keys)
    {
        $values = [];
        foreach ($keys as $key) {
            $values[$key] = $this->get($id, $key);
        }
        return $values;
    }

    /**
     * @param $key
     * @param bool $cache
     * @return bool
     */
    public function has($id, $key, $cache = true)
    {
        return $this->get($id, $key, null, $cache) !== null;
    }

    /**
     * @param array $keys
     * @return bool
     */
    public function hasAll($id, array $keys)
    {
        foreach ($keys as $key) {
            if (!$this->has($id, $key)) {
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
