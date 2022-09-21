<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
       'css/plugins.css',
        'css/style.css',
        'css/green-style.css',
        'css/site.css',
    ];
    public $js = [
       // 'js/jquery.js',
    //    'js/viewportchecker.js',
     //   'js/bootstrap.js',
     //   'js/bootsnav.js',
     //   'js/select2.js',
     // /  'js/wysihtml5-0.js',
      //  'js/bootstrap-wysihtml5.js',
    //    'js/datedropper.js',
      //  'js/dropzone.js',
      //  'js/loader.js',
       // 'js/owl.js',
       // 'js/slick.js',
       // 'js/gmap3.js',
     //   'js/jquery_002.js',
        'js/time_ago.js',
        'js/site.js',
        'js/fontawesome.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
    
    
    public function init()
    {
        parent::init();
        // resetting BootstrapAsset to not load own css files
        \Yii::$app->assetManager->bundles['yii\\bootstrap4\\BootstrapAsset'] = [
            'css' => [],
            'js' => []
        ];
    }
}
