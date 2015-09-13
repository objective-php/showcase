<?php

    use Showcase\Application;

    $autoloader = require '../vendor/autoload.php';

    chdir(__DIR__ . '/..');

    $app = new Application($autoloader);

    $app->setEnv('dev');

    $app->loadConfig('app/config');


    $app->run();