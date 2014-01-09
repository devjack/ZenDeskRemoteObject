<?php

namespace ZenDesk\Service;

use ZenDesk\Service\Remote\TriggerServiceInterface;
use ZenDesk\Entity\Trigger;

class TriggerService extends AbstractService
{
    /**
     * @param Trigger $trigger
     */
    public function persist(Trigger $trigger)
    {
        /** @var TriggerServiceInterface $remoteService */
        $remoteService = $this->getRemoteService();
        $fresh = $remoteService->persist($trigger);
        $trigger->refresh($fresh);

        // inject remote service
        $trigger->setRemoteService($this->getRemoteService());
    }

    /**
     * @param $id
     * @return \ZenDesk\Entity\Trigger
     */
    public function get($id)
    {
        /** @var TriggerServiceInterface $remoteService */
        $remoteService = $this->getRemoteService();
        return $remoteService->get($id);
    }

    /**
     * @return \ZenDesk\Entity\Trigger[]
     */
    public function getAll()
    {
        /** @var TriggerServiceInterface $remoteService */
        $remoteService = $this->getRemoteService();
        return $remoteService->getAll();
    }
}