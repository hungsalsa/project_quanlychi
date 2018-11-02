<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\sanpham\models\ProductCate */

$this->title = 'Update Product Cate: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Product Cates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idCate, 'url' => ['view', 'id' => $model->idCate]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-cate-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
