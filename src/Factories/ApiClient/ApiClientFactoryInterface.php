<?php

namespace ISklepApiClient\Factories\ApiClient;

use ISklepApiClient\Services\ApiClient\ApiClientServiceInterface;

interface ApiClientFactoryInterface
{
    /**
     * @param string $url
     * @param string $login
     * @param string $password
     * @param string|null $headerHost
     *
     * @return ApiClientServiceInterface
     */
    public function create(
        string $url,
        string $login,
        string $password,
        ?string $headerHost = null
    ): ApiClientServiceInterface;
}