<?php

namespace ZenDesk\Service;

use ZenDesk\Service\Remote\MacroServiceInterface;
use ZenDesk\Entity\Macro;

class MacroService extends AbstractService
{
    /**
     * @param Macro $macro
     */
    public function persist(Macro $macro)
    {
        /** @var MacroServiceInterface $remoteService */
        $remoteService = $this->getRemoteService();
        $fresh = $remoteService->persist($macro);
        $macro->refresh($fresh);

        // inject remote service
        $macro->setRemoteService($this->getRemoteService());
    }

    /**
     * @param $id
     * @return \ZenDesk\Entity\Macro
     */
    public function get($id)
    {
        /** @var MacroServiceInterface $remoteService */
        $remoteService = $this->getRemoteService();
        return $remoteService->get($id);
    }

    /**
     * @return \ZenDesk\Entity\Macro[]
     */
    public function getAll()
    {
        /** @var MacroServiceInterface $remoteService */
        $remoteService = $this->getRemoteService();
        return $remoteService->getAll();
    }
}