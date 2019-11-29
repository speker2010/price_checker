<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'components' => [
        'db' => $db,
        'mailer' => [ //https://www.yiiframework.com/extension/yiisoft/yii2-swiftmailer/doc/api/2.1/yii-swiftmailer-mailer
            'class' => 'Swift_SmtpTransport',
            'host' => 'localhost',
            'username' => 'username',
            'password' => 'password',
            'port' => '587',
            'encryption' => 'tls',
        ]
    ],
    'params' => array_merge($params, [
        'reports-email' => 'my@domain.ru', // Reports will send to my@domain.ru email
        'from-email' => 'my@domain.ru' // Reports will send from my@domain.ru email
    ]),
    'controllerMap' => [
        'parse' => 'app\commands\ParseController'
    ],
];

return $config;
