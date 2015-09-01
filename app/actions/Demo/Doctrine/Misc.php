<?php

    namespace Showcase\Action\Demo\Doctrine;

    use Entity\Employee;
    use ObjectivePHP\Application\Action\AbstractAction;
    use ObjectivePHP\Application\Workflow\Event\WorkflowEvent;

    use Doctrine\ORM\EntityManager;

    class Misc extends AbstractAction
    {
        public function run(WorkflowEvent $event)
        {

            /* @var $em EntityManager */
            $em = $this->getServicesFactory()->get('doctrine.em.default');

            $employees = $em->getRepository(Employee::class)->findBy([], [], 10, rand(0,300000));

            return compact('employees');
        }

    }