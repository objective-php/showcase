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


            // layouts
            'layouts.locations' =>
                [
                    'app/layouts'
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