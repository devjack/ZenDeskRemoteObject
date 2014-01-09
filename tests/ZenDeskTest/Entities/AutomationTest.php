<?php

namespace ZenDeskTest\Entity;

use ZenDeskTest\AbstractTestCase;
use ZenDesk\Entity\Automation;
use ZenDeskTestAssets\CacheHttpClient;

class AutomationTest extends AbstractTestCase
{
    /** @var \ZenDesk\Entity\Automation */
    protected static $automation;

    public function testCanSerialize()
    {
        $automation = new Automation();

        $automation->setId(1);

        $this->assertNotNull($automation->getId());
        $automation = unserialize(serialize($automation));

        $this->assertNotNull($automation->getId());
    }

    public function testCanCreateAnAutomation()
    {
        $automation = new Automation();
        /** @var \ZenDesk\Service\AutomationService $service */
        $service = $this->getSM()->get('ZenDesk\Service\AutomationService');

        $this->assertEquals($automation->getId(), null);

        $id = CacheHttpClient::getUniqId() . __METHOD__;

        $automation->setTitle($id);
        $automation->setConditions(array(
            'all' => array(
                array('field' => 'status', 'operator' => 'is', 'value' => 'open'),
                array('field' => 'priority', 'operator' => 'less_than', 'value' => 'high')
            ),
            'any' => array(
                array('field' => 'priority', 'operator' => 'less_than', 'value' => 'high')
            ),
        ));
        $automation->setActions(array(
            array('field' => 'priority', 'value' => 'high')
        ));
        $service->persist($automation);

        $this->assertNotNull($automation->getId());
        $this->assertNotNull($automation->getRemoteService());

        self::$automation = $automation;
    }

    public function testCanUpdateAnAutomation()
    {
        if (!self::$automation) {
            $this->markTestSkipped('Automation entity must be defined');
        }
        $automation = self::$automation;

        $id = CacheHttpClient::getUniqId() . __METHOD__;
        $updatedAt = $automation->getUpdatedAt();

        $automation->setTitle($id);
        $automation->save();

        $this->assertEquals($id, $automation->getTitle());
        $this->assertNotEquals($updatedAt, $automation->getUpdatedAt());
    }

    public function testCanDeleteAnAutomation()
    {
        if (!self::$automation) {
            $this->markTestSkipped('Automation entity must be defined');
        }

        $automation = self::$automation;
        $automation->delete();

        // to change, tests crossed
        $this->setExpectedException('RestRemoteObject\Client\Rest\Exception\ResponseErrorException', 'RecordNotFound');
        /** @var \ZenDesk\Service\AutomationService $service */
        $service = $this->getSM()->get('ZenDesk\Service\AutomationService');
        $service->get($automation->getId());
    }
}