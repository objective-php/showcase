<?php

    namespace Showcase\Action\Demo\Events;
    
    
    use ObjectivePHP\Application\Action\AbstractAction;
    use ObjectivePHP\Application\Action\Param\StringParameter;
    use ObjectivePHP\Application\WebAppWorkflow;
    use ObjectivePHP\Application\Workflow\Event\WorkflowEvent;
    use ObjectivePHP\Application\Workflow\Step\Step;
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


            $workflow = $event->getApplication()->getWorkflow();

            // $this->generateWorkflowEventsTree($events, $nativeWorkflow, 0);
            // $this->generateWorkflowEventsList($ev, $workflow, 0);

            return
                [
                    'page.title' => 'Workflow steps',
                    'page.subtitle' => 'Dynamically displays workflow steps',
                    'workflow' => $workflow
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