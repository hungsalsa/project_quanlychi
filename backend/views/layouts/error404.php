<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\ChitietAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

ChitietAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap" style="margin: 20px">

    <div class="container">
        <div class="col-md-10 col-md-offset-1">
        <h2>Trang này không tồn tại hoặc bạn ko có quyền vào trang này</h2>
        <h1>Vào đây để về trang chủ  
            <?= Html::a('<i class="fa fa-arrow-circle-right" style="font-size: 100px;margin: 5px 20px;color: #0000ff8f"></i><i class="fa fa-home" style="font-size: 100px;margin: 5px 0px;color: #0000ff;"></i>', Yii::$app->request->hostInfo.'/backend',['data-method' => 'post']) ?>
        </h1>
        </div>
    </div>
</div>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
