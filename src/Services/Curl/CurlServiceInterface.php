<?php

namespace ISklepApiClient\Services\Curl;

interface CurlServiceInterface
{
    /**
     * @param string $uri
     *
     * @return string|null
     */
    public function makeGetRequest(string $uri): ?string;
}