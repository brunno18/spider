<?php


$heroku_url = getenv("HEROKU_URL");

if (empty($heroku_url)) {
    $heroku_url = "http://localhost/spider/";
}

return new \Phalcon\Config(array(
    'application' => array(
        'controllersDir' => __DIR__ . '/../controllers/',
        'viewsDir'       => __DIR__ . '/../views/',
        'cacheDir'       => __DIR__ . '/../cache/',
        'formsDir'       => __DIR__ . '/../forms/',
        'libraryDir'     => __DIR__ . '/../library/',
        'baseUri'        => $heroku_url,
    )
));