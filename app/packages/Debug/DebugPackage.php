<?php
    
    namespace Poc\Package\Debug;

    use ObjectivePHP\Application\Workflow\Event\WorkflowEvent;
    use ObjectivePHP\Config\Config;
    use ObjectivePHP\Events\EventInterface;

    class DebugPackage
    {
        public function __invoke(WorkflowEvent $event)
        {
            // init package here
            $workflow  = $event->getApplication()->getWorkflow();

            $application = $event->getApplication();

            $application->getConfig()->merge(new Config([
                'app.debug' => true,
                'app.actions' => [
                        'Poc\\Action\\' => 'app/packages/Debug/actions'
                ],
                'app.views.locations' =>
                [
                    'app/packages/Debug/views'
                ]
            ]));

            $workflow->bind('post', ['dumpConfig' => function () use ($application) {
                var_Dump($application->getConfig()->toArray());
            }]);

            $workflow->bind('post', ['dumpParams' => function () use ($application) {
                var_dump($application->getRequest()->getParameters());
            }]);

           // $workflow->getEventsHandler()->bind('*', [$this, 'trackEvents']);
        }

        public function trackEvents(EventInterface $event)
        {
            echo 'Triggered ' . $event->getName() . '<br />';
            if (count($event->getResults())) echo "<div style='padding-left:30px'> - Ran " . count($event->getResults()) . ' callbacks</div><br>';
        }
    }