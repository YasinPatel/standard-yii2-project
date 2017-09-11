<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;
/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css =
    [
        'plugins/bootstrap/css/bootstrap.min.css',
        'plugins/font-awesome/css/font-awesome.min.css',
        'css/ionicons.min.css',
        'css/AdminLTE.min.css',
        'css/iCheck/square/blue.css',
    ];

    public $js =
    [
        'scripts/jquery-2.2.3.min.js',
        'plugins/bootstrap/js/bootstrap.min.js',
        'scripts/icheck.js',
		    'scripts/jquery.validate.min.js',

    ];

    public $jsOptions = array(
	     'position' => \yii\web\View::POS_HEAD
    );

    //public $depends = [
    //    'yii\web\YiiAsset',
    //    'yii\bootstrap\BootstrapAsset',
    //];
}
