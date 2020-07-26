<?php

declare(strict_types=1);

namespace App\Tests\File\Reader;

use kollex\File\File;
use kollex\File\Reader\CSVReader;
use kollex\File\Reader\JsonReader;
use kollex\File\Reader\ReaderFactory;
use PHPUnit\Framework\TestCase;

class ReaderFactoryTest extends TestCase
{
    private const EXTENSION_TXT = 'txt';

    private ReaderFactory $factory;

    protected function setUp(): void
    {
        $this->factory = new ReaderFactory();
    }

    public function testCreateReaderWrongExtension(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $file = $this->prophesize(File::class);
        $file->getExtension()
            ->shouldBeCalled()
            ->willReturn(self::EXTENSION_TXT);
        $this->factory->createReader($file->reveal());
    }

    /**
     * @dataProvider getCreateReaderData
     */
    public function testCreateReader(string $extension, string $readerFQCN): void
    {
        $file = $this->prophesize(File::class);
        $file->getExtension()
            ->shouldBeCalled()
            ->willReturn($extension);

        self::assertInstanceOf($readerFQCN, $this->factory->createReader($file->reveal()));
    }

    public function getCreateReaderData(): \Generator
    {
        yield 'csv' => [ReaderFactory::EXTENSION_CSV, CSVReader::class];
        yield 'json' => [ReaderFactory::EXTENSION_JSON, JsonReader::class];
    }
}
