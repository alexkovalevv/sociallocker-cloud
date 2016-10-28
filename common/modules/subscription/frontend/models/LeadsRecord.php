<?php
	/**
	 * Класс для работы записи и получения данными лидов
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 * @package subscription
	 */

	namespace common\modules\subscription\frontend\models;

	use Yii;
	use yii\base\Exception;
	use common\modules\subscription\common\models\Leads;
	use frontend\traits\FrontendUsersSpace;

	class LeadsRecord {

		use FrontendUsersSpace;

		public $user_id;
		public $site_id;

		public function __construct($user_id = null, $site_id = null)
		{
			$this->user_id = $user_id;
			$this->site_id = $site_id;
		}

		public function __call($name, array $attributes = [])
		{
			$leads_model = new Leads([
				'user_id' => $this->user_id,
				'site_id' => $this->site_id
			]);

			return self::methodCall($leads_model, $name, $attributes);
		}

		/**
		 * @param int $user_id
		 * @param int $site_id
		 * @return Leads
		 * @see userSpace backend\traits\BackendUsersSpace
		 */
		public static function user($user_id, $site_id = null)
		{
			return self::userSpace($user_id, $site_id);
		}

		/**
		 * @return Leads
		 * @throws Exception
		 * @see globalSpace backend\traits\BackendUsersSpace
		 */
		public static function users()
		{
			return self::globalSpace();
		}
	}
