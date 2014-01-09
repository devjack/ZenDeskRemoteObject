<?php

namespace ZenDeskTest\Entity;

use ZenDeskTest\AbstractTestCase;
use ZenDesk\Entity\OrganizationField;

class OrganizationFieldTest extends AbstractTestCase
{
    /** @var \ZenDesk\Entity\OrganizationField */
    protected static $organizationField;

    public function testCanSerialize()
    {
        $organizationField = new OrganizationField();

        $organizationField->setId(1);

        $this->assertNotNull($organizationField->getId());

        $organizationField = unserialize(serialize($organizationField));

        $this->assertNotNull($organizationField->getId());
    }

    public function testCanCreateOrganizationField()
    {
        $organizationField = new OrganizationField();
        /** @var \ZenDesk\Service\OrganizationFieldService $service */
        $service = $this->getSM()->get('ZenDesk\Service\OrganizationFieldService');

        $this->assertEquals($organizationField->getId(), null);

        $organizationField->setType('text');
        $organizationField->setTitle('My awesome field ' . uniqid());
        $organizationField->setKey('awesome_field_' . uniqid());
        $service->persist($organizationField);

        $this->assertNotNull($organizationField->getId());
        $this->assertNotNull($organizationField->getRemoteService());
        $this->assertNotNull($organizationField->getCreatedAt());

        self::$organizationField = $organizationField;
    }

    public function testCanUpdateAOrganizationField()
    {
        if (!self::$organizationField) {
            $this->markTestSkipped('Organization field entity must be defined');
        }

        $organizationField = self::$organizationField;
        $updatedAt = $organizationField->getUpdatedAt();

        $organizationField->setTitle('My awesome field updated');
        $organizationField->save();

        $this->assertNotEquals($updatedAt, $organizationField->getUpdatedAt());
    }

    public function testCanDeleteAOrganizationField()
    {
        if (!self::$organizationField) {
            $this->markTestSkipped('Organization field entity must be defined');
        }

        $organizationField = self::$organizationField;
        $organizationField->delete();
    }
}