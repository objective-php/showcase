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
            $app->on('rendering')->plug([$this, 'showSource']);
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

            $actionClass = $app->getParam('action');

            // handle action which are services reference
            if ($actionClass instanceof ServiceReference)
            {
                $action      = $app->getServicesFactory()->get($actionClass->getId());
                $actionClass = get_class($action);
            }

            $actionFile = (new \ReflectionClass($actionClass))->getFileName();

            $actionSource = Str::cast(show_source($actionFile, true));
            $actionSource->replace('/^<code>|<\/code>$/', '', Str::REGEXP);

            $output->setVariable('action-source', Tag::pre($actionSource));

            $viewScript = $app->getParam('view.script');


            $viewSource = Str::cast(show_source($viewScript, true));
            $viewSource->replace('/^<code>|<\/code>$/', '', Str::REGEXP);
            $output->setVariable('view-source', Tag::pre($viewSource));


            $app->getResponse()->getBody()->rewind();
            $app->getResponse()->getBody()->write($output);
        }

    }