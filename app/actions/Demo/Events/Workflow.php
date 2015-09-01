<?php

    namespace Showcase\Action\Demo\Events;
    
    
    use ObjectivePHP\Application\Action\AbstractAction;
    use ObjectivePHP\Application\Action\Param\StringParameter;
    use ObjectivePHP\Application\Workflow\Event\WorkflowEvent;
    use ObjectivePHP\Application\Workflow\Step\StepInterface;
    use ObjectivePHP\Application\Workflow\WorkflowInterface;
    use ObjectivePHP\Events\EventInterface;

    class Workflow extends AbstractAction
    {

        /**
         *
         */
        public function run(WorkflowEvent $event)
        {

            $workflow = $event->getApplication()->getWorkflow();

            return
                [
                    'page.title'    => 'Workflow steps',
                    'page.subtitle' => 'Dynamically displays workflow steps',
                    'workflow'      => $workflow
                ];
        }

        protected function generateWorkflowEventsTree(&$tree, WorkflowInterface $workflow, $lastStepIndex)
        {
            $tree[$workflow->getName()] = [];
            $tree                       = &$tree[$workflow->getName()];

            if ($workflow->doesAutoTriggerPrePostEvents())
            {
                $tree[++$lastStepIndex] = 'pre';
            }
            foreach ($workflow->getSteps() as $step)
            {
                if ($step instanceof WorkflowInterface)
                {
                    $lastStepIndex = $this->generateWorkflowEventsTree($tree, $step, $lastStepIndex);
                }
                elseif ($step instanceof StepInterface)
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


    }