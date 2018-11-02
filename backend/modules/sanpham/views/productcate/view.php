<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\sanpham\models\ProductCate */

$this->title = $model->idCate;
$this->params['breadcrumbs'][] = ['label' => 'Product Cates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-cate-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idCate], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idCate], [
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
            'idCate',
            'cateName',
            'note:ntext',
            'status',
            'created_at',
            'updated_at',
            'user_add',
        ],
    ]) ?>

</div>
