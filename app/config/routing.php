<?php
/**
 * This file is part of the Objective PHP project
 *
 * More info about Objective PHP on www.objective-php.org
 *
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
 */

use ObjectivePHP\Application;
use ObjectivePHP\Package\FastRoute\Config\FastRoute;
use ObjectivePHP\ServicesFactory\ServiceReference;
use Showcase\Action\Demo\Doctrine\EntityParameter;
use Showcase\Action\Demo\Doctrine\Listing as DoctrineListing;
use Showcase\Action\Demo\Events\Load;
use Showcase\Action\Demo\Events\Workflow;
use Showcase\Action\Demo\Html;
use Showcase\Action\Demo\Json;
use Showcase\Action\Demo\Services\Definitions;
use Showcase\Action\Home;
use Showcase\Api\Employee\EmployeeEndpoint;

return [

    new FastRoute('home', '/', Home::class),
    new FastRoute('demo/html-tag', '/demo/html/html-tag', Html\HtmlTag::class),
    new FastRoute('demo/events/workflow', '/demo/events/workflow', Workflow::class),
    new FastRoute('demo/events/load', '/demo/events/load', Load::class),
    new FastRoute('demo/services/definitions', '/demo/services/definitions', Definitions::class),
    new FastRoute('demo/doctrine/listing', '/demo/doctrine/listing', DoctrineListing::class),
    new FastRoute('demo/doctrine/entity-parameter', '/demo/doctrine/entity-parameter/{id}', new ServiceReference('action.demo.doctrine.entity-parameter')),
    new FastRoute('demo/json', '/demo/json', Json::class),
    new FastRoute('api/employees', '/api/employees[/{id}]', EmployeeEndpoint::class, FastRoute::RESTFUL)
    //new UrlAlias('/', '/home'),
    //new UrlAlias('/login', '/auth/login'),
    //new SimpleRoute('html-demo', '/html', Html\HtmlTag::class)

];
