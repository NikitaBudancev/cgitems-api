<?php

return [

    'disk' => [
        'image' => 'images',
        'cache' => 'resize',
    ],

    'cache_prefix' => 'media_',

    'strategies' => [
        'image' => ['image', 'preview', 'avatar'],
        'file' => ['file'],
    ],

    'user' => [
        'avatar' => [
            'folder' => 'avatars',
            'sizes' => [
                'large' => ['width' => 1000, 'height' => 1000],
                'medium' => ['width' => 400, 'height' => 400],
                'small' => ['width' => 120, 'height' => 120],
            ],
        ],
    ],

    'project_stage' => [
        'preview' => [
            'folder' => 'projects',
            'sizes' => [
                'large' => ['width' => 1200, 'height' => 675],
                'medium' => ['width' => 900, 'height' => 510],
                'small' => ['width' => 520, 'height' => 288],
            ],
        ],

        'image' => [
            'folder' => 'projects',
            'sizes' => [
                'large' => ['width' => 1700, 'height' => 980],
                'medium' => ['width' => 1200, 'height' => 674],
                'small' => ['width' => 600, 'height' => 336],
            ],
        ],
    ],
];
