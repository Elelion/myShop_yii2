<?php
namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ieAppAsset extends AssetBundle
{
	public $basePath = '@webroot';
  public $baseUrl = '@web';

	public $js = [
		'js/html5shiv.js',
		'js/respond.min.js',
  ];

  // NOTE: specifies the connection condition for all of the above scripts
  public $jsOptions = [
    'condition' => 'lte IE9',

    // NOTE: we say that our scripts are connected in the header
    'position' => \yii\web\View::POS_HEAD,
  ];
}

/**
 * NOTE:
 * lte - operator < or =. The condition is true if the version
 * is younger than or equal to the specified one.
 *
 * condition - to wrap a <link tag using conditional comments
 * with a specific condition
 */