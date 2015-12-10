<?php

    /**
     * @var $config ObjectivePHP\Config\Config
     */

    $dbConfig = $config->eloquent;

    $dbConfig->driver   = 'mysql';
    $dbConfig->host     = '127.0.0.1';
    $dbConfig->port     = 3306;
    $dbConfig->username = 'demo';
    $dbConfig->password = '';
    $dbConfig->database = 'employees';

