<?php

namespace ISklepApiClient\Message;

class Response
{
    private ?string $body;

    /** @var mixed[] $info */
    private array $info;

    private string $errors;
    private int $errno;

    /**
     * @param string|null $body
     * @param mixed[] $info
     * @param string $errors
     * @param int $errno
     */
    public function __construct(?string $body, array $info, string $errors, int $errno)
    {
        $this->body = $body;
        $this->info = $info;
        $this->errors = $errors;
        $this->errno = $errno;
    }

    /**
     * @return string
     */
    public function getErrors(): string
    {
        return $this->errors;
    }

    /**
     * @return string|null
     */
    public function getBody(): ?string
    {
        return $this->body;
    }

    /**
     * @return bool
     */
    public function isSuccessfulCode(): bool
    {
        $code = $this->getResponseCode();

        return null !== $code && $code >= 200 && $code < 300 && 0 === $this->errno;
    }

    /**
     * @return int|null
     */
    public function getResponseCode(): ?int
    {
        return $this->info['http_code'] ?? null;
    }
}
