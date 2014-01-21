<?php

namespace ZenDeskTest;

use PHPUnit_Framework_TestCase;

use Zend\Test\Util\ModuleLoader;

class ModuleTest extends PHPUnit_Framework_TestCase
{
    public function testCanLoadModule()
    {
        $loader = new ModuleLoader(
            array(
                'modules' => array(
                    'ZenDesk' => new \ZenDesk\Module()
                ),
                'module_listener_options' => array(
                    'config_static_paths' => array(
                        __DIR__ . '/../../config/local.config.php',
                    )
                ),
                'service_manager' => array(
                    'factories' => array(
                        'ModuleManager' => 'ZenDeskTestAssets\Mvc\Service\ModuleManagerFactory',
                    ),
                ),
            )
        );
    }
}
