<?php

namespace ZenDeskTest\Entity;

use ZenDeskTest\AbstractTestCase;
use ZenDesk\Entity\UserField;

class UserFieldTest extends AbstractTestCase
{
    /** @var \ZenDesk\Entity\UserField */
    protected static $userField;

    public function testCanSerialize()
    {
        $userField = new UserField();

        $userField->setId(1);

        $this->assertNotNull($userField->getId());

        $userField = unserialize(serialize($userField));

        $this->assertNotNull($userField->getId());
    }

    public function testCanCreateUserField()
    {
        /** @var \ZenDesk\Entity\UserField $userField */
        $userField = new UserField();
        /** @var \ZenDesk\Service\UserFieldService $service */
        $service = $this->getSM()->get('ZenDesk\Service\UserFieldService');

        $this->assertEquals($userField->getId(), null);

        $userField->setType('text');
        $userField->setTitle('My awesome field ' . uniqid());
        $userField->setKey('awesome_field_' . uniqid());
        $service->persist($userField);

        $this->assertNotNull($userField->getId());
        $this->assertNotNull($userField->getRemoteService());
        $this->assertNotNull($userField->getCreatedAt());

        self::$userField = $userField;
    }

    public function testCanUpdateAUserField()
    {
        if (!self::$userField) {
            $this->markTestSkipped('User field entity must be defined');
        }

        $userField = self::$userField;
        $updatedAt = $userField->getUpdatedAt();

        $userField->setTitle('My awesome field updated');
        $userField->save();

        $this->assertNotEquals($updatedAt, $userField->getUpdatedAt());
    }

    public function testCanDeleteAUserField()
    {
        if (!self::$userField) {
            $this->markTestSkipped('User field entity must be defined');
        }

        $userField = self::$userField;
        $userField->delete();
    }
}