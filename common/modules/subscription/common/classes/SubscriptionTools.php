<?php
	/**
	 * Инструменты для работы с подпиской
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */
	
	namespace common\modules\subscription\common\classes;
	
	use Yii;
	
	class SubscriptionTools {
		
		/**
		 * Process names of the identity data.
		 * @param Subscription $service
		 * @param $itemId
		 * @param $identity_data
		 * @return mixed
		 */
		public function prepareDataToSave($service, $locker_id, $identity_data)
		{
			
			// move the values from the custom fields like FNAME, LNAME
			
			if( !empty($service) ) {
				$formType = Yii::$app->locker->getOption($locker_id, 'form_type', 'email-form');
				$fieldsData = Yii::$app->locker->getOption($locker_id, 'custom_fields', null);
				
				if( 'custom-form' == $formType && !empty($fieldsData) ) {
					
					$ids = $service->getNameFieldIds();
					
					$newIdentityData = $identity_data;
					
					foreach($identity_data as $locker_id => $item_value) {
						
						foreach($fieldsData as $field_data) {
							
							if( !isset($field_data['mapOptions']['id']) ) {
								continue;
							}
							if( $field_data['fieldOptions']['id'] !== $locker_id ) {
								continue;
							}
							
							$mapId = $field_data['mapOptions']['id'];
							
							if( in_array($field_data['mapOptions']['mapTo'], ['separator', 'html', 'label']) ) {
								unset($newIdentityData[$locker_id]);
								continue;
							}
							
							foreach($ids as $nameFieldId => $nameFieldType) {
								if( $mapId !== $nameFieldId ) {
									continue;
								}
								$newIdentityData[$nameFieldType] = $item_value;
								unset($newIdentityData[$locker_id]);
							}
						}
					}
					
					$identity_data = $newIdentityData;
				}
			}
			
			// splits the full name into 2 parts
			
			if( isset($identity_data['fullname']) ) {
				
				$fullname = trim($identity_data['fullname']);
				unset($identity_data['fullname']);
				
				$parts = explode(' ', $fullname);
				$nameParts = [];
				
				foreach($parts as $part) {
					if( trim($part) == '' ) {
						continue;
					}
					$nameParts[] = $part;
				}
				
				if( count($nameParts) == 1 ) {
					$identity_data['name'] = $nameParts[0];
				} else if( count($nameParts) > 1 ) {
					$identity_data['name'] = $nameParts[0];
					$identity_data['display_name'] = implode(' ', $nameParts);
					unset($nameParts[0]);
					$identity_data['family'] = implode(' ', $nameParts);
				}
			}
			
			return $identity_data;
		}
		
		/**
		 * Replaces keys of identity data of the view 'cf3' with the ids of custom fields in the mailing services.
		 * @param Subscription $service
		 * @param $locker_id
		 * @param $identity_data
		 * @return array
		 */
		public function mapToServiceIds($service, $locker_id, $identity_data)
		{
			
			$formType = Yii::$app->locker->getOption($locker_id, 'form_type', 'email-form');
			$fieldsData = Yii::$app->locker->getOption($locker_id, 'custom_fields', null);
			
			if( 'custom-form' !== $formType || empty($fieldsData) ) {
				
				$data = [];
				if( isset($identity_data['email']) ) {
					$data['email'] = $identity_data['email'];
				}
				if( isset($identity_data['name']) ) {
					$data['name'] = $identity_data['name'];
				}
				if( isset($identity_data['family']) ) {
					$data['family'] = $identity_data['family'];
				}
				
				return $data;
			}

			$data = [];
			foreach($identity_data as $locker_id => $item_value) {
				
				if( in_array($locker_id, ['email', 'fullname', 'name', 'family', 'display_name']) ) {
					$data[$locker_id] = $item_value;
					continue;
				}
				
				foreach($fieldsData as $field_data) {
					
					if( $field_data['fieldOptions']['id'] === $locker_id ) {
						$mapId = $field_data['mapOptions']['id'];
						$data[$mapId] = $service->prepareFieldValueToSave($field_data['mapOptions'], $item_value);
					}
				}
			}
			
			return $data;
		}
		
		/**
		 * Replaces keys of identity data of the view 'cf3' with the labels the user enteres in the locker settings
		 * @param Subscription $service
		 * @param $service
		 * @param $locker_id
		 * @param $identity_data
		 * @return array
		 */
		public function mapToCustomLabels($service, $locker_id, $identity_data)
		{
			
			$formType = Yii::$app->locker->getOption($locker_id, 'form_type', true);
			$fieldsData = Yii::$app->locker->getOption($locker_id, 'custom_fields', null);
			
			if( 'custom-form' !== $formType || empty($fieldsData) ) {
				return $identity_data;
			}
			
			$data = [];
			foreach($identity_data as $locker_id => $item_value) {
				
				if( in_array($locker_id, ['email', 'fullname', 'name', 'family', 'display_name']) ) {
					$data[$locker_id] = $item_value;
					continue;
				}
				
				foreach($fieldsData as $field_data) {
					
					if( $field_data['fieldOptions']['id'] !== $locker_id ) {
						continue;
					}
					$label = $field_data['serviceOptions']['label'];
					
					if( empty($label) ) {
						continue 2;
					}
					$data['{' . $label . '}'] = $item_value;
					continue 2;
				}
				
				$data[$locker_id] = $item_value;
			}
			
			return $data;
		}
	}