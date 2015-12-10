<?php

    namespace Showcase\Action\Demo\Eloquent;

    use ObjectivePHP\Application\ApplicationInterface;
    use ObjectivePHP\Application\Session\Session;
    use ObjectivePHP\Html\Tag\Tag;
    use ObjectivePHP\Notification\Info;
    use Showcase\Model\Employee;
    use Showcase\Action\Demo\Doctrine\Listing as DoctrineListing;

    /**
     * Class Listing
     *
     * @package Showcase\Action\Demo\Doctrine
     */
    class Listing extends DoctrineListing
    {
        /**
         * @param Application
         *
         * @return array
         */
        public function run(ApplicationInterface $app)
        {
            $employees = Employee::select()->skip(rand(1000, 30000))->limit(10)->get()->toArray();

            (new Session('notifications'))->set('eloquent.info', new Info('This page is identical to ' . Tag::a('the Doctrine version', '/demo/doctrine/listing') . ' but uses Eloquent as ORM.<br><br>The view script is the same, because this Action inherits from the Doctrine version, and no view has been associated. So the view associated to the inherited Action is used by default.'));


            return ['employees' => $employees, 'links-warning' => true];
        }

    }