<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\phieu\models\PhieuSudung */

$this->title = 'Create Phieu Sudung';
$this->params['breadcrumbs'][] = ['label' => 'Phieu Sudungs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phieu-sudung-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'sophieu' => $sophieu,
        'dataEmployee' => $dataEmployee,
        'modelsPhieuTon' => $modelsPhieuTon,
    ]) ?>

</div>
