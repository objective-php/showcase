<?php

    namespace Showcase\Action\Demo\Html;
    
    
    use ObjectivePHP\Application\Action\AbstractAction;
    use ObjectivePHP\Application\Workflow\Event\WorkflowEvent;

    class HtmlTag extends AbstractAction
    {
        /**
         * @param WorkflowEvent $event
         *
         * @return mixed
         */
        public function run(WorkflowEvent $event)
        {
            // nothing to pass to the view script here
        }

    }