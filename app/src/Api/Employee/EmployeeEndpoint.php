<?php

namespace Showcase\Api\Employee;

use ObjectivePHP\Application\Middleware\VersionnedApiMiddleware;
use Showcase\Api\Employee\v1\EmployeeApi;

/**
 * Created by PhpStorm.
 * User: gauthier
 * Date: 23/04/2016
 * Time: 14:12
 */
class EmployeeEndpoint extends VersionnedApiMiddleware
{
    public function init()
    {
        $this->registerMiddleware('1.0', new EmployeeApi());
    }

}