<?php

namespace backend\modules\phieu\controllers;

use Yii;
use backend\modules\phieu\models\PhieuGiao;
use backend\modules\phieu\models\PhieuSophieu;
use backend\modules\phieu\models\PhieuGiaoSearch;
use backend\modules\chi\models\Employee;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PhieugiaoController implements the CRUD actions for PhieuGiao model.
 */
class PhieugiaoController extends Controller
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
     * Lists all PhieuGiao models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PhieuGiaoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PhieuGiao model.
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
     * Creates a new PhieuGiao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PhieuGiao();
        $phieu = new PhieuSophieu();

        $employee = new Employee();
        $dataEmployee = $employee->getAllEmployee();
        if(empty($dataEmployee)){
            $dataEmployee=array();
        }
        $phieu->status = true;
        if ($model->load($post = Yii::$app->request->post()) ) {

            $date = date('Y-m-d',strtotime($_POST['PhieuGiao']['ngay_giao']));
            $model->ngay_giao = $date;

            for ($i = $post['PhieuGiao']['sophieu_dau']; $i <= $post['PhieuGiao']['sophieu_cuoi']; $i++) {
                $phieu->so_phieu = $i;
                $phieu->save();
            }

            // echo '<pre>';
            // print_r($post);die;


            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'dataEmployee' => $dataEmployee,
        ]);
    }

    /**
     * Updates an existing PhieuGiao model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $phieu = new PhieuSophieu();

        // Xóa tất cả các phiếu có ngày giao = ngày giao cập nhật
        // $data = $phieu->XoaPhieu($model->ngay_giao);
        // $data2 = $phieu->getAll_byDate($model->ngay_giao);
        // $data2->deleteAll();

        $employee = new Employee();
        $dataEmployee = $employee->getAllEmployee();
        if(empty($dataEmployee)){
            $dataEmployee=array();
        }

        
        if ($model->load($post = Yii::$app->request->post())) {

            $ngay_giao = date('Y-m-d',strtotime($_POST['PhieuGiao']['ngay_giao']));
            $model->ngay_giao = $ngay_giao;
            
            $sophieu_dau =$post['PhieuGiao']['sophieu_dau'];
            $sophieu_cuoi =$post['PhieuGiao']['sophieu_cuoi'];

            $phieu_2 = $phieu->XoaPhieu_LuuPhieu($model->ngay_giao,$sophieu_dau,$sophieu_cuoi);
            // die;

            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'dataEmployee' => $dataEmployee,
        ]);
    }

    /**
     * Deletes an existing PhieuGiao model.
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
     * Finds the PhieuGiao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PhieuGiao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PhieuGiao::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
