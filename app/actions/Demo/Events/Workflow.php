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
            if ($step = $this->getParam('step'))
            {
                return $this->stepDetails($event);
            }

            return $this->workflowSteps($event);

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


            $this->getApplication()->getWorkflow()->bind('*', function(WorkflowEvent $e) { });

            $event = $this->getParam('step')->replace('_', '.');

            $listeners = $this->getEventsHandler()->getListeners((string) $event);

            $callbacks = [];
            foreach($listeners as $eventMask => $boundCallbacks)
            {
                foreach($boundCallbacks as $alias => $callback)
                {
                    if(is_string($callback))
                    {
                        if (class_exists($callback))
                        {
                            $type = 'invokable class';
                        }
                        else
                        {
                            $type = 'function';
                        }
                    }
                    if($callback instanceof \Closure)
                    {
                        $type = 'closure';
                    }
                    elseif($callback instanceof AbstractAction)
                    {
                        $type = 'action';
                    }
                    elseif(is_object($callback))
                    {
                        $type = 'invokable object';
                    }
                    if(is_array($callback))
                    {
                        if(is_string($callback[0]))
                        {
                            $type = 'static';
                        }
                        else
                        {
                            $type = 'method';
                        }
                    }

                    $callbacks[] = ['event' => $eventMask,  'alias' => $alias, 'type' => $type, 'callback' => $callback];
                }
            }


            return [
                'page.title'    => 'Step details',
                'page.subtitle' => 'List callbacks bound to a given workflow step',
                'event'         => $event,
                'callbacks'     => $callbacks
            ];
        }

        public function workflowSteps(WorkflowEvent $event)
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