<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=yii2advanced',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => false,
            'messageConfig' => [
                'from' => ['support@khrizantema.ru' => 'khrizantema.ru']
            ],
            /*'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'mail.hosting.reg.ru',
                'username' => 'support@khrizantema.ru',
                'password' => '#mtgwar3#',
                'port' => '465',
                'encryption' => 'ssl',
            ],
            'messageConfig' => [
                'from' => ['support@khrizantema.ru' => 'khrizantema.ru']
            ],*/
        ],
        'robokassa' => [
            'sMerchantLogin' => '',
            'sMerchantPass1' => '',
            'sMerchantPass2' => '',
        ],
        'log' => [
            'traceLevel' => 3,
            'targets' => [
                [
                    'class' => 'common\components\EmailTarget',
                    'mailer' => 'mailer',
                    'levels' => ['error', 'warning'],
                    //'levels' => ['error'],
                    'message' => [
                        'subject' => 'Khrizantema.ru - внимание ошибка!',
                        'to' => ['admin@khrizantema.ru'],
                    ],
                ],
            ],
        ],
    ],
];
