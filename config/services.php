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

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],
    'razorpay' => [
        'key' => env('RAZORPAY_KEY'),
        'secret' => env('RAZORPAY_SECRET'),
    ],
 'rapidapi' => [
        'key' => env('RAPID_API_KEY'),
    ],

    'msg91' => [
        'auth_key' => env('MSG91_AUTH_KEY'),
        'templates' => [
            'create_jobcard' => env('MSG91_TEMPLATE_CREATE_JOBCARD', '6aa7dfc8924b7dc6ea062552'),
            'process_jobcard' => env('MSG91_TEMPLATE_PROCESS_JOBCARD', '6aa8112e6ba6e69101032962'),
            'confirm_jobcard' => env('MSG91_TEMPLATE_CONFIRM_JOBCARD', '6aa812358d7e18faee0c5350'),
            'close_jobcard' => env('MSG91_TEMPLATE_CLOSE_JOBCARD', '6aa8131fb6d25ffc7403ad00'),
            'service_reminder' => env('MSG91_TEMPLATE_SERVICE_REMINDER', '6aa813a820187b97040ef082'),
        ],
    ],

];
