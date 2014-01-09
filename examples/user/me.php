<?php

require __DIR__ . '/../../bootstrap.php';
$config = include __DIR__ . '/../../config/config.php';

$config = new \Zend\ServiceManager\Config($config);
$serviceManager = new \Zend\ServiceManager\ServiceManager($config);

/** @var \ZenDesk\Service\UserService $userService */
$userService = $serviceManager->get('ZenDesk\Service\UserService');
$user = $userService->me();

var_dump($user->getName());