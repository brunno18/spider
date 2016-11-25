<?php

use Phalcon\Config;

$heroku_url = getenv("HEROKU_URL");

if (empty($heroku_url)) {
    $heroku_url = "http://localhost/spider/";
}

$dbopts = getenv('DATABASE_URL');

if (empty($dbopts)) {
    $database = array(
        'adapter'     => 'Mysql',
        'host'        => 'localhost',
        'username'    => 'root',
        'password'    => '',
        'dbname'      => 'spider',
        'charset'     => 'utf8',
    );
}
else {
    $dbopts = parse_url($dbopts);
    $database = array(
        'host'        => $dbopts['host'],
        'port'        => $dbopts["port"],
        'username'    => $dbopts['user'],
        'password'    => $dbopts['pass'],
        'dbname'      => ltrim($dbopts["path"],'/')
    );
}

$config = new Config(array(
    'database' => $database,
    'application' => array(
        'modelsDir'      => 'app/models/',
        'migrationsDir'  => 'app/migrations/',
        'baseUri'        => $heroku_url,
        'publicUrl'      => $heroku_url
    )
));

return $config;