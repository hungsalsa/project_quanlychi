<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\chi\models\Expenditure */

$this->title = 'Create Expenditure';
$this->params['breadcrumbs'][] = ['label' => 'Expenditures', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expenditure-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsExpenditureItem' => $modelsExpenditureItem,
        'dataEmployee'=>$dataEmployee,
        'dataCost'=>$dataCost,
    ]) ?>

</div>
