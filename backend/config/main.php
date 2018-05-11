<?php
use \yii\web\Request;
$baseUrl = str_replace('/backend/web', '', (new Request)->getBaseUrl());
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'kqxsmb-app-backend',
    'timeZone' => 'Asia/Bangkok', 
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'layout' => 'layoutTable',
    'bootstrap' => ['log'],
    'modules' => [
        'groupAccount' => [
            'class' => 'backend\modules\groupAccount\groupAccount',
        ],
        'groupAccountDetail' => [
            'class' => 'backend\modules\groupAccountDetail\groupAccountDetail',
        ],
        'groupPermissionAdvanced' => [
            'class' => 'backend\modules\groupPermissionAdvanced\groupPermissionAdvanced',
        ],
        'moduleManager' => [
            'class' => 'backend\modules\moduleManager\moduleManager',
        ],
        'site' => [
            'class' => 'backend\modules\site\site',
        ],

        'userPermissionAdvanced' => [
            'class' => 'backend\modules\userPermissionAdvanced\userPermissionAdvanced',
        ],
        'users' => [
            'class' => 'backend\modules\users\users',
        ],
        //DEMO API SV 
        // 'service' => [
        //     'class' => 'backend\modules\service\service',
        // ],
        'api' => [
            'class' => 'backend\modules\api\api',
        ],
        'dichvu' => [
            'class' => 'backend\modules\dichvu\dichvu',
        ],
        // ============= NV
        // 'post' => [
        //     'class' => 'backend\modules\post\post',
        // ],
        'sortViettel' => [
            'class' => 'backend\modules\sortViettel\sortViettel',
        ],
        'sortVinaphone' => [
            'class' => 'backend\modules\sortVinaphone\sortVinaphone',
        ],
        'sortMobifone' => [
            'class' => 'backend\modules\sortMobifone\sortMobifone',
        ],
        'dealers' => [
            'class' => 'backend\modules\dealers\dealers',
        ],
        'dealerRequest' => [
            'class' => 'backend\modules\dealerRequest\dealerRequest',
        ],
        'dealerRequestStatus' => [
            'class' => 'backend\modules\dealerRequestStatus\dealerRequestStatus',
        ],

        'services' => [
            'class' => 'backend\modules\services\services',
        ],
        'serviceRequest' => [
            'class' => 'backend\modules\serviceRequest\serviceRequest',
        ],
        'subscript' => [
            'class' => 'backend\modules\subscript\subscript',
        ],
        'subscriptStatus' => [
            'class' => 'backend\modules\subscriptStatus\subscriptStatus',
        ],
        'cdrRequest' => [
            'class' => 'backend\modules\cdrRequest\cdrRequest',
        ],
        'cdrStatic' => [
            'class' => 'backend\modules\cdrStatic\cdrStatic',
        ],
        'VnpSynchronizeSubcriberTransaction' => [
            'class' => 'backend\modules\VnpSynchronizeSubcriberTransaction\VnpSynchronizeSubcriberTransaction',
        ],
        // ============= NV
        // CHO PHEN FRONTEND KET HOP
        'trangchu' => [
            'class' => 'backend\modules\trangchu\trangchu',
        ],

    ],
    'components' => [
        
        'myEnum' => [
                'class' => 'backend\components\MyEnum', // extend User component
        ],
        'helper' => [
                'class' => 'common\components\Helper', // extend User component
        ],
        'phoneNumber' => [
                'class' => 'backend\components\PhoneNumber', // extend User component
        ],
        'acl' => [
            'class' => 'backend\components\Acl', // extend User component
        ],
        'airTimePermission' => [
            'class' => 'backend\components\AirTimePermission', // extend User component
        ],
        
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'vasDealer',
            
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
            'errorAction' => 'site/default/error',
        ],
         'request'=>[
            'baseUrl'=>$baseUrl,
        ],
        'urlManager' => [
                'baseUrl'=>$baseUrl,
                'enablePrettyUrl' => true,
                'showScriptName' => false,
                // 'suffix' => '.html',
                     'rules' => [
                        //==============================================================trang chu
                         ''                                                   => 'dealers/default/index',
                         'quan-tri'                                           => 'site/default/index',
                         
                         'sortVinaphone/list-post-by-cate'                    => 'sortVinaphone/default/list-post-by-cate',
                         
                         'sortMobifone/list-post-by-cate'                     => 'sortMobifone/default/list-post-by-cate',
                         
                         'sortViettel/list-post-by-cate'                      => 'sortViettel/default/list-post-by-cate',
                         // 'dichvu/<seviceCode:\w+>'                               => 'dichvu/default/index',
                         ['pattern'=>'dichvu/<seviceCode:\w+>','route'=>'dichvu/default/index',  'suffix'=>'.html'],
                         '<module:\w+>/<action:\w+>'                          => '<module>/default/<action>',
                         
                         '<module:\w+><controller:\w+>/<id:\d+>'              => '<module><controller>/view',
                         '<module:\w+><controller:\w+>/<action:\w+>/<id:\d+>' => '<module><controller>/<action>',
                         '<module:\w+><controller:\w+>/<action:\w+>'          => '<module><controller>/<action>',
                         
                         '<controller:\w+>/<id:\d+>'                          => '<controller>/view',
                         '<controller:\w+>/<action:\w+>/<id:\d+>'             => '<controller>/<action>',
                         '<controller:\w+>/<action:\w+>'                      => '<controller>/<action>',
                ],
        ],
        
        // 'urlManager' => [
        //     'enablePrettyUrl' => true,
        //     'showScriptName' => false,
        //     'rules' => [
        //     ],
        // ],
        
    ],
    'params' => $params,
];
