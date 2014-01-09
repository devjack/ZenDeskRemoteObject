<?php

namespace ZenDeskTest;

use Zend\ServiceManager\Config;
use Zend\ServiceManager\ServiceManager;

use PHPUnit_Framework_TestCase;

abstract class AbstractTestCase extends PHPUnit_Framework_TestCase
{
    /**
     * @var ServiceManager
     */
    protected $sm;

    public function setUp()
    {
        $config = include __DIR__ . '/../../config/config.php';
        $config = new Config($config);
        $this->sm = new ServiceManager($config);
    }

    /**
     * @return ServiceManager
     */
    public function getSM()
    {
        return $this->sm;
    }
}