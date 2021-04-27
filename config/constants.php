<?php
return [
    'image' => [
        'defaultCatImage' => '/media/metravel.jpg'
    ],
    'showListTravel' => [
        'count' => 6
    ],
    'showListMessage' => [
        'count' => 1000
    ],
    'showListArticle' => [
        'count' => 6
    ],
    'showListPerPage' => [
        '6' => 6,
        '12' => 12,
        '24' => 24,
        '36' => 36,
        '72' => 72,
    ],
    'radius' => [
        [
            'id' => 0,
            'name' => 'Показать все объекты',
        ],
        [
            'id' => 60,
            'name' => 60,
        ],
        [
            'id' => 100,
            'name' => 100,
        ], [
            'id' => 150,
            'name' => 150,
        ], [
            'id' => 200,
            'name' => 200,
        ],
    ],
    'resize' =>
        [
            'previewSamllMainTravel' => 'image-server/192',
            'previewMainTravel' => 'image-server/400'
        ]
];
