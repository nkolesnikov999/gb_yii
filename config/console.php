<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

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
        'db' => $db,
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'transport' => [
            'class' => 'Swift_SmtpTransport',
            'host' => 'spl42.hosting.reg.ru', // введите хост или ip почтового сервера
            'username' => 'nk@nkpro.net', // введите логин
            'password' => '', // введите пароль
            'port' => '587',    // порт назначается в зависимости от службы
            'encryption' => 'tls',
             ],
        ],
        //пример для отправки через gmail.com
        /*'mail' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'username@gmail.com',
                'password' => 'password',
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],*/
        //пример для отправки через MS Exchange
        /*'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
                'transport' => [
                    'class' => 'Swift_SmtpTransport',
                    'host' => 'exchange.example.com', //вставляем имя или адрес почтового сервера
                    'username' => '', 
                    'password' => '',
                    'port' => '25',
                    'encryption' => '',
            ],
        ],*/
    ],
    'params' => $params,
    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    */
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
