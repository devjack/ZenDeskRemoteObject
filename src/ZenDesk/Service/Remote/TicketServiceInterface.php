<?php

namespace ZenDesk\Service\Remote;

use ZenDesk\Entity\Ticket;

interface TicketServiceInterface
{
    /**
     * @rest\http POST
     * @rest\uri /tickets
     * @param Ticket $ticket
     * @return \ZenDesk\Entity\Ticket
     */
    public function persist(Ticket $ticket);

    /**
     * @rest\http PUT
     * @rest\uri /tickets/%ticket
     * @param Ticket $ticket
     * @return \ZenDesk\Entity\Ticket
     */
    public function save(Ticket $ticket);

    /**
     * @rest\http DELETE
     * @rest\uri /tickets/%ticket
     * @param Ticket $ticket
     */
    public function delete(Ticket $ticket);

    /**
     * @rest\http PUT
     * @rest\uri /tickets/%ticket
     * @param Ticket $ticket
     * @return \ZenDesk\Entity\Ticket
     */
    public function close(Ticket $ticket);

    /**
     * @rest\http GET
     * @rest\uri /tickets/%id
     * @param int $id
     * @return \ZenDesk\Entity\Ticket[]
     */
    public function get($id);

    /**
     * @rest\http GET
     * @rest\uri /tickets
     * @return \ZenDesk\Entity\Ticket[]
     */
    public function getAll();

    /**
     * @rest\http GET
     * @rest\uri /tickets/recent
     * @return \ZenDesk\Entity\Ticket[]
     */
    public function getRecent();

    /**
     * @rest\http GET
     * @rest\uri /tickets/%ticket/comments
     * @param Ticket $ticket
     * @return \ZenDesk\Entity\Comment[]
     */
    public function getComments(Ticket $ticket);

    /**
     * @rest\http GET
     * @rest\uri /tickets/%ticket/tags
     * @param Ticket $ticket
     * @return \ZenDesk\Entity\Tag[]
     */
    public function getTags(Ticket $ticket);
}