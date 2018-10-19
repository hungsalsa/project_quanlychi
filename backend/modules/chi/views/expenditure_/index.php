<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\chi\models\ExpenditureSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Expenditures';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expenditure-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Expenditure', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn','header'=>'STT',],

            // 'id',
             [
                'class' => 'yii\grid\DataColumn',
               'attribute' => 'day',
               'format' => 'raw',
               'value'=>function ($data) {
                return Html::a(Html::encode($data->day),Yii::$app->homeUrl.'chi/expenditure/update?id='.$data->id);
                },

            ],

            // 'total_money',
            [
                'attribute' =>'total_money',
                'format'=>['decimal',0],
            ],
            'note:ntext',
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
            //'updated_at',
            //'user_add',

            [
                'class' => 'yii\grid\ActionColumn',
                'class' => 'yii\grid\ActionColumn','header'=>'Hành động', 
                'headerOptions' => ['width' => '80','class' => 'text-center'],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
