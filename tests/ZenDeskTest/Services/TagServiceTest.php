<?php

namespace ZenDeskTest\Service;

use ZenDeskTest\AbstractTestCase;

class TagServiceTest extends AbstractTestCase
{
    public function testCanGetAllTags()
    {
        /** @var \ZenDesk\Service\TagService $service */
        $service = $this->getSM()->get('ZenDesk\Service\TagService');
        $tags = $service->getAll();

        $this->assertTrue(count($tags) > 0);
        $tag = current($tags);
        $this->assertNotNull($tag->getName());
        $this->assertNotNull($tag->getCount());
    }
}