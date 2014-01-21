<?php

namespace ZenDesk;

use Zend\ModuleManager\Feature\ServiceProviderInterface;

class Module implements ServiceProviderInterface
{
    public function getServiceConfig()
    {
        return include __DIR__ . '/config/service.config.php';
    }
}
