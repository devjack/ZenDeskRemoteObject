<?php

require __DIR__ . '/../../vendor/autoload.php';

$config = new \Zend\ServiceManager\Config(include __DIR__ . '/../../config/config.php');
$serviceManager = new \Zend\ServiceManager\ServiceManager($config);

/** @var \ZenDesk\Service\UserService $userService */
$userService = $serviceManager->get('ZenDesk\Service\UserService');
$user = $userService->me();

var_dump($user->getName());