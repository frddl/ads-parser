<?php

return [
    'sites' => [
        'tap_az'    => [
            'url' => 'https://tap.az',
            'start_path' => 'https://tap.az/elanlar',
            'route_prefix' => '',
            'name' => 'Tap.az',
            'ad_selector' => 'div.products-i',
            'properties' => [
                'link' => [
                    'selector' => 'a.products-link',
                    'attribute' => 'href',
                ],
                'name' => [
                    'selector' => 'div.products-name',
                    'attribute' => 'innerText',
                ],
                'price' => [
                    'selector' => 'span.price-val',
                    'attribute' => 'innerText'
                ],
            ],
            'notification' => [
                'image' => [
                    'selector' => 'img',
                    'attribute' => 'src',
                ],
                'title' => [
                    'selector' => 'div.products-name',
                    'attribute' => 'innerText'
                ],
                'description' => [
                    'selector' => 'div.products-price-container',
                    'attribute' => 'innerText'
                ],
            ],
            'convert_currency' => false,
            'currency_selector' => 'div.product-price',
        ],

        'turbo_az'  => [
            'url' => 'https://turbo.az',
            'start_path' => 'https://turbo.az/autos',
            'route_prefix' => '',
            'name' => 'Turbo.az',
            'ad_selector' => 'div.products-i',
            'properties' => [
                'link' => [
                    'selector' => 'a.products-i__link',
                    'attribute' => 'href',
                ],
                'name' => [
                    'selector' => 'div.products-i__name',
                    'attribute' => 'innerText',
                ],
                'price' => [
                    'selector' => 'div.product-price',
                    'attribute' => 'innerText'
                ],
            ],
            'notification' => [
                'image' => [
                    'selector' => 'img',
                    'attribute' => 'src',
                ],
                'title' => [
                    'selector' => 'div.products-i__name',
                    'attribute' => 'innerText'
                ],
                'description' => [
                    'selector' => 'div.products-i__attributes',
                    'attribute' => 'innerText'
                ],
            ],
            'convert_currency' => true,
            'currency_selector' => 'div.product-price',
        ],

        'bina_az'  => [
            'url' => 'https://bina.az',
            'start_path' => 'https://bina.az/items/all',
            'route_prefix' => '',
            'name' => 'Bina.az',
            'ad_selector' => 'div.items-i',
            'properties' => [
                'link' => [
                    'selector' => 'a.item_link',
                    'attribute' => 'href',
                ],
                'name' => [
                    'selector' => 'div.location',
                    'attribute' => 'innerText',
                ],
                'price' => [
                    'selector' => 'span.price-val',
                    'attribute' => 'innerText'
                ],
            ],
            'notification' => [
                'image' => [
                    'selector' => 'img',
                    'attribute' => 'src',
                ],
                'title' => [
                    'selector' => 'div.location',
                    'attribute' => 'innerText',
                ],
                'description' => [
                    'selector' => 'ul.name',
                    'attribute' => 'innerText',
                ],
            ],
            'convert_currency' => true,
            'currency_selector' => 'span.price-cur',
        ],

        'lalafo_az' => [
            'url' => 'https://lalafo.az',
            'start_path' => 'https://lalafo.az',
            'route_prefix' => '',
            'name' => 'Lalafo.az',
            'ad_selector' => 'div.adTile-mainInfo',
            'properties' => [
                'link' => [
                    'selector' => 'a.adTile-mainInfo-link',
                    'attribute' => 'href',
                ],
                'name' => [
                    'selector' => 'a.adTile-title',
                    'attribute' => 'innerText',
                ],
                'price' => [
                    'selector' => 'p.adTile-price',
                    'attribute' => 'innerText'
                ],
            ],
            'notification' => [
                'image' => [
                    'selector' => 'img',
                    'attribute' => 'src',
                ],
                'title' => [
                    'selector' => 'a.adTile-title',
                    'attribute' => 'innerText',
                ],
                'description' => [
                    'selector' => 'span.adTile-SEO-description',
                    'attribute' => 'innerText'
                ],
            ],
            'convert_currency' => true,
            'currency_selector' => 'p.adTile-price',
        ],
    ],

    'strategy' => [
        'tap_az'    => App\ParseStrategy\TapAz::class,
        'turbo_az'  => App\ParseStrategy\TurboAz::class,
        'bina_az'   => App\ParseStrategy\BinaAz::class,
        'lalafo_az' => App\ParseStrategy\LalafoAz::class,
    ],

    'periods' => [
        '1',
        '5',
        '15',
        '30',
        '60',
        '120',
    ],

    'currency_string' => 'AZN',
    'currency_variations' => [
        [
            'matches' => ['azn', '???'],
            'multiplier' => 1,
        ],
        [
            'matches' => ['usd', '$'],
            'multiplier' => 1.7,
        ],
        [
            'matches' => ['eur', '???'],
            'multiplier' => 2,
        ]
    ]
];
