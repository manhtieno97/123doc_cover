<?php
return [
    'fileTypes' => explode(",", env('FILE_TYPE_COVER', 'psd,tif,jpeg')) ,
    'fileSize' => [
        'lagger' => [
            'width' => env('IMAGE_COVER_WIDTH_LG', 720),
            'height' => env('IMAGE_COVER_HEIGHT_LG', 720),
            'url' => env('IMAGE_COVER_URL_LG', 'images/lagger'),
        ],
        'medium' => [
            'width' => env('IMAGE_COVER_WIDTH_MD', 500),
            'height' => env('IMAGE_COVER_HEIGHT_MD', 500),
            'url' => env('IMAGE_COVER_URL_MD', 'images/medium'),
        ],
        'small' => [
            'width' => env('IMAGE_COVER_WIDTH_SM', 250),
            'height' => env('IMAGE_COVER_HEIGHT_SM', 250),
            'url' => env('IMAGE_COVER_URL_SM', 'images/small'),
        ],
       
    ],
];

?>