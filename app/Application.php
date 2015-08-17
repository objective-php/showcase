<?php

    namespace Poc;

    use ObjectivePHP\Application\Pattern\Rta\RtaCallbacksAggregate;
    use ObjectivePHP\Application\Pattern\Rta\RtaWorkflow;
    use ObjectivePHP\Application\AbstractApplication;

    class Application extends AbstractApplication
    {
        public function init()
        {
            $this->setWorkflow(new RtaWorkflow());

            $this->getEventsHandler()->bind('workflow.init', new RtaCallbacksAggregate());

        }

    }


