<?php
/**
 * This file is part of the Objective PHP project
 *
 * More info about Objective PHP on www.objective-php.org
 *
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
 */

use ObjectivePHP\Application;
use ObjectivePHP\Application\Config\SimpleRoute;
use ObjectivePHP\Application\Config\UrlAlias;
use Showcase\Action\Demo\Html;

return [
    new UrlAlias('/', '/home'),
    new UrlAlias('/login', '/auth/login'),
    new SimpleRoute('html-demo', '/html', Html\HtmlTag::class)

];
