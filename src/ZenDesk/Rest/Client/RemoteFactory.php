<?php

namespace ZenDesk\Rest\Client;

use RestRemoteObject\Client\Rest;
use RestRemoteObject\Client\Rest\Versioning\UriVersioningStrategy;
use RestRemoteObject\Client\Rest\Authentication\HttpAuthenticationStrategy;
use RestRemoteObject\Client\Rest\Format\Format;
use RestRemoteObject\Client\Rest\Format\ExtensionFormatStrategy;
use RestRemoteObject\Adapter\Rest as RestAdapter;
use RestRemoteObject\Client\Rest\Debug\Debug;
use RestRemoteObject\Client\Rest\Debug\Verbosity\Verbosity;
use RestRemoteObject\Client\Rest\Debug\Writer\Stdout;

use ZenDesk\Rest\Client\Http\Client;
use ZenDesk\Rest\Client\Builder;
use ZenDesk\Rest\Client\ResponseHandler\Builder\WrapperBuilder;
use ZenDesk\Rest\Client\ResponseHandler\Parser\JsonParser;
use ZenDesk\Rest\Client\ResponseHandler\Guardian\HeadersAndContentGuardian;

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