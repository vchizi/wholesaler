<?php

declare(strict_types=1);

namespace kollex\File;

class File
{
    private string $fileName;

    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
    }

    public function getBody(): string
    {
        return file_get_contents($this->fileName);
    }

    public function getExtension(): string
    {
        return pathinfo($this->fileName)['extension'];
    }
}
