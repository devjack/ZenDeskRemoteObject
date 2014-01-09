<?php

namespace ZenDesk\Service;

use ProxyManager\Proxy\RemoteObjectInterface;

abstract class AbstractService
{
    protected $remoteService;

    public function __construct(RemoteObjectInterface $remoteService)
    {
        $this->remoteService = $remoteService;
    }

    public function getRemoteService()
    {
        return $this->remoteService;
    }
}