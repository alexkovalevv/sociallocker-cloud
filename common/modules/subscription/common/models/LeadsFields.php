<?php

	namespace common\modules\subscription\common\models;

	use Yii;

	/**
	 * This is the model class for table "{{%leads_fields}}".
	 *
	 * @property integer $lead_id
	 * @property string $fields_value
	 */
	class LeadsFields extends \yii\db\ActiveRecord {

		private $_fields = [];
		private $_customFields = [];

		/**
		 * @inheritdoc
		 */
		public static function tableName()
		{
			return '{{%subscription_leads_fields}}';
		}

		/**
		 * @inheritdoc
		 */
		public function rules()
		{
			return [
				[['lead_id', 'fields_value'], 'required'],
				[['lead_id'], 'integer'],
				[['fields_value'], 'string'],
			];
		}


		/**
		 * Returns custom fields
		 */
		public function getCustomFields($leadId = null)
		{
			return $this->getLeadFields($leadId, true);
		}

		/**
		 * Returns all fields of a given lead.
		 *
		 * @since 1.0.7
		 * @param int $leadId An id of a lead which contains fields to return.
		 * @return string[]
		 */
		public function getLeadFields($leadId, $custom = false)
		{

			if( $custom && isset($this->_customFields[$leadId]) ) {
				return $this->_customFields[$leadId];
			}
			if( isset($this->_fields[$leadId]) ) {
				return $this->_fields[$leadId];
			}

			$model = $this->findOne($leadId);

			if( !$model ) {
				return [];
			}

			$data = json_decode($model->fields_value, true);

			$fields = [];
			$customFields = [];

			foreach($data as $name => $item) {
				if( $item['custom'] ) {
					$customFields[$name] = $item['value'];
				}

				$fields[$name] = $item['value'];
			}

			$this->_fields[$leadId] = $fields;

			if( $custom ) {
				$this->_customFields = $customFields;

				return $customFields;
			}

			return $fields;
		}

		/**
		 * Returns a given field of a lead.
		 *
		 * @since 1.0.7
		 * @param int $leadId An id of a lead which contains fields to return.
		 * @param string $fieldName A field name to return.
		 * @param mixed $default A default value to return if the field is not found in the database.
		 * @return string
		 */
		public function getLeadField($leadId, $fieldName, $default = null)
		{
			$fields = $this->getLeadFields($leadId);

			return isset($fields[$fieldName])
				? $fields[$fieldName]
				: $default;
		}

		/**
		 * Removes a field of a given lead.
		 *
		 * @since 1.0.7
		 * @param int $leadId An id of a lead which contains a field to remove.
		 * @param string $fieldName A field name to remove.
		 * @return void
		 */
		public function removeLeadField($leadId, $fieldName)
		{
			self::updateLeadField($leadId, $fieldName, null);
		}

		/**
		 * Updates a field of a given lead.
		 *
		 * @since 1.0.7
		 * @param int $leadId An id of a lead which contains a field to update.
		 * @param string $fieldName A field name to update.
		 * @param string $fieldValue A field value to set.
		 * @return boolean
		 */
		public function updateLeadField($leadId, $fieldName, $fieldValue, $custom = 0)
		{

			if( !isset($this->_fields[$leadId]) ) {
				$this->_fields[$leadId] = $this->getLeadFields($leadId);
			}

			$model = $this->findOne($leadId);

			if( empty($fieldValue) && $model ) {

				$data = json_decode($model->fields_value, true);
				if( isset($data[$fieldName]) ) {
					unset($data[$fieldName]);
				}
				$model->fields_value = json_encode($data);

				unset($this->_fields[$leadId][$fieldName]);

				return $model->save(true);
			}

			$this->_fields[$leadId][$fieldName] = $fieldValue;

			if( $model ) {
				$data = json_decode($model->fields_value, true);
				$data[$fieldName]['value'] = $fieldValue;
				$data[$fieldName]['custom'] = $custom;
				$model->fields_value = json_encode($data);

				return $model->save(true);
			}

			$this->lead_id = $leadId;
			$this->fields_value = json_encode([$fieldName => ['value' => $fieldValue, 'custom' => $custom]]);

			return $this->save(true);
		}
	}
