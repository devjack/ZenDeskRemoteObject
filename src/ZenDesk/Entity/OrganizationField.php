<?php

namespace ZenDesk\Entity;

class OrganizationField extends AbstractEntityField
{
    public function getRestParameters()
    {
        return array(
            'organizationField' => $this->getId(),
        );
    }
}