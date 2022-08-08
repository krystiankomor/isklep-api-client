<?php

namespace ISklepApiClient\Service\Curl;

use ISklepApiClient\Message\Response;

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
    public function makeRequest(string $path, string $type, ?array $data = null): Response
    {
        $curlOptions = $this->getCurlOptions($path, $type, $data);

        $curl = curl_init();
        curl_setopt_array($curl, $curlOptions);

        /** @var string|null $return due to CURLOPT_RETURNTRANSFER = true */
        $return = curl_exec($curl);

        $info = curl_getinfo($curl);
        $errors = curl_error($curl);
        $errno = curl_errno($curl);

        curl_close($curl);

        return new Response($return, $info, $errors, $errno);
    }

    /**
     * @param string $path
     * @param string $type
     * @param mixed[]|null $data
     *
     * @return mixed[]
     */
    public function getCurlOptions(string $path, string $type, ?array $data): array
    {
        $curlOptions = [
            CURLOPT_URL            => trim($this->url, '/') . $path,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => $type,
            CURLOPT_HTTPHEADER     => $this->getHeaders(),
        ];

        if (null !== $data) {
            $curlOptions[CURLOPT_HTTPHEADER][] = 'Content-Type: application/json';
            $curlOptions[CURLOPT_POSTFIELDS] = json_encode($data);
        }

        return $curlOptions;
    }

    /**
     * @return string[]
     */
    public function getHeaders(): array
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
