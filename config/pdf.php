<?php

return [
    'mode'                  => 'utf-8',
    'format'                => 'A4',
    'author'                => 'Farid',
    'subject'               => '',
    'keywords'              => '',
    'creator'               => 'Farid',
    'display_mode'          => 'fullpage',
    'tempDir'               => base_path('../temp/'),
    'font_path' => base_path('public/fonts/'),
    'font_data' => [
        'fa' => [
            'R'  => 'fonts/ttf/IRANSansWeb(FaNum).ttf',
            'B'  => 'fonts/ttf/IRANSansWeb(FaNum)_Bold.ttf',
            'useOTL' => 0xFF,
            'useKashida' => 75,
        ],
        'en' => [
            'R'  => 'Gothic/Century Gothic.ttf',
            'B'  => 'Gothic/GOTHICB.ttf',
        ]
    ]
];
