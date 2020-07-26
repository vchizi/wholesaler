<?php

declare(strict_types=1);

namespace kollex\Service\DataProvider;

use kollex\Dataprovider\Assortment\DataProvider;
use kollex\Service\Factory\ProductFactory;
use kollex\Service\Mapper\Mapper;
use kollex\Validator\Validator;
use kollex\Service\DataLoader\WholesalerLoader;

class WholesalerDataProvider implements DataProvider
{
    private WholesalerLoader $wholesalerLoader;
    private Mapper $mapper;
    private Validator $validator;
    private ProductFactory $productFactory;

    public function __construct(
        WholesalerLoader $wholesalerLoader,
        Mapper $mapper,
        Validator $validator,
        ProductFactory $productFactory
    ) {
        $this->wholesalerLoader = $wholesalerLoader;
        $this->mapper = $mapper;
        $this->validator = $validator;
        $this->productFactory = $productFactory;
    }

    public function getProducts(): array
    {
        $products = [];
        foreach ($this->wholesalerLoader->getRawProducts() as $rawProduct) {
            $product = $this->mapper->getMappedProductData($rawProduct);
            if (!$this->validator->valid($product)) {
                //TODO: invalid product. Should be logged and checked if format of data from wholesaler isn't changed
                continue;
            }

            $products[] = $this->productFactory->create($product);
        }

        return $products;
    }
}
