<?php

declare(strict_types=1);

namespace App\Tests\File\Reader;

use kollex\File\File;
use kollex\File\Reader\JsonReader;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;

class JsonReaderTest extends TestCase
{
    private const WRONG_JSON = '{a:1}';
    private const VALID_JSON = '{"data": "1"}';
    private const VALID_DATA = ['data' => '1'];

    /** @var File|ObjectProphecy */
    private $file;

    private JsonReader $reader;

    protected function setUp(): void
    {
        $this->file = $this->prophesize(File::class);
        $this->reader = new JsonReader($this->file->reveal());
    }

    public function testGetDataWrongJson(): void
    {
        $this->expectException(\JsonException::class);
        $this->file->getBody()
            ->willReturn(self::WRONG_JSON)
            ->shouldBeCalled();
        $this->reader->getData();
    }

    public function testGetData(): void
    {
        $this->file->getBody()
            ->willReturn(self::VALID_JSON)
            ->shouldBeCalled();
        self::assertEquals(self::VALID_DATA, $this->reader->getData());
    }
}
