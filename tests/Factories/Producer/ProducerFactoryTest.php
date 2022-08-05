<?php

namespace Factories\Producer;

use ISklepApiClient\Factory\Producer\ProducerFactory;
use PHPUnit\Framework\TestCase;

class ProducerFactoryTest extends TestCase
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
        $service = new ProducerFactory();

        // Act
        $result = $service->create($data);

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
        $service = new ProducerFactory();

        // Act
        $result = $service->create($data);

        // Assert
        $this->assertNull($result->getId());
        $this->assertNull($result->getName());
        $this->assertNull($result->getSiteUrl());
        $this->assertNull($result->getLogoFilename());
        $this->assertNull($result->getOrdering());
        $this->assertNull($result->getSourceId());
    }
}
