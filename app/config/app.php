<?php

    use ObjectivePHP\Primitives\Merger\MergePolicy;
    use Poc\Package\Debug\DebugPackage;
    use Poc\Package\Layout\LayoutPackage;

    return [

        'mergers' => [
            'app.actions' => MergePolicy::COMBINE,
            'app.views.locations' => MergePolicy::NATIVE,
        ],
        'directives' => [
            'app.name' => 'Objective PHP / Proof of Concept',
            'app.actions' =>
            [
                'Poc\\Action\\' => 'app/actions'
            ],
            'app.views.locations' =>
            [
                'app/views'
            ],
            'layout.name' => 'layouts/layout',

            'packages.registered' => [
               LayoutPackage::class,
               DebugPackage::class
            ]
        ]
    ];