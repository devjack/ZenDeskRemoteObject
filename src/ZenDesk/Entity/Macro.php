<?php

namespace ZenDesk\Entity;

use ZenDesk\Entity\Parameter\Action;
use ZenDesk\Entity\Parameter\Restriction;

use RestRemoteObject\Client\Rest\RestParametersAware;

use Zend\Stdlib\Hydrator\ClassMethods;

class Macro extends AbstractEntity implements RestParametersAware
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $title;

    /** @var bool */
    protected $active;

    /** @var Restriction */
    protected $restriction;

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
            'restriction' => serialize($this->getRestriction()),
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

        $data['actions'] = unserialize($data['actions']);
        $data['restriction'] = unserialize($data['restriction']);

        if (null === $data['actions']) {
            $data['actions'] = array();
        }

        $hydrator->hydrate($data, $this);
    }

    /**
     * @param Macro $fresh
     */
    public function refresh($fresh)
    {
        $this->setId($fresh->getId());
        $this->setTitle($fresh->getTitle());
        $this->setActive($fresh->getActive());
        $this->setRestriction($fresh->getRestriction());
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
     * @param array|Restriction $restriction
     */
    public function setRestriction($restriction = null)
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
            'macro' => $this->getId(),
        );
    }
}