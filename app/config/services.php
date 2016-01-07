<?php
    /**
     * This file is part of the Objective PHP project
     *
     * More info about Objective PHP on www.objective-php.org
     *
     * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
     */

    use ObjectivePHP\ServicesFactory\Config\Service;
    use ObjectivePHP\ServicesFactory\ServiceReference;
    use Showcase\Action\Demo\Doctrine\EntityParameter;
    use Showcase\Gateway\HumanResourcesGateway;
    use Showcase\Service\HumanResources;

    return [
        new Service([
            'id'     => 'service.human-resources',
            'class'  => HumanResources::class,
            'params' => [new ServiceReference('gateway.human-resources')]
        ]),
        new Service(
        [
            'id'     => 'gateway.human-resources',
            'class'  => HumanResourcesGateway::class,
            'params' => [new ServiceReference('doctrine.em.default')],
            'description' => 'Gateway to fetch employees, salaries, and titles'
        ]),
        // Action service
        new Service(
        [
            'id'      => 'action.demo.doctrine.entity-parameter',
            'class'   => EntityParameter::class,
            'setters' => [
                'setHumanResources' => new ServiceReference('service.human-resources')
            ]
        ])
    ];
