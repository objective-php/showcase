<?php


    use Showcase\Action\Demo\Doctrine\EntityParameter;
    use Showcase\Gateway\HumanResourcesGateway;
    use ObjectivePHP\ServicesFactory\ServiceReference;
    use Showcase\Service\HumanResources;

    use ObjectivePHP\ServicesFactory;

    return [
        'services' => [
            [
                'id'     => 'service.human-resources',
                'class'  => HumanResources::class,
                'params' => [new ServiceReference('gateway.human-resources')]
            ],
            [
                'id'     => 'gateway.human-resources',
                'class'  => HumanResourcesGateway::class,
                'params' => [new ServiceReference('doctrine.em.default')],

                'description' => 'Gateway to fetch employees, salaries, and titles'
            ],
            // Action service
            [
                'id' => 'action.demo.doctrine.entity-parameter',
                'class' => EntityParameter::class,
                'setters' => [
                    'setHumanResources' => new ServiceReference('service.human-resources')
                ]
            ]

        ]
    ];