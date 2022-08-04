<?php

namespace ISklepApiClient\Services\Curl;

class CurlService implements CurlServiceInterface
{
    private string $url;
    private string $login;
    private string $password;
    private ?string $headerHost;

    public function __construct(string $url, string $login, string $password, ?string $headerHost)
    {
        $this->url = $url;
        $this->login = $login;
        $this->password = $password;
        $this->headerHost = $headerHost;
    }

    /**
     * {@inheritDoc}
     */
    public function makeGetRequest(string $uri): ?string
    {
        $curl = curl_init();
        curl_setopt_array(
            $curl,
            [
                CURLOPT_URL            => $this->url . $uri,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING       => '',
                CURLOPT_MAXREDIRS      => 10,
                CURLOPT_TIMEOUT        => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST  => 'GET',
                CURLOPT_HTTPHEADER     => $this->getHeaders(),
            ]
        );

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }

    /**
     * @return string[]
     */
    private function getHeaders(): array
    {
        $loginPassword = vsprintf(
            '%s:%s',
            [
                $this->login,
                $this->password,
            ]
        );

        $header = [
            sprintf('Authorization: Basic %s', base64_encode($loginPassword)),
        ];

        if (null !== $this->headerHost) {
            $header[] = 'Host: ' . $this->headerHost;
        }

        return $header;
    }
}
