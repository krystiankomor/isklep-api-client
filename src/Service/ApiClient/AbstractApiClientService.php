<?php

namespace ISklepApiClient\Service\ApiClient;

use ISklepApiClient\Enum\RequestTypeEnum;
use ISklepApiClient\Exception\HttpResponseException;
use ISklepApiClient\Message\Response;
use ISklepApiClient\Service\Curl\CurlServiceInterface;

abstract class AbstractApiClientService
{
    protected CurlServiceInterface $curlService;

    public function __construct(CurlServiceInterface $curlService)
    {
        $this->curlService = $curlService;
    }

    /**
     * @param string $path
     *
     * @return Response
     *
     * @throws HttpResponseException
     */
    protected function makeGetRequest(string $path): Response
    {
        return $this->makeRequest($path, RequestTypeEnum::GET);
    }

    /**
     * @param string $path
     * @param mixed[] $data
     *
     * @return Response
     *
     * @throws HttpResponseException
     */
    protected function makePostRequest(string $path, array $data): Response
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
     * @throws HttpResponseException
     */
    private function makeRequest(string $path, string $type, ?array $data = null): Response
    {
        $response = $this->curlService->makeRequest($path, $type, $data);

        if (!$response->isSuccessfulCode()) {
            throw new HttpResponseException($response);
        }

        return $response;
    }
}
