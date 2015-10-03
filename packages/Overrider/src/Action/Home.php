<?php

    namespace Showcase\Package\Overrider\Action;

    use ObjectivePHP\Application\Action\DefaultAction;
    use ObjectivePHP\Application\Workflow\Event\WorkflowEvent;

    /**
     * Class Home
     *
     * @package Showcase\Package\Overrider\Action
     */
    class Home extends \Showcase\Action\Home
    {
        /**
         * @param WorkflowEvent $event
         *
         * @return array
         */
        public function run(WorkflowEvent $event)
        {
            return [
                'page.title'    => $event->getApplication()->getConfig()->app->name,
                'page.subtitle' => 'This is the homepage from Overrider Package!',
            ];
        }
    }