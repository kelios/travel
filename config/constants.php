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
     /*   [
            'id' => 0,
            'name' => 'Показать все объекты',
        ],*/
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
        ],
        [
            'id' => 300,
            'name' => 300,
        ],
        [
            'id' => 400,
            'name' => 400,
        ],
        [
            'id' => 500,
            'name' => 500,
        ],
        [
            'id' => 600,
            'name' => 600,
        ],
    ],
    'resize' =>
        [
            'previewSamllMainTravel' => 'image-server/192',
            'previewMainTravel' => 'image-server/400'
        ]
];
