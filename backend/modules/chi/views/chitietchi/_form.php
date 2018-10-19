<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\chi\models\Chitietchi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="chitietchi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'items_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, 'money')->textInput() ?>

    <?= $form->field($model, 'motorbike')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sea_control')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'accounting_id')->textInput() ?>

    <?= $form->field($model, 'employee_id')->textInput() ?>

    <?= $form->field($model, 'expenditure_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
