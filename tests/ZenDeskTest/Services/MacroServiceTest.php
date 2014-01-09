<?php

namespace ZenDeskTest\Service;

use ZenDeskTest\AbstractTestCase;

class MacroServiceTest extends AbstractTestCase
{
    /** @var \ZenDesk\Entity\Macro */
    protected static $macro;

    public function testCanGetAllMacro()
    {
        /** @var \ZenDesk\Service\MacroService $service */
        $service = $this->getSM()->get('ZenDesk\Service\MacroService');
        $macros = $service->getAll();

        $this->assertTrue(count($macros) > 0);
        $macro = current($macros);
        $this->assertNotNull($macro->getId());

        $actions = $macro->getActions();
        $this->assertNotCount(0, $actions);
        /** @var \ZenDesk\Entity\Parameter\Action $action */
        $action = current($actions);
        $this->assertInstanceOf('ZenDesk\Entity\Parameter\Action', $action);
        $this->assertNotNull($action->getField());
        $this->assertNotNull($action->getValue());
        
        self::$macro = $macro;
    }

    public function testCanGetOneMacro()
    {
        if (!self::$macro) {
            $this->markTestSkipped('Macro entity must be defined');
        }

        /** @var \ZenDesk\Service\MacroService $service */
        $service = $this->getSM()->get('ZenDesk\Service\MacroService');
        $macro = $service->get(self::$macro->getId());

        $this->assertNotNull($macro->getId());

        $actions = $macro->getActions();
        $this->assertNotCount(0, $actions);
        /** @var \ZenDesk\Entity\Parameter\Action $action */
        $action = current($actions);
        $this->assertInstanceOf('ZenDesk\Entity\Parameter\Action', $action);
        $this->assertNotNull($action->getField());
        $this->assertNotNull($action->getValue());
    }
}