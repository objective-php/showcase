<?php

    namespace Showcase\Package\Overrider\Action;

    use ObjectivePHP\Application\Workflow\Event\WorkflowEvent;

    /**
     * Class Home
     *
     * @package Showcase\Package\Overrider\Action
     */
    class Home
    {
        /**
         * @param WorkflowEvent $event
         *
         * @return array
         */
        public function __invoke(WorkflowEvent $event)
        {
            return [
                'page.title'    => $event->getApplication()->getConfig()->app->name,
                'page.subtitle' => 'This is the homepage from Overrider Package!',
            ];
        }
    }