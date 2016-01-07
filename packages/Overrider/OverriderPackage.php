<?php

    namespace Showcase\Package\Overrider;

    use ObjectivePHP\Application\ApplicationInterface;
    use ObjectivePHP\Application\Config\ActionNamespace;
    use ObjectivePHP\Application\Config\ApplicationName;
    use ObjectivePHP\Application\Config\ViewsLocation;
    use ObjectivePHP\Application\Middleware\AbstractMiddleware;
    use ObjectivePHP\Config\Config;
    use ObjectivePHP\ServicesFactory\Config\Service;
    use Showcase\Application;

    /**
     * Class OverriderPackage
     *
     * @package Showcase\Package\Overrider
     */
    class OverriderPackage extends AbstractMiddleware
    {
        /**
         * @param Application $app
         */
        public function run(ApplicationInterface $app)
        {

            // setup autoloading for current package
            $app->getAutoloader()->addPsr4('Showcase\\Package\\Overrider\\', 'packages/Overrider/src');


            // amend configuration
            $directives = [
                new ApplicationName('Overrode App Name'),
                new ActionNamespace('Showcase\Package\Overrider\Action'),
                new ViewsLocation(__DIR__ . '/views'),
                new Service(['id' => 'overrider', 'instance' => new OverriderPackage()])
            ];

            foreach($directives as $directive) $app->getConfig()->import($directive);

        }

    }
