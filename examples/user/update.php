<?php

require __DIR__ . '/../../bootstrap.php';

$config = include __DIR__ . '/../../config/config.php';

$config = new \Zend\ServiceManager\Config($config);
$serviceManager = new \Zend\ServiceManager\ServiceManager($config);

/** @var \ZenDesk\Service\UserService $userService */
$service = $serviceManager->get('ZenDesk\Service\UserService');
$user = $service->me();
$user->setName('Vincent Blanchon');
$user->save();

var_dump($user->getUpdatedAt());
