<?php

namespace ISklepApiClient\Services\ApiClient;

use ISklepApiClient\Dto\Producer;

interface ApiClientServiceInterface
{
    /**
     * @return Producer[]
     */
    public function getAllProducers(): array;

    /**
     * @param Producer $producer
     *
     * @return void
     */
    public function postProducer(Producer $producer): void;
}
