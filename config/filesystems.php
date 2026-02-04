<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application for file storage.
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Below you may configure as many filesystem disks as necessary, and you
    | may even configure multiple disks for the same driver. Examples for
    | most supported storage drivers are configured here for reference.
    |
    | Supported drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app/private'),
            'serve' => true,
            'throw' => false,
            'report' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => rtrim(env('APP_URL'), '/').'/storage',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],

        'foto' => [
            'driver' => 'local',
            'root' => '/home/kemg7663/public_html/foto',
            'url' => rtrim(env('APP_URL'), '/') . '/foto',
            'visibility' => 'public',
        ],

        'infografis' => [
            'driver' => 'local',
            'root' => '/home/kemg7663/public_html/infografis',
            'url' => rtrim(env('APP_URL'), '/') . '/infografis',
            'visibility' => 'public',
        ],

        'video' => [
            'driver' => 'local',
            'root' => '/home/kemg7663/public_html/video',
            'url' => rtrim(env('APP_URL'), '/') . '/video',
            'visibility' => 'public',
        ],

        'services' => [
            'driver' => 'local',
            'root' => '/home/kemg7663/public_html/services',
            'url' => rtrim(env('APP_URL'), '/') . '/services',
            'visibility' => 'public',
        ],

        'slideshows' => [
            'driver' => 'local',
            'root' => '/home/kemg7663/public_html/slideshows',
            'url' => rtrim(env('APP_URL'), '/') . '/slideshows',
            'visibility' => 'public',
        ],

        'struktur' => [
            'driver' => 'local',
            'root' => '/home/kemg7663/public_html/struktur',
            'url' => rtrim(env('APP_URL'), '/') . '/struktur',
            'visibility' => 'public',
        ],

        'tim' => [
            'driver' => 'local',
            'root' => '/home/kemg7663/public_html/tim',
            'url' => rtrim(env('APP_URL'), '/') . '/tim',
            'visibility' => 'public',
        ],

        'lk_pih' => [
            'driver' => 'local',
            'root' => '/home/kemg7663/public_html/lk-pih',
            'url' => rtrim(env('APP_URL'), '/') . '/lk-pih',
            'visibility' => 'public',
        ],

        'image' => [
            'driver' => 'local',
            'root' => '/home/kemg7663/public_html/image',
            'url' => rtrim(env('APP_URL'), '/') . '/image',
            'visibility' => 'public',
        ],

        'pdf' => [
            'driver' => 'local',
            'root' => '/home/kemg7663/public_html/pdf',
            'url' => rtrim(env('APP_URL'), '/') . '/pdf',
            'visibility' => 'public',
        ],

        'regulations' => [
            'driver' => 'local',
            'root' => '/home/kemg7663/public_html/regulations',
            'url' => rtrim(env('APP_URL'), '/') . '/regulations',
            'visibility' => 'public',
        ],

        'uploads' => [
            'driver' => 'local',
            'root' => '/home/kemg7663/public_html/uploads',
            'url' => rtrim(env('APP_URL'), '/') . '/uploads',
            'visibility' => 'public',
        ],

        'pages' => [
            'driver' => 'local',
            'root' => '/home/kemg7663/public_html/pages',
            'url' => rtrim(env('APP_URL'), '/') . '/pages',
            'visibility' => 'public',
        ],

        'postings' => [
            'driver' => 'local',
            'root' => '/home/kemg7663/public_html/postings',
            'url' => rtrim(env('APP_URL'), '/') . '/postings',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
            'report' => false,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
