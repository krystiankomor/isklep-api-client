<?php

namespace ISklepApiClient\Factory\Producer;

use ISklepApiClient\Dto\Producer;

interface ProducerFactoryInterface
{
    /**
     * @param mixed[] $data
     *
     * @return Producer
     */
    public function create(array $data): Producer;
}
