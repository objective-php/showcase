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
use ObjectivePHP\Package\FastRoute\Config\FastRoute;
use Showcase\Action\Demo\Html;
use Showcase\Action\Home;

return [

    new FastRoute('home', '/', Home::class),
    new FastRoute('demo/html-tag', '/demo/html/html-tag', Html\HtmlTag::class),
    //new UrlAlias('/', '/home'),
    //new UrlAlias('/login', '/auth/login'),
    //new SimpleRoute('html-demo', '/html', Html\HtmlTag::class)

];
