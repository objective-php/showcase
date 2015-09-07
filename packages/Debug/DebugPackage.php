<?php
    
    namespace Showcase\Package\Debug;

    use ObjectivePHP\Application\Workflow\Event\WorkflowEvent;
    use ObjectivePHP\Config\Loader\DirectoryLoader;
    use ObjectivePHP\Events\Callback\AliasedCallback;
    use ObjectivePHP\Events\EventInterface;

    class DebugPackage
    {
        public function __invoke(WorkflowEvent $event)
        {

            // init package here
            $application = $event->getApplication();
            $workflow  = $application->getWorkflow();

            $configLoader = new DirectoryLoader();
            $config = $configLoader->load(__DIR__ . '/config');

            $application->getConfig()->merge($config);


            $workflow->bind('packages.post', new AliasedCallback('dumpConfig', function () use ($application)
            {
                var_dump($application->getConfig()->toArray());
            }));

            $workflow->bind('post', new AliasedCallback('dumpParams', function () use ($application) {
               // var_dump($application->getRequest()->getParameters());
            }));

            $workflow->getEventsHandler()->bind('*', [$this, 'trackEvents']);
        }

        public function trackEvents(EventInterface $event)
        {
            echo 'Triggered ' . $event->getName() . '<br />';
            if (count($event->getResults())) echo "<div style='padding-left:30px'> - Ran " . count($event->getResults()) . ' callbacks</div><br>';
        }
    }