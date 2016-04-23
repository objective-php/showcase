<?php

    namespace Showcase\Action\Demo\Doctrine;

    use ObjectivePHP\Application\Action\HttpAction;
    use ObjectivePHP\Application\Action\RenderableAction;
    use ObjectivePHP\Application\ApplicationInterface;
    use ObjectivePHP\Application\Workflow\Event\WorkflowEvent;
    use Showcase\Service\HumanResources;

    /**
     * Class Listing
     *
     * @package Showcase\Action\Demo\Doctrine
     */
    class Listing extends RenderableAction
    {
        /**
         * @var HumanResources
         */
        protected $humanResources;

        /**
         * @param ApplicationInterface $app
         *
         * @return array
         * @internal param WorkflowEvent $event
         *
         */public function run(ApplicationInterface $app)
        {
            $employees = $this->getHumanResources()->getRandomEmployees(10);

            return compact('employees');
        }

        /**
         * @return HumanResources
         */
        public function getHumanResources()
        {
            if (is_null($this->humanResources))
            {
                $this->humanResources = $this->getService('service.human-resources');
            }

            return $this->humanResources;
        }

        /**
         * @param HumanResources $humanResources
         *
         * @return $this
         */
        public function setHumanResources($humanResources)
        {
            $this->humanResources = $humanResources;

            return $this;
        }

    }