<?php

declare(strict_types=1);

namespace kollex\Domain;

use kollex\Dataprovider\Assortment\Product as ProductInterface;

class Product implements ProductInterface
{
    private string $id;
    private string $manufacturer;
    private string $name;
    private string $packaging;
    private string $baseProductPackaging;
    private string $baseProductUnit;
    private float $baseProductAmount;
    private int $baseProductQuantity;
    private ?string $gtin;

    public function __construct(
        string $id,
        string $manufacturer,
        string $name,
        string $packaging,
        string $baseProductPackaging,
        string $baseProductUnit,
        float $baseProductAmount,
        int $baseProductQuantity,
        ?string $gtin
    ) {
        $this->id = $id;
        $this->manufacturer = $manufacturer;
        $this->name = $name;
        $this->packaging = $packaging;
        $this->baseProductPackaging = $baseProductPackaging;
        $this->baseProductUnit = $baseProductUnit;
        $this->baseProductAmount = $baseProductAmount;
        $this->baseProductQuantity = $baseProductQuantity;
        $this->gtin = $gtin;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getManufacturer(): string
    {
        return $this->manufacturer;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPackaging(): string
    {
        return $this->packaging;
    }

    public function getBaseProductPackaging(): string
    {
        return $this->baseProductPackaging;
    }

    public function getBaseProductUnit(): string
    {
        return $this->baseProductUnit;
    }

    public function getBaseProductAmount(): float
    {
        return $this->baseProductAmount;
    }

    public function getBaseProductQuantity(): int
    {
        return $this->baseProductQuantity;
    }

    public function getGtin(): ?string
    {
        return $this->gtin;
    }
}
