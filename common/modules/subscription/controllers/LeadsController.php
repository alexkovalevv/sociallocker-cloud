<?php

namespace common\modules\subscription\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\modules\subscription\models\Leads;
use common\modules\subscription\models\LeadsSearch;
use common\modules\subscription\models\LeadsExport;
use common\modules\lockers\models\lockers\Lockers;

/**
 * LeadsController implements the CRUD actions for Leads model.
 */
class LeadsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Leads models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LeadsSearch();
        $dataProvider = $searchModel->search( Yii::$app->request->queryParams );

        return $this->render( 'index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ] );
    }

    /**
     * Displays a single Leads model.
     *
     * @param string $id
     *
     * @return mixed
     */
    public function actionView( $id )
    {
        return $this->render( 'view', [
            'model' => $this->findModel( $id ),
        ] );
    }

    /**
     * Creates a new Leads model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Leads();

        if ($model->load( Yii::$app->request->post() ) && $model->save()) {
            return $this->redirect( ['view', 'id' => $model->id] );
        } else {
            return $this->render( 'create', [
                'model' => $model,
            ] );
        }
    }

    /**
     * Updates an existing Leads model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param string $id
     *
     * @return mixed
     */
    public function actionUpdate( $id )
    {
        $model = $this->findModel( $id );

        if ($model->load( Yii::$app->request->post() ) && $model->save()) {
            return $this->redirect( ['view', 'id' => $model->id] );
        } else {
            return $this->render( 'update', [
                'model' => $model,
            ] );
        }
    }

    /**
     * Deletes an existing Leads model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param string $id
     *
     * @return mixed
     */
    public function actionDelete( $id )
    {
        $this->findModel( $id )->delete();

        return $this->redirect( ['index'] );
    }

    public function actionExport()
    {
        $model = new LeadsExport();

        $lockers_model = new Lockers();
        $lockers = $lockers_model->find()->where(['user_id'=>Yii::$app->user->identity->id])->all();

        $channels = [];
        foreach( $lockers as $locker ) {
            $channels[$locker->id] = $locker->title;
        }

        if ( $model->load( Yii::$app->request->post() ) && $model->validate() ) {
            if( $model->format === 'csv' ) {
                return $this->exportCsv($model);
            }
        }

        return $this->render( 'export', [
            'model' => $model,
            'channels' => $channels
        ]);
    }

    /**
     * @param object $model
     */
    protected function exportCsv($model) {

        $errors = null;
        $warning = null;

        // - delimiter
        $delimiter = $model->delimiter;
        if (!in_array( $delimiter, array(',', ';') )) {
            $delimiter = ',';
        }

        // - channels
        $lockers = $model->channels;
        $lockerIds = array();
        if( !empty($lockers) ) {
            foreach ($lockers as $lockerId) {
                if ('all' == $lockerId) {
                    continue;
                }
                $lockerIds[] = intval( $lockerId );
            }
        } else {
            $errors .= "Пожалуйста, убедитесь, что вы выбрали хотя бы один канал из списка каналов.\n";
        }

        // - status
        $email_status = $model->email_status;

        if (!in_array( $email_status, array('all', 'confirmed', 'not-confirmed') )) {
            $email_status = 'all';
        }

        // - fields
        $rawFields = $model->fields;

        $fields = array();
        if( !empty($rawFields) ) {
            foreach ($rawFields as $field) {

                if (!in_array( $field,
                    array('lead_email', 'lead_display_name', 'lead_name', 'lead_family', 'lead_ip') )
                )  continue;

                $fields[] = $field;
            }
        } else {
            $errors .= "Пожалуйста, убедитесь, что вы выбрали хотя бы одно поле для экспорта из списка полей.\n";
        }

        // - custom fields
       /*$rawCustomFields = $model->custom_fields;
        $selectedCustomFields = array();

        foreach ($rawCustomFields as $customField) {
            $selectedCustomFields[] = $customField;
        }*/

        if( empty($errors) ) {

            $leads_search_model = new LeadsSearch();
            $dataprovider = $leads_search_model->search([]);

            $leads = array();
            foreach( $dataprovider->getModels() as $model ) {
                $attributes = $model->getAttributes($fields);
                foreach( $fields as $field ) $leads[$model->id][$field] = $attributes[$field];
                //foreach( $selectedCustomFields as $field ) $leads[$id][$field] = null;

                /*if ( !empty( $item['field_name'] ) && in_array($item['field_name'], $selectedCustomFields) ) {
                    $leads[$id][$item['field_name']] = $item['field_value'];
                }*/
            }

            if ( empty( $leads ) ) {
                $warning = 'В базе данных не найдено ни одного подписчики по запрошенным вами параметрам.';
                $this->redirect(['export']);
                Yii::$app->session->setFlash( 'alert', [
                    'body'    => $errors,
                    'options' => ['class' => 'alert alert-danger']
                ] );
            } else {

                $filename = 'leads-' . date('Y-m-d-H-i-s') . '.csv';

                header("Content-Type: text/csv");
                header("Content-Disposition: attachment; filename=" . $filename);
                header("Cache-Control: no-cache, no-store, must-revalidate");
                header("Pragma: no-cache");
                header("Expires: 0");

                $output = fopen("php://output", "w");
                foreach( $leads as $row ) {
                    fputcsv($output, $row, $delimiter);
                }
                fclose($output);

                exit;
            }

        } else {
            $this->redirect(['export']);
            Yii::$app->session->setFlash( 'alert', [
                'body'    => $errors,
                'options' => ['class' => 'alert alert-danger']
            ]);
        }

    }

    /**
     * Finds the Leads model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param string $id
     *
     * @return Leads the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel( $id )
    {
        if (( $model = Leads::findOne( $id ) ) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException( 'The requested page does not exist.' );
        }
    }
}
