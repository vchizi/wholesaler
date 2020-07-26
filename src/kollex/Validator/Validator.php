<?php

namespace kollex\Validator;

interface Validator
{
    public function field(): ?string;

    public function valid($value): bool;
}
