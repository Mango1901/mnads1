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
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'facebook' => [
        'client_id' => '266326077819274',
        'client_secret' => '9cc05f7194483fe80bc024ef9c9d9b03',
        'redirect' =>  env('APP_URL')."/callback/facebook",
    ],
    'google' => [
        'client_id' => '913802604798-i6vvqd8msig9mbjt2i078e9ako5reb67.apps.googleusercontent.com',
        'client_secret' => 'ihmDgRfglKGSG8USbVXVXXI0',
        'redirect' =>  env('APP_URL')."/google/callback"
    ],
];
