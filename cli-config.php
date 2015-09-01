<?php

    namespace Showcase;

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use ObjectivePHP\Application\Workflow\Event\WorkflowEvent;

chdir(__DIR__);

require 'vendor/autoload.php';


$app = new Application();

$app->setEnv('dev');

$app->loadConfig('app/config');

$app->getWorkflow()->bind('packages.post', function (WorkflowEvent $event) {
    $event->getApplication()->getWorkflow()->unbind('route.*');
    $event->getApplication()->getWorkflow()->unbind('response.*');
});

$app->run();

$em = $app->getServicesFactory()->get('doctrine.em.default');
return ConsoleRunner::createHelperSet($em);