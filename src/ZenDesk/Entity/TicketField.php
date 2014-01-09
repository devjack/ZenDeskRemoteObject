<?php

namespace ZenDesk\Entity;

use RestRemoteObject\Client\Rest\RestParametersAware;

class TicketField extends AbstractEntity implements RestParametersAware
{
    /** @var string */
    protected $id;

    /** @var string */
    protected $url;

    /** @var string */
    protected $type;

    /** @var string */
    protected $title;

    /** @var string */
    protected $description;

    /** @var int */
    protected $position;

    /** @var bool */
    protected $active;

    /** @var bool */
    protected $required;

    /** @var string */
    protected $collapsed_for_agent;

    /** @var string */
    protected $regexp_for_validation;

    /** @var string */
    protected $title_in_portal;

    /** @var string */
    protected $visible_in_portal;

    /** @var string */
    protected $editable_in_portal;

    /** @var bool */
    protected $required_in_portal;

    /** @var string */
    protected $tag;

    /** @var string */
    protected $created_at;

    /** @var string */
    protected $updated_at;

    /** @var array */
    protected $system_field_options;

    /** @var array */
    protected $custom_field_options;

    /** @var bool */
    protected $removable;

    /**
     * @param TicketField $fresh
     */
    public function refresh($fresh)
    {
        $this->setId($fresh->getId());
        $this->setUrl($fresh->getUrl());
        $this->setType($fresh->getType());
        $this->setTitle($fresh->getTitle());
        $this->setDescription($fresh->getDescription());
        $this->setPosition($fresh->getPosition());
        $this->setActive($fresh->getActive());
        $this->setRequired($fresh->getRequired());
        $this->setCollapsedForAgent($fresh->getCollapsedForAgent());
        $this->setRegexpForValidation($fresh->getRegexpForValidation());
        $this->setTitleInPortal($fresh->getTitleInPortal());
        $this->setVisibleInPortal($fresh->getVisibleInPortal());
        $this->setEditableInPortal($fresh->getEditableInPortal());
        $this->setRequiredInPortal($fresh->getRequiredInPortal());
        $this->setTag($fresh->getTag());
        $this->setCreatedAt($fresh->getCreatedAt());
        $this->setUpdatedAt($fresh->getUpdatedAt());
        $this->setSystemFieldOptions($fresh->getSystemFieldOptions());
        $this->setCustomFieldOptions($fresh->getCustomFieldOptions());
        $this->setRemovable($fresh->getRemovable());
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
     * @param string $collapsed_for_agent
     */
    public function setCollapsedForAgent($collapsed_for_agent)
    {
        $this->collapsed_for_agent = $collapsed_for_agent;
    }

    /**
     * @return string
     */
    public function getCollapsedForAgent()
    {
        return $this->collapsed_for_agent;
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
     * @param array $custom_field_options
     */
    public function setCustomFieldOptions($custom_field_options)
    {
        $this->custom_field_options = $custom_field_options;
    }

    /**
     * @return array
     */
    public function getCustomFieldOptions()
    {
        return $this->custom_field_options;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $editable_in_portal
     */
    public function setEditableInPortal($editable_in_portal)
    {
        $this->editable_in_portal = $editable_in_portal;
    }

    /**
     * @return string
     */
    public function getEditableInPortal()
    {
        return $this->editable_in_portal;
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
     * @param string $regexp_for_validation
     */
    public function setRegexpForValidation($regexp_for_validation)
    {
        $this->regexp_for_validation = $regexp_for_validation;
    }

    /**
     * @return string
     */
    public function getRegexpForValidation()
    {
        return $this->regexp_for_validation;
    }

    /**
     * @param boolean $removable
     */
    public function setRemovable($removable)
    {
        $this->removable = $removable;
    }

    /**
     * @return boolean
     */
    public function getRemovable()
    {
        // bugfix
        if ($this->getType() == 'tickettype' || $this->getType() == 'priority') {
            return false;
        }
        return $this->removable;
    }

    /**
     * @param boolean $required
     */
    public function setRequired($required)
    {
        $this->required = $required;
    }

    /**
     * @return boolean
     */
    public function getRequired()
    {
        return $this->required;
    }

    /**
     * @param boolean $required_in_portal
     */
    public function setRequiredInPortal($required_in_portal)
    {
        $this->required_in_portal = $required_in_portal;
    }

    /**
     * @return boolean
     */
    public function getRequiredInPortal()
    {
        return $this->required_in_portal;
    }

    /**
     * @param array $system_field_options
     */
    public function setSystemFieldOptions($system_field_options)
    {
        $this->system_field_options = $system_field_options;
    }

    /**
     * @return array
     */
    public function getSystemFieldOptions()
    {
        return $this->system_field_options;
    }

    /**
     * @param string $tag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
    }

    /**
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
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
     * @param string $title_in_portal
     */
    public function setTitleInPortal($title_in_portal)
    {
        $this->title_in_portal = $title_in_portal;
    }

    /**
     * @return string
     */
    public function getTitleInPortal()
    {
        return $this->title_in_portal;
    }

    /**
     * @param $type
     * @throws \LogicException
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
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $visible_in_portal
     */
    public function setVisibleInPortal($visible_in_portal)
    {
        $this->visible_in_portal = $visible_in_portal;
    }

    /**
     * @return string
     */
    public function getVisibleInPortal()
    {
        return $this->visible_in_portal;
    }

    public function getRestParameters()
    {
        return array(
            'ticketField' => $this->getId(),
        );
    }
}