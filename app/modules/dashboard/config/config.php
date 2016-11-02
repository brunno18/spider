<?php

return new \Phalcon\Config(array(
    'application' => array(
        'controllersDir' => __DIR__ . '/../controllers/',
        'viewsDir'       => __DIR__ . '/../views/',
        'libraryDir'     => __DIR__ . '/../library/',
        'cacheDir'       => __DIR__ . '/../cache/',
        'baseUri'        => '/dashboard',
    )
));