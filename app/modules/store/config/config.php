<?php

return new \Phalcon\Config(array(
    'application' => array(
        'controllersDir' => __DIR__ . '/../controllers/',
        'viewsDir'       => __DIR__ . '/../views/',
        'cacheDir'       => __DIR__ . '/../cache/',
        'formsDir'       => __DIR__ . '/../forms/',
        'libraryDir'     => __DIR__ . '/../library/',
        'baseUri'        => '',
    )
));