<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
    'client_id' => '450679821978171
',
    'client_secret' => 'faae7ed76880a43a9c93b8437c31e606',
    'redirect' => 'http://localhost/webson/public/login/facebook/callback',
    ],

    'google' => [
        'client_id' => '827085715012-sdp6lahabgc5jvdhvnki0q7dfirbfpbf.apps.googleusercontent.com',
        'client_secret' => '_lvVD72Vwdrh4R_yX0p-O2hl',
        'redirect' => 'http://localhost/webson/public/login/google/callback',
    ],
];
