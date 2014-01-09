<?php

namespace ZenDeskTest\Service;

use ZenDeskTest\AbstractTestCase;

class AutomationServiceTest extends AbstractTestCase
{
    /** @var \ZenDesk\Entity\Automation */
    protected static $automation;

    public function testCanGetAllAutomation()
    {
        /** @var \ZenDesk\Service\AutomationService $service */
        $service = $this->getSM()->get('ZenDesk\Service\AutomationService');
        $automations = $service->getAll();

        $this->assertTrue(count($automations) > 0);
        $automation = current($automations);

        $this->assertNotNull($automation->getId());

        $actions = $automation->getActions();
        $this->assertNotCount(0, $actions);
        /** @var \ZenDesk\Entity\Parameter\Action $action */
        $action = current($actions);
        $this->assertInstanceOf('ZenDesk\Entity\Parameter\Action', $action);
        $this->assertNotNull($action->getField());
        $this->assertNotNull($action->getValue());

        $conditions = $automation->getConditions();
        $this->assertNotCount(0, $conditions);
        /** @var \ZenDesk\Entity\Parameter\Condition $condition */
        $condition = current($conditions);
        $this->assertInstanceOf('ZenDesk\Entity\Parameter\Condition', $condition);
        $this->assertNotNull($condition->getType());
        $this->assertNotNull($condition->getField());
        $this->assertNotNull($condition->getOperator());
        $this->assertNotNull($condition->getValue());

        self::$automation = $automation;
    }

    public function testCanGetOneAutomation()
    {
        if (!self::$automation) {
            $this->markTestSkipped('Automation entity must be defined');
        }

        /** @var \ZenDesk\Service\AutomationService $service */
        $service = $this->getSM()->get('ZenDesk\Service\AutomationService');
        $automation = $service->get(self::$automation->getId());

        $this->assertNotNull($automation->getId());

        $actions = $automation->getActions();
        $this->assertNotCount(0, $actions);
        /** @var \ZenDesk\Entity\Parameter\Action $action */
        $action = current($actions);
        $this->assertInstanceOf('ZenDesk\Entity\Parameter\Action', $action);
        $this->assertNotNull($action->getField());
        $this->assertNotNull($action->getValue());

        $conditions = $automation->getConditions();
        $this->assertNotCount(0, $conditions);
        /** @var \ZenDesk\Entity\Parameter\Condition $condition */
        $condition = current($conditions);
        $this->assertInstanceOf('ZenDesk\Entity\Parameter\Condition', $condition);
        $this->assertNotNull($condition->getType());
        $this->assertNotNull($condition->getField());
        $this->assertNotNull($condition->getOperator());
        $this->assertNotNull($condition->getValue());
    }
}