<?php

    return [
        'app.debug'           => true,
        'app.actions'         => [
            'Poc\\Action\\' => 'app/packages/Debug/actions'
        ],
        'app.views.locations' =>
            [
                'packages/Debug/views'
            ]
    ];