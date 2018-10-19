<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use kartik\checkbox\CheckboxX;
/* @var $this yii\web\View */
/* @var $model backend\modules\chi\models\Expenditure */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="expenditure-form">
    
    <div class="row">
    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <?= $form->field($model, 'day',['options' => ['class' => 'col-md-4']])->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Enter birth date ...'],
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'dd-mm-yyyy'
        ]
    ]);?>

    <?= $form->field($model, 'total_money',['options' => ['class' => 'col-md-4']])->textInput(['class'=>'total_money form-control','id'=>'totalamount']) ?>

    <?= $form->field($model, 'status',['options' => ['class' => 'activeform col-md-2']])->widget(CheckboxX::classname(),
        [
            'initInputType' => CheckboxX::INPUT_CHECKBOX,
            'options'=>['value' => $model->status],
        ])->label(false);
    ?>
    <?= $form->field($model, 'note',['options' => ['class' => 'col-md-10']])->textarea(['rows' => 6,'cols' => '12']) ?>
    </div>
    <div class="row">
        <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Các khoản chi </h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 40, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsExpenditureItem[0],
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
            <?php foreach ($modelsExpenditureItem as $i => $modelExpenditureItem): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left"> Các khoản chi </h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelExpenditureItem->isNewRecord) {
                                echo Html::activeHiddenInput($modelExpenditureItem, "[{$i}]id");
                            }
                        ?>
                        
                        <div class="row">
                            <div class="col-sm-4">
                                <?php
                                 // $form->field($modelExpenditureItem, "[{$i}]accounting_id")->textInput(['maxlength' => true]) 
                                 ?>
                                <?php
                                echo $form->field($modelExpenditureItem, "[{$i}]accounting_id")->widget(Select2::classname(), [
                                            'data' => $dataEmployee,
                                            'language' => 'en',
                                            'options' => ['placeholder' => 'Pilih Kelas'],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]);
                                ?>
                            </div>
                            <div class="col-sm-4">
                                <?php //echo $form->field($modelExpenditureItem, "[{$i}]employee_id")->textInput(['maxlength' => true]) ?>
                                <?php
                                echo $form->field($modelExpenditureItem, "[{$i}]employee_id")->widget(Select2::classname(), [
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
                            
                            <div class="col-sm-3">
                                <?php
                                 // $form->field($modelExpenditureItem, "[{$i}]type")->textInput(['maxlength' => true]) 
                                 ?>
<!-- ++++=============================================++++++++++++++++++++++++++++++++ -->                                 
                                <?php echo $form->field($modelExpenditureItem, "[{$i}]type")->widget(Select2::classname(), [
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
                            <div class="col-sm-6">
                                <?= $form->field($modelExpenditureItem, "[{$i}]items_name")->textInput(['maxlength' => true]) ?>
                            </div>
                        </div><!-- .row -->
                        <div class="row">
                            <div class="col-sm-3">
                                <?= $form->field($modelExpenditureItem, "[{$i}]quantity")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelExpenditureItem, "[{$i}]money")->textInput(['maxlength' => true,'class' => 'money_item form-control']) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelExpenditureItem, "[{$i}]motorbike")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelExpenditureItem, "[{$i}]sea_control")->textInput(['maxlength' => true]) ?>
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
        <?= Html::submitButton('Save <i class="fa fa-check"></i>&nbsp;', ['class' => 'btn btn-success']) ?>

        <?= Html::a(' Hủy <i class="fa fa-ban"></i>', ['index'], ['class' => 'btn btn-success']) ?>
        
    </div>

    <?php ActiveForm::end(); ?>

</div>
