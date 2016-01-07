<?php
    
    namespace Showcase\Action;

    use ObjectivePHP\Application\Action\DefaultAction;
    use ObjectivePHP\Application\ApplicationInterface;
    use ObjectivePHP\Application\View\Helper\Vars;
    use ObjectivePHP\Application\Workflow\Event\WorkflowEvent;

    /**
     * Class Home
     *
     * @package Showcase\Action
     */
    class Home extends DefaultAction
    {
        /**
         * @param ApplicationInterface
         *
         * @return array
         */
        public function run(ApplicationInterface $app)
        {

            $app->setParam('layout.name', 'home');

            Vars::set('page.title', 'Objective PHP Showcase');

        }
    }
