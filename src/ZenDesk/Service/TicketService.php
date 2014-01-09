<?php

namespace ZenDesk\Service;

use ZenDesk\Entity\Ticket;
use ZenDesk\Service\Remote\TicketServiceInterface;

class TicketService extends AbstractService
{
    /**
     * @param Ticket $ticket
     */
    public function persist(Ticket $ticket)
    {
        /** @var TicketServiceInterface $remoteService */
        $remoteService = $this->getRemoteService();
        $fresh = $remoteService->persist($ticket);
        $ticket->refresh($fresh);

        // inject remote service
        $ticket->setRemoteService($this->getRemoteService());
    }

    /**
     * @param int $id
     * @return \ZenDesk\Entity\Ticket
     */
    public function get($id)
    {
        /** @var TicketServiceInterface $remoteService */
        $remoteService = $this->getRemoteService();
        return $remoteService->get($id);
    }

    /**
     * @return \ZenDesk\Entity\Ticket[]
     */
    public function getAll()
    {
        /** @var TicketServiceInterface $remoteService */
        $remoteService = $this->getRemoteService();
        return $remoteService->getAll();
    }

    /**
     * @return \ZenDesk\Entity\Ticket[]
     */
    public function getRecent()
    {
        /** @var TicketServiceInterface $remoteService */
        $remoteService = $this->getRemoteService();
        return $remoteService->getRecent();
    }
}