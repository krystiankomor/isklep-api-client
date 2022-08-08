<?php

namespace Message;

use ISklepApiClient\Message\Response;
use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{
    /**
     * @param int|null $httpCode
     *
     * @return void
     *
     * @dataProvider getTestGetResponseCodeDataProvider
     */
    public function testGetResponseCode(?int $httpCode): void
    {
        $info = [
            'http_code' => $httpCode,
        ];

        $response = new Response('', $info, '', 0);

        $this->assertEquals($httpCode, $response->getResponseCode());
    }

    /**
     * @param int|null $httpCode
     * @param int $errno
     * @param bool $expectedResult
     *
     * @return void
     *
     * @dataProvider getTestIsSuccessfulCode
     */
    public function testIsSuccessfulCode(?int $httpCode, int $errno, bool $expectedResult): void
    {
        $info = [
            'http_code' => $httpCode,
        ];

        $response = new Response('', $info, '', $errno);

        $this->assertEquals($expectedResult, $response->isSuccessfulCode());
    }

    /**
     * @return array[]
     */
    public function getTestIsSuccessfulCode(): array
    {
        return [
            [200, 0, true],
            [400, 1, false],
            [200, 1, false],
            [400, 0, false],
            [204, 0, true],
            [500, 0, false],
            [null, 0, false],
            [null, 1, false],
        ];
    }

    /**
     * @return array[]
     */
    public function getTestGetResponseCodeDataProvider(): array
    {
        return [
            [null],
            [200],
            [400],
        ];
    }
}
