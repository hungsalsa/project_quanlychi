<?php

use backend\assets\ChitietAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use backend\widgets\TopbarHeaderWidget;
use backend\widgets\LeftSidebarWidget;

ChitietAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= Yii::$app->homeUrl?>vender/images/favicon.png">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
	    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="fix-header fix-sidebar card-no-border">
<?php $this->beginBody() ?>
	<!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Admin Wrap</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
	<div id="main-wrapper">
		<!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <?= TopbarHeaderWidget::widget() ?>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <?= LeftSidebarWidget::widget() ?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
	   <!-- ============================================================== -->
	   <!-- Container fluid  -->
	   <!-- ============================================================== -->
	   <div class="container-fluid">
	      <!-- ============================================================== -->
	      <!-- Bread crumb and right sidebar toggle -->
	      <!-- ============================================================== -->
			<?= $content ?>
	      <!-- ============================================================== -->
      <!-- End Right sidebar -->
      <!-- ============================================================== -->
	    </div>
	   <!-- ============================================================== -->
	   <!-- End Container fluid  -->
	   <!-- ============================================================== -->
	   <!-- ============================================================== -->
	   <!-- footer -->
	   <!-- ============================================================== -->
	   <footer class="footer"> © 2017 Adminwrap by wrappixel.com </footer>
	   <!-- ============================================================== -->
	   <!-- End footer -->
	   <!-- ============================================================== -->
	</div>

</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
