<?php

    namespace Showcase\Package\Overrider;

    use ObjectivePHP\Application\ApplicationInterface;
    use ObjectivePHP\Application\Middleware\AbstractMiddleware;
    use ObjectivePHP\Config\Config;
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

            $app->getConfig()->merge($this->getConfig());

        }


        /**
         * @return Config
         */
        protected function getConfig()
        {

            return Config::factory([
                'actions.namespaces' =>
                    [
                        'Showcase\\Package\\Overrider\\Action'
                    ],
                'views.locations'    =>
                    [
                        __DIR__ . '/views'
                    ],
                'services'           =>
                    [
                        ['id' => 'overrider', 'instance' => new OverriderPackage()]
                    ]
            ]);

        }
    }