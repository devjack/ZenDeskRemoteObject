<?php

$serviceManager = include __DIR__ . '/../sm.php';

/** @var \ZenDesk\Service\UserService $service */
$service = $serviceManager->get('ZenDesk\Service\UserService');
$user = $service->me();

var_dump($user->getName());