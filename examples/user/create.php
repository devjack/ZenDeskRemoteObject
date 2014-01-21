<?php

$serviceManager = include __DIR__ . '/../sm.php';

$user = new ZenDesk\Entity\User();
$user->setName('Vincent Blanchon');
$user->setEmail('blanchon.vincent+zd-integration-test'.time().'@gmail.com');

/** @var \ZenDesk\Service\UserService $service */
$service = $serviceManager->get('ZenDesk\Service\UserService');
$service->persist($user);

var_dump($user->getId());
