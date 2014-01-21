<?php

namespace ZenDeskTest;

use Zend\ServiceManager\Config;
use Zend\ServiceManager\ServiceManager;

use PHPUnit_Framework_TestCase;
use ZenDeskTestAssets\CacheHttpClient;

abstract class AbstractTestCase extends PHPUnit_Framework_TestCase
{
    /**
     * @var ServiceManager
     */
    protected $sm;

    /** @var string */
    public static $testName;

    public function setUp()
    {
        $config = include __DIR__ . '/../../config/service.config.php';
        $config = new Config($config);
        $this->sm = new ServiceManager($config);

        /** @var \RestRemoteObject\Client\Rest $rest */
        $rest = $this->sm->get('ZenDesk\Rest\Client');
        $rest->setHttpClient(new CacheHttpClient());

        self::$testName = strtr(get_class($this), '\\', '-') . '::' . $this->getName();
    }

    public function tearDown()
    {
        if ($this->hasFailed()) {
            CacheHttpClient::deprecate(self::$testName);
        }
    }

    /**
     * @return ServiceManager
     */
    public function getSM()
    {
        return $this->sm;
    }
}