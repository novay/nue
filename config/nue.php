<?php 

use App\Providers\RouteServiceProvider;
use Novay\Nue\Features;

return [

    /*
    |--------------------------------------------------------------------------
    | Nue name
    |--------------------------------------------------------------------------
    |
    | This value is the name of Nue, This setting is displayed on the
    | login page.
    |
    */
    'name' => 'Nue UI',

    /*
    |--------------------------------------------------------------------------
    | Nue brand files
    |--------------------------------------------------------------------------
    |
    | This value is the default assets for Nue Admin.
    |
    */
    'brand' => [
        
        'favicon' => 'https://cdn.btekno.id/img/logo.svg', 

        'logo' => [

            'default' => [

                'light' => 'https://cdn.btekno.id/img/logo.svg', 

                'dark' => 'https://cdn.btekno.id/img/logo-inverse.svg'

            ],

            'mini' => [

                'light' => 'https://cdn.btekno.id/img/logo.svg', 

                'dark' => 'https://cdn.btekno.id/img/logo-inverse.svg'

            ],
        ], 

        'default_avatar' => 'https://cdn.btekno.id/templates/v2/img/160x160/img1.jpg'
    ], 

    /*
    |--------------------------------------------------------------------------
    | Nue Prefix
    |--------------------------------------------------------------------------
    |
    | You may specify prefix if you want to add some word on your specified url.
    | For example: Instead of "localhost/login", you can add prefix here to
    | "localhost/prefix/login" for example.
    |
    */

    'prefix' => env('NUE_PREFIX', ''),

    /*
    |--------------------------------------------------------------------------
    | Nue Guard
    |--------------------------------------------------------------------------
    |
    | Here you may specify which authentication guard Nue will use while
    | authenticating users. This value should correspond with one of your
    | guards that is already present in your "auth" configuration file.
    |
    */

    'guard' => env('NUE_AUTH_GUARD', 'web'),

    /*
    |--------------------------------------------------------------------------
    | Nue Routes Middleware
    |--------------------------------------------------------------------------
    |
    | Here you may specify which middleware Nue will assign to the routes
    | that it registers with the application. If necessary, you may change
    | these middleware but typically this provided default is preferred.
    |
    */

    'middleware' => env('NUE_AUTH_MIDDLEWARE', ['web']),

    /*
    |--------------------------------------------------------------------------
    | Home Path
    |--------------------------------------------------------------------------
    |
    | Here you may configure the path where users will get redirected during
    | authentication or password reset when the operations are successful
    | and the user is authenticated. You are free to change this value.
    |
    | Default use: RouteServiceProvider::HOME
    |
    */

    'home' => env('NUE_AUTH_HOME', RouteServiceProvider::HOME),

    /*
    |--------------------------------------------------------------------------
    | Username / Email
    |--------------------------------------------------------------------------
    |
    | This value defines which model attribute should be considered as your
    | application's "username" field. Typically, this might be the email
    | address of the users but you are free to change this value here.
    |
    | For your information, reset passwords and email verification feature 
    | only work only if you use email as default username field.
    |
    */

    'username' => env('NUE_AUTH_USERNAME', 'email'),

    /*
    |--------------------------------------------------------------------------
    | Features
    |--------------------------------------------------------------------------
    |
    | Some of the Nue features are optional. You may disable the features
    | by removing them from this array. You're free to only remove some of
    | these features or you can even remove all of these if you need to.
    |
    */

    'features' => [
        Features::registration(),
        Features::resetPasswords(),
        Features::emailVerification(),
        Features::updateProfile(),
        Features::updateEmail(),
        Features::updatePassword(),
        Features::profilePhoto(),
        Features::terminateAccount(),
    ],

    /*
    |--------------------------------------------------------------------------
    | Profile Photo Disk
    |--------------------------------------------------------------------------
    |
    | This configuration value determines the default disk that will be used
    | when storing profile photos for your application's users. Typically
    | this will be the "public" disk but you may adjust this if needed.
    |
    */

    'profile_photo_disk' => env('NUE_AUTH_PHOTO', 'public'),
];