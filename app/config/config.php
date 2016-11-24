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
        'modelsDir'      => 'app/models/',
        'migrationsDir'  => 'app/migrations/',
        'baseUri'        => '/spider/',
        'publicUrl'      => 'http://localhost/spider'
    )
));


return $config;