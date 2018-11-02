<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\doanhthu\models\DoanhThuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Doanh Thus';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doanh-thu-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Doanh Thu', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'ngay',
            'giao_sang',
            'tt_ck',
            'tt_the',
            //'tt_tien_mat',
            //'tong_doanh_thu_phieu',
            //'doanh_thu_thuc',
            //'thu_khac',
            //'tien_chi',
            //'tien_hom',
            //'tien_le',
            //'chenh_lech',
            //'ketoan',
            //'nguoi_ky',
            //'note:ntext',
            //'cua_hang',
            //'status',
            //'created_at',
            //'updated_at',
            //'user_add',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
