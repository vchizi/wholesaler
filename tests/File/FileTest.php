<?php

declare(strict_types=1);

namespace App\Tests\File;

use kollex\File\File;
use PHPUnit\Framework\TestCase;

class FileTest extends TestCase
{
    private const TEST_FILE = 'tests/File/test.txt';
    private const BODY = 'test';
    private const EXTENSION = 'txt';

    public function testFile(): void
    {
        $file = new File(self::TEST_FILE);

        self::assertEquals(self::BODY, $file->getBody());
        self::assertEquals(self::EXTENSION, $file->getExtension());
    }
}
