<?php

    namespace Showcase\Action\Demo\Doctrine;
    
    
    use ObjectivePHP\Application\Action\DefaultAction;
    use ObjectivePHP\Application\ApplicationInterface;
    use ObjectivePHP\Notification;
    use Showcase\Service\HumanResources;

    /**
     * Class Parameter
     *
     * @package Showcase\Action\Demo\Doctrine
     */
    class EntityParameter extends DefaultAction
    {
        /**
         * @var HumanResources
         */
        protected $humanResources;

        public function init()
        {
            $this->alias(0, 'employeeId');
        }

        /**
         * @param ApplicationInterface $app
         *
         * @return array
         */
        public function run()
        {

            $employee = $this->humanResources->getEmployee($this->getParam('employeeId'));

            return ['employee' => $employee];
        }

        /**
         * @return HumanResources
         */
        public function getHumanResources()
        {
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