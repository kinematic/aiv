<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'Y1yAnFGPUa9pU7EkEHOzGf_GyiOWvtCM',
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
            'transport' => [
				'class' => 'Swift_SmtpTransport',
				'host' => 'smtp.gmail.com',
				'username' => 'neron.marchenko@gmail.com',
				'password' => 'Marchuk44!',
				'port' => '587',
				'encryption' => 'tls',
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    //'levels' => ['error', 'warning'],
                    'levels' => ['profile'],
                    'enabled' => true,
                ],
            ],
        ],
//         'elasticsearch' => [
//             'class' => 'yii\elasticsearch\Connection',
//             'nodes' => [
//             ['http_address' => '127.0.0.1:9200'],
//             // configure more hosts if you have a cluster
//             ],
//         ],
        'db' => require(__DIR__ . '/db.php'),
		'db2' => require(__DIR__ . '/db2.php'),
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'traceLine' => '<a href="kate://open?url={file}&line={line}">{file}:{line}</a>',
        'allowedIPs' => ['*'],
        'panels' => [
            'db' => [
                'class' => 'yii\debug\panels\DbPanel',
                'defaultOrder' => [
                    'seq' => SORT_ASC
                ],
                'defaultFilter' => [
                    'type' => 'SELECT'
                ]
            ],
        ],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['*'],
    ];
}

return $config;
