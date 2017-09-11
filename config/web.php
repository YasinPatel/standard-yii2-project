<?php
use \yii\web\Request;

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');
$baseUrl = str_replace('/web', '', (new Request)->getBaseUrl());
$config = [
    'language' => 'en',
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'formatter' => [
          'nullDisplay' => '-'
        ],
        'mycomponent' => [
               'class' => 'app\components\MyComponent',
           ],
         'common' => [
                'class' => 'app\components\CommonComponent',
            ],
        'request' => [
            'baseUrl' => $baseUrl,
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'a9ncZ4lIfOb3Ur5NOtTnA5-vg7xmxLJA',
            'parsers' => [
                            'application/json'  => 'yii\web\JsonParser',
                        ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'assetManager' => [
           'bundles' => [             // you can override AssetBundle configs here
               'yii\web\JqueryAsset' => [
                   'sourcePath' => null,
                   'js' => []
               ],
               'yii\bootstrap\BootstrapPluginAsset' => [
                   'sourcePath' => null,
                   'js'=>[]
               ],
           ],
       ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => [
                'name' => '_frontendUserstart', // unique for frontend
            ]
        ],
        'session' => [
          'name' => 'PHPFRONTSESSIDstart',
          'savePath' => sys_get_temp_dir(),
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
            'class' => 'Swift_SmtpTransport',
            'host' => 'smtp.gmail.com',
            'username' => 'phppeerbits@gmail.com',
            'password' => 'php123456',
            'port' => '587',
            'encryption' => 'tls',
            ],
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

        'urlManager' => [
            'class'=>'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
              [
                  'class' => 'yii\rest\UrlRule',
                  'controller' => ['api/user'],
                      'except' => ['view','create','update','delete'],
                      'extraPatterns' => [
                      'POST forgotpassword' => 'forgotpassword',
                      'POST login' => 'login',
                      'POST logout' => 'logout',
                  ],
                  'pluralize' => false,
              ],
            ],
        ],
    ],
    'params' => $params,
    'modules' => [
        'gii' => [
          'class' => 'yii\gii\Module', //adding gii module
          'allowedIPs' => ['127.0.0.1', '::1','192.168.1.*'],  //allowing ip's
          'generators' => [ //here
														'crud' => [ // generator name
																		'class' => 'yii\gii\generators\crud\Generator', // generator class
																		'templates' => [ //setting for out templates
																						'adminLte' => '@app/adminLte/crud/default', // template name => path to template
																		]
														]
										],
        ],
       'debug' => [
            'class' => 'yii\\debug\\Module',
        ],
        'gridview' =>  [
            'class' => '\kartik\grid\Module',
        ],
        'admin' => [
          'class' => 'app\modules\admin\Module',
        ],
        'v1' => [
           'class' => 'app\modules\api\v1\Module',
       ],
    ]
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
    // $config['modules']['gii'] = [
    //     'class' => 'yii\gii\Module',
    //     // uncomment the following to add your IP if you are not connecting from localhost.
    //     //'allowedIPs' => ['127.0.0.1', '::1'],
    // ];
}

return $config;
