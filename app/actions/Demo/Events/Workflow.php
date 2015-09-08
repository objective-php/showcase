<?php

    namespace Showcase\Action\Demo\Events;
    
    
    use ObjectivePHP\Application\Action\AbstractAction;
    use ObjectivePHP\Application\Action\Param\StringParameter;
    use ObjectivePHP\Application\Workflow\Event\WorkflowEvent;
    use ObjectivePHP\Application\Workflow\Step\StepInterface;
    use ObjectivePHP\Application\Workflow\WorkflowInterface;
    use ObjectivePHP\Events\EventInterface;

    /**
     * Class Workflow
     *
     * @package Showcase\Action\Demo\Events
     */
    class Workflow extends AbstractAction
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
                    'workflowTree'      => $workflow
                ];
        }

    }