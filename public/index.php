<?php

    use Showcase\Application;

    $autoloader = require '../vendor/autoload.php';

    chdir(__DIR__ . '/..');

    $app = new Application($autoloader);

    $app->setEnv(getenv('APPLICATION_ENV') ?: 'production');

    $app->loadConfig('app/config');


    //var_dump($app->getConfig()->toArray());
    $app->run();
