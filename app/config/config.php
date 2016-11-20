<?php

use Phalcon\Config;

$config = new Config(array(
    'database' => array(
        'adapter'     => 'Mysql',
        'host'        => 'localhost',
        'username'    => 'root',
        'password'    => '',
        'dbname'      => 'spider',
        'charset'     => 'utf8',
    ),
    'application' => array(
        'modelsDir'      => APP_PATH . '/models/',
        'migrationsDir'  => APP_PATH . '/migrations/',
        'baseUri'        => '/spider/',
        'publicUrl'      => 'http://localhost/spider'
    )
));
