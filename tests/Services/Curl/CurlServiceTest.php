<?php

namespace Services\Curl;

use ISklepApiClient\Service\Curl\CurlService;
use PHPUnit\Framework\TestCase;

class CurlServiceTest extends TestCase
{
    /**
     * @param string|null $headerHost
     *
     * @return void
     *
     * @dataProvider getGetHeadersDataProvider
     */
    public function testGetHeaders(?string $headerHost): void
    {
        // Arrange
        $login = 'login';
        $password = 'password';

        $expectedHeaders = [
            $this->getAuthorizationHeaderString($login, $password),
        ];

        if (null !== $headerHost) {
            $expectedHeaders[] = 'Host: ' . $headerHost;
        }

        $service = new CurlService('url', $login, $password, $headerHost);

        // Act
        $headers = $service->getHeaders();

        // Assert
        $this->assertEquals($expectedHeaders, $headers);
    }

    /**
     * @param string $url
     * @param string $path
     * @param string $expectedUrl
     * @param array|null $data
     *
     * @return void
     *
     * @dataProvider getTestGetCurlOptionsDataProvider
     */
    public function testGetCurlOptions(string $url, string $path, string $expectedUrl, ?array $data): void
    {
        // Arrange
        $service = new CurlService($url, 'login', 'password', null);

        $expectedCount = null === $data ? 9 : 10;
        $expectedHttpHeaderCount = null === $data ? 1 : 2;

        // Act
        $result = $service->getCurlOptions($path, 'type', $data);

        // Assert
        $this->assertCount($expectedCount, $result);
        $this->assertCount($expectedHttpHeaderCount, $result[10023]);

        $this->assertEquals($expectedUrl, $result[10002] ?? null);
    }

    /**
     * @return array
     */
    public function getGetHeadersDataProvider(): array
    {
        return [
            [null],
            ['host1'],
        ];
    }

    /**
     * @param string $login
     * @param string $password
     *
     * @return string
     */
    private function getAuthorizationHeaderString(string $login, string $password): string {
        return 'Authorization: Basic ' . base64_encode($login . ':' . $password);
    }

    /**
     * @return array[]
     */
    public function getTestGetCurlOptionsDataProvider(): array
    {
        return [
            [
                'http://api.pl/',
                '/path/v1',
                'http://api.pl/path/v1',
                null,
            ],
            [
                'http://api.pl',
                '/path/v1',
                'http://api.pl/path/v1',
                null,
            ],
            [
                'http://api.pl',
                'path/v1',
                'http://api.plpath/v1',
                [],
            ],
            [
                'http://api.com',
                '/path/v1',
                'http://api.com/path/v1',
                [],
            ],
        ];
    }
}
