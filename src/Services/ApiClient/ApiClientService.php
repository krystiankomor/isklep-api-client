<?php

namespace ISklepApiClient\Services\ApiClient;

use ISklepApiClient\Dto\Producer;
use ISklepApiClient\Factories\Producer\ProducerFactoryInterface;
use ISklepApiClient\Services\Curl\CurlServiceInterface;

class ApiClientService implements ApiClientServiceInterface
{
    private CurlServiceInterface $curlService;
    private ProducerFactoryInterface  $producerFactory;

    public function __construct(CurlServiceInterface $curlService, ProducerFactoryInterface $producerFactory)
    {
        $this->curlService = $curlService;
        $this->producerFactory = $producerFactory;
    }

    /**
     * {@inheritDoc}
     */
    public function getAllProducers(): array
    {
        $response = $this->curlService->makeGetRequest('/shop_api/v1/producers');

        return array_map(
            function (array $data) {
                return $this->producerFactory->create($data);
            },
            json_decode($response, true)
        );
    }

    /**
     * {@inheritDoc}
     */
    public function postProducer(Producer $producer): void
    {
        $data = ['producer' => $producer];

        $response = $this->curlService->makePostRequest('/shop_api/v1/producers', $data);

        var_dump($response);
    }
}
