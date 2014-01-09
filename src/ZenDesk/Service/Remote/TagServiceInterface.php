<?php

namespace ZenDesk\Service\Remote;

interface TagServiceInterface
{
    /**
     * @rest\http GET
     * @rest\uri /tags
     * @return \ZenDesk\Entity\Tag[]
     */
    public function getAll();
}