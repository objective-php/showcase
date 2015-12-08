<?php

    use Showcase\Package\Debug\Dumper;

    return [
        'services' =>
            [
                [
                    'id'    => 'debug.dumper',
                    'class' => Dumper::class
                ]
            ]
    ];