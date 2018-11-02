<?php

namespace backend\modules\doanhthu\controllers;

use Yii;
use backend\modules\doanhthu\models\DoanhThu;
use backend\modules\doanhthu\models\DoanhThuSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\doanhthu\models\CuaHang;
use backend\modules\chi\models\Employee;
use backend\modules\chi\models\Chingay;
/**
 * DoanhthuController implements the CRUD actions for DoanhThu model.
 */
class DoanhthuController extends Controller
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
     * Lists all DoanhThu models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DoanhThuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DoanhThu model.
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
     * Creates a new DoanhThu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DoanhThu();

        $cuahang = new CuaHang();
        $dataCuahang = $cuahang->getAllCuahang();
        if(empty($dataCuahang)){
            $dataCuahang = array();
        }

        $employee = new Employee();
        $dataEmployee = $employee->getAllEmployee();
        if(empty($dataEmployee)){
            $dataEmployee=array();
        }

        // $chi = new Chingay();
        //     echo $money_chi = $chi->getOneChingay('2018-11-01');die;

        $model->tien_le = 0;
        $model->tt_ck = 0;
        $model->tt_the = 0;
        $model->created_at = time();
        $model->updated_at = time();
        $model->status = true;
        $model->user_add = Yii::$app->user->id;

         if ($model->load($post = Yii::$app->request->post())) {
            $chi = new Chingay();
            $money_chi = $chi->getOneChingay(Yii::$app->formatter->asDate($post['DoanhThu']['ngay'], 'Y-M-d'));
            if(!$money_chi){
                $money_chi = 0;
            }
            $model->ngay = Yii::$app->formatter->asDate($post['DoanhThu']['ngay'], 'Y-M-d');
            $model->tien_chi = $money_chi;

            // Tong doanh thu theo phieu
            $doanhthu_ngay = $post['DoanhThu']['tt_ck'] + $post['DoanhThu']['tt_the'] + $post['DoanhThu']['tt_tien_mat'];
            // gan vao tong_doanh_thu_phieu
            $model ->tong_doanh_thu_phieu = $doanhthu_ngay;


            // Tiền mặt thực tế = tiền hòm + tiền lẻ
            $tien_mat_tt = $post['DoanhThu']['tien_hom'] + $post['DoanhThu']['tien_le'] ;

            // Khoan thu khac
            // Cộng tất cả các khoản thu khác, lặp tất cả các post
            $thu_khac = 0;

            // Chênh lệch tính theo tiền thừa hay thiếu, nếu tiền > tiền phiếu = thừa
            $model->chenh_lech = $tien_mat_tt + $money_chi - $post['DoanhThu']['giao_sang'] - $doanhthu_ngay;

            // Tính doanh thu thực //Tất cả đều trừ chênh lệch
            $model->doanh_thu_thuc = $doanhthu_ngay - abs($tien_mat_tt + $money_chi - $post['DoanhThu']['giao_sang'] - $doanhthu_ngay) + $thu_khac;

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'dataCuahang' => $dataCuahang,
            'dataEmployee' => $dataEmployee,
        ]);
    }

    /**
     * Updates an existing DoanhThu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $cuahang = new CuaHang();
        $dataCuahang = $cuahang->getAllCuahang();
        if(empty($dataCuahang)){
            $dataCuahang = array();
        }

        $employee = new Employee();
        $dataEmployee = $employee->getAllEmployee();
        if(empty($dataEmployee)){
            $dataEmployee=array();
        }

        $model->ngay = Yii::$app->formatter->asDate($model->ngay, 'd-M-Y');

        $model->updated_at = time();
        $model->user_add = Yii::$app->user->id;

        if ($model->load($post = Yii::$app->request->post())) {
            $chi = new Chingay();
            $money_chi = $chi->getOneChingay(Yii::$app->formatter->asDate($post['DoanhThu']['ngay'], 'Y-M-d'));
            if(!$money_chi){
                $money_chi = 0;
            }
            $model->ngay = Yii::$app->formatter->asDate($post['DoanhThu']['ngay'], 'Y-M-d');
            $model->tien_chi = $money_chi;

            // Tong doanh thu theo phieu
            $doanhthu_ngay = $post['DoanhThu']['tt_ck'] + $post['DoanhThu']['tt_the'] + $post['DoanhThu']['tt_tien_mat'];
            // gan vao tong_doanh_thu_phieu
            $model ->tong_doanh_thu_phieu = $doanhthu_ngay;


            // Tiền mặt thực tế = tiền hòm + tiền lẻ
            $tien_mat_tt = $post['DoanhThu']['tien_hom'] + $post['DoanhThu']['tien_le'] ;

            // Khoan thu khac
            // Cộng tất cả các khoản thu khác, lặp tất cả các post
            $thu_khac = 0;

            // Chênh lệch tính theo tiền thừa hay thiếu, nếu tiền > tiền phiếu = thừa
            $model->chenh_lech = $tien_mat_tt + $money_chi - $post['DoanhThu']['giao_sang'] - $doanhthu_ngay;

            // Tính doanh thu thực //Tất cả đều trừ chênh lệch
            $model->doanh_thu_thuc = $doanhthu_ngay - abs($tien_mat_tt + $money_chi - $post['DoanhThu']['giao_sang'] - $doanhthu_ngay) + $thu_khac;

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'dataCuahang' => $dataCuahang,
            'dataEmployee' => $dataEmployee,
        ]);
    }

    /**
     * Deletes an existing DoanhThu model.
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
     * Finds the DoanhThu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DoanhThu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DoanhThu::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
