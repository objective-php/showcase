<?php

    namespace Showcase\Action\Demo\Events;
    
    
    use ObjectivePHP\Application\Action\DefaultAction;
    use ObjectivePHP\Application\ApplicationInterface;
    use ObjectivePHP\Application\Workflow\Hook;
    use ObjectivePHP\Application\Workflow\Step;
    use Showcase\Application;

    /**
     * Class Workflow
     *
     * @package Showcase\Action\Demo\Events
     */
    class Workflow extends DefaultAction
    {

        /**
         * Run the action
         *
         * @var $app Application
         *
         */
        public function run(ApplicationInterface $app)
        {


            $hooks = $app->getSteps();
            $workflow = [];
            $hooks->each(function (Step $hook) use (&$workflow, $app)
            {
                $workflow[$hook->getName()] = [];
                $currentStep                = &$workflow[$hook->getName()];

                    $hook->each(function (Hook $hook, $alias) use(&$currentStep, $app)
                {
                    if(is_int($alias)) $alias = 'unaliased';
                    $currentStep[] = $alias . ': ' . $hook->getMiddleware()->getDescription();
                });


            });

            return
                [
                    'page.title'    => 'Workflow steps',
                    'workflow'  => $workflow
                ];
        }

    }