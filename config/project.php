<?php
/*
    |--------------------------------------------------------------------------
    | Application Environment For Project
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
    */

//Note : Set all the variables used here in environemnt variable first and then use it here //Security purpose during upload to git
return [
    /**
     * url or domain name
     */
    'app_url' => env('APP_URL'),

    /**
     * google firebase key and its url
     */
    'firebase_key' => env('FIREBASE_KEY'),
    'firebase_url' => env('FIREBASE_URL'),
    'test_notification_key' => env('TEST_NOTIFICATION_KEY'),
    
];
