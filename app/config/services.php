<?php


    use Gateway\HumanResourcesGateway;
    use ObjectivePHP\ServicesFactory\Reference;
    use Service\HumanResources;

    return [
        'services' => [
            [
                'id' => 'services.human-resources',
                'class' => HumanResources::class,
                'params' => [new Reference('gateway.human-resources')]
            ],
            [
                'id' => 'gateway.human-resources',
                'class' => HumanResourcesGateway::class,
                'params' => [new Reference('doctrine.em.default')]
            ]

        ]
    ];