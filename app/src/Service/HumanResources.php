<?php

    namespace Service;
    
    
    use Gateway\HumanResourcesGateway;

    class HumanResources
    {
        /**
         * @var HumanResourcesGateway
         */
        protected $gateway;


        public function __construct(HumanResourcesGateway $gateway)
        {
            $this->setGateway($gateway);
        }

        /**
         * @param $employeeId
         *
         * @return \Entity\Employee
         */
        public function getEmployee($employeeId)
        {
            // this is where to perform
            // - parameters sanity checks
            // - ACL checks
            // - etc.
            return $this->getGateway()->fetchEmployee($employeeId);
        }

        /**
         * @param $quantity
         */
        public function getRandomEmployees($quantity)
        {
            return $this->getGateway()->fetchEmployees([],['start' => rand(1000, 30000), 'limit' => $quantity]);
        }

        /**
         * @return HumanResourcesGateway
         */
        public function getGateway()
        {
            return $this->gateway;
        }

        /**
         * @param HumanResourcesGateway $gateway
         *
         * @return $this
         */
        public function setGateway($gateway)
        {
            $this->gateway = $gateway;

            return $this;
        }


    }