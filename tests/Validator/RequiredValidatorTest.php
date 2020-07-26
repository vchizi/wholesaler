<?php

declare(strict_types=1);

namespace App\Tests\Validator;

use kollex\Validator\RequiredValidator;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

class RequiredValidatorTest extends TestCase
{
    private const WRONG_VALUE = 'wrong value';
    private const PRODUCT = [
        'id' => '12345600001',
        'manufacturer' => 'Drinks Corp.',
        'name' => 'Soda Drink, 12 * 1,0l',
        'packaging' => 'CA',
        'baseProductPackaging' => 'BO',
        'baseProductUnit' => 'LT',
        'baseProductAmount' => 1.0,
        'baseProductQuantity' => 12
    ];
    private RequiredValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new RequiredValidator();
    }

    public function testValidWrongValue(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->validator->valid(self::WRONG_VALUE);
    }

    /**
     * @dataProvider getValidData
     */
    public function testValid(array $data, bool $valid): void
    {
        self::assertEquals($valid, $this->validator->valid($data));
    }

    public function getValidData(): \Generator
    {
        yield 'valid' => [
            self::PRODUCT,
            true
        ];
        $product = self::PRODUCT;
        foreach (self::PRODUCT as $key => $value) {
            unset($product[$key]);
            yield "required $key" => [
                $product,
                false
            ];
            $product[$key] = $value;
        }
    }
}
