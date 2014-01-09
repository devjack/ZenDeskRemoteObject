<?php

namespace ZenDesk\Entity\Parameter;

class Action
{
    /** @var string */
    protected $field;

    /** @var int */
    protected $value;

    /**
     * @return String representation of object
     */
    public function serialize()
    {
        return serialize(array(
            'field' => $this->getField(),
            'value' => $this->getValue(),
        ));
    }

    /**
     * @param Action $fresh
     */
    public function refresh($fresh)
    {
        $this->setField($fresh->getField());
        $this->setValue($fresh->getValue());
    }

    /**
     * @param string $field
     */
    public function setField($field)
    {
        $this->field = $field;
    }

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @param int $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }
}