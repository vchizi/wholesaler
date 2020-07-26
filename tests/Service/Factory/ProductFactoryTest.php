<?php

declare(strict_types=1);

namespace App\Tests\Service\Factory;

use kollex\Service\Factory\ProductFactory;
use PHPUnit\Framework\TestCase;

class ProductFactoryTest extends TestCase
{
    private const PRODUCT = [
        'id' => '12345600001',
        'manufacturer' => 'Drinks Corp.',
        'name' => 'Soda Drink, 12 * 1,0l',
        'packaging' => 'CA',
        'baseProductPackaging' => 'BO',
        'baseProductUnit' => 'LT',
        'baseProductAmount' => 1.0,
        'baseProductQuantity' => 12,
        'gtin' => '23880602029774',
    ];

    private ProductFactory $factory;

    protected function setUp(): void
    {
        $this->factory = new ProductFactory();
    }

    public function testCreate(): void
    {
        $product = $this->factory->create(self::PRODUCT);

        self::assertSame(self::PRODUCT['id'], $product->getId());
        self::assertSame(self::PRODUCT['manufacturer'], $product->getManufacturer());
        self::assertSame(self::PRODUCT['name'], $product->getName());
        self::assertSame(self::PRODUCT['packaging'], $product->getPackaging());
        self::assertSame(self::PRODUCT['baseProductPackaging'], $product->getBaseProductPackaging());
        self::assertSame(self::PRODUCT['baseProductUnit'], $product->getBaseProductUnit());
        self::assertSame(self::PRODUCT['baseProductAmount'], $product->getBaseProductAmount());
        self::assertSame(self::PRODUCT['baseProductQuantity'], $product->getBaseProductQuantity());
        self::assertSame(self::PRODUCT['gtin'], $product->getGtin());
    }
}
