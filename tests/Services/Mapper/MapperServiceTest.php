<?php

namespace Services\Mapper;

use ISklepApiClient\Services\Mapper\MapperService;
use PHPUnit\Framework\TestCase;

class MapperServiceTest extends TestCase
{
    public function testCreateProducerFromArray(): void
    {
        // Arrange
        $data = [
            'id' => 5,
            'name' => 'testName',
            'site_url' => 'testSiteUrl',
            'logo_filename' => 'testLogoFilename',
            'ordering' => 1234,
            'source_id' => 422,
        ];
        $service = new MapperService();

        // Act
        $result = $service->createProducerFromArray($data);

        // Assert
        $this->assertEquals($data['id'], $result->getId());
        $this->assertEquals($data['name'], $result->getName());
        $this->assertEquals($data['site_url'], $result->getSiteUrl());
        $this->assertEquals($data['logo_filename'], $result->getLogoFilename());
        $this->assertEquals($data['ordering'], $result->getOrdering());
        $this->assertEquals($data['source_id'], $result->getSourceId());
    }

    public function testCreateProducerFromEmptyArray(): void
    {
        // Arrange
        $data = [];
        $service = new MapperService();

        // Act
        $result = $service->createProducerFromArray($data);

        // Assert
        $this->assertNull($result->getId());
        $this->assertNull($result->getName());
        $this->assertNull($result->getSiteUrl());
        $this->assertNull($result->getLogoFilename());
        $this->assertNull($result->getOrdering());
        $this->assertNull($result->getSourceId());
    }
}