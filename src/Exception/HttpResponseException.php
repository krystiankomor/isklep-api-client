<?php

namespace ISklepApiClient\Exception;

use Exception;
use ISklepApiClient\Message\Response;

class HttpResponseException extends Exception
{
    public function __construct(Response $response)
    {
        parent::__construct(
            $response->getBody() ?? $response->getErrors(),
            $response->getResponseCode() ?? 0
        );
    }
}
