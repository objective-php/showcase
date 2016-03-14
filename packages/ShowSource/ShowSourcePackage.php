<?php

namespace Showcase\Package\ShowSource;

use ObjectivePHP\Application\ApplicationInterface;
use ObjectivePHP\Application\Workflow\Event\WorkflowEvent;
use ObjectivePHP\Html\Tag\Tag;
use ObjectivePHP\Primitives\String\Str;
use ObjectivePHP\ServicesFactory\ServiceReference;

/**
 * Class ShowSourcePackage
 *
 * @package Showcase\Package\ShowSource
 */
class ShowSourcePackage
{
    /**
     * @param WorkflowEvent $event
     */
    public function __invoke(ApplicationInterface $app)
    {
        $app->getStep('rendering')->plug([$this, 'showSource']);
    }

    /**
     * @param WorkflowEvent $event
     *
     * @throws \ObjectivePHP\ServicesFactory\Exception
     */
    public function showSource(ApplicationInterface $app)
    {

        $app->getResponse()->getBody()->rewind();
        $output = Str::cast($app->getResponse()->getBody()->getContents());

        $actionMiddleware = $app->getParam('runtime.action.middleware');

        $action = $actionMiddleware->getInvokable()->getCallable($app);

        if (is_object($action)) {
            $actionClass = get_class($action);

            // handle action which are services reference
            if ($actionClass instanceof ServiceReference) {
                $action = $app->getServicesFactory()->get($actionClass->getId());
                $actionClass = get_class($action);
            }

            $actionFile = (new \ReflectionClass($actionClass))->getFileName();

            $actionSource = Tag::pre(Tag::code(htmlentities(file_get_contents($actionFile)), 'hljs', 'php'));
        }
        else
        {
            $actionSource = "Closure";
        }
        $output->setVariable('action-source', $actionSource);

        $viewScript = $app->getParam('view.script');


        $viewSource = Tag::pre(Tag::code(htmlentities(file_get_contents($viewScript)), 'hljs', 'php'));
        $output->setVariable('view-source', $viewSource);


        $app->getResponse()->getBody()->rewind();
        $app->getResponse()->getBody()->write($output);
    }

}