<?php

namespace ISklepApiClient\Factory\ApiClient;

use ISklepApiClient\Factory\Producer\ProducerFactory;
use ISklepApiClient\Service\ApiClient\ProducerApiClientService;
use ISklepApiClient\Service\ApiClient\ProducerApiClientServiceInterface;
use ISklepApiClient\Service\Curl\CurlService;

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
    ): ProducerApiClientServiceInterface {
        $curlService = new CurlService($url, $login, $password, $headerHost);

        return new ProducerApiClientService($curlService, new ProducerFactory());
    }
}
