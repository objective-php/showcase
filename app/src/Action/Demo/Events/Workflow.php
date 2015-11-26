<?php

    namespace Showcase\Action\Demo\Events;
    
    
    use ObjectivePHP\Application\Action\DefaultAction;
    use ObjectivePHP\Application\Workflow\Event\WorkflowEvent;

    /**
     * Class Workflow
     *
     * @package Showcase\Action\Demo\Events
     */
    class Workflow extends DefaultAction
    {

        /**
         * Run the action
         */
        public function run(WorkflowEvent $event)
        {

            $workflow = $event->getApplication()->getWorkflow();

            return
                [
                    'page.title'    => 'Workflow steps',
                    'page.subtitle' => 'Dynamically displays workflow steps',
                    'workflowTree'  => $workflow
                ];
        }

    }