<?php

namespace ZenDesk\Service;

use ZenDesk\Service\Remote\AutomationServiceInterface;
use ZenDesk\Entity\Automation;

class AutomationService extends AbstractService
{
    /**
     * @param Automation $automation
     */
    public function persist(Automation $automation)
    {
        /** @var AutomationServiceInterface $remoteService */
        $remoteService = $this->getRemoteService();
        $fresh = $remoteService->persist($automation);
        $automation->refresh($fresh);

        // inject remote service
        $automation->setRemoteService($this->getRemoteService());
    }

    /**
     * @param $id
     * @return \ZenDesk\Entity\Automation
     */
    public function get($id)
    {
        /** @var AutomationServiceInterface $remoteService */
        $remoteService = $this->getRemoteService();
        return $remoteService->get($id);
    }

    /**
     * @return \ZenDesk\Entity\Automation[]
     */
    public function getAll()
    {
        /** @var AutomationServiceInterface $remoteService */
        $remoteService = $this->getRemoteService();
        return $remoteService->getAll();
    }
}