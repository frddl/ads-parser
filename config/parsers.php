<?php

return [
    'sites' => [
        'tap_az'    => [
            'url' => 'https://tap.az/',
            'route_prefix' => 'elanlar/',
            'name' => 'Tap.az',
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
        '5',
        '15',
        '30',
        '60',
        '120',
    ]
];
