<?php

    use ObjectivePHP\Matcher\Matcher;
    use ObjectivePHP\Primitives\Merger\MergePolicy;
    use Showcase\Package\Overrider\OverriderPackage;
    use Showcase\Package\Debug\DebugPackage;

    return [

        'mergers'    => [
            'app.actions'         => MergePolicy::COMBINE,
            'views.locations'     => MergePolicy::NATIVE,
        ],
        'directives' =>
            [
                'app.name'            => 'Objective PHP Framework',
                'app.actions'         =>
                    [
                        'Showcase\\Action\\' => 'app/actions'
                    ],

                // views
                'views.locations' =>
                    [
                        'app/views/actions'
                    ],

                // layouts
                'layouts.locations' =>
                    [
                        'app/views/layouts'
                    ],
                'layouts.default'         => 'layout',

                // packages
                'packages.registered' => [
                  //  DebugPackage::class
                  OverriderPackage::class
                ],

                'services' =>
                [
                    [
                        'id' => 'matcher',
                        'class' => Matcher::class
                    ]
                ]
            ]
    ];