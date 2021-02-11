<?php

return [
    'articles' => [
        'service' => 'App\Services\ArticleService',
        'storage' => [
            'images' => 'articles/images',
        ],
    ],
    'imageable' => [
        'articles',
    ],
];
