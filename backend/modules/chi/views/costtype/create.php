<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\chi\models\CostType */

$this->title = 'Create Cost Type';
$this->params['breadcrumbs'][] = ['label' => 'Cost Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cost-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
