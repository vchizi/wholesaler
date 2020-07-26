<?php

declare(strict_types=1);

namespace kollex\Service\DataLoader;

use kollex\File\File;
use kollex\File\Reader\ReaderFactory;

class WholesalerBLoader implements WholesalerLoader
{
    private const FILE_NAME = 'wholesaler_b.json';
    private ReaderFactory $readerFactory;
    private string $storageFolder;

    public function __construct(ReaderFactory $readerFactory, string $storageFolder)
    {
        $this->readerFactory = $readerFactory;
        $this->storageFolder = $storageFolder;
    }

    public function getRawProducts(): array
    {
        $file = new File($this->getPath());
        return $this->readerFactory->createReader($file)->getData()['data'];
    }

    private function getPath(): string
    {
        return $this->storageFolder . DIRECTORY_SEPARATOR . self::FILE_NAME;
    }
}
