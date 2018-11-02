<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use kartik\checkbox\CheckboxX;
$this->registerJsFile('http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js');
$this->registerJsFile('@web/vender/js/jquery.number.min.js');
$this->registerJsFile('@web/vender/js/my_code.js');
/* @var $this yii\web\View */
/* @var $model backend\modules\chi\models\Chingay */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="chingay-form">

    <?php $form = ActiveForm::begin([
        'id' => 'dynamic-form',
        // 'enableAjaxValidation' => true,
        // 'validationUrl'=>Url::toRoute('chingay/validation'),
    ]); ?>

    <?= $form->field($model, 'day',['options' => ['class' => 'col-md-4']])->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Enter birth date ...'],
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'dd-mm-yyyy'
        ]
    ]);?>
    <?= $form->field($model, 'cuahang_id',['options'=>['class'=>'col-md-3']])->widget(Select2::classname(), [
        'data' => $dataCuahang,
        'options' => ['placeholder' => '-- Làm tại --'],
        'pluginOptions' => [
            'tags' => true,
            'tokenSeparators' => [',', ' '],
            'maximumInputLength' => 10
        ],
    ]) ?>

    <?= $form->field($model, 'status',['options' => ['class' => 'status_active col-md-2']])->widget(CheckboxX::classname(),
        [
            'initInputType' => CheckboxX::INPUT_CHECKBOX,
            'options'=>['value' => $model->status],
        ])->label(false);
    ?>
    <div class="clearfix"></div>
    <?= $form->field($model, 'note')->textarea(['rows' => 3]) ?>

    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Các khoản chi </h4></div>
            <div class="panel-body">
               <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 34, // the maximum times, an element can be cloned (default 999)
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
                    'note',
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
                                <div class="col-sm-3">
                                <?php
                                echo $form->field($modelChitietchi, "[{$i}]accounting_id")->widget(Select2::classname(), [
                                            'data' => $dataEmployee,
                                            'language' => 'en',
                                            'options' => ['placeholder' => 'Pilih Kelas'],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]);
                                ?>
                            </div>
                            <div class="col-sm-3">
                                <?php
                                echo $form->field($modelChitietchi, "[{$i}]employee_id")->widget(Select2::classname(), [
                                            'data' => $dataEmployee,
                                            'language' => 'en',
                                            'options' => ['placeholder' => 'Pilih Kelas'],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]);
                                ?>
                            </div>

                            <div class="col-md-1 money_class">
                                <?php echo Html::a('<i class="fa fa-plus-circle"></i>', ['employee/create'], ['title' => 'Thêm nhan vien', 'target' => '_blank', 'data' => ['pjax' => 0]] ); ?>
                            </div>
                            <div class="col-sm-3">
                                <?php echo $form->field($modelChitietchi, "[{$i}]type")->widget(Select2::classname(), [
                                        'data' => $dataCost,
                                        'language' => 'en',
                                        'options' => ['placeholder' => 'Pilih Kelas'],
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],
                                    ]);
                                ?>
                            </div>
                            <div class="col-md-1 money_class">
                                <?php echo Html::a('<i class="fa fa-plus-circle"></i>', ['costtype/create'], ['title' => 'Thêm loại chi phí', 'target' => '_blank', 'data' => ['pjax' => 0]] ); ?>
                            </div>
                                <div class="col-sm-4">
                                    <?= $form->field($modelChitietchi, "[{$i}]items_name")->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-md-2">
                                    <?= $form->field($modelChitietchi, "[{$i}]quantity")->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-md-2">
                                    <?= $form->field($modelChitietchi, "[{$i}]money")->textInput(['maxlength' => true,'class' => 'money_item form-control']) ?>
                                </div>
                                <div class="col-md-2">
                                    <?php echo $form->field($modelChitietchi, "[{$i}]motorbike")->widget(Select2::classname(), [
                                            'data' => $dataMotor,
                                            'language' => 'en',
                                            'options' => ['placeholder' => 'Pilih Kelas'],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]);
                                    ?>
                                </div>
                                <div class="col-md-1 money_class">
                                    <?php echo Html::a('<i class="fa fa-plus-circle"></i>', ['/sanpham/motorbike/create'], ['title' => 'Thêm loại chi phí', 'target' => '_blank', 'data' => ['pjax' => 0]] ); ?>
                                </div>
                                <div class="col-md-2">
                                    <?= $form->field($modelChitietchi, "[{$i}]sea_control")->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-md-10">
                                    <?= $form->field($modelChitietchi, "[{$i}]note")->textInput(['maxlength' => true]) ?>
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
        <?= Html::a('Hủy', ['index'], ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
