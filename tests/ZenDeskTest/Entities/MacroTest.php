<?php

namespace ZenDeskTest\Entity;

use ZenDesk\Entity\Parameter\Restriction;
use ZenDeskTest\AbstractTestCase;
use ZenDesk\Entity\Macro;
use ZenDeskTestAssets\CacheHttpClient;

class MacroTest extends AbstractTestCase
{
    /** @var \ZenDesk\Entity\Macro */
    protected static $macro;

    /** @var \ZenDesk\Entity\Macro */
    protected static $macroRestriction;

    public function testCanSerialize()
    {
        $macro = new Macro();

        $macro->setId(1);

        $this->assertNotNull($macro->getId());

        $macro = unserialize(serialize($macro));

        $this->assertNotNull($macro->getId());
    }

    public function testCanCreateAMacroWithoutRestriction()
    {
        $macro = new Macro();
        /** @var \ZenDesk\Service\MacroService $service */
        $service = $this->getSM()->get('ZenDesk\Service\MacroService');

        $this->assertEquals($macro->getId(), null);

        $id = CacheHttpClient::getUniqId() . __METHOD__;

        $macro->setTitle($id);
        $macro->setActions(array(
            array('field' => 'priority', 'value' => 'high')
        ));
        $service->persist($macro);

        $this->assertNotNull($macro->getId());
        $this->assertNotNull($macro->getRemoteService());

        self::$macro = $macro;
    }

    public function testCanCreateAMacroWithRestriction()
    {
        /** @var \ZenDesk\Service\AgentService $service */
        $service = $this->getSM()->get('ZenDesk\Service\AgentService');
        /** @var \ZenDesk\Entity\Agent $admin */
        $admin = $service->me(); // user with tickets -- to change, bad tests crossed

        $macro = new Macro();
        /** @var \ZenDesk\Service\MacroService $service */
        $service = $this->getSM()->get('ZenDesk\Service\MacroService');

        $this->assertEquals($macro->getId(), null);

        $id = CacheHttpClient::getUniqId() . __METHOD__;

        $macro->setTitle($id);
        $macro->setActions(array(
            array('field' => 'priority', 'value' => 'high')
        ));
        $restriction = new Restriction();
        $restriction->setType('User');
        $restriction->setId($admin->getId());
        $macro->setRestriction($restriction);
        $service->persist($macro);

        $this->assertNotNull($macro->getId());
        $this->assertNotNull($macro->getRestriction());
        $this->assertEquals($admin->getId(), $macro->getRestriction()->getId());

        self::$macroRestriction = $macro;
    }

    public function testCanUpdateAMacroWithRestriction()
    {
        if (!self::$macro) {
            $this->markTestSkipped('Macro entity must be defined');
        }
        $macro = self::$macro;

        $id = CacheHttpClient::getUniqId() . __METHOD__;
        $updatedAt = $macro->getUpdatedAt();

        $macro->setTitle($id);
        $macro->save();

        $this->assertEquals($id, $macro->getTitle());
        $this->assertNotEquals($updatedAt, $macro->getUpdatedAt());
    }

    public function testCanDeleteAMacro()
    {
        if (!self::$macro) {
            $this->markTestSkipped('Macro entity must be defined');
        }

        $macro = self::$macro;
        $macro->delete();

        // to change, tests crossed
        $this->setExpectedException('RestRemoteObject\Client\Rest\Exception\ResponseErrorException', 'RecordNotFound');
        /** @var \ZenDesk\Service\MacroService $service */
        $service = $this->getSM()->get('ZenDesk\Service\MacroService');
        $service->get($macro->getId());

        $macro = self::$macroRestriction;
        $macro->delete();
    }
}