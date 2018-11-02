<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
// use kartik\checkbox\CheckboxX;

/* @var $this yii\web\View */
/* @var $model backend\modules\phieu\models\PhieuGiao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="phieu-giao-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ngay_giao',['options' => ['class' => 'col-md-4']])->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Enter birth date ...'],
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'dd-mm-yyyy'
        ]
    ]);?>

    <?= $form->field($model, 'sophieu_dau',['options' => ['class' => 'col-md-4']])->textInput() ?>

    <?= $form->field($model, 'sophieu_cuoi',['options' => ['class' => 'col-md-4']])->textInput() ?>

    <?= $form->field($model, "nguoi_giao",['options' => ['class' => 'col-md-4']])->widget(Select2::classname(), [
        'data' => $dataEmployee,
        'language' => 'en',
        'options' => ['placeholder' => 'Pilih Kelas'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
    <?= $form->field($model, "nguoi_nhan",['options' => ['class' => 'col-md-4']])->widget(Select2::classname(), [
        'data' => $dataEmployee,
        'language' => 'en',
        'options' => ['placeholder' => 'Pilih Kelas'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
