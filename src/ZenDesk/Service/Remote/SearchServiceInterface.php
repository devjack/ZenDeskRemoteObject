<?php

namespace ZenDesk\Service\Remote;

interface SearchServiceInterface
{
    /**
     * @rest\http GET
     * @rest\uri /search?query=type:user+%query
     * @param int $query
     * @return \ZenDesk\Entity\User[]
     */
    public function users($query);

    /**
     * @rest\http GET
     * @rest\uri /search?query=type:ticket+%query
     * @param int $query
     * @return \ZenDesk\Entity\Ticket[]
     */
    public function tickets($query);
}