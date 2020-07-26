<?php

declare(strict_types=1);

namespace App\Tests\Service\Mapper;

use kollex\Service\Mapper\WholesalerBMapper;
use PHPUnit\Framework\TestCase;

class WholesalerBMapperTest extends TestCase
{
    private WholesalerBMapper $mapper;

    protected function setUp(): void
    {
        $this->mapper = new WholesalerBMapper();
    }

    /**
     * @dataProvider getMapData
     */
    public function testGetMappedProductData(array $rawProduct, array $mappedProduct): void
    {
        self::assertSame($mappedProduct, $this->mapper->getMappedProductData($rawProduct));
    }

    public function getMapData(): \Generator
    {
        yield 'case' => [
            'raw product' => [
                'PRODUCT_IDENTIFIER' => '12345600001',
                'EAN_CODE_GTIN' => '24880602029766',
                'BRAND' => 'Drinks Corp.',
                'NAME' => 'Soda Drink, 12x 1L',
                'PACKAGE' => 'case',
                'ADDITIONAL_INFO' => '',
                'VESSEL' => 'bottle',
                'LITERS_PER_BOTTLE' => '1',
                'BOTTLE_AMOUNT' => '12',
            ],
            'mapped product' => [
                'id' => '12345600001',
                'manufacturer' => 'Drinks Corp.',
                'name' => 'Soda Drink, 12x 1L',
                'packaging' => 'CA',
                'baseProductPackaging' => 'BO',
                'baseProductUnit' => 'LT',
                'baseProductAmount' => 1.0,
                'baseProductQuantity' => 12,
                'gtin' => '24880602029766',
            ]
        ];

        yield 'box' => [
            'raw product' => [
                'PRODUCT_IDENTIFIER' => '12345600001',
                'EAN_CODE_GTIN' => '24880602029766',
                'BRAND' => 'Drinks Corp.',
                'NAME' => 'Soda Drink, 12x 1L',
                'PACKAGE' => 'box',
                'ADDITIONAL_INFO' => '',
                'VESSEL' => 'bottle',
                'LITERS_PER_BOTTLE' => '0,5',
                'BOTTLE_AMOUNT' => '13',
            ],
            'mapped product' => [
                'id' => '12345600001',
                'manufacturer' => 'Drinks Corp.',
                'name' => 'Soda Drink, 12x 1L',
                'packaging' => 'BX',
                'baseProductPackaging' => 'BO',
                'baseProductUnit' => 'LT',
                'baseProductAmount' => 0.5,
                'baseProductQuantity' => 13,
                'gtin' => '24880602029766',
            ]
        ];

        yield 'bottle' => [
            'raw product' => [
                'PRODUCT_IDENTIFIER' => '12345600001',
                'EAN_CODE_GTIN' => '24880602029766',
                'BRAND' => 'Drinks Corp.',
                'NAME' => 'Soda Drink, 12x 1L',
                'PACKAGE' => 'bottle',
                'ADDITIONAL_INFO' => '',
                'VESSEL' => 'can',
                'LITERS_PER_BOTTLE' => '0,75',
                'BOTTLE_AMOUNT' => '11',
            ],
            'mapped product' => [
                'id' => '12345600001',
                'manufacturer' => 'Drinks Corp.',
                'name' => 'Soda Drink, 12x 1L',
                'packaging' => 'BO',
                'baseProductPackaging' => 'CN',
                'baseProductUnit' => 'LT',
                'baseProductAmount' => 0.75,
                'baseProductQuantity' => 11,
                'gtin' => '24880602029766',
            ]
        ];

        yield 'undefined' => [
            'raw product' => [
                'PRODUCT_IDENTIFIER' => '12345600001',
                'EAN_CODE_GTIN' => '24880602029766',
                'BRAND' => 'Drinks Corp.',
                'NAME' => 'Soda Drink, 12x 1L',
                'PACKAGE' => 'undefined',
                'ADDITIONAL_INFO' => '',
                'VESSEL' => 'undefined',
                'LITERS_PER_BOTTLE' => '0,75',
                'BOTTLE_AMOUNT' => '12',
            ],
            'mapped product' => [
                'id' => '12345600001',
                'manufacturer' => 'Drinks Corp.',
                'name' => 'Soda Drink, 12x 1L',
                'packaging' => 'undefined',
                'baseProductPackaging' => 'undefined',
                'baseProductUnit' => 'LT',
                'baseProductAmount' => 0.75,
                'baseProductQuantity' => 12,
                'gtin' => '24880602029766',
            ]
        ];
    }
}
