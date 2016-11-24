<?php

use Phalcon\Config;

$heroku_url = getenv("HEROKU_URL");

if (empty($heroku_url)) {
    $heroku_url = "http://localhost/spider/";
}

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
        'baseUri'        => $heroku_url,
        'publicUrl'      => $heroku_url
    )
));

return $config;