<?php

namespace ZenDesk\Entity\Parameter;

class Execution
{
    /** @var array */
    protected $colums;

    /** @var object */
    protected $group;

    /** @var object */
    protected $sort;

    /**
     * @param Execution $fresh
     */
    public function refresh($fresh)
    {
        $this->setColums($fresh->getColums());
        $this->setGroup($fresh->getGroup());
        $this->setSort($fresh->getSort());
    }

    /**
     * @param array $colums
     */
    public function setColums(array $colums)
    {
        $this->colums = $colums;
    }

    /**
     * @return array
     */
    public function getColums()
    {
        return $this->colums;
    }

    /**
     * @param object $group
     */
    public function setGroup($group)
    {
        $this->group = $group;
    }

    /**
     * @return object
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @param object $sort
     */
    public function setSort($sort)
    {
        $this->sort = $sort;
    }

    /**
     * @return object
     */
    public function getSort()
    {
        return $this->sort;
    }
}
