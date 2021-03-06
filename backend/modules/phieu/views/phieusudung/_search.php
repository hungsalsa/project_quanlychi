<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\phieu\models\PhieuSudungSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="phieu-sudung-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'so_phieu_dau') ?>

    <?= $form->field($model, 'so_phieu_cuoi') ?>

    <?= $form->field($model, 'ngay_sd') ?>

    <?= $form->field($model, 'phieu_huy') ?>

    <?php // echo $form->field($model, 'sl_phieu_tot') ?>

    <?php // echo $form->field($model, 'ke_toan') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'user_create') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
