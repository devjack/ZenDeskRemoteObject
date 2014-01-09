<?php

namespace ZenDesk\Entity\Parameter;

use LogicException;

class Condition
{
    /** @var string */
    protected $type;

    /** @var string */
    protected $field;

    /** @var string */
    protected $operator;

    /** @var string */
    protected $value;

    /**
     * @return String representation of object
     */
    public function serialize()
    {
        return serialize(array(
            'type' => $this->getType(),
            'field' => $this->getField(),
            'operator' => $this->getOperator(),
            'value' => $this->getValue(),
        ));
    }

    /**
     * @param Condition $fresh
     */
    public function refresh($fresh)
    {
        $this->setType($fresh->getType());
        $this->setField($fresh->getField());
        $this->setOperator($fresh->getOperator());
        $this->setValue($fresh->getValue());
    }

    /**
     * @param $type
     * @throws LogicException
     */
    public function setType($type)
    {
        if (!in_array($type, array('all', 'any'))) {
            throw new LogicException('Type must be equals to "all" or "any"');
        }
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
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
     * @param string $operator
     */
    public function setOperator($operator)
    {
        $this->operator = $operator;
    }

    /**
     * @return string
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        /** http://developer.zendesk.com/documentation/rest_api/triggers.html#via-types */
        if ('current_via_id' === $this->getField()) {
            switch ($value) {
                case 'web_form' :                 $value = 0;     break;
                case 'email' :                    $value = 4;     break;
                case 'chat' :                     $value = 29;    break;
                case 'twitter' :                  $value = 30;    break;
                case 'twitter_dm' :               $value = 26;    break;
                case 'twitter_favorite' :         $value = 23;    break;
                case 'voicemail' :                $value = 33;    break;
                case 'phone_call_incoming' :      $value = 34;    break;
                case 'phone_call_outcoming' :     $value = 35;    break;
                case 'get_satisfaction' :         $value = 16;    break;
                case 'feedback_tab' :             $value = 17;    break;
                case 'web_service' :              $value = 5;     break;
                case 'trigger_or_automation' :    $value = 8;     break;
                case 'forum_topic' :              $value = 24;    break;
                case 'closed_ticket' :            $value = 27;    break;
                case 'ticket_sharing' :           $value = 31;    break;
                case 'facebook_post' :            $value = 38;    break;
                case 'facebook_private_message' : $value = 41;    break;
            }
        }
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
}