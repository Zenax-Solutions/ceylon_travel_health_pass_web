<?php

return [
    'name' => 'Ceylon Travel & Health Pass',
    'manifest' => [
        'name' => 'Ceylon Travel & Health Pass',
        'short_name' => 'CTP',
        'start_url' => 'https://healthpass.supunnethsara.dev/app/mobile/home',
        'background_color' => '#ffffff',
        'theme_color' => '#22c55e',
        'display' => 'standalone',
        'orientation'=> 'any',
        'status_bar'=> '#22c55e',
        'icons' => [
            '72x72' => [
                'path' => '/images/icons/logo.png',
                'purpose' => 'any'
            ],
            '96x96' => [
                'path' => '/images/icons/logo.png',
                'purpose' => 'any'
            ],
            '128x128' => [
                'path' => '/images/icons/logo.png',
                'purpose' => 'any'
            ],
            '144x144' => [
                'path' => '/images/icons/logo.png',
                'purpose' => 'any'
            ],
            '152x152' => [
                'path' => '/images/icons/logo.png',
                'purpose' => 'any'
            ],
            '192x192' => [
                'path' => '/images/icons/logo.png',
                'purpose' => 'any'
            ],
            '384x384' => [
                'path' => '/images/icons/logo.png',
                'purpose' => 'any'
            ],
            '512x512' => [
                'path' => '/images/icons/logo.png',
                'purpose' => 'any'
            ],
        ],
        'splash' => [
            '640x1136' => '/images/icons/splash.png',
            '750x1334' => '/images/icons/splash.png',
            '828x1792' => '/images/icons/splash.png',
            '1125x2436' => '/images/icons/splash.png',
            '1242x2208' => '/images/icons/splash.png',
            '1242x2688' => '/images/icons/splash.png',
            '1536x2048' => '/images/icons/splash.png',
            '1668x2224' => '/images/icons/splash.png',
            '1668x2388' => '/images/icons/splash.png',
            '2048x2732' => '/images/icons/splash.png',
        ],
        'shortcuts' => [
            [
                'name' => 'Shortcut Link 1',
                'description' => 'Shortcut Link 1 Description',
                'url' => '/shortcutlink1',
                'icons' => [
                    "src" => "/images/icons/logo.png",
                    "purpose" => "any"
                ]
            ],
            [
                'name' => 'Shortcut Link 2',
                'description' => 'Shortcut Link 2 Description',
                'url' => '/shortcutlink2'
            ]
        ],
        'origin_urls' => [
            'https://healthpass.supunnethsara.dev/agent/login',
            'https://healthpass.supunnethsara.dev/destination/login',
        ],
        'custom' => []
    ]
];
