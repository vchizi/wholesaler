<?php

declare(strict_types=1);

namespace App\Tests\Validator;

use kollex\Validator\PackagingValidator;
use PHPUnit\Framework\TestCase;

class PackagingValidatorTest extends TestCase
{
    private PackagingValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new PackagingValidator();
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
        yield 'CA' => ['CA', true];
        yield 'BX' => ['BX', true];
        yield 'BO' => ['BO', true];
        yield 'invalid' => ['invalid', false];
    }
}
