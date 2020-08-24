<?php
return [
    'fileTypes' => explode(",", env('FILE_TYPE_COVER', 'psd,tif,jpeg')) ,
    'fileSize' => [
        'defaults' => [
            'width' => env('IMAGE_COVER_WIDTH', 500),
            'height' => env('IMAGE_COVER_HEIGHT', 500),
            'url' => storage_path(env('IMAGE_COVER_URL', 'image')),
        ],
        'lagger' => [
            'width' => env('IMAGE_COVER_WIDTH_LG', 720),
            'height' => env('IMAGE_COVER_HEIGHT_LG', 720),
            'url' => storage_path(env('IMAGE_COVER_URL_LG', 'image/lagger')),
        ],
        'medium' => [
            'width' => env('IMAGE_COVER_WIDTH_MD', 500),
            'height' => env('IMAGE_COVER_HEIGHT_MD', 500),
            'url' => storage_path(env('IMAGE_COVER_URL_MD', 'image/medium')),
        ],
        'small' => [
            'width' => env('IMAGE_COVER_WIDTH_SM', 250),
            'height' => env('IMAGE_COVER_HEIGHT_SM', 250),
            'url' => storage_path(env('IMAGE_COVER_URL_SM', 'image/small')),
        ],
       
    ],
];

?>