<?php
    /**
     * Created by PhpStorm.
     * User: gauthier
     * Date: 01/09/15
     * Time: 13:54
     */
    
    namespace Showcase\Action\Demo\Events;
    
    
    use ObjectivePHP\Application\Action\AbstractAction;
    use ObjectivePHP\Application\Action\Param\StringParameter;
    use ObjectivePHP\Application\Workflow\Event\WorkflowEvent;

    class StepDetails extends AbstractAction
    {

        public function expects()
        {
            return [
                (new StringParameter([0 => 'step']))->setMandatory()
            ];
        }

        public function run(WorkflowEvent $event)
        {
            // replace '_' with '.' because '.' are automatically modified when present in $_GET key
            $event = $this->getStepName()->replace('_', '.');

            $listeners = $this->getEventsHandler()->getListeners((string) $event);

            $callbacks = [];

            foreach ($listeners as $eventMask => $boundCallbacks)
            {
                foreach ($boundCallbacks as $alias => $callback)
                {
                    if (is_string($callback))
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
                    if ($callback instanceof \Closure)
                    {
                        $type = 'closure';
                    }
                    elseif ($callback instanceof AbstractAction)
                    {
                        $type = 'action';
                    }
                    elseif (is_object($callback))
                    {
                        $type = 'invokable object';
                    }
                    if (is_array($callback))
                    {
                        if (is_string($callback[0]))
                        {
                            $type = 'static';
                        }
                        else
                        {
                            $type = 'method';
                        }
                    }

                    $callbacks[] = ['event' => $eventMask, 'alias' => $alias, 'type' => $type, 'callback' => $callback];
                }
            }


            return [
                'page.title'    => 'Step details',
                'page.subtitle' => 'List callbacks bound to a given workflow step',
                'event'         => $event,
                'callbacks'     => $callbacks
            ];
        }

        /**
         *
         */
        protected function getStepName()
        {
           return $this->getParam('step');
        }
    }