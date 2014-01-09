<?php

namespace ZenDeskTest\Service;

use ZenDeskTest\AbstractTestCase;

class UserFieldServiceTest extends AbstractTestCase
{
    public function testCanGetATicketField()
    {
        /** @var \ZenDesk\Service\UserFieldService $service */
        $service = $this->getSM()->get('ZenDesk\Service\UserFieldService');
        $field = $service->get(ZD_TESTS_USER_FIELD_SAMPLE_ID);

        $this->assertNotNull($field->getId());
        $this->assertNotNull($field->getTitle());
    }

    public function testCanGetAllTicketField()
    {
        /** @var \ZenDesk\Service\UserFieldService $service */
        $service = $this->getSM()->get('ZenDesk\Service\UserFieldService');
        $fields = $service->getAll();

        $this->assertTrue(count($fields) > 0);
        $field = current($fields);
        $this->assertNotNull($field->getId());
        $this->assertNotNull($field->getTitle());
    }
}