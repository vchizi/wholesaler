<?php

namespace kollex\Dataprovider\Assortment;

interface Product
{
    public const FIELD_ID = 'id';
    public const FIELD_MANUFACTURER = 'manufacturer';
    public const FIELD_NAME = 'name';
    public const FIELD_PACKAGING = 'packaging';
    public const FIELD_BASE_PRODUCT_PACKAGING = 'baseProductPackaging';
    public const FIELD_BASE_PRODUCT_UNIT = 'baseProductUnit';
    public const FIELD_BASE_PRODUCT_AMOUNT = 'baseProductAmount';
    public const FIELD_BASE_PRODUCT_QUANTITY = 'baseProductQuantity';
    public const FIELD_GTIN = 'gtin';

    public function getId(): string;

    public function getManufacturer(): string;

    public function getName(): string;

    public function getPackaging(): string;

    public function getBaseProductPackaging(): string;

    public function getBaseProductUnit(): string;

    public function getBaseProductAmount(): float;

    public function getBaseProductQuantity(): int;

    public function getGtin(): ?string;
}
