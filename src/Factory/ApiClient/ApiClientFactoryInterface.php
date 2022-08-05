<?php

namespace ISklepApiClient\Factory\ApiClient;

use ISklepApiClient\Service\ApiClient\ProducerApiClientServiceInterface;

interface ApiClientFactoryInterface
{
    /**
     * @param string $url
     * @param string $login
     * @param string $password
     * @param string|null $headerHost
     *
     * @return ProducerApiClientServiceInterface
     */
    public function create(
        string $url,
        string $login,
        string $password,
        ?string $headerHost = null
    ): ProducerApiClientServiceInterface;
}
