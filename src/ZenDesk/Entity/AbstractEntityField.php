<?php

namespace ZenDesk\Entity;

use RestRemoteObject\Client\Rest\RestParametersAware;

abstract class AbstractEntityField extends AbstractEntity implements RestParametersAware
{
    /** @var string */
    protected $id;

    /** @var string */
    protected $url;

    /** @var string */
    protected $key;

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

    /** @var string */
    protected $regexp_for_validation;

    /** @var string */
    protected $created_at;

    /** @var string */
    protected $updated_at;

    /** @var string */
    protected $tag;

    /** @var array */
    protected $custom_field_options;

    /**
     * @param AbstractEntityField $fresh
     */
    public function refresh($fresh)
    {
        $this->setId($fresh->getId());
        $this->setUrl($fresh->getUrl());
        $this->setKey($fresh->getKey());
        $this->setType($fresh->getType());
        $this->setTitle($fresh->getTitle());
        $this->setDescription($fresh->getDescription());
        $this->setPosition($fresh->getPosition());
        $this->setActive($fresh->getActive());
        $this->setRegexpForValidation($fresh->getRegexpForValidation());
        $this->setCreatedAt($fresh->getCreatedAt());
        $this->setUpdatedAt($fresh->getUpdatedAt());
        $this->setTag($fresh->getTag());
        $this->setCustomFieldOptions($fresh->getCustomFieldOptions());
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
     * @param string $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }
}