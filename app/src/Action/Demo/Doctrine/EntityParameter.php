<?php

    namespace Showcase\Action\Demo\Doctrine;
    
    
    use ObjectivePHP\Application\Action\DefaultAction;
    use ObjectivePHP\Application\Action\Parameter\AbstractParameterProcessor;
    use ObjectivePHP\Application\Workflow\Event\WorkflowEvent;
    use ObjectivePHP\DoctrinePackage\Parameter\EntityParameterProcessor;
    use Showcase\Entity\Employee;
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

            $this->setParameterProcessor(
                (new EntityParameterProcessor('employee', 0))
                    ->setEntity(Employee::class)
                    ->setMandatory()
                    ->setMessage(AbstractParameterProcessor::IS_MISSING, 'Le paramètre :param est manquant')
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