<?php

return [
    // API
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => 'beer',
        'prefix' => 'api',
        'extraPatterns' => [
            'GET random' => 'random',
        ],
    ],
    // Web
    '/sobre' => 'site/about',
    '/contato' => 'site/contact',
];
