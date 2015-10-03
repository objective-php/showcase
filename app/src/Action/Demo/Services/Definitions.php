<?php

    namespace Showcase\Action\Demo\Services;

    use ObjectivePHP\Application\Action\DefaultAction;
    use ObjectivePHP\Application\Workflow\Event\WorkflowEvent;

    /**
     * Class Definitions
     *
     * @package Showcase\Action\Demo\Services
     */
    class Definitions extends DefaultAction
    {
        /**
         * @param WorkflowEvent $event
         *
         * @return array
         */
        public function run(WorkflowEvent $event)
        {

            $services = $this->getServicesFactory()->getServices();


            return [
                'services' => $services
            ];
        }

    }