<?php

namespace ZenDeskTest\Entity;

use ZenDeskTest\AbstractTestCase;
use ZenDesk\Entity\TicketField;

class TicketFieldTest extends AbstractTestCase
{
    /** @var \ZenDesk\Entity\TicketField */
    protected static $ticketField;

    public function testCanSerialize()
    {
        $ticketField = new TicketField();

        $ticketField->setId(1);

        $this->assertNotNull($ticketField->getId());

        $ticketField = unserialize(serialize($ticketField));

        $this->assertNotNull($ticketField->getId());
    }

    public function testCanCreateTicketField()
    {
        $ticketField = new TicketField();
        /** @var \ZenDesk\Service\TicketFieldService $service */
        $service = $this->getSM()->get('ZenDesk\Service\TicketFieldService');

        $this->assertEquals($ticketField->getId(), null);

        $ticketField->setType('text');
        $ticketField->setTitle('My awesome field');
        $service->persist($ticketField);

        $this->assertNotNull($ticketField->getId());
        $this->assertNotNull($ticketField->getRemoteService());
        $this->assertNotNull($ticketField->getCreatedAt());

        self::$ticketField = $ticketField;
    }

    public function testCanUpdateATicketField()
    {
        if (!self::$ticketField) {
            $this->markTestSkipped('Ticket field entity must be defined');
        }

        $ticketField = self::$ticketField;
        $updatedAt = $ticketField->getUpdatedAt();

        $ticketField->setTitle('My awesome field updated');
        $ticketField->save();

        $this->assertNotEquals($updatedAt, $ticketField->getUpdatedAt());
    }

    public function testCanDeleteATicketField()
    {
        if (!self::$ticketField) {
            $this->markTestSkipped('Ticket field entity must be defined');
        }

        $ticketField = self::$ticketField;
        $ticketField->delete();
    }
}