<?php

namespace ISklepApiClient\Service\ApiClient;

use ISklepApiClient\Dto\Producer;
use ISklepApiClient\Exception\CurlResponseException;

interface ProducerApiClientServiceInterface
{
    /**
     * @return Producer[]
     *
     * @throws CurlResponseException
     */
    public function getAllProducers(): array;

    /**
     * @param Producer $producer
     *
     * @return void
     *
     * @throws CurlResponseException
     */
    public function postProducer(Producer $producer): void;
}
