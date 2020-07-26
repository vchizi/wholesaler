<?php

declare(strict_types=1);

namespace kollex\Service\Factory;

use kollex\Dataprovider\Assortment\Product as ProductInterface;
use kollex\Domain\Product;

class ProductFactory
{
    public function create(array $product): ProductInterface
    {
        return new Product(
            $product['id'],
            $product['manufacturer'],
            $product['name'],
            $product['packaging'],
            $product['baseProductPackaging'],
            $product['baseProductUnit'],
            $product['baseProductAmount'],
            $product['baseProductQuantity'],
            $product['gtin']
        );
    }
}
