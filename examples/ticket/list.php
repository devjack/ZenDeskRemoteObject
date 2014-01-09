<?php

require __DIR__ . '/../../bootstrap.php';

$config = include __DIR__ . '/../../config/config.php';

$config = new \Zend\ServiceManager\Config($config);
$serviceManager = new \Zend\ServiceManager\ServiceManager($config);

/** @var \ZenDesk\Service\TicketService $ticket */
$service = $serviceManager->get('ZenDesk\Service\TicketService');
$tickets = $service->getAll();

var_dump(count($tickets));