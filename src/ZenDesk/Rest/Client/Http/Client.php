<?php

namespace ZenDesk\Rest\Client\Http;

use Zend\Http\Client as BaseClient;
use Zend\Http\Client\Adapter\Curl as CurlAdapter;

class Client extends BaseClient
{
    public function __construct($uri = null, $options = null)
    {
        $curl = new CurlAdapter();
        $curl->setCurlOption(CURLOPT_SSL_VERIFYPEER, false);
        $this->setAdapter($curl);

        parent::__construct($uri, $options);
    }

    protected function prepareHeaders($body, $uri)
    {
        $headers = parent::prepareHeaders($body, $uri);
        $headers['Content-Type'] = 'application/json';
        $headers['Accept'] = 'application/json';
        return $headers;
    }
}