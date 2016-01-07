<?php
    /**
     * This file is part of the Objective PHP project
     *
     * More info about Objective PHP on www.objective-php.org
     *
     * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
     */

    use ObjectivePHP\Application;

    return [
        new Application\Config\Route('/', '/home'),
        new Application\Config\Route('/login', '/auth/login')
    ];
