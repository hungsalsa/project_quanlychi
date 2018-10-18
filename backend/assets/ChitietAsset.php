<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class ChitietAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
       'vender/node_modules/bootstrap/css/bootstrap.min.css',
        'css/stylechitiet.css',
        // 'css/colors/blue-dark.css'
    ];
    public $js = [
        'vender/node_modules/jquery/jquery.min.js',
        'vender/node_modules/bootstrap/js/popper.min.js',
        'vender/node_modules/bootstrap/js/bootstrap.min.js',
        'vender/node_modules/ps/perfect-scrollbar.jquery.min.js',
        'js/waves.js',
        'js/sidebarmenu.js',
        'vender/node_modules/sticky-kit-master/dist/sticky-kit.min.js',
        'vender/node_modules/sparkline/jquery.sparkline.min.js',
        'js/custom.min.js',
        'vender/node_modules/datatables/jquery.dataTables.min.js',
        'https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js',
        'https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js',
        'https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js',
        'https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js',
        'https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js',
        'https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js',
        'js/chitietExport.js',
        // 'vender/node_modules/styleswitcher/jQuery.style.switcher.js',
        // 'vender/node_modules/d3/d3.min.js',
        // 'vender/node_modules/c3-master/c3.min.js',
        // 'vender/node_modules/toast-master/js/jquery.toast.js',
        // 'js/dashboard1.js',
        // 'vender/node_modules/styleswitcher/jQuery.style.switcher.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
