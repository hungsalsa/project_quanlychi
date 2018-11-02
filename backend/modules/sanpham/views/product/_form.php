<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\checkbox\CheckboxX;
/* @var $this yii\web\View */
/* @var $model backend\modules\sanpham\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idPro',['options' => ['class' => 'col-md-4']])->textInput() ?>

    <?= $form->field($model, 'proName',['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status',['options' => ['class' => 'money_class col-md-2']])->widget(CheckboxX::classname(),
        [
            'initInputType' => CheckboxX::INPUT_CHECKBOX,
            'options'=>['value' => $model->status],
        ])->label(false);
    ?>
    <div class="clearfix"></div>
    <?= $form->field($model, 'quantity',['options' => ['class' => 'col-md-2']])->textInput() ?>

    <?= $form->field($model, 'price',['options' => ['class' => 'col-md-2']])->textInput(['maxlength' => true]) ?>

    
    
    <?= $form->field($model, 'unit',['options'=>['class'=>'col-md-2']])->widget(Select2::classname(), 
        [
            'data' => $dataUnit,
            'options' => ['placeholder' => 'Select a color ...'],
            'pluginOptions' => [
                'tags' => true,
                'tokenSeparators' => [',', ' '],
                'maximumInputLength' => 10
            ],
        ]) ?>
    <?= $form->field($model, 'cate_id',['options'=>['class'=>'col-md-3']])->widget(Select2::classname(), 
        [
            'data' => $dataCate,
            'options' => ['placeholder' => 'Select a color ...'],
            'pluginOptions' => [
                'tags' => true,
                'tokenSeparators' => [',', ' '],
                'maximumInputLength' => 10
            ],
        ]) 
    ?>

    <?= $form->field($model, 'bike_id',['options'=>['class'=>'col-md-3']])->widget(Select2::classname(), 
        [
            'data' => $dataMotor,
            'options' => ['placeholder' => 'Select a color ...'],
            'pluginOptions' => [
                'tags' => true,
                'tokenSeparators' => [',', ' '],
                'maximumInputLength' => 10
            ],
        ]) 
    ?>

    <?= $form->field($model, 'manu_id',['options'=>['class'=>'col-md-3']])->widget(Select2::classname(), 
        [
            'data' => $dataManu,
            'options' => ['placeholder' => 'Select a color ...'],
            'pluginOptions' => [
                'tags' => true,
                'tokenSeparators' => [',', ' '],
                'maximumInputLength' => 10
            ],
        ]) 
    ?>
    <div class="clearfix"></div>
    
    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
