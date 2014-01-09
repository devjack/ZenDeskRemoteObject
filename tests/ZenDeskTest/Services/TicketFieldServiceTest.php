<?php

namespace ZenDeskTest\Service;

use ZenDeskTest\AbstractTestCase;

class TicketFieldServiceTest extends AbstractTestCase
{
    public function testCanGetATicketField()
    {
        /** @var \ZenDesk\Service\TicketFieldService $service */
        $service = $this->getSM()->get('ZenDesk\Service\TicketFieldService');
        $field = $service->get(ZD_TESTS_TICKET_FIELD_SAMPLE_ID);

        $this->assertNotNull($field->getId());
        $this->assertNotNull($field->getTitle());
    }

    public function testCanGetAllTicketField()
    {
        /** @var \ZenDesk\Service\TicketFieldService $service */
        $service = $this->getSM()->get('ZenDesk\Service\TicketFieldService');
        $fields = $service->getAll();

        $this->assertTrue(count($fields) > 0);
        $field = current($fields);
        $this->assertNotNull($field->getId());
        $this->assertNotNull($field->getTitle());
    }
}