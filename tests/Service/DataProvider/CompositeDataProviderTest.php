<?php

declare(strict_types=1);

namespace App\Tests\Service\DataProvider;

use kollex\Dataprovider\Assortment\DataProvider;
use kollex\Dataprovider\Assortment\Product;
use kollex\Service\DataProvider\CompositeDataProvider;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;

class CompositeDataProviderTest extends TestCase
{
    /** @var DataProvider|ObjectProphecy */
    private $firstDataProvider;

    /** @var DataProvider|ObjectProphecy */
    private $secondDataProvider;

    private CompositeDataProvider $provider;

    protected function setUp(): void
    {
        $this->firstDataProvider = $this->prophesize(DataProvider::class);
        $this->secondDataProvider = $this->prophesize(DataProvider::class);
        $this->provider = new CompositeDataProvider([
            $this->firstDataProvider->reveal(),
            $this->secondDataProvider->reveal()
        ]);
    }

    public function testGetProducts(): void
    {
        $firstProduct = $this->prophesize(Product::class);
        $secondProduct = $this->prophesize(Product::class);
        $this->firstDataProvider->getProducts()
            ->willReturn([$firstProduct->reveal(), $secondProduct->reveal()]);
        $thirdProduct = $this->prophesize(Product::class);
        $this->secondDataProvider->getProducts()
            ->willReturn([$thirdProduct->reveal()]);

        self::assertSame([
            $firstProduct->reveal(),
            $secondProduct->reveal(),
            $thirdProduct->reveal()
        ], $this->provider->getProducts());
    }
}
