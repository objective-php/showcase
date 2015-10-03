<?php

    use ObjectivePHP\Matcher\Matcher;
    use ObjectivePHP\Primitives\Merger\MergePolicy;
    use Showcase\Package\Overrider\OverriderPackage;
    use ObjectivePHP\DoctrinePackage\DoctrinePackage;
    use Showcase\Package\Debug\DebugPackage;
    use Showcase\Package\ShowSource\ShowSourcePackage;

    return [
            'app.name'            => 'Objective PHP Framework',
            'actions.namespaces'  =>
                [
                    'Showcase\\Action'
                ],

            // views
            /*
            'views.locations' =>
                [
                    'app/views/actions'
                ],
            */
            // layouts
            'layouts.locations' =>
                [
                    // 'app/views/layouts'
                    'app/layouts'
                ],
            'layouts.default'   => 'layout',

            // packages
             'packages.registered' => [
               // DebugPackage::class,
               // OverriderPackage::class,
               DoctrinePackage::class,
               ShowSourcePackage::class
            ],

            'doctrine.em.default.entities.locations' => 'app/src/Entity',

            'services' =>
            [
                [
                    'id' => 'matcher',
                    'class' => Matcher::class
                ]
            ]
    ];