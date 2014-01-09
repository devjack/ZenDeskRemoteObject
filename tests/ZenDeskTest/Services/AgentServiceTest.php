<?php

namespace ZenDeskTest\Service;

use ZenDeskTest\AbstractTestCase;

class AgentServiceTest extends AbstractTestCase
{
    public function testCanSearchUser()
    {
        /** @var \ZenDesk\Service\AgentService $service */
        $service = $this->getSM()->get('ZenDesk\Service\AgentService');
        $users = $service->search('unknow');

        $this->assertCount(0, $users);

        $users = $service->search('blanchon');

        $this->assertNotCount(0, $users);
        $user = current($users);
        $this->assertNotNull($user->getId());
        $this->assertNotNull($user->getName());
    }

    public function testCanAutocompleteUser()
    {
        /** @var \ZenDesk\Service\AgentService $service */
        $service = $this->getSM()->get('ZenDesk\Service\AgentService');
        $users = $service->autocomplete('unknow');

        $this->assertCount(0, $users);

        $users = $service->autocomplete('blanc');

        $this->assertNotCount(0, $users);
        $user = current($users);
        $this->assertNotNull($user->getId());
        $this->assertNotNull($user->getName());
    }
}