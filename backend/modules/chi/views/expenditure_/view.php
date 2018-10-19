<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\chi\models\Expenditure */

$this->title = 'Các khoản chi của : '.$model->day;
$this->params['breadcrumbs'][] = ['label' => 'Expenditures', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expenditure-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Danh sách', ['index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            // 'day',
            [
                'attribute' => 'day',
                'format' => ['date', 'php: d-m-Y'],
                'filter'=>false,
            ],
            // 'total_money',
            [
                'attribute' =>'total_money',
                'format'=>['decimal',0],
                
            ],
            'note:ntext',
            // 'status',
            [
                'attribute' => 'status',
                'value'=>function($data){
                    if($data->status==1){
                        return "kích hoạt";
                    }else{
                        return "Ẩn";
                    }
                },
                // 'headerOptions' => ['class' => 'text-center'],
            ],
            'created_at',
            'updated_at',
            'user_add',
        ],
    ]) ?>

</div>
