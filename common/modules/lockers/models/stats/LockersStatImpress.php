<?php

namespace common\modules\lockers\models\stats;

use Yii;

/**
 * This is the model class for table "{{%lockers_stat_impress}}".
 *
 * @property integer $id
 * @property integer $locker_id
 * @property integer $impress
 * @property string $aggregate_date
 * @property string $site_url
 * @property string $page_url_hash
 * @property string $page_url
 */
class LockersStatImpress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%lockers_stat_impress}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['locker_id', 'site_url', 'page_url_hash', 'page_url'], 'required'],
            [['locker_id', 'impress', 'aggregate_date'], 'safe'],
            [['page_url'], 'string'],
            [['page_url_hash'], 'string', 'max' => 32],
            [['site_url'], 'string', 'max' => 255],
            [['site_url', 'page_url'], 'url']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'locker_id' => 'ID замка',
            'impress' => 'Просмотров',
            'aggregate_date' => 'Дата',
            'site_url' => 'Сайт',
            'page_url_hash' => 'Хеш страницы',
            'page_url' => 'Страница',
        ];
    }

	public function newUpdate() {

		if( $this->validate() ) {
			Yii::$app->db->createCommand("INSERT INTO {{%lockers_stat_impress}}(
				locker_id,
				impress,
				aggregate_date,
				site_url,
				page_url_hash,
				page_url
			) VALUES ('$this->locker_id','1', CURDATE(), '$this->site_url', '$this->page_url_hash', '$this->page_url')
			ON DUPLICATE KEY UPDATE impress=impress+1")->execute();
			return true;
		}

		return false;
	}
}
