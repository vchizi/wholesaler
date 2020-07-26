<?php

declare(strict_types=1);

namespace kollex\Service\Mapper;

use kollex\Domain\Product;

class WholesalerAMapper implements Mapper
{
    private const FIELD_ID = 'id';
    private const FIELD_MANUFACTURER = 'manufacturer';
    private const FIELD_PRODUCT = 'product';
    private const FIELD_PACKAGING_UNIT = 'packaging unit';
    private const FIELD_PACKAGING_PRODUCT = 'packaging product';
    private const FIELD_AMOUNT_PER_UNIT = 'amount per unit';
    private const FIELD_EAN = 'ean';
    private const PACKAGING_MAP = [
        'case' => 'CA',
        'box' => 'BX',
        'bottle' => 'BO',
    ];
    private const PRODUCT_PACKAGING_MAP = [
        'bottle' => 'BO',
        'can' => 'CN'
    ];
    private const PRODUCT_UNIT_MAP = [
        'l' => 'LT',
    ];

    public function getMappedProductData(array $rawProduct): array
    {
        $packagingProduct = explode(' ', $rawProduct[self::FIELD_PACKAGING_PRODUCT]);
        [$packaging, $baseProductQuantity] = [$packagingProduct[0], $packagingProduct[1] ?? 0];
        [$productAmount, $productUnit] = preg_split(
            '/^(\d+\.\d+)(\w+)$/',
            $rawProduct[self::FIELD_AMOUNT_PER_UNIT],
            -1,
            PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE
        );
        return [
            Product::FIELD_ID => $rawProduct[self::FIELD_ID],
            Product::FIELD_MANUFACTURER => $rawProduct[self::FIELD_MANUFACTURER],
            Product::FIELD_NAME => $rawProduct[self::FIELD_PRODUCT],
            Product::FIELD_PACKAGING => self::PACKAGING_MAP[$packaging] ?? $packaging,
            Product::FIELD_BASE_PRODUCT_PACKAGING =>
                self::PRODUCT_PACKAGING_MAP[$rawProduct[self::FIELD_PACKAGING_UNIT]]
                ?? $rawProduct[self::FIELD_PACKAGING_UNIT],
            Product::FIELD_BASE_PRODUCT_UNIT => self::PRODUCT_UNIT_MAP[$productUnit] ?? $productUnit,
            Product::FIELD_BASE_PRODUCT_AMOUNT => (float)$productAmount,
            Product::FIELD_BASE_PRODUCT_QUANTITY => (int)$baseProductQuantity,
            Product::FIELD_GTIN => $rawProduct[self::FIELD_EAN],
        ];
    }
}
