<?php

    namespace Showcase\Action\Demo\Doctrine;

    use Entity\Employee;
    use ObjectivePHP\Application\Action\AbstractAction;
    use ObjectivePHP\Application\Workflow\Event\WorkflowEvent;

    use Doctrine\ORM\EntityManager;
    use Service\HumanResources;

    class Misc extends AbstractAction
    {
        /**
         * @var HumanResources
         */
        protected $humanResources;

        public function run(WorkflowEvent $event)
        {

            $employees = $this->getHumanResources()->getRandomEmployees(10);

            return compact('employees');
        }

        /**
         * @return HumanResources
         */
        public function getHumanResources()
        {
            if(is_null($this->humanResources))
            {
                $this->humanResources = $this->getService('services.human-resources');
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