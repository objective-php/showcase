<?php

    namespace Showcase;

    use ObjectivePHP\Application\AbstractApplication;
    use ObjectivePHP\Application\WebAppWorkflow;
    use ObjectivePHP\Application\Task\RtaCallbacksAggregate;

    class Application extends AbstractApplication
    {
        public function init()
        {
            $this->setWorkflow(new WebAppWorkflow());

            $this->getWorkflow()->bind('init', new RtaCallbacksAggregate());

        }

    }


