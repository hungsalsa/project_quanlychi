<?php

namespace backend\modules\sanpham\controllers;

use Yii;
use backend\modules\sanpham\models\Order;
use backend\modules\sanpham\models\OrderDetail;
use backend\modules\sanpham\models\Model;
use backend\modules\sanpham\models\Motorbike;
use backend\modules\sanpham\models\Manufacture;
use backend\modules\chi\models\Employee;
use backend\modules\sanpham\models\Product;
use backend\modules\sanpham\models\OrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Response;
use yii\widgets\ActiveForm;
/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
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
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
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
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();

        $employee = new Employee();
        $dataEmployee = $employee->getAllEmployee();
        if(empty($dataEmployee)){
            $dataEmployee=array();
        }

        /*==================================*/
        $motor = new Motorbike();
        $dataMotor = $motor->getAllMotorbike();
        if(empty($dataMotor)){
            $dataMotor = array();
        }

        $manufacture = new Manufacture();
        $dataManu = $manufacture->getAllManufacture();
        if(empty($dataManu)){
            $dataManu = array();
        }

        $product = new Product();
        $dataPro = $product->getAllProduct();
        if(empty($dataPro)){
            $dataPro=array();
        }

        $dataProduct = array();
        foreach ($dataPro as $value) {
            $dataProduct[$value['idPro']] = $value['idPro']. ' - '.$value['proName']. ' - '.$dataMotor[$value['bike_id']]. ' - '.$dataManu[$value['manu_id']];
        }

        // echo '<pre>';print_r($dataProduct);
        // die;
/*==================================*/
        $model->status = true;
        $model->created_at = time();
        $model->updated_at = time();
        $model->user_add = Yii::$app->user->id;

        $modelsOrderDetail = [new OrderDetail];

        $modelsOrderDetail = Model::createMultiple(OrderDetail::classname());
            Model::loadMultiple($modelsOrderDetail, Yii::$app->request->post());
            
  //       if (Yii::$app->request->isAjax)
  // {
  //     Yii::$app->response->format = Response::FORMAT_JSON;
  //     return ActiveForm::validate($modelsOrderDetail);

  // }elseif
        if ($model->load(Yii::$app->request->post())) {
            $date = date('Y-m-d',strtotime($_POST['Order']['date']));
            $model->date = $date;

            $modelsOrderDetail = Model::createMultiple(OrderDetail::classname());
            Model::loadMultiple($modelsOrderDetail, Yii::$app->request->post());

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsOrderDetail),
                    ActiveForm::validate($model)
                );
            }

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsOrderDetail) && $valid;
            
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsOrderDetail as $modelOrderDetail) {
                            $modelOrderDetail->order_id = $model->idOrder;
                            if (! ($flag = $modelOrderDetail->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->idOrder]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }

            // return $this->redirect(['view', 'id' => $model->idOrder]);
        }

        return $this->render('create', [
            'model' => $model,
            'modelsOrderDetail' => (empty($modelsOrderDetail)) ? [new OrderDetail] : $modelsOrderDetail,
            'dataEmployee'=>$dataEmployee,
            'dataProduct'=>$dataProduct,
        ]);
    }

    /**
     * Updates an existing Order model.
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

        /*==================================*/
        $motor = new Motorbike();
        $dataMotor = $motor->getAllMotorbike();
        if(empty($dataMotor)){
            $dataMotor = array();
        }

        $manufacture = new Manufacture();
        $dataManu = $manufacture->getAllManufacture();
        if(empty($dataManu)){
            $dataManu = array();
        }

        $product = new Product();
        $dataPro = $product->getAllProduct();
        if(empty($dataPro)){
            $dataPro=array();
        }

        $dataProduct = array();
        foreach ($dataPro as $value) {
            $dataProduct[$value['idPro']] = $value['idPro']. ' - '.$value['proName']. ' - '.$dataMotor[$value['bike_id']]. ' - '.$dataManu[$value['manu_id']];
        }

/*==================================*/
        $model->status = true;
        $model->created_at = time();
        $model->updated_at = time();
        $model->user_add = Yii::$app->user->id;

        $model->updated_at = time();
        $model->user_add = Yii::$app->user->id;

        $modelsOrderDetail = $model->orderDetails;

        // So luong cu chua cap nhat
        $updateQuanold = array();
        foreach ($modelsOrderDetail as $value) {
            $updateQuanold[] = array(
                'pro_id'=>$value->pro_id,
                'quantity'=>$value->quantity,
            );
        }

        // $modelsOrderDetail = Model::createMultiple(OrderDetail::classname(), $modelsOrderDetail);
        // echo '<pre>';print_r($updateQuanold);
        // die;
// if (Yii::$app->request->isAjax)
//   {
//       Yii::$app->response->format = Response::FORMAT_JSON;
//       return ActiveForm::validate($modelsOrderDetail);

//   } elseif
         if($model->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($modelsOrderDetail, 'id', 'id');
            $modelsOrderDetail = Model::createMultiple(OrderDetail::classname(), $modelsOrderDetail);
            Model::loadMultiple($modelsOrderDetail, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsOrderDetail, 'id', 'id')));

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsOrderDetail),
                    ActiveForm::validate($model)
                );
            }
            echo '<pre>';
            foreach ($modelsOrderDetail as $value) {
                // print_r($value);
                print_r($product->updateProQuantity($value->pro_id,10));
                // echo 'pro_id'. $value->pro_id.'<br/>';
                // echo 'price_sales'. $value->price_sales.'<br/>';
            }
            
die;
            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsOrderDetail) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (! empty($deletedIDs)) {
                            OrderDetail::deleteAll(['id' => $deletedIDs]);
                        }
                        // echo '<pre>';
                        foreach ($modelsOrderDetail as $modelOrderDetail) { 
                            $modelOrderDetail->order_id = $model->idOrder;
                            // $model->quantity = $model->quantity - (int)$modelOrderDetail->quantity;
                            if (! ($flag = $modelOrderDetail->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->idOrder]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }



            // return $this->redirect(['view', 'id' => $model->idOrder]);
        }

        return $this->render('update', [
            'model' => $model,
            'modelsOrderDetail' => (empty($modelsOrderDetail)) ? [new OrderDetail] : $modelsOrderDetail,
            'dataEmployee'=>$dataEmployee,
            'dataProduct'=>$dataProduct,
        ]);
    }

    /**
     * Deletes an existing Order model.
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
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
