<?php

declare(strict_types=1);

namespace kollex\File\Reader;

use kollex\File\File;

class CSVReader implements Reader
{
    private File $file;

    public function __construct(File $file)
    {
        $this->file = $file;
    }

    public function getData(): array
    {
        $headers = [];
        $data = [];
        foreach (str_getcsv($this->file->getBody(), "\n") as $rowNumber => $rowContent) {
            $rowData = str_getcsv($rowContent, ';');
            if ($rowNumber === 0) {
                $headers = $rowData;
                continue;
            }

            $body = [];
            foreach ($rowData as $key => $value) {
                $body[$headers[$key]] = $value;
            }

            $data[] = $body;
        }

        return $data;
    }
}
