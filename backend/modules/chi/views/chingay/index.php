<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\chi\models\ChingaySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách các khoản chi theo ngày';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chingay-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Thêm mới', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'day',
            [
                'class' => 'yii\grid\DataColumn',
               'attribute' => 'day',
               'format' => 'raw',
               'value'=>function ($data) {
                return Html::a(Html::encode($data->day),Yii::$app->homeUrl.'chi/chingay/update?id='.$data->id);
                },

            ],
            [
                'attribute' =>'total_money',
                'format'=>['decimal',0],
                
            ],
            'note:ntext',
            [
                'attribute' => 'status',
                'value'=>function($data){
                    if($data->status==1){
                        return "Kích hoạt";
                    }else{
                        return "Ẩn";
                    }
                },
                'headerOptions' => ['class' => 'text-center','width'=>'9%'],
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:H:i d-m-Y']
            ],
            'cuahang_id',
            //'created_at',
            //'updated_at',
            //'user_add',

            [
                'class' => 'yii\grid\ActionColumn',
                'class' => 'yii\grid\ActionColumn','header'=>'Hành động', 
                'headerOptions' => ['width' => '10%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
