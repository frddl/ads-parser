<?php

return [
    'sites' => [
        'tap_az'    => [
            'url' => 'https://tap.az/',
            'start_path' => 'https://tap.az/elanlar',
            'route_prefix' => 'elanlar/',
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
            'convert_currency' => false,
            'currency_selector' => 'div.product-price',
            'currency_variations' => [
                [
                    'matches' => ['azn', '₼'],
                    'multiplier' => 1,
                ],
                [
                    'matches' => ['usd', '$'],
                    'multiplier' => 1.7,
                ],
                [
                    'matches' => ['eur', '€'],
                    'multiplier' => 2,
                ]
            ]
        ],

        'turbo_az'  => [
            'url' => 'https://turbo.az/',
            'start_path' => 'https://turbo.az/autos?q%5Bmake%5D%5B%5D=4&q%5Bmodel%5D%5B%5D=149',
            'route_prefix' => 'autos/',
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
            'convert_currency' => true,
            'currency_selector' => 'div.product-price',
            'currency_variations' => [
                [
                    'matches' => ['azn', '₼'],
                    'multiplier' => 1,
                ],
                [
                    'matches' => ['usd', '$'],
                    'multiplier' => 1.7,
                ],
                [
                    'matches' => ['eur', '€'],
                    'multiplier' => 2,
                ]
            ]
        ],

        // 'lalafo_az' => [
        //     'url' => 'https://lalafo.az/',
        //     'route_prefix' => '',
        //     'name' => 'Lalafo.az',
        // ],

        // 'bina_az'   => [
        //     'url' => 'https://bina.az/',
        //     'route_prefix' => 'items/',
        //     'name' => 'Bina.az',
        // ],
    ],

    'strategy' => [
        'tap_az'    => App\ParseStrategy\TapAz::class,
        'turbo_az'  => App\ParseStrategy\TurboAz::class,
        // 'lalafo_az' => App\ParseStrategy\LalafoAz::class,
        // 'bina_az'   => App\ParseStrategy\BinaAz::class,
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
];
