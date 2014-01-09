<?php

namespace ZenDesk\Service\Remote;

use ZenDesk\Entity\TicketField;

interface TicketFieldServiceInterface
{
    /**
     * @rest\http POST
     * @rest\uri /ticket_fields
     * @param TicketField $ticketField
     * @return \ZenDesk\Entity\TicketField
     */
    public function persist(TicketField $ticketField);

    /**
     * @rest\http PUT
     * @rest\uri /ticket_fields/%ticketField
     * @param TicketField $ticketField
     * @return \ZenDesk\Entity\TicketField
     */
    public function save(TicketField $ticketField);

    /**
     * @rest\http DELETE
     * @rest\uri /ticket_fields/%ticketField
     * @param TicketField $ticketField
     */
    public function delete(TicketField $ticketField);

    /**
     * @rest\http GET
     * @rest\uri /ticket_fields/%id
     * @param int $id
     * @return \ZenDesk\Entity\TicketField
     */
    public function get($id);

    /**
     * @rest\http GET
     * @rest\uri /ticket_fields
     * @return \ZenDesk\Entity\TicketField[]
     */
    public function getAll();
}