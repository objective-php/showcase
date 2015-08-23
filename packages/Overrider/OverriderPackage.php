<?php

    namespace Showcase\Package\Overrider;

    use ObjectivePHP\Application\Workflow\Event\WorkflowEvent;
    use ObjectivePHP\Config\Config;
    
    class OverriderPackage
    {
        public function __invoke(WorkflowEvent $event)
        {

            $event->getApplication()->getConfig()->merge($this->getConfig());

        }


        protected function getConfig()
        {

            return Config::factory([
                'app.actions' => ['Showcase\\Action\\' => __DIR__ . '/actions'],
                'views.locations' =>
                [
                    __DIR__ . '/views'
                ]
            ]);

        }
    }