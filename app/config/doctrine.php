<?php
    /**
     * This file is part of the Objective PHP project
     *
     * More info about Objective PHP on www.objective-php.org
     *
     * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
     */

    use ObjectivePHP\Package\Doctrine\Config\EntityManager;

    return [
        new EntityManager('default', [
            'driver'        => 'pdo_mysql',
            'host'          => '127.0.0.1',
            'port'          => 3306,
            'user'          => 'demo',
            'password'      => '',
            'dbname'        => 'employees',
            'mapping_types' => ['enum' => 'string']
        ])
    ];


