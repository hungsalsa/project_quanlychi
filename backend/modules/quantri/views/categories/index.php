<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\quantri\models\CategoriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categories-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Categories', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'id',
            // 'cateName',
            [
               'attribute' => 'cateName',
               'format' => 'raw',
               'value'=>function ($data) {
                return Html::a(Html::encode($data->cateName),Yii::$app->homeUrl.'quantri/categories/view?id='.$data->id);
                },
            ],
            'groupId',
            'parent_id',
            'link',
            //'images',
            //'sort',
            //'title',
            //'keyword',
            //'descriptions:ntext',
            //'status',
             [
                'class' => 'yii\grid\DataColumn',
                'attribute' => 'created_at',
                'content'=>function($data){
                    return date('d/m/Y - H:i:s', $data->created_at);
                },
                'headerOptions' => ['class' => 'text-center'],
                'contentOptions' => ['style' => '', 'class' => 'text-center'],
            ],
            // [
            //     'class' => 'yii\grid\DataColumn',
            //     'attribute' => 'updated_at',
            //     'content'=>function($data){
            //         return date('d/m/Y - H:i:s', $data->created_at);
            //     },
            //     'headerOptions' => ['class' => 'text-center'],
            //     'contentOptions' => ['style' => '', 'class' => 'text-center'],
            // ],
            // [
            //   'attribute' => 'updated_at',
            //   'formatter' => [
            //         'class' => 'yii\i18n\Formatter',
            //         'dateFormat' => 'php:d-M-Y',
            //         'datetimeFormat' => 'php:d-M-Y H:i:s',
            //         'timeFormat' => 'php:H:i:s',
            //     ],
            //   'value'=>function($data){
            //             return  date('d/m/Y - H:i:s', $data->created_at);
            //         },
                
            // ],
            //'created_at',
            //'updated_at',
            'userAdd',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
