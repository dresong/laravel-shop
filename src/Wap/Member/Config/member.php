<?php

return [
    "wechat" => [
        'official_account' => [
            'default' => [
                'app_id' => env('WECHAT_OFFICIAL_ACCOUNT_APPID', 'dre-your-app-id'),         // AppID
                'secret' => env('WECHAT_OFFICIAL_ACCOUNT_SECRET', 'dre-your-app-secret'),    // AppSecret
                'token' => env('WECHAT_OFFICIAL_ACCOUNT_TOKEN', 'dre-your-token'),           // Token
                'aes_key' => env('WECHAT_OFFICIAL_ACCOUNT_AES_KEY', ''),                 // EncodingAESKey

                /*
                 * OAuth 配置
                 *
                 * scopes：公众平台（snsapi_userinfo / snsapi_base），开放平台：snsapi_login
                 * callback：OAuth授权完成后的回调页地址(如果使用中间件，则随便填写。。。)
                 */
                'oauth' => [
                    'scopes'   => array_map('trim', explode(',', env('WECHAT_OFFICIAL_ACCOUNT_OAUTH_SCOPES', 'snsapi_userinfo'))),
                    'callback' => env('WECHAT_OFFICIAL_ACCOUNT_OAUTH_CALLBACK', '/examples/oauth_callback.php'),
                ],
            ],
        ],
      ],

    "auth" => [
        'controller' => Dresong\LaravelShop\Wap\Member\Http\Controllers\AuthorizationController::class,

        'guard' => 'member',

        'guards' => [
            'member' => [
                'driver' => 'session',
                'provider' => 'members',
            ]
        ],

        'providers' => [
            'members' => [
                'driver' => 'eloquent',
                'model' => Dresong\LaravelShop\Wap\Member\Models\User::class,
            ]
        ]
    ]
];
