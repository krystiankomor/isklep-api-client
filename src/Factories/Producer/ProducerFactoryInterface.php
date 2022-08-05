<?php

namespace ISklepApiClient\Factories\Producer;

use ISklepApiClient\Dto\Producer;

interface ProducerFactoryInterface
{
    /**
     * @param array $data
     *
     * @return Producer
     */
    public function create(array $data): Producer;
}