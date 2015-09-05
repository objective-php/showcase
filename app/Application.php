<?php

    namespace Showcase;

    use Listener\ActionDependenciesInjector;
    use ObjectivePHP\Application\AbstractApplication;
    use ObjectivePHP\Application\WebAppWorkflow;
    use ObjectivePHP\Application\Task\RtaCallbacksAggregate;
    use ObjectivePHP\ServicesFactory\ServicesFactory;

    class Application extends AbstractApplication
    {
        public function init()
        {
            $this->setWorkflow(new WebAppWorkflow());

            // bind main workflow listeners
            $this->getWorkflow()->bind('init', new RtaCallbacksAggregate());

            // bind application listeners
            $this->getEventsHandler()->bind(ServicesFactory::EVENT_INSTANCE_BUILT . '.action.*', ActionDependenciesInjector::class);

        }

    }


