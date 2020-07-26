<?php

declare(strict_types=1);

namespace kollex\Validator;

class CompositeValidator implements Validator
{
    /** @var Validator[] */
    private array $validators;

    /**
     * @param Validator[] $validators
     */
    public function __construct(array $validators)
    {
        foreach ($validators as $validator) {
            if (!$validator instanceof Validator) {
                throw new \InvalidArgumentException(\sprintf(
                    '%s provider expected, given: %s',
                    Validator::class,
                    get_class($validator)
                ));
            }

            $this->validators[] = $validator;
        }
    }

    public function valid($value): bool
    {
        if (!is_array($value)) {
            throw new \InvalidArgumentException(\sprintf('"$value" must be array, given: %s', gettype($value)));
        }

        foreach ($this->validators as $validator) {
            if ($validator->field() === null) {
                if (!$validator->valid($value)) {
                    return false;
                }

                continue;
            }

            if (!$validator->valid($value[$validator->field()])) {
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
