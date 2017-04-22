<?php

$container->loadFromExtension('doctrine', array(
    'dbal' => array(
        'driver' => 'pdo_mysql',
        'host' => 'localhost',
        'dbname' => 'web_store',
        'user' => 'root',
        'password' => 'casa1990',
    ),
));

