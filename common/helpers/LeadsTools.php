<?php
	namespace common\helpers;

	use common\modules\subscription\common\models\LeadsFields;
	use Yii;
	use common\helpers\Avatars;

	class LeadsTools {

		/**
		 * Получает аватар подписавшегося пользователя
		 * @param $lead_id
		 * @return null|string
		 */
		public static function getAvatar($lead_id)
		{
			$lead_fields = new LeadsFields();
			$image_source = $lead_fields->getLeadField($lead_id, 'avatar_url');

			$avatar_url = Avatars::get(md5($image_source), $image_source);

			if( empty($avatar_url) ) {
				return null;
			}

			$alt = 'Аватар пользователя';

			return "<img src='$avatar_url' width='40' height='40' alt='$alt' />";
		}

		/**
		 * Получает иконку сервиса, через который подписался пользователь         *
		 * @param $lead_id
		 * @return string
		 */
		public static function getServiceIcon($lead_id)
		{
			$output = '';

			$lead_fields_model = new LeadsFields();
			$fields = $lead_fields_model->getLeadFields($lead_id);

			if( isset($fields['profile_url']) && isset($fields['source']) ) {
				$output = sprintf('<a href="%s" target="_blank" class="lead-social-icon lead-facebook-icon"><i class="fa fa-%s"></i></a>', $fields['profile_url'], $fields['source']);
			}

			return $output;
		}
	}