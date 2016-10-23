<?php
	/**
	 * Инструменты для работы с подпиской
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */

	namespace common\modules\subscription\common\classes;

	use Yii;

	class SubscriptionTools {

		public function normilizeValues($values = [])
		{
			if( empty($values) ) {
				return $values;
			}
			if( !is_array($values) ) {
				$values = [$values];
			}

			foreach($values as $index => $value) {

				$values[$index] = is_array($value)
					? $this->normilizeValues($value)
					: $this->normilizeValue($value);
			}

			return $values;
		}

		public function normilizeValue($value = null)
		{
			if( 'false' === $value ) {
				$value = false;
			} elseif( 'true' === $value ) {
				$value = true;
			} elseif( 'null' === $value ) {
				$value = null;
			}

			return $value;
		}

		/**
		 * Process names of the identity data.
		 */
		public function prepareDataToSave($service, $itemId, $identityData)
		{

			// move the values from the custom fields like FNAME, LNAME

			if( !empty($service) ) {
				$formType = Yii::$app->lockers->getOption($itemId, 'form_type', 'email-form');
				$strFieldsJson = Yii::$app->lockers->getOption($itemId, 'custom_fields', null);

				if( 'custom-form' == $formType && !empty($strFieldsJson) ) {

					$fieldsData = json_decode($strFieldsJson, true);
					$ids = $service->getNameFieldIds();

					$newIdentityData = $identityData;

					foreach($identityData as $itemId => $itemValue) {

						foreach($fieldsData as $fieldData) {

							if( !isset($fieldData['mapOptions']['id']) ) {
								continue;
							}
							if( $fieldData['fieldOptions']['id'] !== $itemId ) {
								continue;
							}

							$mapId = $fieldData['mapOptions']['id'];

							if( in_array($fieldData['mapOptions']['mapTo'], ['separator', 'html', 'label']) ) {
								unset($newIdentityData[$itemId]);
								continue;
							}

							foreach($ids as $nameFieldId => $nameFieldType) {
								if( $mapId !== $nameFieldId ) {
									continue;
								}
								$newIdentityData[$nameFieldType] = $itemValue;
								unset($newIdentityData[$itemId]);
							}
						}
					}

					$identityData = $newIdentityData;
				}
			}

			// splits the full name into 2 parts

			if( isset($identityData['fullname']) ) {

				$fullname = trim($identityData['fullname']);
				unset($identityData['fullname']);

				$parts = explode(' ', $fullname);
				$nameParts = [];

				foreach($parts as $part) {
					if( trim($part) == '' ) {
						continue;
					}
					$nameParts[] = $part;
				}

				if( count($nameParts) == 1 ) {
					$identityData['name'] = $nameParts[0];
				} else if( count($nameParts) > 1 ) {
					$identityData['name'] = $nameParts[0];
					$identityData['displayName'] = implode(' ', $nameParts);
					unset($nameParts[0]);
					$identityData['family'] = implode(' ', $nameParts);
				}
			}

			return $identityData;
		}

		/**
		 * Replaces keys of identity data of the view 'cf3' with the ids of custom fields in the mailing services.
		 */
		public function mapToServiceIds($service, $itemId, $identityData)
		{

			$formType = Yii::$app->lockers->getOption($itemId, 'form_type', 'email-form');
			$strFieldsJson = Yii::$app->lockers->getOption($itemId, 'custom_fields', null);

			if( 'custom-form' !== $formType || empty($strFieldsJson) ) {

				$data = [];
				if( isset($identityData['email']) ) {
					$data['email'] = $identityData['email'];
				}
				if( isset($identityData['name']) ) {
					$data['name'] = $identityData['name'];
				}
				if( isset($identityData['family']) ) {
					$data['family'] = $identityData['family'];
				}

				return $data;
			}

			$fieldsData = json_decode($strFieldsJson, true);

			$data = [];
			foreach($identityData as $itemId => $itemValue) {

				if( in_array($itemId, ['email', 'fullname', 'name', 'family', 'displayName']) ) {
					$data[$itemId] = $itemValue;
					continue;
				}

				foreach($fieldsData as $fieldData) {

					if( $fieldData['fieldOptions']['id'] === $itemId ) {
						$mapId = $fieldData['mapOptions']['id'];
						$data[$mapId] = $service->prepareFieldValueToSave($fieldData['mapOptions'], $itemValue);
					}
				}
			}

			return $data;
		}

		/**
		 * Replaces keys of identity data of the view 'cf3' with the labels the user enteres in the locker settings.
		 */
		public function mapToCustomLabels($service, $itemId, $identityData)
		{

			$formType = Yii::$app->lockers->getOption($itemId, 'form_type', true);
			$strFieldsJson = Yii::$app->lockers->getOption($itemId, 'custom_fields', null);

			if( 'custom-form' !== $formType || empty($strFieldsJson) ) {
				return $identityData;
			}

			$fieldsData = json_decode($strFieldsJson, true);

			$data = [];
			foreach($identityData as $itemId => $itemValue) {

				if( in_array($itemId, ['email', 'fullname', 'name', 'family', 'displayName']) ) {
					$data[$itemId] = $itemValue;
					continue;
				}

				foreach($fieldsData as $fieldData) {

					if( $fieldData['fieldOptions']['id'] !== $itemId ) {
						continue;
					}
					$label = $fieldData['serviceOptions']['label'];

					if( empty($label) ) {
						continue 2;
					}
					$data['{' . $label . '}'] = $itemValue;
					continue 2;
				}

				$data[$itemId] = $itemValue;
			}

			return $data;
		}
	}