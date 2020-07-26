<?php

namespace kollex\File\Reader;

use kollex\File\File;

interface Reader
{
    public function __construct(File $file);

    public function getData(): array;
}
