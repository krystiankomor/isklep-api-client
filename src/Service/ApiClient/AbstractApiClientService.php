<?php

namespace ISklepApiClient\Service\ApiClient;

use ISklepApiClient\Enum\RequestTypeEnum;
use ISklepApiClient\Exception\CurlResponseException;
use ISklepApiClient\Message\Response;
use ISklepApiClient\Service\Curl\CurlServiceInterface;

abstract class AbstractApiClientService
{
    private CurlServiceInterface $curlService;

    public function __construct(CurlServiceInterface $curlService)
    {
        $this->curlService = $curlService;
    }

    /**
     * @param string $path
     *
     * @return Response
     *
     * @throws CurlResponseException
     */
    public function makeGetRequest(string $path): Response
    {
        return $this->makeRequest($path, RequestTypeEnum::GET);
    }

    /**
     * @param string $path
     * @param mixed[] $data
     *
     * @return Response
     *
     * @throws CurlResponseException
     */
    public function makePostRequest(string $path, array $data): Response
    {
        return $this->makeRequest($path, RequestTypeEnum::POST, $data);
    }

    /**
     * @param string $path
     * @param string $type
     * @param mixed[]|null $data
     *
     * @return Response
     *
     * @throws CurlResponseException
     */
    private function makeRequest(string $path, string $type, ?array $data = null): Response
    {
        $response = $this->curlService->makeRequest($path, $type, $data);

        if (!$response->isSuccessfulCode()) {
            throw new CurlResponseException($response);
        }

        return $response;
    }
}
