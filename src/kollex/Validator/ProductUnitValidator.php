<?php

declare(strict_types=1);

namespace kollex\Validator;

class ProductUnitValidator implements Validator
{
    private const PRODUCT_UNIT = [
        'LT',
        'GR',
    ];

    public function valid($value): bool
    {
        if (!is_string($value)) {
            throw new \InvalidArgumentException(\sprintf('"$value" must be string, given: %s', gettype($value)));
        }

        return in_array($value, self::PRODUCT_UNIT, true);
    }

    public function field(): ?string
    {
        return 'baseProductUnit';
    }
}
