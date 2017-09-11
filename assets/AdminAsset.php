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
class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css =
    [
        'plugins/bootstrap/css/bootstrap.min.css',
        'plugins/font-awesome/css/font-awesome.min.css',
		    'css/ionicons.min.css',
        'css/AdminLTE.min.css',
		    'css/custom.css',
        'css/skins/_all-skins.min.css',
		    'plugins/bootstrap-fileupload/bootstrap-fileupload.css',
        'plugins/toastr/toastr.css',
        'plugins/bootstrap-datepicker/css/datepicker.css',
        'plugins/timepicker/bootstrap-timepicker.min.css',
    ];

    public $js =
    [
        'scripts/jquery-2.2.3.min.js',
        'plugins/bootstrap/js/bootstrap.min.js',
        'scripts/fastclick.js',
    		'scripts/app.min.js',
    		'scripts/demo.js',
    		'scripts/jquery.validate.min.js',
    		'plugins/bootstrap-fileupload/bootstrap-fileupload.js',
        'plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
        'plugins/timepicker/bootstrap-timepicker.min.js',
        'plugins/toastr/toastr.min.js',
    ];

	public $jsOptions = array(
	'position' => \yii\web\View::POS_HEAD
	);

    //public $depends = [
    //    'yii\web\YiiAsset',
    //    'yii\bootstrap\BootstrapAsset',
    //];
}
