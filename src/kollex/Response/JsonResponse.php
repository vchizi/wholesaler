<?php

declare(strict_types=1);

namespace kollex\Response;

use kollex\Dataprovider\Assortment\Product;

class JsonResponse
{
    /**
     * @param Product[] $products
     */
    public function create(array $products): string
    {
        return json_encode(array_map(static function (Product $product) {

            return [
                Product::FIELD_ID => $product->getId(),
                Product::FIELD_MANUFACTURER => $product->getManufacturer(),
                Product::FIELD_NAME => $product->getName(),
                Product::FIELD_PACKAGING => $product->getPackaging(),
                Product::FIELD_BASE_PRODUCT_PACKAGING => $product->getBaseProductPackaging(),
                Product::FIELD_BASE_PRODUCT_UNIT => $product->getBaseProductUnit(),
                Product::FIELD_BASE_PRODUCT_AMOUNT => $product->getBaseProductAmount(),
                Product::FIELD_BASE_PRODUCT_QUANTITY => $product->getBaseProductQuantity(),
                Product::FIELD_GTIN => $product->getGtin(),
            ];
        }, $products));
    }
}
