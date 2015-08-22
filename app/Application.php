<?php

    namespace Showcase;

    use ObjectivePHP\Application\Pattern\Rta\RtaCallbacksAggregate;
    use ObjectivePHP\Application\Pattern\Rta\RtaWorkflow;
    use ObjectivePHP\Application\AbstractApplication;

    class Application extends AbstractApplication
    {
        public function init()
        {
            $this->setWorkflow(new RtaWorkflow());

            $this->getWorkflow()->bind('init', new RtaCallbacksAggregate());

        }

    }


