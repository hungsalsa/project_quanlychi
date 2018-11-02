<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\doanhthu\models\DoanhThu */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Doanh Thus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doanh-thu-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Danh sách', ['index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'ngay',
            'giao_sang',
            'tt_ck',
            'tt_the',
            'tt_tien_mat',
            'tong_doanh_thu_phieu',
            'doanh_thu_thuc',
            'thu_khac',
            'tien_chi',
            'tien_hom',
            'tien_le',
            'chenh_lech',
            'ketoan',
            'nguoi_ky',
            'note:ntext',
            'cua_hang',
            'status',
            'created_at',
            'updated_at',
            'user_add',
        ],
    ]) ?>

</div>
