<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\select2\Select2;
use kartik\checkbox\CheckboxX;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model backend\modules\sanpham\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form','enableAjaxValidation' => true]); ?>

    <?= $form->field($model, 'cusName',['options' => ['class' => 'col-md-4']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_sales',['options' => ['class' => 'col-md-3']])->widget(Select2::classname(), [
        'data' => $dataEmployee,
        'language' => 'en',
        'options' => ['placeholder' => 'Select a state ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
     ?>

    <?= $form->field($model, 'date',['options' => ['class' => 'col-md-3']])->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Enter birth date ...'],
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'dd-mm-yyyy'
        ]
    ]);?>

    <?= $form->field($model, 'status',['options' => ['class' => 'money_class col-md-2']])->widget(CheckboxX::classname(),
        [
            'initInputType' => CheckboxX::INPUT_CHECKBOX,
            'options'=>['value' => $model->status],
        ])->label(false);
    ?>
    <div class="clearfix"></div>

    <div class="row">
        <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Addresses</h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsOrderDetail[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'pro_id',
                    'quantity',
                    'price_sales',
                    'bill_number',
                    'note',
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($modelsOrderDetail as $i => $modelOrderDetail): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Address</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelOrderDetail->isNewRecord) {
                                echo Html::activeHiddenInput($modelOrderDetail, "[{$i}]id");
                            }
                        ?>
                        <div class="row">
                            <div class="col-sm-7">
                                <?=
                                 $form->field($modelOrderDetail, "[{$i}]pro_id")->widget(Select2::classname(), [
                                            'data' => $dataProduct,
                                            'language' => 'en',
                                            'options' => ['placeholder' => 'Pilih Kelas'],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]);
                                ?>
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($modelOrderDetail, "[{$i}]quantity")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelOrderDetail, "[{$i}]price_sales")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelOrderDetail, "[{$i}]bill_number")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-9">
                                <?= $form->field($modelOrderDetail, "[{$i}]note")->textInput(['maxlength' => true]) ?>
                            </div>
                        </div><!-- .row -->
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
