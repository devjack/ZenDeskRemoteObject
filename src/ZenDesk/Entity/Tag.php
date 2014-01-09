<?php

namespace ZenDesk\Entity;

class Tag extends AbstractEntity
{
    /** @var string */
    protected $name;

    /** @var int */
    protected $count;

    /**
     * @param Comment $fresh
     */
    public function refresh($fresh)
    {
        $this->setName($this->getName());
        $this->setCount($this->getCount());
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param int $count
     */
    public function setCount($count)
    {
        $this->count = $count;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }
}