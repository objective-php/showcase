<?php

    namespace Showcase\Action\Demo\Doctrine;
    
    
    use Entity\Employee;
    use ObjectivePHP\Application\Action\AbstractAction;
    use ObjectivePHP\Application\Workflow\Event\WorkflowEvent;
    use ObjectivePHP\DoctrinePackage\Parameter\EntityParameter;

    class Parameter extends AbstractAction
    {

        public function expects()
        {
            return [
                (new EntityParameter(0, true))->setEntity(Employee::class)
            ];
        }

        public function run(WorkflowEvent $event)
        {
            return ['employee' => $this->getEmployee()];
        }

        /**
         * @return Employee
         */
        protected function getEmployee()
        {
           return $this->getParam(0);
        }
    }