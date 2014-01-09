<?php

namespace ZenDesk\Service;

use ZenDesk\Service\Remote\TagServiceInterface;

class TagService extends AbstractService
{
    /**
     * @return \ZenDesk\Entity\Tag[]
     */
    public function getAll()
    {
        /** @var TagServiceInterface $remoteService */
        $remoteService = $this->getRemoteService();
        return $remoteService->getAll();
    }
}