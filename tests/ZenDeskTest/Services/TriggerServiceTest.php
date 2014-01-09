<?php

namespace ZenDeskTest\Service;

use ZenDeskTest\AbstractTestCase;

class TriggerServiceTest extends AbstractTestCase
{
    /** @var \ZenDesk\Entity\Trigger */
    protected static $trigger;

    public function testCanGetAllTrigger()
    {
        /** @var \ZenDesk\Service\TriggerService $service */
        $service = $this->getSM()->get('ZenDesk\Service\TriggerService');
        $triggers = $service->getAll();

        $this->assertTrue(count($triggers) > 0);
        $trigger = current($triggers);
        $this->assertNotNull($trigger->getId());

        $actions = $trigger->getActions();
        $this->assertNotCount(0, $actions);
        /** @var \ZenDesk\Entity\Parameter\Action $action */
        $action = current($actions);
        $this->assertInstanceOf('ZenDesk\Entity\Parameter\Action', $action);
        $this->assertNotNull($action->getField());
        $this->assertNotNull($action->getValue());

        $conditions = $trigger->getConditions();
        $this->assertNotCount(0, $conditions);
        /** @var \ZenDesk\Entity\Parameter\Condition $condition */
        $condition = current($conditions);
        $this->assertInstanceOf('ZenDesk\Entity\Parameter\Condition', $condition);
        $this->assertNotNull($condition->getType());
        $this->assertNotNull($condition->getField());
        $this->assertNotNull($condition->getOperator());
        $this->assertNotNull($condition->getValue());

        self::$trigger = $trigger;
    }

    public function testCanGetOneTrigger()
    {
        if (!self::$trigger) {
            $this->markTestSkipped('Trigger entity must be defined');
        }

        /** @var \ZenDesk\Service\TriggerService $service */
        $service = $this->getSM()->get('ZenDesk\Service\TriggerService');
        $trigger = $service->get(self::$trigger->getId());

        $this->assertNotNull($trigger->getId());

        $actions = $trigger->getActions();
        $this->assertNotCount(0, $actions);
        /** @var \ZenDesk\Entity\Parameter\Action $action */
        $action = current($actions);
        $this->assertInstanceOf('ZenDesk\Entity\Parameter\Action', $action);
        $this->assertNotNull($action->getField());
        $this->assertNotNull($action->getValue());

        $conditions = $trigger->getConditions();
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