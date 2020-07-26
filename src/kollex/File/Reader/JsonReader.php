<?php

declare(strict_types=1);

namespace kollex\File\Reader;

use kollex\File\File;

class JsonReader implements Reader
{
    private File $file;

    public function __construct(File $file)
    {
        $this->file = $file;
    }

    public function getData(): array
    {
        return json_decode($this->file->getBody(), true, 512, JSON_THROW_ON_ERROR);
    }
}
