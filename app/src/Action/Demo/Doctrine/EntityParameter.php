<?php

    namespace Showcase\Action\Demo\Doctrine;
    
    
    use ObjectivePHP\Application\Action\RenderableAction;
    use ObjectivePHP\Application\ApplicationInterface;
    use ObjectivePHP\Notification;
    use Showcase\Service\HumanResources;

    /**
     * Class Parameter
     *
     * @package Showcase\Action\Demo\Doctrine
     */
    class EntityParameter extends RenderableAction
    {
        /**
         * @var HumanResources
         */
        protected $humanResources;

        public function init()
        {
            // $this->alias(0, 'employeeId');
        }

        /**
         * @param ApplicationInterface $app
         *
         * @return array
         */
        public function run(ApplicationInterface $app)
        {

            $id = $app->getRequest()->getParameters()->fromRoute('id');
            $employee = $this->humanResources->getEmployee($id);

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