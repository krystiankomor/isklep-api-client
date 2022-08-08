# i-sklep API client
Composer library to handle API integration with i-sklep service.

## Usage

```injectablephp
use ISklepApiClient\Dto\Producer;
use ISklepApiClient\Factory\ProducerApiClient\ProducerApiClientFactory;

$apiClient = (new ProducerApiClientFactory())->create(
    'host',
    'login',
    'password',
    'headerHost'
);


$producer = new Producer();
// Fluent setters are implemented to Producer class which can be used

$apiClient->postProducer($producer);

$producers = $apiClient->getAllProducers();
```

## ProducerApiClientFactory params

- host - service host, e.g. http://nginx
- login - service login
- password - service password
- headerHost [optional] - host to be sent in header, e.g. when using containerized nginx with set `server_name`
