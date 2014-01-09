<?php

namespace ZenDesk\Entity;

use ZenDesk\Entity\Parameter\Action;
use ZenDesk\Entity\Parameter\Condition;

use RestRemoteObject\Client\Rest\RestParametersAware;

use Zend\Stdlib\Hydrator\ClassMethods;

abstract class AbstractHook extends AbstractEntity implements RestParametersAware
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $title;

    /** @var bool */
    protected $active;

    /** @var int */
    protected $position;

    /** @var array */
    protected $conditions;

    /** @var array */
    protected $actions;

    /** @var string */
    protected $created_at;

    /** @var string */
    protected $updated_at;

    /**
     * @return String representation of object
     */
    public function serialize()
    {
        return serialize(array(
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'active' => $this->getActive(),
            'position' => $this->getPosition(),
            'conditions' => serialize($this->getConditions()),
            'actions' => serialize($this->getActions()),
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
        $data['actions'] = unserialize($data['actions']);

        if (null === $data['actions']) {
            $data['actions'] = array();
        }
        if (null === $data['conditions']) {
            $data['conditions'] = array();
        }

        $hydrator->hydrate($data, $this);
    }

    /**
     * @param Trigger $fresh
     */
    public function refresh($fresh)
    {
        $this->setId($fresh->getId());
        $this->setTitle($fresh->getTitle());
        $this->setActive($fresh->getActive());
        $this->setPosition($fresh->getPosition());
        $this->setConditions($fresh->getConditions());
        $this->setActions($fresh->getActions());
        $this->setCreatedAt($fresh->getCreatedAt());
        $this->setUpdatedAt($fresh->getUpdatedAt());
    }

    /**
     * @param Action $action
     */
    public function addAction(Action $action)
    {
        $this->actions[] = $action;
    }

    /**
     * @param Action[]|array $actions
     */
    public function setActions(array $actions)
    {
        foreach ($actions as $action) {
            if (is_array($action)) {
                $field = $action['field'];
                $value = $action['value'];
                $action = new Action();
                $action->setField($field);
                $action->setValue($value);
            }
            $this->addAction($action);
        }
    }

    /**
     * @return Action[]
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * @param boolean $active
     */
    public function setActive($active)
    {
        $this->active = $active;
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
     * @param int $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
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

    public function getRestParameters()
    {
        return array(
            'hook' => $this->getId(),
        );
    }
}