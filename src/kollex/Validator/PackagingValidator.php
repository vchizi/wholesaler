<?php

declare(strict_types=1);

namespace kollex\Validator;

class PackagingValidator implements Validator
{
    private const PACKAGING = [
        'CA',
        'BX',
        'BO',
    ];

    public function valid($value): bool
    {
        if (!is_string($value)) {
            throw new \InvalidArgumentException(\sprintf('"$value" must be string, given: %s', gettype($value)));
        }

        return in_array($value, self::PACKAGING, true);
    }

    public function field(): ?string
    {
        return 'packaging';
    }
}
