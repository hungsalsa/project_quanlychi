<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use kartik\checkbox\CheckboxX;
use wbraganca\dynamicform\DynamicFormWidget;
/* @var $this yii\web\View */
/* @var $model backend\modules\phieu\models\PhieuSudung */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="phieu-sudung-form">
<?php echo Yii::$app->controller->action->id; //current controller action id ?>
    <?php $form = ActiveForm::begin(['enableAjaxValidation' => true,'id' => 'dynamic-form']); ?>

    <?= $form->field($model, 'ngay_sd',['options' => ['class' => 'col-md-3']])->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Enter birth date ...'],
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'dd-mm-yyyy'
        ]
    ]);?>

    <?= $form->field($model, "so_phieu_dau",['options' => ['class' => 'col-md-3']])->widget(Select2::classname(), [
        'data' => $sophieu,
        'language' => 'en',
        'options' => ['placeholder' => 'Pilih Kelas'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($model, "so_phieu_cuoi",['options' => ['class' => 'col-md-3']])->widget(Select2::classname(), [
        'data' => $sophieu,
        'language' => 'en',
        'options' => ['placeholder' => 'Pilih Kelas'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>


    <?= $form->field($model, 'sl_phieu_tot',['options' => ['class' => 'col-md-3']])->textInput() ?>

    <?= $form->field($model, 'phieu_huy',['options' => ['class' => 'col-md-7']])->widget(Select2::classname(), [
    	'data' => $sophieu,
    	'language' => 'vi',
    	'options' => ['placeholder' => 'Select many bill ...', 'multiple' => true],
    	'pluginOptions' => [
    		'tags' => true,
    		'tokenSeparators' => [',', ' '],
    		'maximumInputLength' => 10,
    		'allowClear' => true
    	],
    ]);?>

    


    <?= $form->field($model, "ke_toan",['options' => ['class' => 'col-md-3']])->widget(Select2::classname(), [
        'data' => $dataEmployee,
        'language' => 'en',
        'options' => ['placeholder' => 'Pilih Kelas'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
	<?= $form->field($model, 'status',['options' => ['class' => 'status_active col-md-2']])->widget(CheckboxX::classname(),
        [
            'initInputType' => CheckboxX::INPUT_CHECKBOX,
            'options'=>['value' => $model->status],
        ])->label(false);
    ?>
	<div class="clearfix"></div>
    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <div class="row">
    	<div class="panel panel-default col-md-12">
    		<div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Danh sách phiếu tồn</h4></div>
    		<div class="panel-body">
    			<?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsPhieuTon[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                	'so_phieu_ton',
                	'note',
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            	<?php foreach ($modelsPhieuTon as $i => $modelPhieuTon): ?>
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
            				if (! $modelPhieuTon->isNewRecord) {
            					echo Html::activeHiddenInput($modelPhieuTon, "[{$i}]id");
            				}
            				?>

            				<div class="row">
            					<div class="col-sm-10">
            						<?= $form->field($modelPhieuTon, "[{$i}]so_phieu_ton",['options' => ['class' => 'col-md-3']])->widget(Select2::classname(), [
            							'data' => $sophieu,
            							'language' => 'en',
            							'options' => ['placeholder' => 'Pilih Kelas'],
            							'pluginOptions' => [
            								'allowClear' => true
            							],
            						]);
            						?>
            						<?= $form->field($modelPhieuTon, "[{$i}]note",['options' => ['class' => 'col-md-9']])->textarea(['rows' => 3]) ?>
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
