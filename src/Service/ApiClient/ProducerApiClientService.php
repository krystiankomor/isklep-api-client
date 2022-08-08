<?php

namespace ISklepApiClient\Service\ApiClient;

use ISklepApiClient\Dto\Producer;
use ISklepApiClient\Factory\Producer\ProducerFactoryInterface;
use ISklepApiClient\Service\Curl\CurlServiceInterface;

class ProducerApiClientService extends AbstractApiClientService implements ProducerApiClientServiceInterface
{
    private ProducerFactoryInterface  $producerFactory;

    public function __construct(CurlServiceInterface $curlService, ProducerFactoryInterface $producerFactory)
    {
        parent::__construct($curlService);

        $this->producerFactory = $producerFactory;
    }

    /**
     * {@inheritDoc}
     */
    public function getAllProducers(): array
    {
        $response = $this->makeGetRequest('/shop_api/v1/producers');

        return array_map(
            function (array $data) {
                return $this->producerFactory->create($data);
            },
            json_decode($response->getBody() ?? '{}', true)
        );
    }

    /**
     * {@inheritDoc}
     */
    public function postProducer(Producer $producer): void
    {
        $this->makePostRequest('/shop_api/v1/producers', ['producer' => $producer]);
    }
}
