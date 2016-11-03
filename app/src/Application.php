<?php

namespace Showcase;

use ObjectivePHP\Application\AbstractApplication;
use ObjectivePHP\Application\Operation\RequestWrapper;
use ObjectivePHP\Application\Operation\ResponseInitializer;
use ObjectivePHP\Application\Operation\ResponseSender;
use ObjectivePHP\Application\Operation\ServiceLoader;
use ObjectivePHP\Application\Operation\ViewRenderer;
use ObjectivePHP\Application\Operation\ViewResolver;
use ObjectivePHP\Application\Session\Session;
use ObjectivePHP\Application\View\Helper\Vars;
use ObjectivePHP\Application\Workflow\Filter\ContentTypeFilter;
use ObjectivePHP\Application\Workflow\Filter\UrlFilter;
use ObjectivePHP\Notification\Info;
use ObjectivePHP\Package\FastRoute\FastRoutePackage;
use ObjectivePHP\Package\FastRoute\FastRouteRouter;
use ObjectivePHP\Router\Dispatcher;
use ObjectivePHP\Router\MetaRouter;
use ObjectivePHP\Router\PathMapperRouter;
use Showcase\Middleware\LayoutSwitcher;
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
        // initialize request and response
        $this->getStep('init')
            // handle request and response
             ->plug(new RequestWrapper())->as('request-wrapper')
             ->plug(new ResponseInitializer())->as('response-initializer')
        ;
        
        
        // route request (this is done after packages have been loaded)
        //
        // NOTE: using asDefault() make this middleware optional - if
        // another one with the same reference has been plugged earlier,
        // this call has no effect on the actual middleware stack
        $router = new MetaRouter([new PathMapperRouter(), new FastRouteRouter()]);
        $this->getStep('route')->plug($router)->asDefault('router');
        
        // load framework native middleware
        $this->getStep('bootstrap')->plug(ServiceLoader::class)->asDefault('service-loader');
        // give access to config everywhere, including views
        //
        // Note: this is used by default layouts
        $this->getStep('bootstrap')->plug(
            function ($app)
            {
                Vars::$config = $app->getConfig();
            }
        )
        ;
        
        // actually executes action
        $this->getStep('action')->plug(new Dispatcher());
        
        // handle view rendering
        $this->getStep('rendering')
             ->plug(LayoutSwitcher::class, new UrlFilter('/'))
             ->plug(function ()
             {
                 (new Session('notifications'))->set('hello', (new Info('Welcome on ObjectivePHP demo')));
                 (new Session)->set('greetings.done', true);
             }, new UrlFilter('/'), [$this, 'filterGreetingsMiddlewareActivation'])
            // this one for all HTML pages rendered by actions from "demo" namespace
             ->plug(ShowSourcePackage::class, new UrlFilter('/demo/*'), new ContentTypeFilter('text/html'))
             ->plug(new ViewResolver())->as('view-resolver')
             ->plug(new ViewRenderer())->as('view-renderer')
        ;
        
        
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


