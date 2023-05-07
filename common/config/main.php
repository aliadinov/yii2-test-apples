<?php

use common\repositories\AppleRepository;
use common\services\ApplesService;

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
    ],
    'container' => [
        'singletons' => [
            ApplesService::class => [
                'class' => ApplesService::class
            ],
            AppleRepository::class => [
                'class' => AppleRepository::class
            ]
        ],
    ]
];
