<?php

    namespace Listener;
    
    use ObjectivePHP\Events\EventInterface;

    class ActionDependenciesInjector
    {
        public function __invoke(EventInterface $event)
        {
            $action = $event->getContext()['instance'];
            $servicesFactory = $event->getOrigin();

            if(method_exists($action, 'setHumanResources'))
            {
                $action->setHumanResources($servicesFactory->get('services.human-resources'));
            }

        }
    }