<?php

namespace kollex\Service\Mapper;

interface Mapper
{
    public function getMappedProductData(array $rawProduct): array;
}
