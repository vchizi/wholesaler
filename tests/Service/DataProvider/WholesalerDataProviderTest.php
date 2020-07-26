<?php

declare(strict_types=1);

namespace App\Tests\Service\DataProvider;

use kollex\Dataprovider\Assortment\Product;
use kollex\Service\DataLoader\WholesalerLoader;
use kollex\Service\DataProvider\WholesalerDataProvider;
use kollex\Service\Factory\ProductFactory;
use kollex\Service\Mapper\Mapper;
use kollex\Validator\Validator;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;

class WholesalerDataProviderTest extends TestCase
{
    private const RAW_PRODUCTS = [['identifier' => 10, 'product' => 'test'], ['identifier' => 20, 'product' => 'test']];
    private const PRODUCT_VALID = ['id' => 10, 'name' => 'test'];
    private const PRODUCT_INVALID = ['id' => 20, 'name' => 'test'];

    /** @var WholesalerLoader|ObjectProphecy */
    private $wholesalerLoader;

    /** @var Mapper|ObjectProphecy */
    private $mapper;

    /** @var Validator|ObjectProphecy */
    private $validator;

    /** @var ProductFactory|ObjectProphecy */
    private $productFactory;

    private WholesalerDataProvider $provider;

    protected function setUp(): void
    {
        $this->wholesalerLoader = $this->prophesize(WholesalerLoader::class);
        $this->mapper = $this->prophesize(Mapper::class);
        $this->validator = $this->prophesize(Validator::class);
        $this->productFactory = $this->prophesize(ProductFactory::class);
        $this->provider = new WholesalerDataProvider(
            $this->wholesalerLoader->reveal(),
            $this->mapper->reveal(),
            $this->validator->reveal(),
            $this->productFactory->reveal()
        );
    }

    public function testGetProducts(): void
    {
        $this->wholesalerLoader->getRawProducts()
            ->willReturn(self::RAW_PRODUCTS)
            ->shouldBeCalled();
        $this->mapper->getMappedProductData(self::RAW_PRODUCTS[0])
            ->willReturn(self::PRODUCT_VALID)
            ->shouldBeCalled();
        $this->mapper->getMappedProductData(self::RAW_PRODUCTS[1])
            ->willReturn(self::PRODUCT_INVALID)
            ->shouldBeCalled();
        $this->validator->valid(self::PRODUCT_VALID)
            ->willReturn(true)
            ->shouldBeCalled();
        $this->validator->valid(self::PRODUCT_INVALID)
            ->willReturn(false)
            ->shouldBeCalled();
        $product = $this->prophesize(Product::class);
        $this->productFactory->create(self::PRODUCT_VALID)
            ->willReturn($product->reveal())
            ->shouldBeCalled();

        self::assertSame([$product->reveal()], $this->provider->getProducts());
    }
}
