<?php

namespace backend\modules\phieu\controllers;

use Yii;
use backend\modules\phieu\models\PhieuSudung;
use backend\modules\phieu\models\PhieuSophieu;
use backend\modules\phieu\models\PhieuTon;
use backend\modules\chi\models\Employee;
use backend\modules\chi\models\Model;
use backend\modules\phieu\models\PhieuSudungSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
/**
 * PhieusudungController implements the CRUD actions for PhieuSudung model.
 */
class PhieusudungController extends Controller
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
     * Lists all PhieuSudung models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PhieuSudungSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PhieuSudung model.
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
     * Creates a new PhieuSudung model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PhieuSudung();
        $model->scenario = 'createnew';

        $phieu = new PhieuSophieu();
        $sophieu =$phieu->getAllPhieu();
        if(empty($sophieu)){
            $sophieu = array();
        }

        $employee = new Employee();
        $dataEmployee = $employee->getAllEmployee();
        if(empty($dataEmployee)){
            $dataEmployee=array();
        }

        $model->status = true;
        $model->created_at = time();
        $model->updated_at = time();
        $model->user_create = Yii::$app->user->id;

        // $phieu11 = $phieu->checkPhieuSD(120);
        // echo '<pre>';
        // print_r($phieu11);die;

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }

        $modelsPhieuTon = [new PhieuTon];

        if ($model->load($post = Yii::$app->request->post()) ) {
            $post = $post['PhieuSudung'];
            
            $date = date('Y-m-d',strtotime($post['ngay_sd']));
            $model->ngay_sd = $date;
            // update ngay su dung phiếu
            if ($post['phieu_huy'] !='') {
                $model->phieu_huy = json_encode($post['phieu_huy']);
            }

            /*===========START dynamic ===================*/

            $modelsPhieuTon = Model::createMultiple(PhieuTon::classname());
            Model::loadMultiple($modelsPhieuTon, Yii::$app->request->post());

            // ajax validation
            // if (Yii::$app->request->isAjax) {
            //     Yii::$app->response->format = Response::FORMAT_JSON;
            //     return ArrayHelper::merge(
            //         ActiveForm::validateMultiple($modelsPhieuTon),
            //         ActiveForm::validate($model)
            //     );
            // }

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsPhieuTon) && $valid;
            
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsPhieuTon as $modelPhieuTon) {
                            $modelPhieuTon->ngay_sd = $model->ngay_sd;
                            if (! ($flag = $modelPhieuTon->save(false))) {
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
            /*===========END dynamic ===================*/

            if($model->save()){
                PhieuSophieu::updatePhieu($date,$post['so_phieu_dau'],$post['so_phieu_cuoi']);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'sophieu' => $sophieu,
            'dataEmployee' => $dataEmployee,
            'modelsPhieuTon' => (empty($modelsPhieuTon)) ? [new PhieuTon] : $modelsPhieuTon
        ]);
    }

    /**
     * Updates an existing PhieuSudung model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'update';

        $phieu = new PhieuSophieu();
        $sophieu =$phieu->getAllPhieu();
        if(empty($sophieu)){
            $sophieu = array();
        }

        $employee = new Employee();
        $dataEmployee = $employee->getAllEmployee();
        if(empty($dataEmployee)){
            $dataEmployee=array();
        }

        if ($model->phieu_huy !='') {
            $model->phieu_huy = json_decode($model->phieu_huy);
        }

        $model->updated_at = time();
        $model->user_create = Yii::$app->user->id;

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }

        $modelsPhieuTon = $model->phieuTons;

        if ($model->load($post = Yii::$app->request->post())) {
            $post = $post['PhieuSudung'];

            // chuyen doi ngay
            $date = date('Y-m-d',strtotime($post['ngay_sd']));
            $model->ngay_sd = $date;
            // update ngay su dung phiếu
            $model->phieu_huy = json_encode($post['phieu_huy']);
/*==================================================================================================*/            
            $oldIDs = ArrayHelper::map($modelsPhieuTon, 'id', 'id');
            $modelsPhieuTon = Model::createMultiple(PhieuTon::classname(), $modelsPhieuTon);
            Model::loadMultiple($modelsPhieuTon, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsPhieuTon, 'id', 'id')));

            // ajax validation
            // if (Yii::$app->request->isAjax) {
            //     Yii::$app->response->format = Response::FORMAT_JSON;
            //     return ArrayHelper::merge(
            //         ActiveForm::validateMultiple($modelsPhieuTon),
            //         ActiveForm::validate($model)
            //     );
            // }

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsPhieuTon) && $valid;
            // PhieuSophieu::updatePhieu($date,$post['so_phieu_dau'],$post['so_phieu_cuoi']);
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (! empty($deletedIDs)) {
                            PhieuTon::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsPhieuTon as $modelPhieuTon) {
                            $modelPhieuTon->ngay_sd = $model->id;
                            $modelPhieuTon->status = true;
// echo '<pre>';print_r($_POST);
// print_r($modelPhieuTon);
// die;
                            if (! ($flag = $modelPhieuTon->save(false))) {
                                $transaction->rollBack();
                                break;
                            }else{
                                var_dump($modelPhieuTon->errors);echo 'sadada';
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

        
           // if($model->save()){

           //      return $this->redirect(['view', 'id' => $model->id]);
           //  }
/*==================================================================================================*/
        }else{
// echo '<pre>';print_r($modelsPhieuTon);die;
        return $this->render('update', [
            'model' => $model,
            'sophieu' => $sophieu,
            'dataEmployee' => $dataEmployee,
            'modelsPhieuTon' => (empty($modelsPhieuTon)) ? [new PhieuTon] : $modelsPhieuTon
        ]);
    }
    }

    /**
     * Deletes an existing PhieuSudung model.
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
     * Finds the PhieuSudung model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PhieuSudung the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PhieuSudung::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
