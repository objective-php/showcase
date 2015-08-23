<?php

    use Showcase\Application;

    require '../vendor/autoload.php';

    chdir(__DIR__ . '/..');

    $app = new Application();

    $app->setEnv('dev');

    $app->loadConfig('app/config');


    $app->run();