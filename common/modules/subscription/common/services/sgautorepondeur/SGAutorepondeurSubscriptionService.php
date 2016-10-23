<?php
	namespace common\modules\subscription\common\services\sgautorepondeur;

	use Yii;
	use common\modules\subscription\common\classes\Subscription;
	use common\modules\subscription\common\classes\SubscriptionException;
	use GuzzleHttp\Client;
	use GuzzleHttp\Exception\RequestException;

	class SGAutorepondeurSubscriptionService extends Subscription {

		/**
		 * Returns lists available to subscribe.
		 *
		 * @since 1.0.0
		 * @return mixed[]
		 */
		public function getLists()
		{
			return [];
		}

		/**
		 * Subscribes the person.
		 */
		public function subscribe($identityData, $listId, $doubleOptin, $contextData, $verified)
		{

			$vars = $this->refine($identityData);
			$email = $identityData['email'];

			$condition = [];

			if( isset($contextData['lockerId']) ) {
				$condition['locker_id'] = $contextData['lockerId'];
			}

			$apiKey = Yii::$app->lockersSettings->getOne('sg_apikey', false, $condition);
			$memberId = Yii::$app->lockersSettings->getOne('sg_memberid', false, $condition);

			if( empty($apiKey) ) {
				throw new SubscriptionException('The Activation Code of SG Autorepondeur is not specified.');
			}

			if( empty($memberId) ) {
				throw new SubscriptionException('The Member Id of SG Autorepondeur is not specified.');
			}

			if( empty($listId) ) {
				throw new SubscriptionException('The List Id of SG Autorepondeur is not specified.');
			}

			// FROM THIS LINE, DO NOT CHANGE ANYTHING
			$values = [
				'membreid' => $memberId,
				'codeactivationclient' => $apiKey,
				'inscription_normale' => "non",
				'listeid' => $listId,
				'email' => $email,
				'nom' => null,
				'prenom' => null,
				'civilite' => null,
				'adresse' => null,
				'codepostal' => null,
				'ville' => null,
				'pays' => null,
				'siteweb' => null,
				'telephone' => null,
				'parrain' => null,
				'fax' => null,
				'msn' => null,
				'skype' => null,
				'pseudo' => null,
				'sexe' => null,
				'journaissance' => null,
				'moisnaissance' => null,
				'anneenaissance' => null,
				'ip' => Yii::$app->request->getUserIP(),
				'identite' => null,
				'champs_1' => null,
				'champs_2' => null,
				'champs_3' => null,
				'champs_4' => null,
				'champs_5' => null,
				'champs_6' => null,
				'champs_7' => null,
				'champs_8' => null,
				'champs_9' => null,
				'champs_10' => null,
				'champs_11' => null,
				'champs_12' => null,
				'champs_13' => null,
				'champs_14' => null,
				'champs_15' => null,
				'champs_16' => null
			];

			$values = array_merge($values, $identityData);

			if( !empty($identityData['name']) ) {
				$values['nom'] = $identityData['name'];
			}
			if( !empty($identityData['family']) ) {
				$values['prenom'] = $identityData['family'];
			}
			if( empty($values['nom']) && !empty($identityData['displayName']) ) {
				$values['nom'] = $identityData['displayName'];
			}

			$parts = explode('@', $email);

			if( empty($values['nom']) ) {
				$values['nom'] = $parts[0];
			}
			if( empty($values['prenom']) ) {
				$values['prenom'] = $parts[0];
			}

			$client = new Client([
				'timeout' => 10
			]);

			try {
				$result = $client->request("POST", 'http://sg-autorepondeur.com/inscr_decrypt.php', [
					'query' => $values
				]);

				$resultBody = $result->getBody();

				$response = trim($resultBody);

				if( $response == 'informationmanquante' ) {
					throw new SubscriptionException("The data passed incorrect or list ID not found.");
				}

				return ['status' => 'subscribed'];
			} catch( RequestException $e ) {
				throw new SubscriptionException('Unexpected error occurred during connection to SGAutorepondeur: ' . $e->getResponse());
			}
		}

		/**
		 * Checks if the user subscribed.
		 */
		public function check($identityData, $listId, $contextData)
		{
			return ['status' => 'subscribed'];
		}

		/**
		 * Returns custom fields.
		 */
		public function getCustomFields($listId)
		{

			$customFields = [];

			$fields = [
				['name' => 'civilite', 'title' => 'Civilite'],
				['name' => 'adresse', 'title' => 'Adresse'],
				['name' => 'codepostal', 'title' => 'Code Postal'],
				['name' => 'ville', 'title' => 'Ville'],
				['name' => 'pays', 'title' => 'Pays'],
				['name' => 'siteweb', 'title' => 'Siteweb'],
				['name' => 'telephone', 'title' => 'Téléphone'],
				['name' => 'parrain', 'title' => 'Parrain'],
				['name' => 'fax', 'title' => 'Fax'],
				['name' => 'msn', 'title' => 'MSN'],
				['name' => 'skype', 'title' => 'Skype'],
				['name' => 'pseudo', 'title' => 'Pseudo'],
				['name' => 'sexe', 'title' => 'Sexe'],
				['name' => 'journaissance', 'title' => 'Jour Naissance'],
				['name' => 'moisnaissance', 'title' => 'Mois Naissance'],
				['name' => 'anneenaissance', 'title' => 'Anne Naissance'],
				['name' => 'identite', 'title' => 'Pièce d\'identité'],
				['name' => 'champs_1', 'title' => 'Champ personnalisé 1'],
				['name' => 'champs_2', 'title' => 'Champ personnalisé 2'],
				['name' => 'champs_3', 'title' => 'Champ personnalisé 3'],
				['name' => 'champs_4', 'title' => 'Champ personnalisé 4'],
				['name' => 'champs_5', 'title' => 'Champ personnalisé 5'],
				['name' => 'champs_6', 'title' => 'Champ personnalisé 6'],
				['name' => 'champs_7', 'title' => 'Champ personnalisé 7'],
				['name' => 'champs_8', 'title' => 'Champ personnalisé 8'],
				['name' => 'champs_9', 'title' => 'Champ personnalisé 9'],
				['name' => 'champs_10', 'title' => 'Champ personnalisé 10'],
				['name' => 'champs_11', 'title' => 'Champ personnalisé 11'],
				['name' => 'champs_12', 'title' => 'Champ personnalisé 12'],
				['name' => 'champs_13', 'title' => 'Champ personnalisé 13'],
				['name' => 'champs_14', 'title' => 'Champ personnalisé 14'],
				['name' => 'champs_15', 'title' => 'Champ personnalisé 15'],
				['name' => 'champs_16', 'title' => 'Champ personnalisé 16']
			];

			foreach($fields as $field) {
				$fieldType = ['text', 'dropdown', 'integer', 'hidden', 'date', 'checkbox', 'url'];

				$can = [
					'changeType' => true,
					'changeReq' => true,
					'changeDropdown' => true,
					'changeMask' => true
				];

				$fieldOptions = [];
				$fieldOptions['req'] = false;

				$customFields[] = [

					'fieldOptions' => $fieldOptions,
					'mapOptions' => [
						'req' => false,
						'id' => $field['name'],
						'name' => $field['name'],
						'title' => $field['title'],
						'labelTitle' => $field['title'],
						'mapTo' => $fieldType,
						'service' => $field
					],
					'premissions' => [
						'can' => $can
					]
				];
			}

			return $customFields;
		}
	}
