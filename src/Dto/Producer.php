<?php

namespace ISklepApiClient\Dto;

use JsonSerializable;

class Producer implements JsonSerializable
{
    private ?int $id = null;
    private ?string $name = null;
    private ?string $siteUrl = null;
    private ?string $logoFilename = null;
    private ?int $ordering = null;
    private ?string $sourceId = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     *
     * @return Producer
     */
    public function setId(?int $id): Producer
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     *
     * @return Producer
     */
    public function setName(?string $name): Producer
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSiteUrl(): ?string
    {
        return $this->siteUrl;
    }

    /**
     * @param string|null $siteUrl
     *
     * @return Producer
     */
    public function setSiteUrl(?string $siteUrl): Producer
    {
        $this->siteUrl = $siteUrl;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLogoFilename(): ?string
    {
        return $this->logoFilename;
    }

    /**
     * @param string|null $logoFilename
     *
     * @return Producer
     */
    public function setLogoFilename(?string $logoFilename): Producer
    {
        $this->logoFilename = $logoFilename;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getOrdering(): ?int
    {
        return $this->ordering;
    }

    /**
     * @param int|null $ordering
     *
     * @return Producer
     */
    public function setOrdering(?int $ordering): Producer
    {
        $this->ordering = $ordering;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSourceId(): ?string
    {
        return $this->sourceId;
    }

    /**
     * @param string|null $sourceId
     *
     * @return Producer
     */
    public function setSourceId(?string $sourceId): Producer
    {
        $this->sourceId = $sourceId;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function jsonSerialize(): array
    {
        return [
            'id'            => $this->getId(),
            'name'          => $this->getName(),
            'site_url'      => $this->getSiteUrl(),
            'logo_filename' => $this->getLogoFilename(),
            'ordering'      => $this->getOrdering(),
            'source_id'     => $this->getSourceId(),
        ];
    }
}