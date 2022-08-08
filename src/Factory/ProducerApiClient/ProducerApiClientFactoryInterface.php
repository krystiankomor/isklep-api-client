<?php

namespace ISklepApiClient\Factory\ProducerApiClient;

use ISklepApiClient\Service\ApiClient\ProducerApiClientServiceInterface;

interface ProducerApiClientFactoryInterface
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
