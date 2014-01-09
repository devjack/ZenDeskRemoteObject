<?php

namespace ZenDeskTest\Service;

use ZenDeskTest\AbstractTestCase;

class TicketServiceTest extends AbstractTestCase
{
    public function testCanGetAllTickets()
    {
        /** @var \ZenDesk\Service\TicketService $service */
        $service = $this->getSM()->get('ZenDesk\Service\TicketService');
        $tickets = $service->getAll();

        $this->assertTrue(count($tickets) > 0);
        $ticket = current($tickets);
        $this->assertNotNull($ticket->getId());
        $this->assertNotNull($ticket->getStatus());
    }

    public function testCanGetRecenteTickets()
    {
        /** @var \ZenDesk\Service\TicketService $service */
        $service = $this->getSM()->get('ZenDesk\Service\TicketService');
        $tickets = $service->getRecent();

        $this->assertTrue(count($tickets) > 0);
        $ticket = current($tickets);
        $this->assertNotNull($ticket->getId());
        $this->assertNotNull($ticket->getStatus());
    }
}