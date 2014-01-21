<?php

$serviceManager = include __DIR__ . '/../sm.php';

/** @var \ZenDesk\Service\TicketService $service */
$service = $serviceManager->get('ZenDesk\Service\TicketService');
$tickets = $service->getAll();

var_dump(count($tickets));