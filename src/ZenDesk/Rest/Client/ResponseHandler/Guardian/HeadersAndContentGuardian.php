<?php

namespace ZenDesk\Rest\Client\ResponseHandler\Guardian;

use RestRemoteObject\Client\Rest\ResponseHandler\Guardian\GuardianInterface;
use RestRemoteObject\Client\Rest\Exception\ResponseErrorException;

use Zend\Http\Response;

class HeadersAndContentGuardian implements GuardianInterface
{
    /**
     * @var array
     */
    protected $warningHeaders = array();

    /**
     * @param array $warningHeaders
     */
    public function __construct(array $warningHeaders = array())
    {
        $this->warningHeaders = $warningHeaders;
    }

    /**
     * @param Response $response
     * @throws ResponseErrorException
     */
    public function guard(Response $response)
    {
        $headers = $response->getHeaders();
        foreach($this->warningHeaders as $errorsHeader) {
            $header = $headers->get($errorsHeader);
            if ($header) {
                trigger_error(sprintf('Warning header found "%s"', $header->getFieldValue()), E_USER_WARNING);
            }
        }

        $content = $response->getBody();

        $content = json_decode($content, true);
        if (isset($content['error'])) {
            $message = $content['error'];
            if (isset($content['message'])) {
                $message .= ', '. $content['message'];
            } else {
                $message .= ', '. $content['description'] .'. ';
                if (isset($content['details'])) {
                    foreach($content['details'] as $type) {
                        foreach ($type as $msg) {
                            $message .= $msg['description'] . '. ';
                        }
                    }
                }
            }
            throw new ResponseErrorException(sprintf('API Error "%s"', $message));
        }
    }
}