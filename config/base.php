<?php

/*
 * The default file system disk used is 'Public'.
 * Any path unless specified is relative to 'storage/app/public'.
 */

return [

    /**
    |--------------------------------------------------------------------------
    | Default file upload configurations
    |--------------------------------------------------------------------------
     */

    'uploads' => [
        'image' => [
            'encode' => 'jpg',
            'allowed_mime' => ['jpeg', 'png', 'bmp'],
        ],
    ],

    /**
    |--------------------------------------------------------------------------
    | User specific configurations
    |--------------------------------------------------------------------------
     */

    'user' => [
        'upload' => [
            'profile-picture' => [
                'path' => 'uploads/user/profile-picture/',
                'image' => [
                    'min_resolution' => 100,
                    'store_resolution' => 150,
                    'max_file_size_kb' => 5000,
                ],
            ],
        ],
    ],

/**
    |--------------------------------------------------------------------------
    | FrontPage images specific configurations
    |--------------------------------------------------------------------------
     */

    'cms' => [
        'upload' => [
            'web-picture' => [
                'path' => 'uploadwebfrontfiles/',
                'image' => [
                    'min_resolution' => 100,
                    'store_resolution' => 150,
                    'max_file_size_kb' => 50000,
                ],

            ],
        ],
    ],

    /**
    |--------------------------------------------------------------------------
    | Driver specific configurations
    |--------------------------------------------------------------------------
     */

    'driver' => [
        'upload' => [
            'profile-picture' => [
                'path' => 'uploads/driver/profile-picture/',
                'image' => [
                    'min_resolution' => 100,
                    'store_resolution' => 150,
                    'max_file_size_kb' => 500,
                ],
            ],
                'documents' => [
                'path' => 'uploads/driver/documents/',
                'image' => [
                    'min_resolution' => 100,
                    'store_resolution' => 1024,
                    'max_file_size_kb' => 5000,
                ],
            ],
        ],
    ],

    /**
    |--------------------------------------------------------------------------
    | Sytem-Admin specific configurations
    |--------------------------------------------------------------------------
     */

    'system-admin' => [
        'upload' => [
            'logo' => [
                'path' => 'uploads/system-admin/logo/',
                'image' => [
                    'min_resolution' => 1000,
                    'store_resolution' => 150,
                    'max_file_size_kb' => 500,
                ],
            ],
        ],
    ],
    /**
    *|--------------------------------------------------------------------------
    *| Request configurations
    *|--------------------------------------------------------------------------
    */
    'request' => [
        'upload' => [
            'delivery-proof' => [
                'path' => 'uploads/delivery-proof/images/',
                'image' => [
                    'min_resolution' => 100,
                    'store_resolution' => 1250,
                    'max_file_size_kb' => 5000,
                ],
            ],
        ],
    ],
    /**
    |--------------------------------------------------------------------------
    | User specific configurations
    |--------------------------------------------------------------------------
     */

    'types' => [
        'upload' => [
            'images' => [
                'path' => 'uploads/types/images/',
                'image' => [
                    'min_resolution' => 100,
                    'store_resolution' => 150,
                    'max_file_size_kb' => 500,
                ],
            ],
        ],
    ],
     /**
    *|--------------------------------------------------------------------------
    *| Banner Image specific configurations
    *|--------------------------------------------------------------------------
    */

    'banner' => [
        'upload' => [
            'banner-image' => [
                'path' => 'uploads/banner/banner-image/',
                'image' => [
                    'min_resolution' => 100,
                    'store_resolution' => 1250,
                    'max_file_size_kb' => 10000,
                ],
            ],
        ],
    ],


    /**
    |--------------------------------------------------------------------------
    | APP BUILD specific configurations
    |--------------------------------------------------------------------------
     */

    'app-build' => [
        'upload' => [
            'ios-builds' => [
                'ipa'=>[
                'path' => 'uploads/builds/ios/ipa/',
                ],
                'plist'=>[
                    'path'=>'uploads/builds/ios/plist/'
                ]
            ],
            'android-builds' => [
                'apk'=>[
                'path' => 'uploads/builds/android/apk',
                ],
            ],
        ],
    ],
    /**
    |--------------------------------------------------------------------------
    | Companies specific configurations
    |--------------------------------------------------------------------------
     */

    'company' => [
        'upload' => [
            'images' => [
                'path' => 'uploads/company/icons/',
                'image' => [
                    'min_resolution' => 100,
                    'store_resolution' => 150,
                    'max_file_size_kb' => 500,
                ],
            ],
        ],
    ],

    /**
    * |--------------------------------------------------------------------------
    * | Owner specific configurations
    * |--------------------------------------------------------------------------
    */

    'owner' => [
        'upload' => [
            'profile-picture' => [
                'path' => 'uploads/owner/profile-picture/',
                'image' => [
                    'min_resolution' => 100,
                    'store_resolution' => 150,
                    'max_file_size_kb' => 500,
                ],
            ],
                'documents' => [
                'path' => 'uploads/owner/documents/',
                'image' => [
                    'min_resolution' => 100,
                    'store_resolution' => 1250,
                    'max_file_size_kb' => 10000,
                ],
            ],
        ],
    ],
    /**
    *|--------------------------------------------------------------------------
    *| Country specific configurations
    *|--------------------------------------------------------------------------
    */
    'country' => [
        'upload' => [
            'flag' => [
                'path' => 'images/country/flags/',
                'image' => [
                    'min_resolution' => 100,
                    'store_resolution' => 150,
                    'max_file_size_kb' => 500,
                ],
            ],
        ],
    ],

     /**
    *|--------------------------------------------------------------------------
    *| Fleet Vehicle specific configurations
    *|--------------------------------------------------------------------------
    */

    'fleets' => [
        'upload' => [
            'images' => [
                'path' => 'uploads/fleets/images/',
                'image' => [
                    'min_resolution' => 100,
                    'store_resolution' => 150,
                    'max_file_size_kb' => 500,
                ],
            ],
        ],
    ],


    /**
    *|--------------------------------------------------------------------------
    *| Push Notification configurations
    *|--------------------------------------------------------------------------
    */
    'pushnotification' => [
        'upload' => [
            'images' => [
                'path' => 'uploads/push-notification/images/',
                'image' => [
                    'min_resolution' => 100,
                    'store_resolution' => 1250,
                    'max_file_size_kb' => 500,
                ],
            ],
        ],
    ],


    /**
    |--------------------------------------------------------------------------
    | Default common configurations
    |--------------------------------------------------------------------------
     */

    'default' => [
        /*
                     * The paths are relative to the public folder 'public'.
        */
        'user' => [
            'profile_picture' => '/assets/images/default-profile-picture.png',
        ],

    ],

    'pdf' => [
        'generator' => 'dompdf.wrapper',
    ],

    /**
    |--------------------------------------------------------------------------
    | Web/App configurations
    |--------------------------------------------------------------------------
     */

    'web' => [
        'verification' => [
            'google' => env('GOOGLE_VERIFICATION_KEY'),
            'bing' => env('BING_VERIFICATION_KEY'),
        ],

        'links' => [
            'facebook' => env('FACEBOOK_LINK'),
            'twitter' => env('TWITTER_LINK'),
            'instagram' => env('INSTAGRAM_LINK'),
            'google_plus' => env('GOOGLEPLUS_LINK'),
            'linkedin' => env('LINKEDIN_LINK'),
        ],
    ],

    'payment_gateway' => [
        'braintree' => [
            'class' => 'App\Base\Payment\BrainTree'
        ],
        'stripe' => [
            'class' => 'App\Base\Payment\Stripe'
        ]
    ],


    /**
    *|--------------------------------------------------------------------------
    *| Onboarding specific configurations
    *|--------------------------------------------------------------------------
    */

    'onboarding' => [
        'upload' => [
                'path' => 'onboarding/upload/',
                'image' => [
                    'min_resolution' => 100,
                    'store_resolution' => 1250,
                    'max_file_size_kb' => 500,
            ],
        ],
    ],

];
