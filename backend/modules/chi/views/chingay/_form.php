<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
/* @var $this yii\web\View */
/* @var $model backend\modules\chi\models\Chingay */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="chingay-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <?= $form->field($model, 'day')->textInput() ?>

    <?= $form->field($model, 'total_money')->textInput() ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Các khoản chi </h4></div>
            <div class="panel-body">
               <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsChitietchi[0],
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
                <?php foreach ($modelsChitietchi as $i => $modelChitietchi): ?>
                    <div class="item panel panel-default"><!-- widgetBody -->
                        <div class="panel-heading">
                            <h3 class="panel-title pull-left">Khoản chi</h3>
                            <div class="pull-right">
                                <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <?php
                            // necessary for update action.
                            if (! $modelChitietchi->isNewRecord) {
                                echo Html::activeHiddenInput($modelChitietchi, "[{$i}]id");
                            }
                            ?>
                            <div class="row">
                                <div class="col-sm-6">
                                    <?= $form->field($modelChitietchi, "[{$i}]type")->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-sm-6">
                                    <?= $form->field($modelChitietchi, "[{$i}]items_name")->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-md-3">
                                    <?= $form->field($modelChitietchi, "[{$i}]quantity")->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-md-3">
                                    <?= $form->field($modelChitietchi, "[{$i}]money")->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-md-3">
                                    <?= $form->field($modelChitietchi, "[{$i}]motorbike")->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-md-3">
                                    <?= $form->field($modelChitietchi, "[{$i}]sea_control")->textInput(['maxlength' => true]) ?>
                                </div>
                            </div><!-- .row -->
                            <div class="col-sm-4">
                                <?= $form->field($modelChitietchi, "[{$i}]accounting_id")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($modelChitietchi, "[{$i}]employee_id")->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>
</div>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'user_add')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
