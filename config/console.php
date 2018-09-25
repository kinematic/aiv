<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');
$db_local_postgres = require(__DIR__ . '/db_local_postgres.php');
$db_remote_mysql = require(__DIR__ . '/db_remote_mysql.php');
$db_remote_mysql_aiv = require(__DIR__ . '/db_remote_mysql_aiv.php');
$db_remote_oracle = require(__DIR__ . '/db_remote_oracle.php');

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db_local_postgres,
		'db2' => $db_remote_mysql,
		'db_remote_mysql_aiv' => $db_remote_mysql_aiv,
		'db_remote_oracle' => $db_remote_oracle,
    ],
    'params' => $params,

    'controllerMap' => [
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'interactive' => [
                'false'
            ],
        ],
    ],

];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
