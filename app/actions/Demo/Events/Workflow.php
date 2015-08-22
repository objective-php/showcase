<?php

    namespace Showcase\Action\Demo\Events;
    
    
    use ObjectivePHP\Application\Action\AbstractAction;
    use ObjectivePHP\Application\Action\Param\StringParameter;
    use ObjectivePHP\Application\Pattern\Rta\RtaWorkflow;
    use ObjectivePHP\Application\Workflow\Event\WorkflowEvent;
    use ObjectivePHP\Application\Workflow\Step\StepInterface;
    use ObjectivePHP\Application\Workflow\WorkflowInterface;

    class Workflow extends AbstractAction
    {

        public function expects()
        {
            return [
                new StringParameter([0 => 'step'])
            ];
        }


        /**
         *
         */
        public function run(WorkflowEvent $event)
        {

            // detail step
            if($step = $this->getParam('step'))
            {
                return $this->stepDetails($event);
            }

            return $this->workflowSteps($event);

        }

        public function workflowSteps(WorkflowEvent $event)
        {


            $nativeWorkflow = new RtaWorkflow();

            $this->generateWorkflowEventsTree($events, $nativeWorkflow, 0);



            return
                [
                    'layout' => ['pageTitle' => 'Workflow steps'],
                    'events' => $events
                ];
        }

        protected function generateWorkflowEventsTree(&$tree, WorkflowInterface $workflow, $lastStepIndex)
        {
            $tree[$workflow->getName()] = [];
            $tree = &$tree[$workflow->getName()];

            if ($workflow->doesAutoTriggerPrePostEvents())
            {
                $tree[++$lastStepIndex] = 'pre';
            }
            foreach($workflow->getSteps() as $step)
            {
                if($step instanceof WorkflowInterface)
                {
                    $lastStepIndex = $this->generateWorkflowEventsTree($tree, $step, $lastStepIndex);
                }
                elseif($step instanceof StepInterface)
                {
                    $tree[++$lastStepIndex] = $step->getName();
                }
            }

            if ($workflow->doesAutoTriggerPrePostEvents())
            {
                $tree[++$lastStepIndex] = 'post';
            }

            return $lastStepIndex;
        }

        /**
         * Detail a workflow step
         *
         * @param WorkflowEvent $event
         *
         * @return array
         */
        public function stepDetails(WorkflowEvent $event)
        {
            $this->setViewName('demo/events/workflow.step');

            return [
                'layout' => ['pageTitle' => 'Step details'],
                'step' => $this->getParam('step')
            ];
        }



    }