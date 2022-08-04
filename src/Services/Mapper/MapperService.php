<?php

namespace ISklepApiClient\Services\Mapper;

use ISklepApiClient\Dto\Producer;

class MapperService implements MapperServiceInterface
{
    /**
     * {@inheritDoc}
     */
    public function createProducerFromArray(array $data): Producer
    {
        return (new Producer())
            ->setId($data['id'] ?? null)
            ->setName($data['name'] ?? null)
            ->setSiteUrl($data['site_url'] ?? null)
            ->setLogoFilename($data['logo_filename'] ?? null)
            ->setOrdering($data['ordering'] ?? null)
            ->setSourceId($data['source_id'] ?? null);
    }
}