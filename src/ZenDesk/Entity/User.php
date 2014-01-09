<?php

namespace ZenDesk\Entity;

use RestRemoteObject\Client\Rest\RestParametersAware;

class User extends AbstractEntity implements RestParametersAware
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $url;

    /** @var string */
    protected $name;

    /** @var string */
    protected $created_at;

    /** @var string */
    protected $updated_at;

    /** @var string */
    protected $time_zone;

    /** @var string */
    protected $email;

    /** @var string */
    protected $phone;

    /** @var string */
    protected $locale;

    /** @var int */
    protected $locale_id;

    /** @var int */
    protected $organization_id;

    /** @var string */
    protected $role = 'end-user';

    /** @var bool */
    protected $verified = false;

    /** @var bool */
    protected $suspended = false;

    //protected $photo;

    /**
     * @param User $fresh
     */
    public function refresh($fresh)
    {
        $this->setId($fresh->getId());
        $this->setUrl($fresh->getUrl());
        $this->setName($fresh->getName());
        $this->setCreatedAt($fresh->getCreatedAt());
        $this->setUpdatedAt($fresh->getUpdatedAt());
        $this->setTimeZone($fresh->getTimeZone());
        $this->setEmail($fresh->getEmail());
        $this->setPhone($fresh->getPhone());
        $this->setLocale($fresh->getLocale());
        $this->setLocaleId($fresh->getLocaleId());
        $this->setOrganizationId($fresh->getOrganizationId());
        $this->setRole($fresh->getRole());
        $this->setVerified($fresh->getVerified());
        $this->setSuspended($fresh->getSuspended());
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
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
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
     * @param string $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param int $locale_id
     */
    public function setLocaleId($locale_id)
    {
        $this->locale_id = $locale_id;
    }

    /**
     * @return int
     */
    public function getLocaleId()
    {
        return $this->locale_id;
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
     * @param int $organization_id
     */
    public function setOrganizationId($organization_id)
    {
        $this->organization_id = $organization_id;
    }

    /**
     * @return int
     */
    public function getOrganizationId()
    {
        return $this->organization_id;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param string $time_zone
     */
    public function setTimeZone($time_zone)
    {
        $this->time_zone = $time_zone;
    }

    /**
     * @return string
     */
    public function getTimeZone()
    {
        return $this->time_zone;
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
     * @param boolean $verified
     */
    public function setVerified($verified)
    {
        $this->verified = $verified;
    }

    /**
     * @return boolean
     */
    public function getVerified()
    {
        return $this->verified;
    }

    /**
     * @param boolean $suspended
     */
    public function setSuspended($suspended)
    {
        $this->suspended = $suspended;
    }

    /**
     * @return boolean
     */
    public function getSuspended()
    {
        return $this->suspended;
    }

    public function suspend()
    {
        $remote = $this->getRemoteService();
        $fresh = $remote->suspend($this);
        $this->refresh($fresh);
    }

    public function getRestParameters()
    {
        return array(
            'user' => $this->getId(),
        );
    }
}