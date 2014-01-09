<?php

namespace ZenDesk\Rest\Client;

use RestRemoteObject\Client\Rest;
use RestRemoteObject\Client\Rest\Versioning\UriVersioningStrategy;
use RestRemoteObject\Client\Rest\Authentication\HttpAuthenticationStrategy;
use RestRemoteObject\Client\Rest\Format\Format;
use RestRemoteObject\Client\Rest\Format\ExtensionFormatStrategy;
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

class ClientFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');
        $config = $config['zendesk'];

        $client = new Rest('https://' . $config['host'] . '.zendesk.com/api/');
        $client->setFormatStrategy(
            new ExtensionFormatStrategy(new Format(Format::JSON))
        );

        if (!isset($config['version'])) {
            $config['version'] = 'v2';
        }

        $client->setVersioningStrategy(
            new UriVersioningStrategy($config['version'], '/api')
        );
        $client->setAuthenticationStrategy(
            new HttpAuthenticationStrategy($config['user'], $config['token'])
        );
        $client->setHttpClient(
            new Client()
        );
        $client->addBuilders(array(
            new Builder\TicketBuilder(), new Builder\UserBuilder(), new Builder\AgentBuilder(),
            new Builder\TicketFieldBuilder(), new Builder\TriggerBuilder(), new Builder\AutomationBuilder(),
            new Builder\MacroBuilder(), new Builder\UserFieldBuilder(), new Builder\OrganizationFieldBuilder(),
            new Builder\ViewBuilder(),
        ));

        if (isset($config['builders'])) {
            foreach ($config['builders'] as $builder) {
                $client->addBuilder(new $builder());
            }
        }

        $guardian = new HeadersAndContentGuardian(
            array('X-Zendesk-API-Warn')
        );
        $client->setGuardian($guardian);

        if (isset($config['debug']) && $config['debug']) {
            $debug = new Debug();
            $debug->setVerbosity(new Verbosity(Verbosity::TRACE_REQUEST_URI));
            $debug->setWriter(new Stdout());
            $client->setDebug($debug);
        }

        /** @var \RestRemoteObject\Client\Rest\ResponseHandler\DefaultResponseHandler $responseHandler */
        $responseHandler = $client->getResponseHandler();
        $responseHandler->setResponseParser(new JsonParser());
        $responseHandler->setResponseBuilder(new WrapperBuilder($serviceLocator));

        return $client;
    }
}