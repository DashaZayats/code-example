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
           'siteKey' => '',
           'secret' => '',
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
                
                
                    'parser' => 'parser/index',
                    'parser/product' => 'parser/product',
                    'parser/image' => 'parser/image',
                    'parser/updateimage' => 'parser/updateimage',
                    'parser/moto' => 'parser/moto',
                    'parser/motoproduct' => 'parser/motoproduct',
                
                    'parser-garnityra' => 'parser-garnityra/index',
                    'parser-garnityra/product' => 'parser-garnityra/product',
                    'parser-garnityra/option' => 'parser-garnityra/option',
                    'parser-garnityra/image' => 'parser-garnityra/image',
                
                    'parser-kurtki' => 'parser-kurtki/index',
                    'parser-kurtki/product' => 'parser-kurtki/product',
                    'parser-kurtki/option' => 'parser-kurtki/option',
                    'parser-kurtki/image' => 'parser-kurtki/image',
                    'parser-kurtki/seoproduct' => 'parser-kurtki/seoproduct',
                    'parser-kurtki/maincategory' => 'parser-kurtki/maincategory',
                    'parser-kurtki/setimages' => 'parser-kurtki/setimages',
                
                
                    'parser-schem' => 'parser-schem/index',
                    'parser-schem/product' => 'parser-schem/product',
                    'parser-schem/option' => 'parser-schem/option',
                    'parser-schem/image' => 'parser-schem/image',
                    'parser-schem/seoproduct' => 'parser-schem/seoproduct',
                    'parser-schem/maincategory' => 'parser-schem/maincategory',
                    'parser-schem/setimages' => 'parser-schem/setimages',
                    'parser-schem/seo' => 'parser-schem/seo',
                    'parser-schem/brend' => 'parser-schem/brend',
                    'parser-schem/brend-image' => 'parser-schem/brend-image',
                
                    'avito' => 'avito/index',
                
                    'controller/action/' => 'controller/action',
                    '<url:.+>/' => 'site/redirect',
                ),
        ],
 
    ],
    'params' => $params,
    'timeZone' => 'Europe/Minsk',
];
