<?php

namespace ZenDeskTest\Service;

use ZenDeskTest\AbstractTestCase;

class ViewServiceTest extends AbstractTestCase
{
    public function testCanGetAllViews()
    {
        /** @var \ZenDesk\Service\ViewService $service */
        $service = $this->getSM()->get('ZenDesk\Service\ViewService');
        $views = $service->getAll();

        $this->assertTrue(count($views) > 0);
        $view = current($views);
        $this->assertNotNull($view->getId());
        $this->assertNotNull($view->getTitle());
    }

    public function testCanGetAllActiveViews()
    {
        /** @var \ZenDesk\Service\ViewService $service */
        $service = $this->getSM()->get('ZenDesk\Service\ViewService');
        $views = $service->getAllActive();

        $this->assertTrue(count($views) > 0);
        $view = current($views);
        $this->assertNotNull($view->getId());
        $this->assertNotNull($view->getTitle());
    }
}