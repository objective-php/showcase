<?php

    namespace Showcase\Package\Overrider\Action;

    use ObjectivePHP\Application\Action\DefaultAction;
    use ObjectivePHP\Application\ApplicationInterface;
    use ObjectivePHP\Application\Workflow\Event\WorkflowEvent;

    /**
     * Class Home
     *
     * @package Showcase\Package\Overrider\Action
     */
    class Home extends \Showcase\Action\Home
    {
        /**
         * @param ApplicationInterface $app
         *
         * @return array
         */
        public function run(ApplicationInterface $app)
        {
            return [
                'page.title'    => 'Test',
                'page.subtitle' => 'This is the homepage from Overrider Package!',
            ];
        }
    }