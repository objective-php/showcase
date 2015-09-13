<?php

    namespace Showcase;

    use ObjectivePHP\Application\AbstractApplication;
    use ObjectivePHP\Application\WebAppWorkflow;
    use ObjectivePHP\Application\Task\RtaCallbacksBinder;

    /**
     * Class Application
     *
     * @package Showcase
     */
    class Application extends AbstractApplication
    {
        public function init()
        {

            // register packages autoloading config
            $this->getAutoloader()->addPsr4('Showcase\\Package\\', 'packages/');

            // inject workflow
            $this->setWorkflow(new WebAppWorkflow());

            // bind main workflow listeners
            $this->getWorkflow()->bind('init', new RtaCallbacksBinder());

        }

    }


