<?php

    namespace Showcase;

    use ObjectivePHP\Application\AbstractApplication;
    use ObjectivePHP\Application\WebAppWorkflow;
    use ObjectivePHP\Application\Task\RtaCallbacksBinder;

    class Application extends AbstractApplication
    {
        public function init()
        {
            $this->setWorkflow(new WebAppWorkflow());

            // bind main workflow listeners
            $this->getWorkflow()->bind('init', new RtaCallbacksBinder());

        }

    }


