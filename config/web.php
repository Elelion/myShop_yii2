<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],

    // NOTE: setting the language
    'language' => 'ru-RU',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],

    /*
     * NOTE:
     * look in: controllers -> CategoryController.php
     * !!!rules in ... must be removed!!!
     *
     * if this doesn't work, see  urlManager -> rules
     * '' => 'site/index',
     * '' => 'category/index',
     * */
    //'defaultRoute' => 'main',
    'defaultRoute' => 'category/index',

    // NOTE: setting the language
    // 'language' => 'ru-RU',

    'components' => [
        'request' => [
            /**
			 * NOTE:
			 * insert a secret key in the following
			 * (if it is empty) - this is required by cookie validation
			 */
            'cookieValidationKey' => 'sd*#Dsdj8sad9s8ad8S',

            // NOTE: include Human-friendly URL
            // 'baseUrl' => $baseUrl,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,

        // NOTE: include Human-friendly URL
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                //'' => 'site/index',
                //'' => 'category/index',

                // NOTE: making links beautiful
                'category/<id:\d+>' => 'category/view',
            ]
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
