<?php

namespace ZenDesk\Rest\Client\ResponseHandler\Builder;

use RestRemoteObject\Client\Rest\Context;
use Zend\ServiceManager\ServiceManager;
use RestRemoteObject\Client\Rest\ResponseHandler\Builder\DefaultBuilder;

class WrapperBuilder extends DefaultBuilder
{
    protected $serviceManager;

    public function __construct(ServiceManager $sm)
    {
        $this->serviceManager = $sm;
    }

    /**
     * Create instance
     * @param Context $context
     * @return object
     */
    protected function createInstance(Context $context)
    {
        $descriptor = $context->getResourceDescriptor();
        $returnType = $descriptor->getReturnType();

        // inheritance handling
        $interface = $descriptor->getClassName();
        if (
            $interface == 'ZenDesk\Service\Remote\AgentServiceInterface' &&
            $returnType == 'ZenDesk\Entity\User'
        ) {
            $returnType = 'ZenDesk\Entity\Agent';
        }

        $remoteServiceName = preg_replace('#\\\Entity#', '\Service\Remote', $returnType) . 'ServiceInterface';

        $factory = $this->serviceManager->get('ZenDesk\Rest\Remote');
        $remoteService = $factory->createProxy($remoteServiceName);

        $entity = new $returnType();
        $entity->setRemoteService($remoteService);

        return $entity;
    }
}