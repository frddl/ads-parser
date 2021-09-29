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
            ]
        ],

        'turbo_az'  => [
            'url' => 'https://turbo.az/',
            'route_prefix' => 'autos/',
            'name' => 'Turbo.az',
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
    ]
];
