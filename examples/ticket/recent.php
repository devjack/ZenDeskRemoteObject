<?php

require __DIR__ . '/../../vendor/autoload.php';

$config = new \Zend\ServiceManager\Config(include __DIR__ . '/../../config/config.php');
$serviceManager = new \Zend\ServiceManager\ServiceManager($config);

/** @var \ZenDesk\Service\TicketService $ticket */
$service = $serviceManager->get('ZenDesk\Service\TicketService');
$tickets = $service->getRecent();

var_dump(count($tickets));