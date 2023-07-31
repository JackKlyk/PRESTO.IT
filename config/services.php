<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],


    'google' => [
        'client_id' => '426717501593-6tdd50623198gi1e8j8u4un04mqc2iki.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://127.0.0.1:8000/login/google/callback',
    ],

    'github' => [
        'client_id' => '349501a686b05ff7344b',
        'client_secret' => '876c46cc9a4ccf5526064d8723bb7a6e7d787381',
        'redirect' => 'http://127.0.0.1:8000/login/github/callback',
    ],

    // 'facebook' => [
    //     'client_id' => '279242031348661',
    //     'client_secret' => 'c1fb6b769a2a09d2e4302c8070e85ba5',
    //     'redirect' => 'http://127.0.0.1:8000/login/facebook/callback',
    // ],
];
