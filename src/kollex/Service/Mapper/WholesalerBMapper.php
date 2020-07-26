<?php

declare(strict_types=1);

namespace kollex\Service\Mapper;

use kollex\Domain\Product;

class WholesalerBMapper implements Mapper
{
    private const FIELD_PRODUCT_IDENTIFIER = 'PRODUCT_IDENTIFIER';
    private const FIELD_BRAND = 'BRAND';
    private const FIELD_NAME = 'NAME';
    private const FIELD_PACKAGE = 'PACKAGE';
    private const FIELD_VESSEL = 'VESSEL';
    private const FIELD_LITERS_PER_BOTTLE = 'LITERS_PER_BOTTLE';
    private const FIELD_BOTTLE_AMOUNT = 'BOTTLE_AMOUNT';
    private const FIELD_EAN_CODE_GTIN = 'EAN_CODE_GTIN';
    private const PACKAGING_MAP = [
        'case' => 'CA',
        'box' => 'BX',
        'bottle' => 'BO',
    ];
    private const PRODUCT_PACKAGING_MAP = [
        'bottle' => 'BO',
        'can' => 'CN'
    ];

    public function getMappedProductData(array $rawProduct): array
    {
        return [
            Product::FIELD_ID => $rawProduct[self::FIELD_PRODUCT_IDENTIFIER],
            Product::FIELD_MANUFACTURER => $rawProduct[self::FIELD_BRAND],
            Product::FIELD_NAME => $rawProduct[self::FIELD_NAME],
            Product::FIELD_PACKAGING => self::PACKAGING_MAP[$rawProduct[self::FIELD_PACKAGE]]
                ?? $rawProduct[self::FIELD_PACKAGE],
            Product::FIELD_BASE_PRODUCT_PACKAGING => self::PRODUCT_PACKAGING_MAP[$rawProduct[self::FIELD_VESSEL]]
                ?? $rawProduct[self::FIELD_VESSEL],
            Product::FIELD_BASE_PRODUCT_UNIT => 'LT',
            Product::FIELD_BASE_PRODUCT_AMOUNT => (float)str_replace(
                ',',
                '.',
                $rawProduct[self::FIELD_LITERS_PER_BOTTLE]
            ),
            Product::FIELD_BASE_PRODUCT_QUANTITY => (int)$rawProduct[self::FIELD_BOTTLE_AMOUNT],
            Product::FIELD_GTIN => $rawProduct[self::FIELD_EAN_CODE_GTIN],
        ];
    }
}
