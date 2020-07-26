<?php

declare(strict_types=1);

namespace App\Tests\Response;

use kollex\Dataprovider\Assortment\Product;
use kollex\Response\JsonResponse;
use PHPUnit\Framework\TestCase;

class JsonResponseTest extends TestCase
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

    private JsonResponse $response;

    protected function setUp(): void
    {
        $this->response = new JsonResponse();
    }

    public function testCreate(): void
    {
        $product = $this->prophesize(Product::class);
        $product->getId()
            ->willReturn(self::PRODUCT[Product::FIELD_ID])
            ->shouldBeCalled();
        $product->getManufacturer()
            ->willReturn(self::PRODUCT[Product::FIELD_MANUFACTURER])
            ->shouldBeCalled();
        $product->getName()
            ->willReturn(self::PRODUCT[Product::FIELD_NAME])
            ->shouldBeCalled();
        $product->getPackaging()
            ->willReturn(self::PRODUCT[Product::FIELD_PACKAGING])
            ->shouldBeCalled();
        $product->getBaseProductPackaging()
            ->willReturn(self::PRODUCT[Product::FIELD_BASE_PRODUCT_PACKAGING])
            ->shouldBeCalled();
        $product->getBaseProductUnit()
            ->willReturn(self::PRODUCT[Product::FIELD_BASE_PRODUCT_UNIT])
            ->shouldBeCalled();
        $product->getBaseProductAmount()
            ->willReturn(self::PRODUCT[Product::FIELD_BASE_PRODUCT_AMOUNT])
            ->shouldBeCalled();
        $product->getBaseProductQuantity()
            ->willReturn(self::PRODUCT[Product::FIELD_BASE_PRODUCT_QUANTITY])
            ->shouldBeCalled();
        $product->getGtin()
            ->willReturn(self::PRODUCT[Product::FIELD_GTIN])
            ->shouldBeCalled();

        self::assertSame(json_encode([self::PRODUCT]), $this->response->create([$product->reveal()]));
    }
}
