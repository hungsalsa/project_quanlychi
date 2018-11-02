<?php

namespace backend\modules\chi\controllers;

use Yii;
use backend\modules\chi\models\Chingay;
use backend\modules\chi\models\ChingaySearch;
use backend\modules\chi\models\Chitietchi;
use backend\modules\chi\models\Employee;
use backend\modules\chi\models\CostType;
use backend\modules\chi\models\Model;
use backend\modules\sanpham\models\Motorbike;
use backend\modules\doanhthu\models\CuaHang;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
/**
 * ChingayController implements the CRUD actions for Chingay model.
 */
class ChingayController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        // 'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback'=> function ($rule ,$action)
                        {
                            $control = Yii::$app->controller->id;
                            $action = Yii::$app->controller->action->id;
                            $module = Yii::$app->controller->module->id;

                            $role = $module.'/'.$control.'/'.$action;
                            if (Yii::$app->user->can($role)) {
                                return true;
                            }
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Lists all Chingay models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ChingaySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDanhsach()
    {
        $chi = new Chingay();
        $dataChi = $chi->getAllChi();
        if(empty($dataChi)){
            $dataChi=array();
        }

        // echo '<pre>';
        // print_r($dataChi);
        return $this->render('danhsach', [
            'dataChi' => $dataChi,
        ]);
    }

    /**
     * Displays a single Chingay model.
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
     * Creates a new Chingay model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Chingay();

        $employee = new Employee();
        $dataEmployee = $employee->getAllEmployee();
        if(empty($dataEmployee)){
            $dataEmployee=array();
        }

        $motor = new Motorbike();
        $dataMotor = $motor->getAllMotorbike();
        if(empty($dataMotor)){
            $dataMotor=array();
        }

        $cost_type = new CostType();
        $dataCost = $cost_type->getAllCosttype();
        if(empty($dataCost)){
            $dataCost=array();
        }

        $cuahang = new CuaHang();
        $dataCuahang = $cuahang->getAllCuahang();
        if(empty($dataCuahang)){
            $dataCuahang = array();
        }


        $model->status = true;
        $model->created_at = time();
        $model->updated_at = time();
        $model->user_add = Yii::$app->user->id;

        $modelsChitietchi = [new Chitietchi];

        // Lặp các khoản chi và cộng tổng
        if($tien = Yii::$app->request->post()){
            $total = 0;
            foreach ($tien['Chitietchi'] as $value) {
                $total+= (int)str_replace(',','',$value['money']);
            }
            $model->total_money =  $total;
            
        }

        if ($model->load(Yii::$app->request->post())) 
        {
            $date = date('Y-m-d',strtotime($_POST['Chingay']['day']));
            $model->day = $date;

            // if($_POST['Chingay']['total_money'] != ''){
            //     $model->total_money = (int)str_replace(',','',$_POST['Chingay']['total_money']);
            // }

            $modelsChitietchi = Model::createMultiple(Chitietchi::classname());
            Model::loadMultiple($modelsChitietchi, Yii::$app->request->post());

            // ajax validation
            // if (Yii::$app->request->isAjax) 
            // {
            //     Yii::$app->response->format = Response::FORMAT_JSON;
            //     return ArrayHelper::merge(
            //         ActiveForm::validateMultiple($modelsChitietchi),
            //         ActiveForm::validate($model)
            //     );
            // }

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsChitietchi) && $valid;
            
            if ($valid) 
            {
                $transaction = \Yii::$app->db->beginTransaction();
                try 
                {
                    if ($flag = $model->save(false)) 
                    {
                        foreach ($modelsChitietchi as $modelChitietchi) 
                        {
                            $modelChitietchi->expenditure_id = $model->id;
                            if (! ($flag = $modelChitietchi->save(false))) 
                            {
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
                'modelsChitietchi' => (empty($modelsChitietchi)) ? [new Chitietchi] : $modelsChitietchi,
                'dataEmployee'=>$dataEmployee,
                'dataCost'=>$dataCost,
                'dataMotor'=>$dataMotor,
                'dataCuahang'=>$dataCuahang,
            ]);
        
    }

    /**
     * Updates an existing Chingay model.
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

        $motor = new Motorbike();
        $dataMotor = $motor->getAllMotorbike();
        if(empty($dataMotor)){
            $dataMotor=array();
        }

        $cost_type = new CostType();
        $dataCost = $cost_type->getAllCosttype();
        if(empty($dataCost)){
            $dataCost=array();
        }

        $cuahang = new CuaHang();
        $dataCuahang = $cuahang->getAllCuahang();
        if(empty($dataCuahang)){
            $dataCuahang = array();
        }

        $modelsChitietchi = $model->chitietchi;

        if($tien = Yii::$app->request->post()){
            $total = 0;
            foreach ($tien['Chitietchi'] as $value) {
                $total+= (int)str_replace(',','',$value['money']);
            }
            $model->total_money =  $total;
            
        }

        if ($model->load(Yii::$app->request->post())) {

            

            if(!empty($_POST['Chingay']['day'])){
                 $date = date('Y-m-d',strtotime($_POST['Chingay']['day']));
                $model->day = $date;
            }
            // if($_POST['Chingay']['total_money'] != ''){
            //     $model->total_money = (int)str_replace(',','',$_POST['Chingay']['total_money']);
            // }

           

            $oldIDs = ArrayHelper::map($modelsChitietchi, 'id', 'id');
            $modelsChitietchi = Model::createMultiple(Chitietchi::classname(), $modelsChitietchi);
            Model::loadMultiple($modelsChitietchi, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsChitietchi, 'id', 'id')));

            // ajax validation
            // if (Yii::$app->request->isAjax) {
            //     Yii::$app->response->format = Response::FORMAT_JSON;
            //     return ArrayHelper::merge(
            //         ActiveForm::validateMultiple($modelsChitietchi),
            //         ActiveForm::validate($model)
            //     );
            // }

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsChitietchi) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (! empty($deletedIDs)) {
                            Chitietchi::deleteAll(['id' => $deletedIDs]);
                        }
                        $total_tien =0;
                        foreach ($modelsChitietchi as $modelChitietchi) {
                            $modelChitietchi->expenditure_id = $model->id;
                            $modelChitietchi->money = str_replace(',','',$modelChitietchi->money);
                            if (! ($flag = $modelChitietchi->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag ) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
            // $model->save();
            // return $this->redirect(['view', 'id' => $model->id]);
        }
        else{
            return $this->render('update', [
                'model' => $model,
                'modelsChitietchi' => (empty($modelsChitietchi)) ? [new Chitietchi] : $modelsChitietchi,
                'dataEmployee'=>$dataEmployee,
                'dataCost'=>$dataCost,
                'dataMotor'=>$dataMotor,
                'dataCuahang'=>$dataCuahang,
            ]);
        }
    }

    /**
     * Deletes an existing Chingay model.
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
     * Finds the Chingay model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Chingay the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Chingay::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionValidation() {
        $model = new Chingay();
       if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }
    }
}
