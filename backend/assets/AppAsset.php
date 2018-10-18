<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
       'vender/node_modules/bootstrap/css/bootstrap.min.css',
        'vender/node_modules/perfect-scrollbar/css/perfect-scrollbar.css',
        'vender/node_modules/morrisjs/morris.css',
        'vender/node_modules/c3-master/c3.min.css',
        'vender/node_modules/toast-master/css/jquery.toast.css',
        'css/style.css',
        'css/pages/dashboard1.css',
        'css/colors/blue-dark.css'
    ];
    public $js = [
        // 'vender/node_modules/jquery/jquery.min.js',
        'vender/node_modules/bootstrap/js/popper.min.js',
        'vender/node_modules/bootstrap/js/bootstrap.min.js',
        'vender/node_modules/ps/perfect-scrollbar.jquery.min.js',
        'js/waves.js',
        'js/sidebarmenu.js',
        'js/custom.js',
        // 'js/jquery.number.min.js',
        'vender/node_modules/raphael/raphael-min.js',
        // 'vender/node_modules/morrisjs/morris.min.js',
        'vender/node_modules/d3/d3.min.js',
        'vender/node_modules/c3-master/c3.min.js',
        'vender/node_modules/toast-master/js/jquery.toast.js',
        // 'js/dashboard1.js',
        // 'vender/node_modules/styleswitcher/jQuery.style.switcher.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
