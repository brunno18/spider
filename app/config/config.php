<?php

use Phalcon\Config;

$heroku_url = getenv("HEROKU_URL");

if (empty($heroku_url)) {
    $heroku_url = "http://localhost/spider/";
}

$dbopts = getenv('DATABASE_URL');

if (empty($dbopts)) {
    $dbopts['adapter'] = 'Mysql';
    $dbopts['host'] = 'localhost';
    $dbopts['port'] = '3306';
    $dbopts['user'] = 'root';
    $dbopts['pass'] = '';
    $dbopts['dbname'] = 'spider';
}
else {
    $dbopts = parse_url($dbopts);
    $dbopts['adapter'] = 'Postgresql';
    $dbopts['dbname'] = ltrim($dbopts["path"],'/');
}

$config = new Config(array(
    'database' => array(
        'adapter'     => $dbopts['adapter'],
        'host'        => $dbopts['host'],
        'port'        => $dbopts['port'],
        'username'    => $dbopts['user'],
        'password'    => $dbopts['pass'],
        'dbname'      => $dbopts['dbname'],
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