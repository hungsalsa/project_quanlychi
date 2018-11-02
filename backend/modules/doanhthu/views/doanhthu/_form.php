<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use kartik\checkbox\CheckboxX;
use kartik\number\NumberControl;
/* @var $this yii\web\View */
/* @var $model backend\modules\doanhthu\models\DoanhThu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="doanh-thu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ngay',['options' => ['class' => 'col-md-3']])->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Enter birth date ...'],
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'dd-mm-yyyy'
        ]
    ]);?>
    <?= $form->field($model, 'cua_hang',['options'=>['class'=>'col-md-3']])->widget(Select2::classname(), [
        'data' => $dataCuahang,
        'options' => ['placeholder' => '-- Làm tại --'],
        'pluginOptions' => [
            'tags' => true,
            'tokenSeparators' => [',', ' '],
            'maximumInputLength' => 10
        ],
    ]) ?>

    <?= $form->field($model, 'ketoan',['options'=>['class'=>'col-md-3']])->widget(Select2::classname(), [
        'data' => $dataEmployee,
        'options' => ['placeholder' => '-- Làm tại --'],
        'pluginOptions' => [
            'tags' => true,
            'tokenSeparators' => [',', ' '],
            'maximumInputLength' => 10
        ],
    ]) ?>

    <?= $form->field($model, 'nguoi_ky',['options'=>['class'=>'col-md-3']])->widget(Select2::classname(), [
        'data' => $dataEmployee,
        'options' => ['placeholder' => '-- Làm tại --'],
        'pluginOptions' => [
            'tags' => true,
            'tokenSeparators' => [',', ' '],
            'maximumInputLength' => 10
        ],
    ]) ?>
    <div class="clearfix"></div>

    <?= $form->field($model, 'giao_sang',['options'=>['class'=>'col-md-2']])->widget(NumberControl::classname(), [
            'maskedInputOptions' => [
                // 'prefix' => 'vnđ ',
                'suffix' => '',
                'allowMinus' => false,
                'groupSeparator' => '.',
                'radixPoint' => ','
            ],
            'displayOptions' => ['class' => 'form-control kv-monospace'],
            'saveInputContainer' => ['class' => 'kv-saved-cont']
        ]);
     ?>
    <?= $form->field($model, 'tt_ck',['options'=>['class'=>'col-md-2']])->widget(NumberControl::classname(), [
            'maskedInputOptions' => [
                // 'prefix' => 'vnđ ',
                'suffix' => '',
                'allowMinus' => false,
                'groupSeparator' => '.',
                'radixPoint' => ','
            ],
            'displayOptions' => ['class' => 'form-control kv-monospace'],
            'saveInputContainer' => ['class' => 'kv-saved-cont']
        ]);
     ?>
    <?= $form->field($model, 'tt_the',['options'=>['class'=>'col-md-2']])->widget(NumberControl::classname(), [
            'maskedInputOptions' => [
                // 'prefix' => 'vnđ ',
                'suffix' => '',
                'allowMinus' => false,
                'groupSeparator' => '.',
                'radixPoint' => ','
            ],
            'displayOptions' => ['class' => 'form-control kv-monospace'],
            'saveInputContainer' => ['class' => 'kv-saved-cont']
        ]);
     ?>
<?= $form->field($model, 'tt_tien_mat',['options'=>['class'=>'col-md-2']])->widget(NumberControl::classname(), [
            'maskedInputOptions' => [
                // 'prefix' => 'vnđ ',
                'suffix' => '',
                'allowMinus' => false,
                'groupSeparator' => '.',
                'radixPoint' => ','
            ],
            'displayOptions' => ['class' => 'form-control kv-monospace'],
            'saveInputContainer' => ['class' => 'kv-saved-cont']
        ]);
     ?>
<?= $form->field($model, 'tien_hom',['options'=>['class'=>'col-md-2']])->widget(NumberControl::classname(), [
            'maskedInputOptions' => [
                // 'prefix' => 'vnđ ',
                'suffix' => '',
                'allowMinus' => false,
                'groupSeparator' => '.',
                'radixPoint' => ','
            ],
            'displayOptions' => ['class' => 'form-control kv-monospace'],
            'saveInputContainer' => ['class' => 'kv-saved-cont']
        ]);
     ?>
<?= $form->field($model, 'tien_le',['options'=>['class'=>'col-md-2']])->widget(NumberControl::classname(), [
            'maskedInputOptions' => [
                // 'prefix' => 'vnđ ',
                'suffix' => '',
                'allowMinus' => false,
                'groupSeparator' => '.',
                'radixPoint' => ','
            ],
            'displayOptions' => ['class' => 'form-control kv-monospace'],
            'saveInputContainer' => ['class' => 'kv-saved-cont']
        ]);
     ?>

     <?= $form->field($model, 'tien_chi',['options'=>['class'=>'col-md-2']])->widget(NumberControl::classname(), [
            'maskedInputOptions' => [
                // 'prefix' => 'vnđ ',
                'suffix' => '',
                'allowMinus' => false,
                'groupSeparator' => '.',
                'radixPoint' => ','
            ],
            'displayOptions' => ['class' => 'form-control kv-monospace'],
            'saveInputContainer' => ['class' => 'kv-saved-cont']
        ]);
     ?>

     <?= $form->field($model, 'status',['options' => ['class' => 'money_class col-md-2']])->widget(CheckboxX::classname(),
        [
            'initInputType' => CheckboxX::INPUT_CHECKBOX,
            'options'=>['value' => $model->status],
        ])->label(false);
    ?>
    <?php // $form->field($model, 'chenh_lech',['options'=>['class'=>'col-md-2']])->textInput() ?>

<div class="clearfix"></div>
    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    

        <?= $form->field($model, 'thu_khac',['options'=>['class'=>'col-md-2']])->textInput() ?>

        <?php // $form->field($model, 'tong_doanh_thu_phieu',['options'=>['class'=>'col-md-2']])->textInput() ?>

    <?php // $form->field($model, 'doanh_thu_thuc',['options'=>['class'=>'col-md-2']])->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
