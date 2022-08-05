<?php

namespace ISklepApiClient\Services\Curl;

interface CurlServiceInterface
{
    /**
     * @param string $path
     *
     * @return string|null
     */
    public function makeGetRequest(string $path): ?string;

    /**
     * @param string $path
     * @param array $data
     *
     * @return string|null
     */
    public function makePostRequest(string $path, array $data): ?string;
}
