<?php

declare(strict_types=1);

namespace App\Tests;

use PHPUnit\Framework\TestCase;

/**
 * Very dirty hack to test response
 */
class IndexTest extends TestCase
{
    // phpcs:ignore Generic.Files.LineLength
    private const RESPONSE = '[{"id":"12345600001","manufacturer":"Drinks Corp.","name":"Soda Drink, 12 * 1,0l","packaging":"CA","baseProductPackaging":"BO","baseProductUnit":"LT","baseProductAmount":1,"baseProductQuantity":12,"gtin":"23880602029774"},{"id":"12345600002","manufacturer":"Drinks Corp.","name":"Orange Drink, 20 * 0,5l","packaging":"CA","baseProductPackaging":"BO","baseProductUnit":"LT","baseProductAmount":0.5,"baseProductQuantity":20,"gtin":"23880602029781"},{"id":"12345600003","manufacturer":"Drinks Corp.","name":"Beer, 6 * 0,5l","packaging":"BX","baseProductPackaging":"CN","baseProductUnit":"LT","baseProductAmount":0.5,"baseProductQuantity":6,"gtin":"23880602029798"},{"id":"12345600001","manufacturer":"Drinks Corp.","name":"Soda Drink, 12x 1L","packaging":"CA","baseProductPackaging":"BO","baseProductUnit":"LT","baseProductAmount":1,"baseProductQuantity":12,"gtin":"24880602029766"},{"id":"12345600002","manufacturer":"Drinks Corp.","name":"Orange Drink, 20x 0.5L","packaging":"CA","baseProductPackaging":"BO","baseProductUnit":"LT","baseProductAmount":0.5,"baseProductQuantity":20,"gtin":"24880602029773"},{"id":"12345600003","manufacturer":"Drinks Corp.","name":"Beer, 6x 0.5L","packaging":"BX","baseProductPackaging":"CN","baseProductUnit":"LT","baseProductAmount":0.5,"baseProductQuantity":6,"gtin":"24880602029780"}]';

    public function testIndex(): void
    {
        self::assertEquals(self::RESPONSE, `php public/index.php`);
    }
}
