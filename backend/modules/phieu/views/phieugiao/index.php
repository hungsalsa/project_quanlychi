<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\phieu\models\PhieuGiaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Phieu Giaos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phieu-giao-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Phieu Giao', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'ngay_giao',
            'sophieu_dau',
            'sophieu_cuoi',
            'nguoi_giao',
            //'nguoi_nhan',
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Phiếu thiếu',
                'headerOptions' => ['class' => 'text-center','style'=>'width:10%'],
                'contentOptions' => ['class' => 'text-center'],
                'template' => '{my_button}', 
                'buttons' => [
                    'my_button' => function ($url, $model, $key) {
                        return Html::a('Thiếu phiếu', ['phieuthieu/indext', 'id'=>$model->id], ['title' => 'Phiếu thiếu', 'target' => '_blank', 'data' => ['pjax' => 0]] );
                    },
                ],
            ],
            //'note:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
