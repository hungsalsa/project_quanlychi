<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\chi\models\Chingay */

$this->title = 'Chỉnh sửa chi ngày : '.$model->day;
$this->params['breadcrumbs'][] = ['label' => 'Chingays', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="chingay-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsChitietchi' => (empty($modelsChitietchi)) ? [new Chitietchi] : $modelsChitietchi,
        'dataEmployee'=>$dataEmployee,
        'dataCost'=>$dataCost,
        'dataMotor'=>$dataMotor,
        'dataCuahang'=>$dataCuahang,
    ]) ?>

</div>
