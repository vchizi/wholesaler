<?php

declare(strict_types=1);

namespace kollex\File\Reader;

use kollex\File\File;

class ReaderFactory
{
    public const EXTENSION_CSV = 'csv';
    public const EXTENSION_JSON = 'json';

    private const READERS = [
        self::EXTENSION_CSV => CSVReader::class,
        self::EXTENSION_JSON => JsonReader::class
    ];

    public function createReader(File $file): Reader
    {
        $reader = self::READERS[$file->getExtension()] ?? null;
        if ($reader === null) {
            throw new \InvalidArgumentException('Not supported file extension!');
        }

        return new $reader($file);
    }
}
