<?php

namespace ZenDesk\Rest\Client;

use RestRemoteObject\Client\Rest;
use RestRemoteObject\Adapter\Rest as RestAdapter;

use ZenDesk\Rest\Client\Builder;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use ProxyManager\Factory\RemoteObjectFactory;

class RemoteFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $client = $serviceLocator->get('ZenDesk\Rest\Client');

        $factory = new RemoteObjectFactory(
            new RestAdapter($client)
        );

        return $factory;
    }
}