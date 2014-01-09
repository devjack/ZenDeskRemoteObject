<?php

require __DIR__ . '/../../bootstrap.php';

$config = include __DIR__ . '/../../config/config.php';

$config = new \Zend\ServiceManager\Config($config);
$serviceManager = new \Zend\ServiceManager\ServiceManager($config);

$ticket = new ZenDesk\Entity\Ticket();
$ticket->setSubject('My first ticket');
$ticket->setDescription('French will win the soccer world cup');
$ticket->setStatus('pending');

$service = $serviceManager->get('ZenDesk\Service\TicketService');
$service->persist($ticket);

var_dump($ticket->getId());