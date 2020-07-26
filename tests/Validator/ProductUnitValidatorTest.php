<?php

declare(strict_types=1);

namespace App\Tests\Validator;

use kollex\Validator\ProductUnitValidator;
use PHPUnit\Framework\TestCase;

class ProductUnitValidatorTest extends TestCase
{
    private ProductUnitValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new  ProductUnitValidator();
    }

    public function testValidInvalidType(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->validator->valid([]);
    }

    /**
     * @dataProvider getValidData
     */
    public function testValid(string $value, bool $valid): void
    {
        self::assertEquals($valid, $this->validator->valid($value));
    }

    public function getValidData(): \Generator
    {
        yield 'LT' => ['LT', true];
        yield 'GR' => ['GR', true];
        yield 'invalid' => ['invalid', false];
    }
}
