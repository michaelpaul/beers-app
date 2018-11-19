<?php
/**
 * Application configuration shared by all test types
 */
return yii\helpers\ArrayHelper::merge(require 'web.php', [
    'id' => 'basic-tests',
    'basePath' => dirname(__DIR__),
    'components' => [
        'db' => require __DIR__ . '/test_db.php',
        'mailer' => [
            'useFileTransport' => true,
        ],
        'assetManager' => [
            'basePath' => __DIR__ . '/../web/assets',
        ],
        'request' => [
            'cookieValidationKey' => 'test',
            'enableCsrfValidation' => false,
        ],
    ]
]);
