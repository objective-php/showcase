<?php

    namespace Showcase\Package\Overrider;

    use ObjectivePHP\Application\Workflow\Event\WorkflowEvent;
    use ObjectivePHP\Config\Config;

    /**
     * Class OverriderPackage
     *
     * @package Showcase\Package\Overrider
     */
    class OverriderPackage
    {
        /**
         * @param WorkflowEvent $event
         */
        public function __invoke(WorkflowEvent $event)
        {

            // setup autoloading for current package
            $event->getApplication()->getAutoloader()->addPsr4('Showcase\\Package\\Overrider\\', 'packages/Overrider/src');

            $event->getApplication()->getConfig()->merge($this->getConfig());

        }


        /**
         * @return mixed|null|Config
         */
        protected function getConfig()
        {

            return Config::factory([
                'actions.namespaces' => ['Showcase\\Package\\Overrider\\Action'],
                'views.locations' =>
                [
                    __DIR__ . '/views'
                ],
                'services' =>
                [
                    ['id' => 'overrider', 'instance' => new OverriderPackage()]
                ]
            ]);

        }
    }