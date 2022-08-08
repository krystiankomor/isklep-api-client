<?php

namespace Services\ApiClient;

use ISklepApiClient\Exception\CurlResponseException;
use ISklepApiClient\Message\Response;
use ISklepApiClient\Service\ApiClient\AbstractApiClientService;
use ISklepApiClient\Service\Curl\CurlServiceInterface;
use PHPUnit\Framework\TestCase;

class AbstractApiClientServiceTest extends TestCase
{
    /**
     * @param bool $throwsException
     *
     * @return void
     *
     * @dataProvider getThrowsExceptionDataProvider
     */
    public function testMakeGetRequest(bool $throwsException): void
    {
        // Arrange
        $service = $this->prepareService('getPath', 'GET', null, !$throwsException);

        // Act
        if ($throwsException) {
            $this->expectException(CurlResponseException::class);
        }

        $result = $service->makeGetRequest('getPath');

        // Assert
        if (!$throwsException) {
            $this->assertInstanceOf(Response::class, $result);
        }
    }

    /**
     * @param bool $throwsException
     *
     * @return void
     *
     * @dataProvider getThrowsExceptionDataProvider
     */
    public function testMakePostRequest(bool $throwsException): void
    {
        // Arrange
        $service = $this->prepareService('postPath', 'POST', [], !$throwsException);

        // Act
        if ($throwsException) {
            $this->expectException(CurlResponseException::class);
        }

        $result = $service->makePostRequest('postPath', []);

        // Assert
        if (!$throwsException) {
            $this->assertInstanceOf(Response::class, $result);
        }
    }

    /**
     * @return bool[][]
     */
    public function getThrowsExceptionDataProvider(): array
    {
        return [
            [false],
            [true],
        ];
    }

    /**
     * @param string $path
     * @param string $type
     * @param array|null $data
     * @param bool $isSuccessfulCode
     *
     * @return AbstractApiClientService
     */
    private function prepareService(string $path, string $type, ?array $data, bool $isSuccessfulCode = true)
    {
        $response = $this->createMock(Response::class);
        $response
            ->expects($this->once())
            ->method('isSuccessfulCode')
            ->willReturn($isSuccessfulCode);

        $curlService = $this->createMock(CurlServiceInterface::class);
        $curlService
            ->expects($this->once())
            ->method('makeRequest')
            ->with($path, $type, $data)
            ->willReturn($response);

        return new class($curlService) extends AbstractApiClientService {};
    }
}
