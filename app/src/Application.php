<?php

    namespace Showcase;

    use ObjectivePHP\Application\AbstractApplication;
    use ObjectivePHP\Application\ApplicationInterface;
    use ObjectivePHP\Application\Config\ApplicationName;
    use ObjectivePHP\Application\Operation\Common\RequestWrapper;
    use ObjectivePHP\Application\Operation\Common\ResponseSender;
    use ObjectivePHP\Application\Operation\Common\ServiceLoader;
    use ObjectivePHP\Application\Operation\Common\SimpleRouter;
    use ObjectivePHP\Application\Operation\Common\ViewRenderer;
    use ObjectivePHP\Application\Operation\Rta\ActionPlugger;
    use ObjectivePHP\Application\Operation\Rta\ViewResolver;
    use ObjectivePHP\Application\Session\Session;
    use ObjectivePHP\Application\View\Helper\Vars;
    use ObjectivePHP\Application\Workflow\Filter\ContentTypeFilter;
    use ObjectivePHP\Application\Workflow\Filter\UrlFilter;
    use ObjectivePHP\Package\Doctrine\DoctrinePackage;
    use ObjectivePHP\Package\Eloquent\EloquentPackage;
    use ObjectivePHP\Notification\Info;
    use ObjectivePHP\Package\FastRoute\FastRoutePackage;
    use Showcase\Middleware\LayoutSwitcher;
    use ObjectivePHP\Package\Devtools\DevtoolsPackage;
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
            $this->getStep('init')->plug(DevtoolsPackage::class, function (ApplicationInterface $app)
            {
                return $app->getEnv() == 'development' && isset($_GET['debug']);
            })->as('devtools')
            ;


            // initialize request
            $this->getStep('init')// handle request
            ->plug(new RequestWrapper())->as('request-wrapper');

            $this->getStep('init')
                // load FastRoute router
                ->plug(new FastRoutePackage())
            ;


            // load external packages
            $this->getStep('bootstrap')
                // and this one only for urls under /demo/doctrine
                 ->plug(new DoctrinePackage(), new UrlFilter('/demo/doctrine/*'))
                // same for Eloquent
                 ->plug(new EloquentPackage(), new UrlFilter('/demo/eloquent/*'))
                // activate Overrider package
                ->plug(new OverriderPackage(), function($app) { return !empty($_GET['override']);})
            ;

            $this->getStep('rendering')
                // this one for all HTML pages rendered by actions from "demo" namespace
                 ->plug(ShowSourcePackage::class, new UrlFilter('/demo/*'), new ContentTypeFilter('text/html'))
            ;

           // $this->getStep('bootstrap')->plug(function($app) { var_dump($app->getConfig()->get('layouts.locations'));});


            // route request (this is done after packages have been loaded)
            //
            // NOTE: using asDefault() make this middleware optional - if
            // another one with the same reference has been plugged earlier,
            // this call has no effect on the actual middleware stack
            $this->getStep('route')->plug(SimpleRouter::class)->asDefault('router');


            // load framework native middleware
            $this->getStep('bootstrap')->plug(ServiceLoader::class)->asDefault('service-loader');

            // give access to config everywhere, including views
            $this->getStep('bootstrap')->plug(function (Application $app)
            {
                // inject application config in Vars
                //
                // we use here a public variable to prevent code assist from exposing
                // methods as setConfig()
                //
                // From now on, you can get the config by using Vars::config()
                Vars::$config = $app->getConfig();
            })
            ;

            // action runner will catch action return value and inject the in the Vars container
            // $this->getStep('route')->plug(ActionPlugger::class)->asDefault('action-plugger');

            // inject a message on all pages but home
            $this->getStep('rendering')->plug(function ()
            {
                (new Session('notifications'))->set('action.current', (new Info('Rendering action "' . $this->getParam('runtime.action.middleware')
                                                                                                            ->getDescription() . '"')));
            },
                new UrlFilter('!/'), // "!/" means "does not match URL matching '/'",
                function($app) { return $app->getParam('runtime.action.middleware');} // this won't be executed if no action middleware was set
            )
            ;

            // inject a message on home page only, and only on first visit
            $this->getStep('rendering')->plug(function ()
            {
                (new Session('notifications'))->set('hello', (new Info('Welcome on ObjectivePHP demo')));
                (new Session)->set('greetings.done', true);

            }, new UrlFilter('/'), [$this, 'filterGreetingsMiddlewareActivation'])
            ;


            $this->getStep('rendering')
                 ->plug(LayoutSwitcher::class, new UrlFilter('/'))
                 ->plug(new ViewResolver(), new ContentTypeFilter('text/html'))->asDefault('view-resolver')
                 ->plug(new ViewRenderer(), new ContentTypeFilter('text/html'))->asDefault('view-renderer')
            ;


            /**
             * Uncomment the line below if you want to return Json
             */
            // $this->on('end')->plug(new ResponseSender(), function($app) { return $app->getRequest()->getHeader('Content-Type') == 'application/json';});
            $this->getStep('end')->plug(new ResponseSender());

        }

        /**
         *
         * Tells the application whether a given middleware should be executed or not
         *
         * @return bool
         */
        public function filterGreetingsMiddlewareActivation()
        {
            return !((new Session)->get('greetings.done'));
        }

    }


