<?php

$serviceManager = include __DIR__ . '/../sm.php';

/** @var \ZenDesk\Service\UserService $service */
$service = $serviceManager->get('ZenDesk\Service\UserService');
$user = $service->me();
$user->setName('Vincent Blanchon');
$user->save();

var_dump($user->getUpdatedAt());
