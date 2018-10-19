<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\chi\models\Chingay */

$this->title = 'Create Chingay';
$this->params['breadcrumbs'][] = ['label' => 'Chingays', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chingay-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsChitietchi' => $modelsChitietchi,
    ]) ?>

</div>
