<?php

namespace ZenDesk\Entity;

use Serializable;
use LogicException;

use Zend\Stdlib\Hydrator\ClassMethods;

abstract class AbstractEntity implements Serializable
{
    protected $remoteService;

    public function save()
    {
        $remoteService = $this->getRemoteService();
        $fresh = $remoteService->save($this);

        $this->refresh($fresh);
    }

    public function delete()
    {
        $remoteService = $this->getRemoteService();
        $fresh = $remoteService->delete($this);

        if ($fresh) {
            $this->refresh($fresh);
        }
    }

    /**
     * @param mixed $remoteService
     */
    public function setRemoteService($remoteService)
    {
        $this->remoteService = $remoteService;
    }

    /**
     * @return mixed
     */
    public function getRemoteService()
    {
        return $this->remoteService;
    }

    /**
     * String representation of object
     *
     * @return string
     */
    public function serialize()
    {
        $hydrator = new ClassMethods();

        $data = $hydrator->extract($this);
        unset($data['remote_service']);

        return serialize($data);
    }

    /**
     * Constructs the object
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        $hydrator = new ClassMethods();

        $data = unserialize($serialized);
        $hydrator->hydrate($data, $this);
    }

    abstract public function refresh($fresh);
}