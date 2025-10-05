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

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'tmdb' => [
        'api_key' => env('TMDB_API_KEY'),
        'access_token' => env('TMDB_ACCESS_TOKEN'),
        'base_url' => env('TMDB_BASE_URL', 'https://api.themoviedb.org/3'),
    ],

    'vidlink' => [
        'base_url' => env('VIDLINK_BASE_URL', 'https://vidlink.pro'),
    ],

    'mal' => [
        'client_id' => env('MAL_CLIENT_ID'),
        'client_secret' => env('MAL_CLIENT_SECRET'),
        'base_url' => env('MAL_BASE_URL', 'https://vidlink.pro'),
    ],

];
