<?php


    use Gateway\HumanResourcesGateway;
    use ObjectivePHP\ServicesFactory\Reference;
    use Service\HumanResources;

    use ObjectivePHP\ServicesFactory;

    return [
        'services' => [
            [
                'id'     => 'services.human-resources',
                'class'  => HumanResources::class,
                'params' => [new ServicesFactory\Reference('gateway.human-resources')]
            ],
            [
                'id'     => 'gateway.human-resources',
                'class'  => HumanResourcesGateway::class,
                'params' => [new Reference('doctrine.em.default')],

                'description' => 'Gateway to fetch employees, salaries, and titles'
            ]

        ]
    ];