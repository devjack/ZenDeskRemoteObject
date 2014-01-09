<?php

require __DIR__ . '/../../bootstrap.php';

$config = include __DIR__ . '/../../config/config.php';

$config = new \Zend\ServiceManager\Config($config);
$serviceManager = new \Zend\ServiceManager\ServiceManager($config);

$user = new ZenDesk\Entity\User();
$user->setName('Vincent Blanchon');
$user->setEmail('blanchon.vincent+zd-integration-test'.time().'@gmail.com');

$service = $serviceManager->get('ZenDesk\Service\UserService');
$service->persist($user);

var_dump($user->getId());
