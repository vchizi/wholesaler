<?php

use kollex\File\Reader\ReaderFactory;
use kollex\Response\JsonResponse;
use kollex\Service\DataLoader\WholesalerALoader;
use kollex\Service\DataLoader\WholesalerBLoader;
use kollex\Service\DataProvider\CompositeDataProvider;
use kollex\Service\DataProvider\WholesalerDataProvider;
use kollex\Service\Factory\ProductFactory;
use kollex\Service\Mapper\WholesalerAMapper;
use kollex\Service\Mapper\WholesalerBMapper;
use kollex\Validator\CompositeValidator;
use kollex\Validator\PackagingValidator;
use kollex\Validator\ProductPackagingValidator;
use kollex\Validator\ProductUnitValidator;
use kollex\Validator\RequiredValidator;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$storageFolder = dirname(__FILE__, 2) . DIRECTORY_SEPARATOR . 'data';

$validator = new CompositeValidator([
    new RequiredValidator(),
    new PackagingValidator(),
    new ProductPackagingValidator(),
    new ProductUnitValidator()
]);
$productFactory = new ProductFactory();

$readerFactory = new ReaderFactory();
$compositeDataProvider = new CompositeDataProvider([
    new WholesalerDataProvider(
        new WholesalerALoader($readerFactory, $storageFolder),
        new WholesalerAMapper(),
        $validator,
        $productFactory
    ),
    new WholesalerDataProvider(
        new WholesalerBLoader($readerFactory, $storageFolder),
        new WholesalerBMapper(),
        $validator,
        $productFactory
    )
]);

echo (new JsonResponse())->create($compositeDataProvider->getProducts());