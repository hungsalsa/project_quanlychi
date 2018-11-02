<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\phieu\models\PhieuSudungSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Phieu Sudungs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phieu-sudung-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Phieu Sudung', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'so_phieu_dau',
            'so_phieu_cuoi',
            'ngay_sd',
            'phieu_huy',
            //'sl_phieu_tot',
            //'ke_toan',
            //'note:ntext',
            //'status',
            //'created_at',
            //'updated_at',
            //'user_create',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
