<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'name' => 'Freetask.online',
    'basePath' => dirname(__DIR__),
    'language' => 'ru',
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => '',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'reCaptcha' => [
           'name' => 'reCaptcha',
           'class' => 'himiklab\yii2\recaptcha\ReCaptcha',
           'siteKey' => '6LdCaSEiAAAAAEII30vDo9Uo-lMxoheTwr6qhz4Z',
           'secret' => '6LdCaSEiAAAAAOBnTYdhuUyKPAxfmP5zBBxWe-Lh',
           ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => true, 
            'suffix' => '',
            'rules' => array(
                    '/' => 'site/index', //для главной страницы
                   
                    'site/captcha' => 'site/captcha', //для капчи ничего не меняем
                    //эти страницы будут открываться при указании только одного действия
                    '<action:search|login|logout|signup|request-password-reset|about|contact|upload>' => 'site/<action>',
                    'jobs' => 'jobs/index',
                    'jobs/search' => 'jobs/search',
               //     'jobs/<id:[-_0-9a-zA-Z]+>/' => 'jobs/view',
                    'jobs/<slug:[-_0-9a-zA-Z]+>/' => 'jobs/view',
                    'responses/create' => 'responses/create',
                    'projects' => 'projects/index',
                    'projects/create' => 'projects/create',
                    'projects/update/<id:[-_0-9a-zA-Z]+>/' => 'projects/update',
                    'projects/updateresponses/<id:[-_0-9a-zA-Z]+>/' => 'projects/updateresponses',
                    'projects/<url:[-_0-9a-zA-Z]+>/' => 'projects/view',
                    'profile' => 'profile/index',
                    'profile/responses' => 'profile/responses',
                    'profile/response/<id:[-_0-9a-zA-Z]+>/' => 'profile/response',
                    'profile/project/<id:[-_0-9a-zA-Z]+>/' => 'profile/project',
                    'profile/projects' => 'profile/projects',
                    'profile/view' => 'profile/view',
                    'profile/update' => 'profile/update',
                    'messages/create' => 'messages/create',
                    'messages/createresponses' => 'messages/createresponses',
                    'sitemap.xml' => 'site/sitemap',
                    'controller/action/' => 'controller/action',
                    '<url:.+>/' => 'site/redirect',
                ),
        ],
 
    ],
    'params' => $params,
    'timeZone' => 'Europe/Minsk',
];
