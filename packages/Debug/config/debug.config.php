<?php

    use Showcase\Package\Debug\Dumper;

    return [
        'app.debug'           => true,
        'services' =>
            [
                [
                    'id'    => 'dumper',
                    'class' => Dumper::class
                ]
            ]
    ];