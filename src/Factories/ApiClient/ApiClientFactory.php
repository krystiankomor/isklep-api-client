<?php

namespace ISklepApiClient\Factories\ApiClient;

use ISklepApiClient\Factories\Producer\ProducerFactory;
use ISklepApiClient\Services\ApiClient\ApiClientService;
use ISklepApiClient\Services\ApiClient\ApiClientServiceInterface;
use ISklepApiClient\Services\Curl\CurlService;

class ApiClientFactory implements ApiClientFactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function create(
        string $url,
        string $login,
        string $password,
        ?string $headerHost = null
    ): ApiClientServiceInterface {
        $curlService = new CurlService($url, $login, $password, $headerHost);

        return new ApiClientService($curlService, new ProducerFactory());
    }
}
