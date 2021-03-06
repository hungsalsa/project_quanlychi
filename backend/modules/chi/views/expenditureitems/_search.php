<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\chi\models\ExpenditureItemsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="expenditure-items-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'items_name') ?>

    <?= $form->field($model, 'quantity') ?>

    <?= $form->field($model, 'money') ?>

    <?php // echo $form->field($model, 'motorbike') ?>

    <?php // echo $form->field($model, 'sea_control') ?>

    <?php // echo $form->field($model, 'accounting_id') ?>

    <?php // echo $form->field($model, 'employee_id') ?>

    <?php // echo $form->field($model, 'expenditure_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
