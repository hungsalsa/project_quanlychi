<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\sanpham\models\Order */

$this->title = 'Update Order: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idOrder, 'url' => ['view', 'id' => $model->idOrder]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="order-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsOrderDetail'=>$modelsOrderDetail,
        'dataEmployee'=>$dataEmployee,
        'dataProduct'=>$dataProduct,
    ]) ?>

</div>
