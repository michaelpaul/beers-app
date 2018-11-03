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
    '/' => 'site/index',
    '/about' => 'site/about',
    '/contact' => 'site/contact',
    '/captcha' => 'site/captcha',
    '/login' => 'site/login',
    '/logout' => 'site/logout',
];
