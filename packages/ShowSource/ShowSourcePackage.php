<?php

    namespace Showcase\Package\ShowSource;

    use ObjectivePHP\Application\View\Helper\Vars;
    use ObjectivePHP\Application\Workflow\Event\WorkflowEvent;
    use ObjectivePHP\Html\Tag\Tag;
    use ObjectivePHP\Primitives\String\String;
    use ObjectivePHP\ServicesFactory\Reference;

    class ShowSourcePackage
    {
        public function __invoke(WorkflowEvent $event)
        {
            $workflow = $event->getApplication()->getWorkflow();


            $workflow->bind('response.post', [$this, 'showSource']);


        }

        public function showSource(WorkflowEvent $event)
        {
            $application = $event->getApplication();
            $previousResults = $application->getWorkflow()->getStep('response')->getEarlierEvent('generate')->getResults();

            $output = String::cast($previousResults->last());
            $actionClass = $application->getWorkflow()->getStep('route')->getEarlierEvent('resolve')->getResults()['action-resolver'];

            // handle action which are services reference
            if($actionClass instanceof Reference)
            {
                $action = $application->getServicesFactory()->get($actionClass->getId());
                $actionClass= get_class($action);
            }

            $actionFile = (new \ReflectionClass($actionClass))->getFileName();
            $actionSource = String::cast(show_source($actionFile, true));
            $actionSource->replace('/^<code>|<\/code>$/', '', String::REGEXP);

            $output->setVariable('action-source', Tag::div($actionSource));

            $viewScript = Vars::get('view.path');

            $viewSource = String::cast(show_source($viewScript, true));
            $viewSource->replace('/^<code>|<\/code>$/', '', String::REGEXP);
            $output->setVariable('view-source', Tag::div($viewSource));

            echo $output;
        }

    }