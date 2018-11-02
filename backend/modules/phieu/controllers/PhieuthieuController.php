<?php

namespace backend\modules\phieu\controllers;

use Yii;
use backend\modules\phieu\models\PhieuThieu;
use backend\modules\phieu\models\PhieuGiao;
use backend\modules\phieu\models\PhieuSophieu;
use backend\modules\phieu\models\PhieuThieuSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\bootstrap\ActiveForm;
/**
 * PhieuthieuController implements the CRUD actions for PhieuThieu model.
 */
class PhieuthieuController extends Controller
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
     * Lists all PhieuThieu models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PhieuThieuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    

    /**
     * Displays a single PhieuThieu model.
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
     * Creates a new PhieuThieu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    
    public function actionCreate()
    {
        $model = new PhieuThieu();

        $model->status = true;

        $phieugiao = new PhieuGiao();
        $daygiao =$phieugiao->getAllDatePhieu();
        if(empty($daygiao)){
            $daygiao = array();
        }

        $phieu = new PhieuSophieu();
        $sophieu =$phieu->getAllPhieu();
        if(empty($sophieu)){
            $sophieu = array();
        }

        // echo '<pre>';echo $phieu->checkphieu('2018-10-26',110);die;

        // $phieu = new PhieuSophieu();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }

        if ($model->load($post = Yii::$app->request->post())) {
            // Xoa phieu vua tao trong bang phieu
            // $phieu->xoaphieu($post['PhieuThieu']['ngay_giao'],$post['PhieuThieu']['so_phieu']);
            
            if($model->save() && $phieu->xoaphieu($post['PhieuThieu']['ngay_giao'],$post['PhieuThieu']['so_phieu'])){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'daygiao' => $daygiao,
            'sophieu' => $sophieu,
        ]);
    }

    /**
     * Updates an existing PhieuThieu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $phieugiao = new PhieuGiao();
        $daygiao =$phieugiao->getAllDatePhieu();
        if(empty($daygiao)){
            $daygiao = array();
        }

        $phieu = new PhieuSophieu();
        $sophieu =$phieu->getAllPhieu();
        
        // echo '<pre>';print_r($sophieu);die;
        $so_phieu_cu = $model->so_phieu;
        $ngay_giao_cu = $model->ngay_giao;

        $sophieu[$so_phieu_cu] = $so_phieu_cu;
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }

        if ($model->load($post = Yii::$app->request->post())) {
            // Cap nhat lai so phieu da xoa truoc do trong bang phieu
            $phieuLuu = new PhieuSophieu();
            $phieuLuu->ngay_giao = $ngay_giao_cu;
            $phieuLuu->so_phieu = $so_phieu_cu;
            $phieuLuu->save();
            // Xoa phieu vua tao trong bang phieu

            if($model->save() && $phieu->xoaphieu($post['PhieuThieu']['ngay_giao'],$post['PhieuThieu']['so_phieu'])){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'daygiao' => $daygiao,
            'sophieu' => $sophieu,
        ]);
    }

    /**
     * Deletes an existing PhieuThieu model.
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
     * Finds the PhieuThieu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PhieuThieu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PhieuThieu::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
