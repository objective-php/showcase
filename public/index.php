<?php

    use Showcase\Application;

    require '../vendor/autoload.php';

    chdir(__DIR__ . '/..');

    $app = new Application();

    $app->setEnv('dev');

    $app->loadConfig('app/config');


    // echo '<h1>Welcome to ' . $app->getConfig()->app->name . '</h1>';

    $app->run();