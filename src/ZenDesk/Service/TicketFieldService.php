<?php

namespace ZenDesk\Service;

use ZenDesk\Entity\TicketField;
use ZenDesk\Service\Remote\TicketFieldServiceInterface;

class TicketFieldService extends AbstractService
{
    /**
     * @param TicketField $ticketField
     */
    public function persist(TicketField $ticketField)
    {
        /** @var TicketFieldServiceInterface $remoteService */
        $remoteService = $this->getRemoteService();
        $fresh = $remoteService->persist($ticketField);
        $ticketField->refresh($fresh);

        // inject remote service
        $ticketField->setRemoteService($this->getRemoteService());
    }

    /**
     * @param int $id
     * @return TicketField
     */
    public function get($id)
    {
        /** @var TicketFieldServiceInterface $remoteService */
        $remoteService = $this->getRemoteService();
        return $remoteService->get($id);
    }

    /**
     * @return \ZenDesk\Entity\TicketField[]
     */
    public function getAll()
    {
        /** @var TicketFieldServiceInterface $remoteService */
        $remoteService = $this->getRemoteService();
        return $remoteService->getAll();
    }
}