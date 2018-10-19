<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\chi\models\Expenditure */

$this->title = 'Cập nhật: '.$model->day;
$this->params['breadcrumbs'][] = ['label' => 'Expenditures', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="expenditure-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsExpenditureItem' => $modelsExpenditureItem,
        'dataEmployee'=>$dataEmployee,
        'dataCost'=>$dataCost,
    ]) ?>

</div>
