<?php

declare(strict_types=1);

namespace App\Tests\File\Reader;

use kollex\File\File;
use kollex\File\Reader\CSVReader;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;

class CSVReaderTest extends TestCase
{
    private const VALID_CSV = "id;name\n10;test";
    private const VALID_DATA = [['id' => 10, 'name' => 'test']];

    /** @var File|ObjectProphecy */
    private $file;

    private CSVReader $reader;

    protected function setUp(): void
    {
        $this->file = $this->prophesize(File::class);
        $this->reader = new CSVReader($this->file->reveal());
    }

    public function testGetData(): void
    {
        $this->file->getBody()
            ->willReturn(self::VALID_CSV)
            ->shouldBeCalled();
        self::assertEquals(self::VALID_DATA, $this->reader->getData());
    }
}
