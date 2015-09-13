<?php

    namespace Showcase\Action\Demo\Services;
    use ObjectivePHP\Application\Action\AbstractAction;
    use ObjectivePHP\Application\Workflow\Event\WorkflowEvent;
    
    /**
     * Created by PhpStorm.
     * User: gauthier
     * Date: 23/08/15
     * Time: 19:19
     */
    class Definitions extends AbstractAction
    {
        public function run(WorkflowEvent $event)
        {

            $services = $this->getServicesFactory()->getServices();


            return [
                'services' => $services
            ];
        }

    }