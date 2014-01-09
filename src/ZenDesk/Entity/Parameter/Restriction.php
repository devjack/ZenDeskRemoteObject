<?php

namespace ZenDesk\Entity\Parameter;

class Restriction
{
    /** @var string */
    protected $type;

    /** @var int */
    protected $id;

    /**
     * @return String representation of object
     */
    public function serialize()
    {
        return serialize(array(
            'id' => $this->getId(),
            'type' => $this->getType(),
        ));
    }

    /**
     * @param Restriction $fresh
     */
    public function refresh($fresh)
    {
        $this->setId($fresh->getId());
        $this->setType($fresh->getType());
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}