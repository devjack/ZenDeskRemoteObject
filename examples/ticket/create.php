<?php

$serviceManager = include __DIR__ . '/../sm.php';

$ticket = new ZenDesk\Entity\Ticket();
$ticket->setSubject('My first ticket');
$ticket->setDescription('French will win the soccer world cup');
$ticket->setStatus('pending');

/** @var \ZenDesk\Service\TicketService $service */
$service = $serviceManager->get('ZenDesk\Service\TicketService');
$service->persist($ticket);

var_dump($ticket->getId());