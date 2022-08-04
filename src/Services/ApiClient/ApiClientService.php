<?php

namespace ISklepApiClient\Services\ApiClient;

use ISklepApiClient\Services\Curl\CurlServiceInterface;
use ISklepApiClient\Services\Mapper\MapperServiceInterface;

class ApiClientService implements ApiClientServiceInterface
{
    private CurlServiceInterface $curlService;
    private MapperServiceInterface  $mapperService;

    public function __construct(CurlServiceInterface $curlService, MapperServiceInterface $mapperService)
    {
        $this->curlService = $curlService;
        $this->mapperService = $mapperService;
    }

    /**
     * {@inheritDoc}
     */
    public function getAllProducers(): array
    {
        $response = $this->curlService->makeGetRequest('/shop_api/v1/producers');

        return array_map(
            function (array $data) {
                return $this->mapperService->createProducerFromArray($data);
            },
            json_decode($response, true)
        );
    }
}
