<?php

    namespace Showcase\Action\Demo\Html;
    
    
    use ObjectivePHP\Application\Action\RenderableAction;
    use ObjectivePHP\Application\ApplicationInterface;
    use ObjectivePHP\Application\Workflow\Event\WorkflowEvent;
    use Showcase\Application;

    /**
     * Class HtmlTag
     *
     * @package Showcase\Action\Demo\Html
     */
    class HtmlTag extends RenderableAction
    {
        /**
         * @param Application $app
         *
         * @return mixed
         */
        public function run(ApplicationInterface $app)
        {
            // nothing to pass to the view script here
        }

    }