<?php


    use Showcase\Gateway\HumanResourcesGateway;
    use ObjectivePHP\ServicesFactory\ServiceReference;
    use Showcase\Service\HumanResources;

    use ObjectivePHP\ServicesFactory;

    return [
        'services' => [
            [
                'id'     => 'services.human-resources',
                'class'  => HumanResources::class,
                'params' => [new ServiceReference('gateway.human-resources')]
            ],
            [
                'id'     => 'gateway.human-resources',
                'class'  => HumanResourcesGateway::class,
                'params' => [new ServiceReference('doctrine.em.default')],

                'description' => 'Gateway to fetch employees, salaries, and titles'
            ]

        ]
    ];