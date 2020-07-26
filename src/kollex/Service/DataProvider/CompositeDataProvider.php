<?php

declare(strict_types=1);

namespace kollex\Service\DataProvider;

use kollex\Dataprovider\Assortment\DataProvider;

class CompositeDataProvider implements DataProvider
{
    /** @var DataProvider[] */
    private array $dataProviders = [];

    /**
     * @param DataProvider[] $dataProviders
     */
    public function __construct(array $dataProviders)
    {
        foreach ($dataProviders as $dataProvider) {
            if (!$dataProvider instanceof DataProvider) {
                throw new \InvalidArgumentException(\sprintf(
                    '%s provider expected, given: %s',
                    DataProvider::class,
                    get_class($dataProvider)
                ));
            }

            $this->dataProviders[] = $dataProvider;
        }
    }

    public function getProducts(): array
    {
        $products = [];
        foreach ($this->dataProviders as $dataProvider) {
            //TODO: Refactor this
            $products = array_merge($products, $dataProvider->getProducts());
        }

        return $products;
    }
}
