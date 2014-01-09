<?php

namespace ZenDeskTest\Entity;

use ZenDeskTest\AbstractTestCase;
use ZenDesk\Entity\View;

class ViewTest extends AbstractTestCase
{
    /** @var \ZenDesk\Entity\View */
    protected static $view;

    public function testCanSerialize()
    {
        $view = new View();

        $view->setId(1);
        $this->assertNotNull($view->getId());

        $view = unserialize(serialize($view));

        $this->assertNotNull($view->getId());
    }

    public function testCanCreateAView()
    {
        $view = new View();
        /** @var \ZenDesk\Service\ViewService $view */
        $service = $this->getSM()->get('ZenDesk\Service\ViewService');

        $this->assertEquals($view->getId(), null);

        $id = uniqid();

        $view->setTitle($title = 'View ' . $id);
        $view->setConditions(array(
            'all' => array(
                array('field' => 'status', 'operator' => 'is', 'value' => 'open'),
            ),
        ));
        $service->persist($view);

        $this->assertNotNull($view->getId());
        $this->assertNotNull($view->getRemoteService());
        $this->assertEquals($view->getTitle(), $title);

        self::$view = $view;
    }

    public function testCanUpdateAView()
    {
        if (!self::$view) {
            $this->markTestSkipped('View entity must be defined');
        }

        $view = self::$view;

        $id = uniqid();
        $updatedAt = $view->getUpdatedAt();

        $view->setTitle($title = 'View ' . $id);
        $view->save();

        $this->assertNotNull($view->getId());
        $this->assertEquals($view->getTitle(), $title);
        $this->assertNotEquals($updatedAt, $view->getUpdatedAt());
    }

    public function testCanGetTickets()
    {
        if (!self::$view) {
            $this->markTestSkipped('View entity must be defined');
        }

        $view = self::$view;
        $tickets = $view->getTickets();

        $this->assertTrue(count($tickets) > 0);
    }

    public function testCanDeleteAUser()
    {
        if (!self::$view) {
            $this->markTestSkipped('View entity must be defined');
        }

        $view = self::$view;
        $view->delete();

        // to change, tests crossed
        $this->setExpectedException('RestRemoteObject\Client\Rest\Exception\RuntimeMethodException', '404');
        $viewService = $this->getSM()->get('ZenDesk\Service\ViewService');
        $viewService->get($view->getId());
    }
}