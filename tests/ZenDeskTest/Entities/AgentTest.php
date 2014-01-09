<?php

namespace ZenDeskTest\Entity;

use ZenDeskTest\AbstractTestCase;
use ZenDesk\Entity\Agent;

class AgentTest extends AbstractTestCase
{
    /** @var \ZenDesk\Entity\Agent */
    protected static $agent;

    public function testCanSerialize()
    {
        $agent = new Agent();

        $agent->setExternalId(1);

        $this->assertNotNull($agent->getExternalId());

        $agent = unserialize(serialize($agent));

        $this->assertNotNull($agent->getExternalId());
    }

    public function testCanCreateAUser()
    {
        $agent = new Agent();
        /** @var \ZenDesk\Service\AgentService $service */
        $service = $this->getSM()->get('ZenDesk\Service\AgentService');

        $this->assertEquals($agent->getId(), null);

        $id = uniqid();

        $agent->setName($name = 'Vince' . $id);
        $agent->setEmail('blanchon.vincent+zd-tests'.$id.'@gmail.com');
        $service->persist($agent);

        $this->assertNotNull($agent->getId());
        $this->assertNotNull($agent->getRemoteService());
        $this->assertEquals($agent->getName(), $name);

        self::$agent = $agent;
    }

    public function testCanUpdateAUser()
    {
        if (!self::$agent) {
            $this->markTestSkipped('User entity must be defined');
        }

        $agent = self::$agent;
        $id = uniqid();

        $updatedAt = $agent->getUpdatedAt();

        $agent->setName($name = 'Vincent' . $id);
        $agent->save();

        $this->assertNotEquals($updatedAt, $agent->getUpdatedAt());
    }

    public function testCanGetTickets()
    {
        if (!self::$agent) {
            $this->markTestSkipped('User entity must be defined');
        }

        $user = self::$agent;
        $tickets = $user->getTickets();

        $this->assertCount(0, $tickets);

        /** @var \ZenDesk\Service\AgentService $service */
        $service = $this->getSM()->get('ZenDesk\Service\AgentService');
        /** @var \ZenDesk\Entity\Agent $admin */
        $admin = $service->me(); // user with tickets -- to change, bad tests crossed
        $tickets = $admin->getTickets();

        $this->assertTrue(count($tickets) > 0);
        $ticket = current($tickets);
        $this->assertNotNull($ticket->getId());

    }

    public function testCanDeleteAUser()
    {
        if (!self::$agent) {
            $this->markTestSkipped('User entity must be defined');
        }

        $agent = self::$agent;
        $active = $agent->getActive();

        $agent->delete();

        $this->assertNotEquals($active, $agent->getActive());
    }
}