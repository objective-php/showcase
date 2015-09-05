<?php

    namespace Showcase\Action\Demo\Doctrine;
    
    
    use Entity\Employee;
    use ObjectivePHP\Application\Action\AbstractAction;
    use ObjectivePHP\Application\Action\Param\StringParameter;
    use ObjectivePHP\Application\Workflow\Event\WorkflowEvent;
    use ObjectivePHP\DoctrinePackage\Parameter\EntityParameter;
    use Service\HumanResources;

    class Parameter extends AbstractAction
    {
        /**
         * @var HumanResources
         */
        protected $humanResources;

        public function expects()
        {
            return [
                (new EntityParameter(0, 'employee'))
                    ->setEntity(Employee::class)
                    ->setMandatory()
                    ->setMessage('Le paramètre :param est manquant')
            ];
        }

        public function run(WorkflowEvent $event)
        {
            return ['employee' => $this->getEmployee()];
        }

        /**
         * @codeAssist
         * @return Employee
         */
        protected function getEmployee()
        {
           return $this->getParam('employee');
        }
    }