<?php

namespace Showcase\Api\Employee\v1;

use ObjectivePHP\Application\ApplicationInterface;
use ObjectivePHP\Application\Middleware\AbstractRestfulMiddleware;

/**
 * Created by PhpStorm.
 * User: gauthier
 * Date: 23/04/2016
 * Time: 14:14
 */
class EmployeeApi extends AbstractRestfulMiddleware
{
    public function get(ApplicationInterface $app)
    {

        if($id = $app->getRequest()->getParameters()->fromRoute('id'))
        {
            return ['employee' => $id];
        }
        else
        {
            return ['employees' => [rand(), rand()]];
        }
    }
}