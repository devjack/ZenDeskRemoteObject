<?php

namespace ZenDeskTest\Service;

use ZenDeskTest\AbstractTestCase;

class UserServiceTest extends AbstractTestCase
{
    protected static $userId;

    public function testCanGetCurrentUser()
    {
        /** @var \ZenDesk\Service\UserService $service */
        $service = $this->getSM()->get('ZenDesk\Service\UserService');
        $user = $service->me();

        $this->assertNotNull($user->getId());
        $this->assertNotNull($user->getEmail());

        self::$userId = $user->getId();
    }

    public function testCanGetUser()
    {
        /** @var \ZenDesk\Service\UserService $service */
        $service = $this->sm->get('ZenDesk\Service\UserService');
        $user = $service->get(self::$userId);

        $this->assertEquals(self::$userId, $user->getId());
        $this->assertNotNull($user->getEmail());
    }

    public function testCanGetAllUsers()
    {
        /** @var \ZenDesk\Service\UserService $service */
        $service = $this->sm->get('ZenDesk\Service\UserService');
        $users = $service->getAll();

        $this->assertTrue(count($users) > 0);
        $user = current($users);
        $this->assertNotNull($user->getId());
        $this->assertNotNull($user->getEmail());
    }
}