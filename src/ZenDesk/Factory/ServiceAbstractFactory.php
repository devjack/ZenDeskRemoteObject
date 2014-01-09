<?php

namespace ZenDesk\Factory;

use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ServiceAbstractFactory implements AbstractFactoryInterface
{
    /**
     * Determine if we can create a service with name
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @param $name
     * @param $requestedName
     * @return bool
     */
    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        return (bool)preg_match('#^\\\?ZenDesk\\\Service\\\#', $requestedName);
    }

    /**
     * Create service with name
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @param $name
     * @param $requestedName
     * @return mixed
     */
    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        $factory = $serviceLocator->get('ZenDesk\Rest\Remote');

        $remoteServiceName = preg_replace('#ZenDesk\\\Service#', 'ZenDesk\Service\Remote', $requestedName) . 'Interface';
        $remoteService = $factory->createProxy($remoteServiceName);

        return new $requestedName($remoteService);
    }
}