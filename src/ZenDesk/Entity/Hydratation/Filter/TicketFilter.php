<?php

namespace ZenDesk\Entity\Hydratation\Filter;

use Zend\Stdlib\Hydrator\Filter\FilterInterface;

class TicketFilter implements FilterInterface
{
    /**
     * Should return true, if the given filter
     * does not match
     *
     * @param string $property The name of the property
     * @return bool
     */
    public function filter($property)
    {
        if (!preg_match('#::get#', $property)) {
            return false;
        }

        if (preg_match('#::getComments#', $property)) {
            return false;
        }

        if (preg_match('#::getRequester#', $property)) {
            return false;
        }

        return true;
    }
}