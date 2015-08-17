<?php

    use ObjectivePHP\Primitives\Merger\MergePolicy;
    use Poc\Package\Debug\DebugPackage;

    return [

        'mergers' => [
            'app.actions' => MergePolicy::COMBINE,
            'app.views' => MergePolicy::COMBINE,
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
            'packages.registered' => [
               DebugPackage::class
            ]
        ]
    ];