<?php

    namespace Showcase\Action\Demo\Html;
    
    
    use ObjectivePHP\Application\Action\DefaultAction;
    use ObjectivePHP\Application\Workflow\Event\WorkflowEvent;

    /**
     * Class HtmlTag
     *
     * @package Showcase\Action\Demo\Html
     */
    class HtmlTag extends DefaultAction
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