<?php

declare(strict_types=1);

namespace kollex\Validator;

class RequiredValidator implements Validator
{
    private const REQUIRED_FIELD = [
        'id',
        'manufacturer',
        'name',
        'packaging',
        'baseProductPackaging',
        'baseProductUnit',
        'baseProductAmount',
        'baseProductQuantity',
    ];

    public function valid($value): bool
    {
        if (!is_array($value)) {
            throw new \InvalidArgumentException(\sprintf('"$value" must be array, given: %s', gettype($value)));
        }

        foreach (self::REQUIRED_FIELD as $field) {
            if (!isset($value[$field])) {
                return false;
            }
        }

        return true;
    }

    public function field(): ?string
    {
        return null;
    }
}
