<?php
    /**
     * This file is part of the Objective PHP project
     *
     * More info about Objective PHP on www.objective-php.org
     *
     * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
     */

    use ObjectivePHP\Package\Eloquent\Config\EloquentCapsule;

    return [
        new EloquentCapsule('default',
            [
                'driver'   => 'mysql',
                'host'     => '127.0.0.1',
                'username' => 'demo',
                'password' => '',
                'database' => 'employees'
            ]
        )
    ];

