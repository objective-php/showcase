<?php

    namespace Showcase\Action\Demo\Doctrine;
    
    
    use Showcase\Entity\Employee;
    use ObjectivePHP\Application\Action\AbstractAction;
    use ObjectivePHP\Application\Action\Parameter\ActionParameter;
    use ObjectivePHP\Application\Workflow\Event\WorkflowEvent;
    use ObjectivePHP\DoctrinePackage\Parameter\EntityParameterProcessor;
    use Showcase\Service\HumanResources;

    /**
     * Class Parameter
     *
     * @package Showcase\Action\Demo\Doctrine
     */
    class EntityParameter extends AbstractAction
    {
        /**
         * @var HumanResources
         */
        protected $humanResources;

        public function init()
        {

            $this->setParameterProcessor(
                (new EntityParameterProcessor('employee', 0))
                    ->setEntity(Employee::class)
                    ->setMandatory()
                    ->setMessage(ActionParameter::IS_MISSING, 'Le paramètre :param est manquant')
            );

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