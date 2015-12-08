<?php
    
    namespace Showcase\Package\Debug;

    use ObjectivePHP\Application\ApplicationInterface;
    use ObjectivePHP\Config\Loader\DirectoryLoader;
    use ObjectivePHP\Events\EventInterface;
    use ObjectivePHP\Matcher\Matcher;
    use ObjectivePHP\ServicesFactory\ServicesFactory;
    use PhpConsole\Connector;
    use Showcase\Application;

    /**
     * Class DebugPackage
     *
     * @package Showcase\Package\Debug
     */
    class DebugPackage
    {

        /**
         * @param Application $app
         *
         * @throws \ObjectivePHP\Config\Exception
         */
        public function __invoke(ApplicationInterface $app)
        {

            // setup autoloading for current package
            $app->getAutoloader()->addPsr4('Showcase\\Package\\Debug\\', 'packages/Debug/src');


            // init package here
            $configLoader = new DirectoryLoader();
            $config       = $configLoader->load(__DIR__ . '/config');

            $app->getConfig()->merge($config);

            $connector = Connector::getInstance();

            $connector->setSourcesBasePath(getcwd());
            $matcher = new Matcher();

            // redirect errors to PhpConsole
            \PhpConsole\Handler::getInstance()->start();

            $app->getEventsHandler()->bind('*', function (EventInterface $event) use ($app, $connector, $matcher)
            {

                /**
                 * @var $connector \PhpConsole\Connector
                 */
                if ($connector->isActiveClient())
                {
                    $console = \PhpConsole\Handler::getInstance();
                    $context = $event->getContext();
                    $origin = $event->getOrigin();

                    switch (true)
                    {
                        case $event->getName() == 'application.workflow.step.run':
                            $console->debug(sprintf('Starting running step %s', $origin->getName()), 'workflow.step');
                            break;
                        case $event->getName() == 'application.workflow.hook.run':
                            $console->debug(sprintf('Running Middleware %s (%s)', $origin->getMiddleware()->getReference(), $origin->getMiddleware()->getDetails()), 'workflow.hook');
                            break;
                        case $matcher->match(ServicesFactory::EVENT_INSTANCE_BUILT . '.*', $event->getName()):
                            $console->debug(sprintf('Built service %s (%s)', $context['serviceSpecs']->getId(), (is_object($context['instance']) ? get_class($context['instance']) : get_type($context['instance']))), 'services');
                            break;
                    }
                }

            })
            ;

        }


    }