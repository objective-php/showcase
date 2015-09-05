<?php

    namespace Gateway;
    
    
    use Doctrine\ORM\EntityManager;
    use Entity\Employee;

    class HumanResourcesGateway
    {
        /**
         * @var EntityManager
         */
        protected $entityManager;

        public function __construct(EntityManager $entityManager)
        {
            $this->setEntityManager($entityManager);
        }

        /**
         * @param $employeeId
         *
         * @return Employee
         * @throws \Doctrine\ORM\ORMException
         * @throws \Doctrine\ORM\OptimisticLockException
         * @throws \Doctrine\ORM\TransactionRequiredException
         *
         */
        public function fetchEmployee($employeeId)
        {
            return $this->getEntityManager()->getRepository(Employee::class)->find($employeeId);
        }

        /**
         * @param $criteria
         * @param $options
         *
         * @return array
         */
        public function fetchEmployees($criteria, $options)
        {
            // init expected options
            $orderBy = $limit = $offset = null;

            if(!empty($options['order']))
            {
                $orderBy = $options['order'];
            }

            if(!empty($options['limit']))
            {
                $limit = $options['limit'];
            }

            if(!empty($options['start']))
            {
                $offset = $options['start'];
            }

            $repository = $this->getEntityManager()->getRepository(Employee::class);

            return $repository->findBy($criteria, $orderBy, $limit, $offset);
        }

        /**
         * @return EntityManager
         */
        public function getEntityManager()
        {
            return $this->entityManager;
        }

        /**
         * @param EntityManager $entityManager
         *
         * @return $this
         */
        public function setEntityManager($entityManager)
        {
            $this->entityManager = $entityManager;

            return $this;
        }


    }