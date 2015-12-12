<?php

    namespace Showcase;

    use ObjectivePHP\Application\AbstractApplication;
    use ObjectivePHP\Application\Operation\Common\RequestWrapper;
    use ObjectivePHP\Application\Operation\Common\ResponseInitializer;
    use ObjectivePHP\Application\Operation\Common\ResponseSender;
    use ObjectivePHP\Application\Operation\Common\ServiceLoader;
    use ObjectivePHP\Application\Operation\Common\SimpleRouter;
    use ObjectivePHP\Application\Operation\Common\ViewRenderer;
    use ObjectivePHP\Application\Operation\Rta\ActionRunner;
    use ObjectivePHP\Application\Operation\Rta\ViewResolver;
    use ObjectivePHP\Application\Session\Session;
    use ObjectivePHP\Application\View\Helper\Vars;
    use ObjectivePHP\Application\Workflow\Filter\RouteFilter;
    use ObjectivePHP\Application\Workflow\Filter\UrlFilter;
    use ObjectivePHP\DoctrinePackage\DoctrinePackage;
    use ObjectivePHP\Notification\Info;
    use ObjectivePHP\EloquentPackage\EloquentPackage;
    use Showcase\Middleware\LayoutSwitcher;
    use Showcase\Package\Debug\DebugPackage;
    use Showcase\Package\Overrider\OverriderPackage;
    use Showcase\Package\ShowSource\ShowSourcePackage;

    /**
     * Class Application
     *
     * @package Showcase
     */
    class Application extends AbstractApplication
    {
        public function init()
        {

            // register packages autoloading
            $this->getAutoloader()->addPsr4('Showcase\\Package\\', 'packages/');

            // define middleware endpoints
            $this->addSteps('init', 'bootstrap', 'route', 'action', 'rendering', 'end');

            // plug the debug package first, so that it can report all Middleware execution
            $this->on('init')->plug(DebugPackage::class, function ($app)
            {
                return $app->getEnv() == 'development' && isset($_GET['debug']);
            })
            ;


            // initialize request and response
            $this->on('init')
                // handle request and response
                 ->plug(new RequestWrapper())->as('request-wrapper')
                 ->plug(new ResponseInitializer())->as('response-initializer')
            ;


            $this->importPackages();

            // route request (this is done after packages have been loaded)
            //
            // NOTE: using asDefault() make this middleware optional - if
            // another one with the same reference has been plugged earlier,
            // this call has no effect on the actual middleware stack
            $this->on('route')->plug(SimpleRouter::class)->asDefault('router');


            // load framework native middleware
            $this->on('bootstrap')->plug(ServiceLoader::class)->asDefault('service-loader');

            // give access to config everywhere, including views
            $this->on('bootstrap')->plug(function ($app)
            {
                Vars::$config = $app->getConfig();
            })
            ;

            // action runner will catch action return value and inject the in the Vars container
            $this->on('action')->plug(ActionRunner::class)->asDefault('action-runner');

            // inject a message on all pages but home
            $this->on('rendering')->plug(function ()
            {
                (new Session('notifications'))->set('action.current', (new Info('Rendering action "' . $this->getParam('action') . '"')));
            },
                new UrlFilter('!/'))
            ;

            // inject a message on home page only, and only on first visit
            $this->on('rendering')->plug(function ()
            {
                (new Session('notifications'))->set('hello', (new Info('Welcome on ObjectivePHP demo')));
                (new Session)->set('greetings.done', true);

            }, new UrlFilter('/'), [$this, 'assertGreetingsMiddlewareActivation'])
            ;


            $this->on('rendering')
                 ->plug(LayoutSwitcher::class, new UrlFilter('/'))
                 ->plug(new ViewResolver())->as('view-resolver')
                 ->plug(new ViewRenderer())->as('view-renderer')
            ;


            /**
             * Uncomment the line below if you want to return Json
             */
            // $this->on('end')->plug(new ResponseSender(), function($app) { return $app->getRequest()->getHeader('Content-Type') == 'application/json';});
            $this->on('end')->plug(new ResponseSender());

        }

        public function importPackages()
        {

            $this->on('bootstrap')
                // load external packages

                // this one for all url below /demo (leading and trailing "/" are ignored)
                 ->plug(ShowSourcePackage::class, new UrlFilter('/demo/*'))
                // and this one only for urls under /demo/doctrine
                ->plug(new DoctrinePackage(), new UrlFilter('/demo/doctrine/*'))
                // same for Eloquent
                ->plug(new EloquentPackage(), new UrlFilter('/demo/eloquent/*'))
            ;

        }

        /**
         *
         * Tells the application whether a given middleware should be executed or not
         *
         * @return bool
         */
        public function assertGreetingsMiddlewareActivation()
        {
            $session = new Session;

            return !$session->get('greetings.done');
        }

    }


