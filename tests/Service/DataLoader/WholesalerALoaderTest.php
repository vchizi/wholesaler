<?php

declare(strict_types=1);

namespace App\Tests\Service\DataLoader;

use kollex\File\File;
use kollex\File\Reader\Reader;
use kollex\File\Reader\ReaderFactory;
use kollex\Service\DataLoader\WholesalerALoader;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;

class WholesalerALoaderTest extends TestCase
{
    private const DATA = ['data' => 'data'];
    private const STORAGE_FOLDER = 'tmp';

    /** @var ReaderFactory|ObjectProphecy */
    private $readerFactory;

    private WholesalerALoader $loader;

    protected function setUp(): void
    {
        $this->readerFactory = $this->prophesize(ReaderFactory::class);
        $this->loader = new WholesalerALoader($this->readerFactory->reveal(), self::STORAGE_FOLDER);
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

        self::assertEquals(self::DATA, $this->loader->getRawProducts());
    }
}
