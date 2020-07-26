<?php

declare(strict_types=1);

namespace App\Tests\Service\DataLoader;

use kollex\File\File;
use kollex\File\Reader\Reader;
use kollex\File\Reader\ReaderFactory;
use kollex\Service\DataLoader\WholesalerBLoader;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;

class WholesalerBLoaderTest extends TestCase
{
    private const DATA = ['data' => ['test']];
    private const STORAGE_FOLDER = 'tmp';

    /** @var ReaderFactory|ObjectProphecy */
    private $readerFactory;

    private WholesalerBLoader $loader;

    protected function setUp(): void
    {
        $this->readerFactory = $this->prophesize(ReaderFactory::class);
        $this->loader = new WholesalerBLoader($this->readerFactory->reveal(), self::STORAGE_FOLDER);
    }

    public function testGetRawProducts()
    {
        $reader = $this->prophesize(Reader::class);
        $this->readerFactory->createReader(Argument::type(File::class))
            ->willReturn($reader->reveal())
            ->shouldBeCalled();
        $reader->getData()
            ->willReturn(self::DATA)
            ->shouldBeCalled();

        self::assertEquals(self::DATA['data'], $this->loader->getRawProducts());
    }
}
