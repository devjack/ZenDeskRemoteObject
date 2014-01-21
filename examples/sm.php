<?php

require __DIR__ . '/../vendor/autoload.php';

$config = include __DIR__ . '/../config/service.config.php';
$config = array_merge($config, array(
    'services' => array(
        'Config' => include __DIR__ . '/../config/local.config.php',
    ),
));

$serviceManager = new \Zend\ServiceManager\ServiceManager(
    new \Zend\ServiceManager\Config($config)
);

return $serviceManager;
