<?php

namespace ZenDeskTest\Service;

use ZenDeskTest\AbstractTestCase;

class SearchServiceTest extends AbstractTestCase
{
    public function testCanSearchUsers()
    {
        /** @var \ZenDesk\Service\SearchService $service */
        $service = $this->getSM()->get('ZenDesk\Service\SearchService');
        $users = $service->users('created<' . date('Y-m-d'));

        $this->assertTrue(count($users) > 0);
        $user = current($users);
        $this->assertNotNull($user->getId());
        $this->assertNotNull($user->getEmail());
    }

    public function testCanSearchTickets()
    {
        /** @var \ZenDesk\Service\SearchService $service */
        $service = $this->getSM()->get('ZenDesk\Service\SearchService');
        $tickets = $service->tickets('created<' . date('Y-m-d'));

        $this->assertTrue(count($tickets) > 0);
        $ticket = current($tickets);
        $this->assertNotNull($ticket->getId());
        $this->assertNotNull($ticket->getSubject());
    }
}