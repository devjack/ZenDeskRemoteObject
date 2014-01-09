<?php

namespace ZenDeskTest\Service;

use ZenDeskTest\AbstractTestCase;

class OrganizationFieldServiceTest extends AbstractTestCase
{
    public function testCanGetATicketField()
    {
        /** @var \ZenDesk\Service\OrganizationFieldService $service */
        $service = $this->getSM()->get('ZenDesk\Service\OrganizationFieldService');
        $field = $service->get(ZD_TESTS_ORGANIZATION_FIELD_SAMPLE_ID);

        $this->assertNotNull($field->getId());
        $this->assertNotNull($field->getTitle());
    }

    public function testCanGetAllTicketField()
    {
        /** @var \ZenDesk\Service\OrganizationFieldService $service */
        $service = $this->getSM()->get('ZenDesk\Service\OrganizationFieldService');
        $fields = $service->getAll();

        $this->assertTrue(count($fields) > 0);
        $field = current($fields);
        $this->assertNotNull($field->getId());
        $this->assertNotNull($field->getTitle());
    }
}