<?php

    namespace Showcase\Package\ShowSource;

    use ObjectivePHP\Application\View\Helper\Vars;
    use ObjectivePHP\Application\Workflow\Event\WorkflowEvent;
    use ObjectivePHP\Html\Tag\Tag;
    use ObjectivePHP\Primitives\String\String;
    use ObjectivePHP\ServicesFactory\Reference;

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
        public function __invoke(WorkflowEvent $event)
        {
            $workflow = $event->getApplication()->getWorkflow()->getRoot();

            $workflow->bind('response.generate', [$this, 'showSource']);

        }

        /**
         * @param WorkflowEvent $event
         *
         * @throws \ObjectivePHP\ServicesFactory\Exception
         */
        public function showSource(WorkflowEvent $event)
        {
            $application = $event->getApplication();

            $event->getApplication()->getResponse()->getBody()->rewind();
            $output = String::cast($event->getApplication()->getResponse()->getBody()->getContents());

            $actionClass = $application->getWorkflow()->getStep('route')->getEarlierEvent('resolve')
                                       ->getResults()['action-resolver'];

            // handle action which are services reference
            if ($actionClass instanceof Reference)
            {
                $action      = $application->getServicesFactory()->get($actionClass->getId());
                $actionClass = get_class($action);
            }

            $actionFile = (new \ReflectionClass($actionClass))->getFileName();

            $actionSource = String::cast(show_source($actionFile, true));
            $actionSource->replace('/^<code>|<\/code>$/', '', String::REGEXP);

            $output->setVariable('action-source', Tag::pre($actionSource));

            $viewScript = Vars::get('view.path');

            $viewSource = String::cast(show_source($viewScript, true));
            $viewSource->replace('/^<code>|<\/code>$/', '', String::REGEXP);
            $output->setVariable('view-source', Tag::pre($viewSource));

            $event->getApplication()->getResponse()->getBody()->rewind();
            $event->getApplication()->getResponse()->getBody()->write($output);
        }

    }