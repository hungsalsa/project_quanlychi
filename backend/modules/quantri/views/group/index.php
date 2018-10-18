<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\quantri\models\GroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách Groups';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Group', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'id',
            // 'groupsName',
            [
               'attribute' => 'groupsName',
               'format' => 'raw',
               'value'=>function ($data) {
                return Html::a(Html::encode($data->groupsName),Yii::$app->homeUrl.'quantri/group/view?id='.$data->id);
                },
            ],
            [
                'class' => 'yii\grid\DataColumn',
                'attribute' => 'status',
                'content'=>function($data){
                    if($data->status == 1) {
                        return " Hiện ";
                    }else{
                        return ' Ân ';
                    }
                },
                'headerOptions' => ['class' => 'text-center'],
                'contentOptions' => ['style' => '', 'class' => 'text-center'],
            ],
            [
                'class' => 'yii\grid\DataColumn',
                'attribute' => 'created_at',
                'content'=>function($data){
                    return date('d/m/Y - H:i:s', $data->created_at);
                },
                'headerOptions' => ['class' => 'text-center'],
                'contentOptions' => ['style' => '', 'class' => 'text-center'],
            ],
            [
                'class' => 'yii\grid\DataColumn',
                'attribute' => 'updated_at',
                'content'=>function($data){
                    return date('d/m/Y - H:i:s', $data->created_at);
                },
                'headerOptions' => ['class' => 'text-center'],
                'contentOptions' => ['style' => '', 'class' => 'text-center'],
            ],
            // 'status',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
