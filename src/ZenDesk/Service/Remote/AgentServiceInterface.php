<?php

namespace ZenDesk\Service\Remote;

use ZenDesk\Entity\Agent;

interface AgentServiceInterface extends UserServiceInterface
{
    /**
     * @rest\http GET
     * @rest\uri /users/%user/tickets/requested
     * @param Agent $user
     * @return \ZenDesk\Entity\Ticket[]
     */
    public function getTickets(Agent $user);

    /**
     * @rest\http GET
     * @rest\uri /users/search?query=%query
     * @param string $query
     * @return \ZenDesk\Entity\User[]
     */
    public function search($query);

    /**
     * @rest\http POST
     * @rest\uri /users/autocomplete
     * @param string $name
     * @return \ZenDesk\Entity\User[]
     */
    public function autocomplete($name);
}