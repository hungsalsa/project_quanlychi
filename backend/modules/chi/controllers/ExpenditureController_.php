<?php

namespace backend\modules\chi\controllers;

use Yii;
use backend\modules\chi\models\Expenditure;
use backend\modules\chi\models\Employee;
use backend\modules\chi\models\Model;
use backend\modules\chi\models\CostType;
use backend\modules\chi\models\ExpenditureItems;
use backend\modules\chi\models\ExpenditureSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * ExpenditureController implements the CRUD actions for Expenditure model.
 */
class ExpenditureController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Expenditure models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ExpenditureSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Expenditure model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionChitiet()
    {
        $this->layout = 'detail';
        $model = new Expenditure();
        $data = $model->getallItem();

        // echo '<pre>';
        // print_r($data);die;

        return $this->render('chitiet',[
            'data'=>$data
        ]);
    }

    /**
     * Creates a new Expenditure model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Expenditure();

        $employee = new Employee();
        $dataEmployee = $employee->getAllEmployee();
        if(empty($dataEmployee)){
            $dataEmployee=array();
        }

        $cost_type = new CostType();
        $dataCost = $cost_type->getAllCosttype();
        if(empty($dataCost)){
            $dataCost=array();
        }

        // print_r($dataEmployee);die;

        $modelsExpenditureItems = [new ExpenditureItems];

        $model->created_at = time();
        $model->updated_at = time();
        $model->user_add = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            if($_POST['Expenditure']['day'] != ''){
                $model->day = date("Y-m-d", strtotime($_POST['Expenditure']['day']));
            }
            if($_POST['Expenditure']['total_money'] != ''){
                // echo $_POST['Expenditure']['total_money']; die;
                $model->total_money = (int)str_replace(',','',$_POST['Expenditure']['total_money']);
            }

            $modelsExpenditureItems = Model::createMultiple(ExpenditureItems::classname());
            Model::loadMultiple($modelsExpenditureItems, Yii::$app->request->post());

            // ajax validation
            // if (Yii::$app->request->isAjax) {
            //     Yii::$app->response->format = Response::FORMAT_JSON;
            //     return ArrayHelper::merge(
            //         ActiveForm::validateMultiple($modelsExpenditureItems),
            //         ActiveForm::validate($modelCustomer)
            //     );
            // }

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsExpenditureItems) && $valid;
            
            $model->total_money = 1000;
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        $total = 0;
                        foreach ($modelsExpenditureItems as $modelExpenditureItems) {
                            $total = $total + $modelExpenditureItems->money;
                            $modelExpenditureItems->expenditure_id = $model->id;
                            if (! ($flag = $modelExpenditureItems->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }

            // return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'dataCost' => $dataCost,
            'dataEmployee' => $dataEmployee,
            'modelsExpenditureItems' => (empty($modelsExpenditureItems)) ? [new ExpenditureItems] : $modelsExpenditureItems
        ]);
    }

    /**
     * Updates an existing Expenditure model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        // echo '<pre>';print_r($model);die;
        $modelsExpenditureItems = $model->expenditureItems;

        // $modelCustomer = $this->findModel($id);
        // $modelsAddress = $modelCustomer->addresses;

        $employee = new Employee();
        $dataEmployee = $employee->getAllEmployee();
        if(empty($dataEmployee)){
            $dataEmployee=array();
        }

        $cost_type = new CostType();
        $dataCost = $cost_type->getAllCosttype();
        if(empty($dataCost)){
            $dataCost=array();
        }

        // $modelsExpenditureItems = [new ExpenditureItems];

        $model->updated_at = time();
        $model->user_add = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            if($_POST['Expenditure']['total_money'] != ''){
                // echo $_POST['Expenditure']['total_money']; die;
                $model->total_money = (int)str_replace(',','',$_POST['Expenditure']['total_money']);
            }
            if($_POST['Expenditure']['day'] != ''){
                // echo date_format($_POST['Expenditure']['day'], 'Y-M-d');die;
                 $model->day = date("Y-m-d", strtotime($_POST['Expenditure']['day']));
            }
            $oldIDs = ArrayHelper::map($modelsExpenditureItems, 'id', 'id');
            $modelsExpenditureItems = Model::createMultiple(ExpenditureItems::classname(), $modelsExpenditureItems);
            Model::loadMultiple($modelsExpenditureItems, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsExpenditureItems, 'id', 'id')));

            // ajax validation
            // if (Yii::$app->request->isAjax) {
            //     Yii::$app->response->format = Response::FORMAT_JSON;
            //     return ArrayHelper::merge(
            //         ActiveForm::validateMultiple($modelsExpenditureItems),
            //         ActiveForm::validate($modelCustomer)
            //     );
            // }

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsExpenditureItems) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (! empty($deletedIDs)) {
                            ExpenditureItems::deleteAll(['id' => $deletedIDs]);
                        }
                        // $model->total_money=0;
                        foreach ($modelsExpenditureItems as $modelExpenditureItems) {
                            $modelExpenditureItems->expenditure_id = $model->id;

                            if (! ($flag = $modelExpenditureItems->save(false))) {
 
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }

            }

            /*=================================*/

        }

        // if(!$model->validate()){
            
        // }

        return $this->render('update', [
            'model' => $model,
            'dataCost' => $dataCost,
            'dataEmployee' => $dataEmployee,
            'modelsExpenditureItems' => (empty($modelsExpenditureItems)) ? [new ExpenditureItems] : $modelsExpenditureItems
        ]);
    }

    /**
     * Deletes an existing Expenditure model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Expenditure model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Expenditure the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Expenditure::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
