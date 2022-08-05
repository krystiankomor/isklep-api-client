<?php

namespace ISklepApiClient\Service\ApiClient;

use ISklepApiClient\Dto\Producer;
use ISklepApiClient\Exception\HttpResponseException;

interface ProducerApiClientServiceInterface
{
    /**
     * @return Producer[]
     *
     * @throws HttpResponseException
     */
    public function getAllProducers(): array;

    /**
     * @param Producer $producer
     *
     * @return void
     *
     * @throws HttpResponseException
     */
    public function postProducer(Producer $producer): void;
}
