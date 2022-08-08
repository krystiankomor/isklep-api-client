<?php

namespace ISklepApiClient\Exception;

use Exception;
use ISklepApiClient\Message\Response;

class CurlResponseException extends Exception
{
    private string $errors;

    public function __construct(Response $response)
    {
        parent::__construct(
            $response->getBody(),
            $response->getResponseCode() ?? 0
        );

        $this->errors = $response->getErrors();
    }

    /**
     * @return string
     */
    public function getErrors(): string
    {
        return $this->errors;
    }
}
