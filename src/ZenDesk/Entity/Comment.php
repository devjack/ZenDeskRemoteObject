<?php

namespace ZenDesk\Entity;

class Comment extends AbstractEntity
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $body;

    /** @var string */
    protected $html_body;

    /** @var bool */
    protected $public;

    /** @var bool */
    protected $trusted;

    /** @var int */
    protected $author_id;

    /**
     * @param Comment $fresh
     */
    public function refresh($fresh)
    {
        $this->setId($fresh->getId());
        $this->setBody($fresh->getBody());
        $this->setHtmlBody($fresh->getHtmlBody());
        $this->setPublic($fresh->getPublic());
        $this->setTrusted($fresh->getTrusted());
        $this->setAuthorId($fresh->getAuthorId());
    }

    /**
     * @param string $html_body
     */
    public function setHtmlBody($html_body)
    {
        $this->html_body = $html_body;
    }

    /**
     * @return string
     */
    public function getHtmlBody()
    {
        return $this->html_body;
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
     * @param boolean $public
     */
    public function setPublic($public)
    {
        $this->public = $public;
    }

    /**
     * @return boolean
     */
    public function getPublic()
    {
        return $this->public;
    }

    /**
     * @param boolean $trusted
     */
    public function setTrusted($trusted)
    {
        $this->trusted = $trusted;
    }

    /**
     * @return boolean
     */
    public function getTrusted()
    {
        return $this->trusted;
    }

    /**
     * @param string $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param int $author_id
     */
    public function setAuthorId($author_id)
    {
        $this->author_id = $author_id;
    }

    /**
     * @return int
     */
    public function getAuthorId()
    {
        return $this->author_id;
    }
}