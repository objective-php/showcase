<?php

    namespace Showcase\Action;

    use ObjectivePHP\Application\Workflow\Event\WorkflowEvent;

    class Home
    {
        public function __invoke(WorkflowEvent $event)
        {
            echo '<h2>We\'ve been through DebugPackage</h2>';
        }
    }