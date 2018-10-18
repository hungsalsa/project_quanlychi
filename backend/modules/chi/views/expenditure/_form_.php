<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\checkbox\CheckboxX;
use kartik\select2\Select2;
use kartik\money\MaskMoney;
// use kartik\form\ActiveForm;
// use yii\bootstrap4\Modal;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model backend\modules\chi\models\Expenditure */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="expenditure-form">

    <?php $form = ActiveForm::begin([
        'id' => 'dynamic-form',
    ]); ?>

    <div class="form-group pull-right">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <?php
        // echo $form->field($model, 'day')->widget(Select2::classname(), [
        //     'data' => $dataCost,
        //     'options' => ['placeholder' => '-- Chọn loại chi --'],
        //     'pluginOptions' => [
        //         'tags' => true,
        //         'tokenSeparators' => [',', ' '],
        //         'maximumInputLength' => 10
        //     ],
        // ]) 
        ?>
        

    <?php // $form->field($model, 'day',['options' => ['class' => 'col-md-4']])->textInput() ?>
    <?= $form->field($model, 'day',['options' => ['class' => 'col-md-4']])->widget(DatePicker::classname(), [
    'options' => ['placeholder' => 'Enter birth date ...'],
    'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'dd/mm/yyyy'
    ]
]);?>
    <?= $form->field($model, "total_money")->textInput(['maxlength' => true,'class'=>'total_money money_class','id'=>'totalamount']) ?>


    <?php
    //     echo  MaskMoney::widget([
    //     'name' => 'Expenditure[total_money]',
    //     'value' => 0.0,
    //     'disabled' => false,
    //     'pluginOptions' => [
    //         'prefix' => '',
    //         'thousands' => '.',
    //         'decimal' => ',',
    //         'precision' => 0
    //     ],
    //     'options' => [
    //         'class' => 'total_money col-md-3 money_class',
    //         'placeholder' => 'Enter a valid amount...'
    //     ],
    // ]);
?>

    <?= $form->field($model, 'status',['options' => ['class' => 'activeform col-md-1']])->widget(CheckboxX::classname(),
        [
            'initInputType' => CheckboxX::INPUT_CHECKBOX,
            'options'=>['value' => $model->status],
        ])->label(false);
    ?>
    </div>
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Các khoản chi</h4></div>
            <div class="panel-body">
                 <?php DynamicFormWidget::begin([
                    'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                    'widgetBody' => '.container-items', // required: css class selector
                    'widgetItem' => '.item', // required: css class
                    'limit' => 50, // the maximum times, an element can be cloned (default 999)
                    'min' => 1, // 0 or 1 (default 1)
                    'insertButton' => '.add-item', // css class
                    'deleteButton' => '.remove-item', // css class
                    'model' => $modelsExpenditureItems[0],
                    'formId' => 'dynamic-form',
                    'formFields' => [
                        'type',
                        'items_name',
                        'quantity',
                        'money',
                        'motorbike',
                        'sea_control',
                        'accounting_id',
                        'employee_id',
                    ],
                ]); ?>

                <div class="container-items"><!-- widgetContainer -->
                <?php foreach ($modelsExpenditureItems as $i => $modelExpenditureItems): ?>
                    <div class="item panel panel-default"><!-- widgetBody -->
                        <div class="panel-heading">
                            <h3 class="panel-title pull-left">Các khoản chi</h3>
                            <div class="pull-right">
                                <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <?php
                                // necessary for update action.
                                if (! $modelExpenditureItems->isNewRecord) {
                                    echo Html::activeHiddenInput($modelExpenditureItems, "[{$i}]id");
                                }
                            ?>
    
                            <div class="row">
                                <div class="col-sm-4">
                                <?php
                                echo $form->field($modelExpenditureItems, "[{$i}]type")->widget(Select2::classname(), [
                                            'data' => $dataCost,
                                            'language' => 'en',
                                            'options' => ['placeholder' => 'Pilih Kelas'],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]);
                                ?>
                                </div>
                                <div class="col-md-2 money_class">
                                <?php echo Html::a('Thêm <i class="fa fa-plus-circle"></i>', ['costtype/create'], ['title' => 'Thêm loại chi phí', 'target' => '_blank', 'data' => ['pjax' => 0]] ); ?>
                                </div>

                                <div class="col-sm-2">
                                    <?php // $form->field($modelExpenditureItems, "[{$i}]accounting_id")->textInput(['maxlength' => true]) ?>
                                    <?php
                                    echo $form->field($modelExpenditureItems, "[{$i}]accounting_id")->widget(Select2::classname(), [
                                            'data' => $dataEmployee,
                                            'language' => 'en',
                                            'options' => ['placeholder' => 'Pilih Kelas'],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]); 
                                        ?>
                                </div>

                                <div class="col-sm-2">
                                   <!--  <?php // $form->field($modelExpenditureItems, "[{$i}]employee_id")->textInput(['maxlength' => true]) ?> -->
                                    
                                <?php
                                echo $form->field($modelExpenditureItems, "[{$i}]employee_id")->widget(Select2::classname(), [
                                        'data' => $dataEmployee,
                                        'language' => 'en',
                                        'options' => ['placeholder' => 'Pilih Kelas'],
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],
                                    ]); 
                                    ?>
                                </div>
                                <div class="col-md-2 money_class">
                                <?php echo Html::a('Thêm <i class="fa fa-plus-circle"></i>', ['employee/create'], ['title' => 'Thêm loại chi phí', 'target' => '_blank', 'data' => ['pjax' => 0]] ); ?>
                                </div>

                                <div class="col-sm-4">
                                    <?= $form->field($modelExpenditureItems, "[{$i}]items_name")->textInput(['maxlength' => true]) ?>

                                    <?php // $form->field($modelExpenditureItems, "[{$i}]items_name")->dropDownList($dataEmployee) ?>

    
                                </div>
                                <div class="col-sm-4">
                                    <?= $form->field($modelExpenditureItems, "[{$i}]quantity")->textInput(['maxlength' => true]) ?>
                                </div>
                            
                                <div class="col-sm-4">
                                    <?php echo $form->field($modelExpenditureItems, "[{$i}]money")->textInput(['maxlength' => true,'class' => 'money_item money_class']) ?>

                                    <?php 
                                        
                                        // echo MaskMoney::widget([
                                        //     'name' => 'ExpenditureItems[{$i}][money]',
                                        //     'value' => null,
                                        //     'options' => [
                                        //         'class' => 'money_item',
                                        //         'placeholder' => 'Enter a valid amount...'
                                        //     ],
                                        //     'pluginOptions' => [
                                        //         // 'suffix' => '', 
                                        //         // 'affixesStay' => true,
                                        //         // 'thousands' => ',',
                                        //         // 'decimal' => '.',
                                        //         // 'precision' => 2, 
                                        //         // 'allowZero' => true,
                                        //         // 'allowNegative' => true,
                                        //     ]
                                        // ]);
                                     ?>
                                    
                                </div>
                                <div class="col-sm-4">
                                    <?= $form->field($modelExpenditureItems, "[{$i}]motorbike")->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-sm-4">
                                    <?= $form->field($modelExpenditureItems, "[{$i}]sea_control")->textInput(['maxlength' => true]) ?>
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

