<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = [
		// 'css/bootstrap.min.css',

		'css/font-awesome.min.css',
		'css/prettyPhoto.css',
		'css/price-range.css',
		'css/animate.css',
		'css/main.css',
		'css/responsive.css',
		'css/site.css',
	];
	public $js = [
		// 'js/jquery.js',
		// 'js/bootstrap.min.js',

		'js/jquery.scrollUp.min.js',
		'js/price-range.js',
		'js/jquery.prettyPhoto.js',

        /*
         * NOTE:
         * jquery.accordion.js - remembers the state of the accordion
         * */
        'js/jquery.accordion.js',
        'js/jquery.cookie.js',

        'js/main.js',
	];
	public $depends = [
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapPluginAsset',
	];
}

/**
 * NOTE:
 * • 'yii\bootstrap\BootstrapAsset', -> BootstrapPluginAsset
 *
 * • disabled:
 * 'css/bootstrap.min.css'
 * 'js/jquery.js',
 * 'js/bootstrap.min.js',
 * because this dependency already contains this css and js -> BootstrapAsset
 * BUT, if we want to connect our styles and scripts,
 * we need to disable it -> BootstrapAsset, and including our css and js
 */