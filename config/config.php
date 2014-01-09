<?php

$config = array(
    'abstract_factories' => array(
        'ZenDesk\Factory\ServiceAbstractFactory' => 'ZenDesk\Factory\ServiceAbstractFactory',
    ),
    'factories' => array(
        'ZenDesk\Rest\Client' => 'ZenDesk\Rest\Client\ClientFactory',
        'ZenDesk\Rest\Remote' => 'ZenDesk\Rest\Client\RemoteFactory',
    ),
);

$config = array_replace_recursive($config, include 'local.config.php');

return $config;
