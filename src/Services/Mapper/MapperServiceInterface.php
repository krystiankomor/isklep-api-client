<?php

namespace ISklepApiClient\Services\Mapper;

use ISklepApiClient\Dto\Producer;

interface MapperServiceInterface
{
    /**
     * @param array $data
     *
     * @return Producer
     */
    public function createProducerFromArray(array $data): Producer;
}