<?php

namespace Services\ApiClient;

use ISklepApiClient\Dto\Producer;
use ISklepApiClient\Factory\Producer\ProducerFactoryInterface;
use ISklepApiClient\Message\Response;
use ISklepApiClient\Service\ApiClient\ProducerApiClientService;
use ISklepApiClient\Service\Curl\CurlServiceInterface;
use PHPUnit\Framework\TestCase;

class ProducerApiClientServiceTest extends TestCase
{
    public function testGetAllProducers(): void
    {
        // Arrange
        $json = '[{}, {}]';
        $response = $this->createResponse($json);
        $producer = new Producer();

        $curlService = $this->createMock(CurlServiceInterface::class);
        $curlService
            ->expects($this->once())
            ->method('makeRequest')
            ->with('/shop_api/v1/producers', 'GET')
            ->willReturn($response);

        $mapperService = $this->createMock(ProducerFactoryInterface::class);
        $mapperService
            ->expects($this->exactly(2))
            ->method('create')
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

    public function testPostProducer(): void
    {
        // Arrange
        $json = '[{}, {}]';
        $response = $this->createResponse($json);
        $producer = new Producer();

        $curlService = $this->createMock(CurlServiceInterface::class);
        $curlService
            ->expects($this->once())
            ->method('makeRequest')
            ->with('/shop_api/v1/producers', 'POST', ['producer' => $producer])
            ->willReturn($response);

        $service = $this->getService($curlService);

        // Act
        $service->postProducer($producer);
    }

    /**
     * @param string $body
     * @param int|null $responseCode
     *
     * @return Response
     */
    private function createResponse(string $body, ?int $responseCode = null): Response
    {
        return new Response(
            $body,
            [
                'http_code' => $responseCode ?? 200,
            ],
            '',
            0
        );
    }

    private function getService(
        CurlServiceInterface $curlService = null,
        ProducerFactoryInterface $producerFactory = null
    ): ProducerApiClientService {
        return new ProducerApiClientService(
            $curlService ?? $this->createMock(CurlServiceInterface::class),
            $producerFactory ?? $this->createMock(ProducerFactoryInterface::class)
        );
    }
}
