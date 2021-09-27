<?php

return [
    'sites' => [
        'tap_az'    => [
            'url' => 'https://tap.az/',
            'route_prefix' => 'elanlar/',
        ],

        'turbo_az'  => [
            'url' => 'https://turbo.az/',
            'route_prefix' => 'autos/',
        ],

        'lalafo_az' => [
            'url' => 'https://lalafo.az/',
            'route_prefix' => '',
        ],

        'bina_az'   => [
            'url' => 'https://bina.az/',
            'route_prefix' => 'items/',
        ],
    ],

    'strategy' => [
        'tap_az'    => App\ParseStrategy\TapAz::class,
        'turbo_az'  => App\ParseStrategy\TurboAz::class,
        'lalafo_az' => App\ParseStrategy\LalafoAz::class,
        'bina_az'   => App\ParseStrategy\BinaAz::class,
    ]
];
