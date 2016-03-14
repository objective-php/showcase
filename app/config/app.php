<?php
    /**
     * This file is part of the Objective PHP project
     *
     * More info about Objective PHP on www.objective-php.org
     *
     * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
     */

    use ObjectivePHP\Application\Config\ActionNamespace;
    use ObjectivePHP\Application\Config\ApplicationName;
    use ObjectivePHP\Application\Config\LayoutsLocation;
    use ObjectivePHP\Package\Doctrine\Config\EntityManager;

    return
        [
        new ApplicationName('Objective PHP Framework'),
        new ActionNamespace('Showcase\\Action'),
        new LayoutsLocation('app/layouts'),
        new EntityManager('default', ['entities.locations' => 'app/src/Entity'])
    ];
