<?php

declare(strict_types=1);

namespace App\Tests\Service\Mapper;

use kollex\Service\Mapper\WholesalerAMapper;
use PHPUnit\Framework\TestCase;

class WholesalerAMapperTest extends TestCase
{
    private WholesalerAMapper $mapper;

    protected function setUp(): void
    {
        $this->mapper = new WholesalerAMapper();
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
                'id' => '12345600001',
                'ean' => '23880602029774',
                'manufacturer' => 'Drinks Corp.',
                'product' => 'Soda Drink, 12 * 1,0l',
                'description' => 'Lorem ipsum usu amet dicat nullam ea',
                'packaging product' => 'case 12',
                'foo' => 'bar',
                'packaging unit' => 'bottle',
                'amount per unit' => '1.0l',
                'items on stock (availability)' => '123',
                'warehouse' => 'north'
            ],
            'mapped product' => [
                'id' => '12345600001',
                'manufacturer' => 'Drinks Corp.',
                'name' => 'Soda Drink, 12 * 1,0l',
                'packaging' => 'CA',
                'baseProductPackaging' => 'BO',
                'baseProductUnit' => 'LT',
                'baseProductAmount' => 1.0,
                'baseProductQuantity' => 12,
                'gtin' => '23880602029774',
            ]
        ];

        yield 'box' => [
            'raw product' => [
                'id' => '12345600001',
                'ean' => '23880602029774',
                'manufacturer' => 'Drinks Corp.',
                'product' => 'Soda Drink, 12 * 1,0l',
                'description' => 'Lorem ipsum usu amet dicat nullam ea',
                'packaging product' => 'box 13',
                'foo' => 'bar',
                'packaging unit' => 'bottle',
                'amount per unit' => '0.5l',
                'items on stock (availability)' => '123',
                'warehouse' => 'north'
            ],
            'mapped product' => [
                'id' => '12345600001',
                'manufacturer' => 'Drinks Corp.',
                'name' => 'Soda Drink, 12 * 1,0l',
                'packaging' => 'BX',
                'baseProductPackaging' => 'BO',
                'baseProductUnit' => 'LT',
                'baseProductAmount' => 0.5,
                'baseProductQuantity' => 13,
                'gtin' => '23880602029774',
            ]
        ];

        yield 'bottle' => [
            'raw product' => [
                'id' => '12345600001',
                'ean' => '23880602029774',
                'manufacturer' => 'Drinks Corp.',
                'product' => 'Soda Drink, 12 * 1,0l',
                'description' => 'Lorem ipsum usu amet dicat nullam ea',
                'packaging product' => 'bottle 11',
                'foo' => 'bar',
                'packaging unit' => 'can',
                'amount per unit' => '0.75l',
                'items on stock (availability)' => '123',
                'warehouse' => 'north'
            ],
            'mapped product' => [
                'id' => '12345600001',
                'manufacturer' => 'Drinks Corp.',
                'name' => 'Soda Drink, 12 * 1,0l',
                'packaging' => 'BO',
                'baseProductPackaging' => 'CN',
                'baseProductUnit' => 'LT',
                'baseProductAmount' => 0.75,
                'baseProductQuantity' => 11,
                'gtin' => '23880602029774',
            ]
        ];

        yield 'undefined' => [
            'raw product' => [
                'id' => '12345600001',
                'ean' => '23880602029774',
                'manufacturer' => 'Drinks Corp.',
                'product' => 'Soda Drink, 12 * 1,0l',
                'description' => 'Lorem ipsum usu amet dicat nullam ea',
                'packaging product' => 'undefined',
                'foo' => 'bar',
                'packaging unit' => 'undefined',
                'amount per unit' => '0.75l',
                'items on stock (availability)' => '123',
                'warehouse' => 'north'
            ],
            'mapped product' => [
                'id' => '12345600001',
                'manufacturer' => 'Drinks Corp.',
                'name' => 'Soda Drink, 12 * 1,0l',
                'packaging' => 'undefined',
                'baseProductPackaging' => 'undefined',
                'baseProductUnit' => 'LT',
                'baseProductAmount' => 0.75,
                'baseProductQuantity' => 0,
                'gtin' => '23880602029774',
            ]
        ];
    }
}
