<?php

use backend\assets\HomeAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use backend\widgets\navbarWidget;
use backend\widgets\sidebarWidget;
// use backend\widgets\contentHeaderWidget;
// use backend\widgets\controlSidebarWidget;
// use backend\widgets\footerWidget;
HomeAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="app sidebar-mini rtl">
<?php $this->beginBody() ?>
		<!-- ===================Navbar=========================== -->
		<?= navbarWidget::widget() ?>
		<!-- ===================Navbar :END =========================== -->

		<!-- ===================MAIN SIDEBAR CONTAINER=========================== -->
		<?= sidebarWidget::widget() ?>
		<!-- ===================MAIN SIDEBAR CONTAINER :END =========================== -->
		<!-- ===================CONTENT WRAPPER. CONTAINS PAGE CONTENT=========================== -->
		<main class="app-content">
			<div class="app-title">
				<div>
					<h1><i class="fa fa-dashboard"></i> Dashboard</h1>
					<p>A free and open source Bootstrap 4 admin template</p>
				</div>
				<ul class="app-breadcrumb breadcrumb">
					<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
					<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
				</ul>
			</div>
			<?= $content ?>
		</main>

		<!-- ===================CONTENT WRAPPER. CONTAINS PAGE CONTENT :END =========================== -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
