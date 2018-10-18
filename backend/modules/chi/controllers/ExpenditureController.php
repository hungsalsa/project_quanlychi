<?php

namespace backend\modules\chi\controllers;

use Yii;
use backend\modules\chi\models\Expenditure;
use backend\modules\chi\models\ExpenditureItems;
use backend\modules\chi\models\Model;
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

    /**
     * Creates a new Expenditure model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Expenditure();
        $modelsExpenditureItem = [new ExpenditureItems];

        $model->created_at = time();
        $model->updated_at = time();
        $model->user_add = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post())) {
            // kiểm tra và trả về ngày lưu data
            if(!empty($_POST['Expenditure']['day'])){
                 $date = date('Y-m-d',strtotime($_POST['Expenditure']['day']));
                $model->day = $date;
            }





            $modelsExpenditureItem = Model::createMultiple(ExpenditureItems::classname());
            Model::loadMultiple($modelsExpenditureItem, Yii::$app->request->post());

            // ajax validation
            // if (Yii::$app->request->isAjax) {
            //     Yii::$app->response->format = Response::FORMAT_JSON;
            //     return ArrayHelper::merge(
            //         ActiveForm::validateMultiple($modelsExpenditureItem),
            //         ActiveForm::validate($modelCustomer)
            //     );
            // }

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsExpenditureItem) && $valid;
            
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsExpenditureItem as $modelExpenditureItem) 
                        {
                            $modelExpenditureItem->expenditure_id = $model->id;
                            if (! ($flag = $modelExpenditureItem->save(false))) {
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
             $model->save();
            // return $this->redirect(['view', 'id' => $model->id]);
        }
        else{

            return $this->render('create', [
                'model' => $model,
                'modelsExpenditureItem' => (empty($modelsExpenditureItem)) ? [new ExpenditureItems] : $modelsExpenditureItem
            ]);
        }
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


        $modelsExpenditureItem = $model->expenditureItems;

        $model->updated_at = time();
        $model->user_add = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            if(!empty($_POST['Expenditure']['day'])){
                 $date = date('Y-m-d',strtotime($_POST['Expenditure']['day']));
                $model->day = $date;
            }

            if($_POST['Expenditure']['total_money'] != ''){
                $model->total_money = (int)str_replace(',','',$_POST['Expenditure']['total_money']);
            }
            echo $model->day = date("Y-m-d", strtotime($_POST['Expenditure']['day']));


            $oldIDs = ArrayHelper::map($modelsExpenditureItem, 'id', 'id');
            $modelsExpenditureItem = Model::createMultiple(ExpenditureItems::classname(), $modelsExpenditureItem);
            Model::loadMultiple($modelsExpenditureItem, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsExpenditureItem, 'id', 'id')));

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsExpenditureItem),
                    ActiveForm::validate($model)
                );
            }

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsExpenditureItem) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (! empty($deletedIDs)) {
                            ExpenditureItems::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsExpenditureItem as $modelExpenditureItem) {
                            $modelExpenditureItem->expenditure_id = $model->id;
                            if (! ($flag = $modelExpenditureItem->save(false))) {
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
        else {
            return $this->render('update', [
                'model' => $model,
                'modelsExpenditureItem' => (empty($modelsExpenditureItem)) ? [new ExpenditureItems] : $modelsExpenditureItem,
                'dataEmployee'=>$dataEmployee,
                'dataCost'=>$dataCost,
            ]);
        }
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
