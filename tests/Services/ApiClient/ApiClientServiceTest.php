<?php

namespace Services\ApiClient;

use ISklepApiClient\Dto\Producer;
use ISklepApiClient\Services\ApiClient\ApiClientService;
use ISklepApiClient\Services\Curl\CurlServiceInterface;
use ISklepApiClient\Services\Mapper\MapperServiceInterface;
use PHPUnit\Framework\TestCase;

class ApiClientServiceTest extends TestCase
{
    public function testGetAllProducers(): void
    {
        // Arrange
        $json = '[{}, {}]';
        $producer = new Producer();

        $curlService = $this->createMock(CurlServiceInterface::class);
        $curlService
            ->expects($this->once())
            ->method('makeGetRequest')
            ->with('/shop_api/v1/producers')
            ->willReturn($json);

        $mapperService = $this->createMock(MapperServiceInterface::class);
        $mapperService
            ->expects($this->exactly(2))
            ->method('createProducerFromArray')
            ->with([])
            ->willReturn($producer);

        $service = $this->getService($curlService, $mapperService);

        // Act
        $results = $service->getAllProducers();

        // Assert
        foreach ($results as $i => $result) {
            $this->assertEquals($producer, $result, $i);
        }
    }

    private function getService(
        CurlServiceInterface $curlService = null,
        MapperServiceInterface $mapperService = null
    ): ApiClientService {
        return new ApiClientService(
            $curlService ?? $this->createMock(CurlServiceInterface::class),
            $mapperService ?? $this->createMock(MapperServiceInterface::class)
        );
    }
}