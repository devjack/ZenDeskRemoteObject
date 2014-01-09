<?php

namespace ZenDesk\Entity;

use Zend\Stdlib\Hydrator\Filter\FilterInterface;
use Zend\Stdlib\Hydrator\Filter\FilterProviderInterface;

use ZenDesk\Entity\Hydratation\Filter\AgentFilter;

class Agent extends User implements FilterProviderInterface
{
    /** @var int */
    protected $external_id;

    /** @var string */
    protected $alias;

    /** @var bool */
    protected $active;

    protected $shared;

    protected $shared_agent;

    protected $last_login_at;

    protected $signature;

    protected $details;

    protected $notes;

    protected $custom_role_id;

    protected $moderator;

    protected $ticket_restriction;

    protected $only_private_comments;

    protected $tags;

    protected $suspended = false;

    protected $restricted_agent;

    protected $user_fields;

    /** @var string */
    protected $role = 'agent';

    /** @var array */
    protected $tickets;

    /**
     * @param Agent $fresh
     */
    public function refresh($fresh)
    {
        parent::refresh($fresh);

        $this->setExternalId($fresh->getExternalId());
        $this->setAlias($fresh->getAlias());
        $this->setActive($fresh->getActive());
        $this->setShared($fresh->getShared());
        $this->setSharedAgent($fresh->getSharedAgent());
        $this->setLastLoginAt($fresh->getLastLoginAt());
        $this->setSignature($fresh->getSignature());
        $this->setDetails($fresh->getDetails());
        $this->setNotes($fresh->getNotes());
        $this->setCustomRoleId($fresh->getCustomRoleId());
        $this->setModerator($fresh->getModerator());
        $this->setTicketRestriction($fresh->getTicketRestriction());
        $this->setOnlyPrivateComments($fresh->getOnlyPrivateComments());
        $this->setTags($fresh->getTags());
        $this->setSuspended($fresh->getSuspended());
        $this->setRestrictedAgent($fresh->getRestrictedAgent());
        $this->setUserFields($fresh->getUserFields());
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
     * @param string $alias
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @param mixed $custom_role_id
     */
    public function setCustomRoleId($custom_role_id)
    {
        $this->custom_role_id = $custom_role_id;
    }

    /**
     * @return mixed
     */
    public function getCustomRoleId()
    {
        return $this->custom_role_id;
    }

    /**
     * @param mixed $details
     */
    public function setDetails($details)
    {
        $this->details = $details;
    }

    /**
     * @return mixed
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * @param int $external_id
     */
    public function setExternalId($external_id)
    {
        $this->external_id = $external_id;
    }

    /**
     * @return int
     */
    public function getExternalId()
    {
        return $this->external_id;
    }

    /**
     * @param mixed $last_login_at
     */
    public function setLastLoginAt($last_login_at)
    {
        $this->last_login_at = $last_login_at;
    }

    /**
     * @return mixed
     */
    public function getLastLoginAt()
    {
        return $this->last_login_at;
    }

    /**
     * @param mixed $moderator
     */
    public function setModerator($moderator)
    {
        $this->moderator = $moderator;
    }

    /**
     * @return mixed
     */
    public function getModerator()
    {
        return $this->moderator;
    }

    /**
     * @param mixed $notes
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;
    }

    /**
     * @return mixed
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @param mixed $only_private_comments
     */
    public function setOnlyPrivateComments($only_private_comments)
    {
        $this->only_private_comments = $only_private_comments;
    }

    /**
     * @return mixed
     */
    public function getOnlyPrivateComments()
    {
        return $this->only_private_comments;
    }

    /**
     * @param mixed $restricted_agent
     */
    public function setRestrictedAgent($restricted_agent)
    {
        $this->restricted_agent = $restricted_agent;
    }

    /**
     * @return mixed
     */
    public function getRestrictedAgent()
    {
        return $this->restricted_agent;
    }

    /**
     * @param mixed $shared
     */
    public function setShared($shared)
    {
        $this->shared = $shared;
    }

    /**
     * @return mixed
     */
    public function getShared()
    {
        return $this->shared;
    }

    /**
     * @param mixed $shared_agent
     */
    public function setSharedAgent($shared_agent)
    {
        $this->shared_agent = $shared_agent;
    }

    /**
     * @return mixed
     */
    public function getSharedAgent()
    {
        return $this->shared_agent;
    }

    /**
     * @param mixed $signature
     */
    public function setSignature($signature)
    {
        $this->signature = $signature;
    }

    /**
     * @return mixed
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * @param mixed $suspended
     */
    public function setSuspended($suspended)
    {
        $this->suspended = $suspended;
    }

    /**
     * @return mixed
     */
    public function getSuspended()
    {
        return $this->suspended;
    }

    /**
     * @param mixed $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param mixed $ticket_restriction
     */
    public function setTicketRestriction($ticket_restriction)
    {
        $this->ticket_restriction = $ticket_restriction;
    }

    /**
     * @return mixed
     */
    public function getTicketRestriction()
    {
        return $this->ticket_restriction;
    }

    /**
     * @param mixed $user_fields
     */
    public function setUserFields($user_fields)
    {
        $this->user_fields = $user_fields;
    }

    /**
     * @return mixed
     */
    public function getUserFields()
    {
        return $this->user_fields;
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

    /**
     * Provides a filter for hydration
     *
     * @return FilterInterface
     */
    public function getFilter()
    {
        return new AgentFilter();
    }
}