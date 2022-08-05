<?php

namespace ISklepApiClient\Service\Curl;

use ISklepApiClient\Message\Response;

interface CurlServiceInterface
{
    /**
     * @param string $path
     * @param string $type
     * @param mixed[]|null $data
     *
     * @return Response
     */
    public function makeRequest(string $path, string $type, ?array $data = null): Response;
}
