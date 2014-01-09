<?php

namespace ZenDeskTest\Entity;

use ZenDeskTest\AbstractTestCase;
use ZenDesk\Entity\Trigger;
use ZenDeskTestAssets\CacheHttpClient;

class TriggerTest extends AbstractTestCase
{
    /** @var \ZenDesk\Entity\Trigger */
    protected static $trigger;

    public function testCanSerialize()
    {
        $trigger = new Trigger();

        $trigger->setId(1);

        $this->assertNotNull($trigger->getId());

        $trigger = unserialize(serialize($trigger));

        $this->assertNotNull($trigger->getId());
    }

    public function testCanCreateATrigger()
    {
        $trigger = new Trigger();
        /** @var \ZenDesk\Service\TriggerService $service */
        $service = $this->getSM()->get('ZenDesk\Service\TriggerService');

        $this->assertEquals($trigger->getId(), null);

        $id = CacheHttpClient::getUniqId() . __METHOD__;

        $trigger->setTitle($id);
        $trigger->setConditions(array(
            'all' => array(
                array('field' => 'status', 'operator' => 'is', 'value' => 'open'),
                array('field' => 'priority', 'operator' => 'less_than', 'value' => 'high')
            ),
            'any' => array(
                array('field' => 'priority', 'operator' => 'less_than', 'value' => 'high')
            ),
        ));
        $trigger->setActions(array(
            array('field' => 'priority', 'value' => 'high')
        ));
        $service->persist($trigger);

        $this->assertNotNull($trigger->getId());
        $this->assertNotNull($trigger->getRemoteService());

        self::$trigger = $trigger;
    }

    public function testCanUpdateATrigger()
    {
        if (!self::$trigger) {
            $this->markTestSkipped('Trigger entity must be defined');
        }
        $trigger = self::$trigger;

        $id = CacheHttpClient::getUniqId() . __METHOD__;
        $updatedAt = $trigger->getUpdatedAt();

        $trigger->setTitle($id);
        $trigger->save();

        $this->assertEquals($id, $trigger->getTitle());
        $this->assertNotEquals($updatedAt, $trigger->getUpdatedAt());
    }

    public function testCanDeleteATrigger()
    {
        if (!self::$trigger) {
            $this->markTestSkipped('Trigger entity must be defined');
        }

        $trigger = self::$trigger;
        $trigger->delete();

        // to change, tests crossed
        $this->setExpectedException('RestRemoteObject\Client\Rest\Exception\ResponseErrorException', 'RecordNotFound');
        $triggerService = $this->getSM()->get('ZenDesk\Service\TriggerService');
        $triggerService->get($trigger->getId());
    }
}