<?php

declare(strict_types=1);

namespace App\Tests\Validator;

use kollex\Validator\ProductPackagingValidator;
use PHPUnit\Framework\TestCase;

class ProductPackagingValidatorTest extends TestCase
{
    private ProductPackagingValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new ProductPackagingValidator();
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
        yield 'BO' => ['BO', true];
        yield 'CN' => ['CN', true];
        yield 'invalid' => ['invalid', false];
    }
}
