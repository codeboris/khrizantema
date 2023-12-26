<?php

$config = [
    'components' => [
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'vkontakte' => [
                    'class' => 'yii\authclient\clients\VKontakte',
                    'clientId' => '',// template  ~ 7001251
                    'clientSecret' => '', // template ~ zaTA9odY1CHEksPjLir1
                ],
                'github' => [
                    'class' => 'yii\authclient\clients\GitHub',
                    'clientId' => '',// template ~ b1b37d10626c7b7a8b60
                    'clientSecret' => '', // template ~ db56dee1bda79c43fbf0cf296ec399afe9bcced6
                ],
            ],
        ],
    ]
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
