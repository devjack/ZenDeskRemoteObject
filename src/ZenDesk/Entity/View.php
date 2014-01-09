<?php

namespace ZenDesk\Entity;

use Zend\Stdlib\Hydrator\ClassMethods;
use ZenDesk\Entity\Parameter\Condition;
use ZenDesk\Entity\Parameter\Execution;
use ZenDesk\Entity\Parameter\Restriction;

use RestRemoteObject\Client\Rest\RestParametersAware;

class View extends AbstractEntity implements RestParametersAware
{
    /** @var string */
    protected $id;

    /** @var string */
    protected $title;

    /** @var bool */
    protected $active;

    /** @var string */
    protected $sla_id;

    /** @var Restriction */
    protected $restriction;

    /** @var Execution */
    protected $execution;

    /** @var Condition[] */
    protected $conditions;

    /** @var string */
    protected $created_at;

    /** @var string */
    protected $updated_at;

    /** @var array */
    protected $tickets;

    /**
     * @param View $fresh
     */
    public function refresh($fresh)
    {
        $this->setId($fresh->getId());
        $this->setTitle($fresh->getTitle());
        $this->setActive($fresh->getActive());
        $this->setSlaId($fresh->getSlaId());
        $this->setRestriction($fresh->getRestriction());
        $this->setExecution($fresh->getExecution());
        $this->setConditions($fresh->getConditions());
        $this->setCreatedAt($fresh->getCreatedAt());
        $this->setUpdatedAt($fresh->getUpdatedAt());
    }

    /**
     * @return String representation of object
     */
    public function serialize()
    {
        return serialize(array(
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'active' => $this->getActive(),
            'conditions' => serialize($this->getConditions()),
            'restriction' => $this->getRestriction(),
            'execution' => $this->getExecution(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt(),
        ));
    }

    /**
     * Constructs the object
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        $hydrator = new ClassMethods();

        $data = unserialize($serialized);

        $data['conditions'] = unserialize($data['conditions']);

        if (null === $data['conditions']) {
            $data['conditions'] = array();
        }

        $hydrator->hydrate($data, $this);
    }

    /**
     * @param boolean $active
     */
    public function setActive($active)
    {
        $this->active = (bool)$active;
    }

    /**
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param Condition $condition
     */
    public function addCondition(Condition $condition)
    {
        $this->conditions[] = $condition;
    }

    /**
     * @param Condition[]|array $conditions
     */
    public function setConditions(array $conditions)
    {
        foreach ($conditions as $type => $subCondition) {
            if (is_array($subCondition)) {
                foreach ($subCondition as $condition) {
                    if (is_array($condition)) {
                        $field = $condition['field'];
                        $operator = $condition['operator'];
                        $value = $condition['value'];
                        $condition = new Condition();
                        $condition->setType($type);
                        $condition->setField($field);
                        $condition->setOperator($operator);
                        $condition->setValue($value);
                    }
                    $this->addCondition($condition);
                }
            } else {
                $this->addCondition($subCondition);
            }
        }
    }

    /**
     * @return Condition[]
     */
    public function getConditions()
    {
        return $this->conditions;
    }

    /**
     * @param string $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param Execution $execution
     */
    public function setExecution($execution)
    {
        if (is_array($execution)) {
            $sort = $execution['sort'];
            $group = $execution['group'];
            $columns = $execution['columns'];
            $execution = new Execution();
            $execution->setSort($sort);
            $execution->setGroup($group);
            $execution->setColums($columns);
        }
        $this->execution = $execution;
    }

    /**
     * @return Execution
     */
    public function getExecution()
    {
        return $this->execution;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param Restriction|array $restriction
     */
    public function setRestriction($restriction)
    {
        if (is_array($restriction)) {
            $type = $restriction['type'];
            $id = $restriction['id'];
            $restriction = new Restriction();
            $restriction->setType($type);
            $restriction->setId($id);
        }
        $this->restriction = $restriction;
    }

    /**
     * @return Restriction
     */
    public function getRestriction()
    {
        return $this->restriction;
    }

    /**
     * @param string $sla_id
     */
    public function setSlaId($sla_id)
    {
        $this->sla_id = $sla_id;
    }

    /**
     * @return string
     */
    public function getSlaId()
    {
        return $this->sla_id;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $updated_at
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }

    /**
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param array $tickets
     */
    public function setTickets(array $tickets)
    {
        $this->tickets = $tickets;
    }

    /**
     * @return array
     */
    public function getTickets()
    {
        if (null === $this->tickets) {
            $remote = $this->getRemoteService();
            $tickets = $remote->getTickets($this);
            $this->setTickets($tickets);
        }
        return $this->tickets;
    }

    public function getRestParameters()
    {
        return array(
            'view' => $this->getId(),
        );
    }
}