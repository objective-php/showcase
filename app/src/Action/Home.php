<?php
    
    namespace Showcase\Action;

    use ObjectivePHP\Application\Action\DefaultAction;
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
         * @param WorkflowEvent $event
         *
         * @return array
         */
        public function run(WorkflowEvent $event)
        {


            Vars::set('page.title', 'Objective PHP Showcase');

        }
    }