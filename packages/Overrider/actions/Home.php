<?php

    namespace Showcase\Action;

    use ObjectivePHP\Application\Workflow\Event\WorkflowEvent;

    class Home
    {
        public function __invoke(WorkflowEvent $event)
        {
            return [
                'page.title' => 'Overridden page title'
            ];
        }
    }