<?php
    
    namespace Showcase\Package\Debug;

    use ObjectivePHP\Application\Workflow\Event\WorkflowEvent;
    use ObjectivePHP\Config\Loader\DirectoryLoader;
    use ObjectivePHP\Events\Callback\AliasedCallback;
    use ObjectivePHP\Events\EventInterface;

    /**
     * Class DebugPackage
     *
     * @package Showcase\Package\Debug
     */
    class DebugPackage
    {
        /**
         * @param WorkflowEvent $event
         *
         * @throws \ObjectivePHP\Config\Exception
         */
        public function __invoke(WorkflowEvent $event)
        {

            // setup autoloading for current package
            $event->getApplication()->getAutoloader()->addPsr4('Showcase\\Package\\Debug\\', 'packages/Debug/src');


            // init package here
            $application = $event->getApplication();
            $workflow  = $application->getWorkflow();

            $configLoader = new DirectoryLoader();
            $config = $configLoader->load(__DIR__ . '/config');

            $application->getConfig()->merge($config);

            // $workflow->getEventsHandler()->bind('*', [$this, 'trackEvents']);
        }

        /**
         * @param EventInterface $event
         */
        public function trackEvents(EventInterface $event)
        {
            echo 'Triggered ' . $event->getName() . '<br />';
            if (count($event->getResults())) echo "<div style='padding-left:30px'> - Ran " . count($event->getResults()) . ' callbacks</div><br>';
        }

        /**
         * Dump residual buffered output
         */
        public function __destruct()
        {
            ob_start();
            fpassthru(fopen('php://memory', 'r'));
            $output = ob_get_clean();
            if($output)
            {
                echo 'Unsent output:<br /><br />';
                echo $output;
            }
        }

    }