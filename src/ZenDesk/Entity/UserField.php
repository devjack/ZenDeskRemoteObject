<?php

namespace ZenDesk\Entity;

class UserField extends AbstractEntityField
{
    public function getRestParameters()
    {
        return array(
            'userField' => $this->getId(),
        );
    }
}