<?php

declare(strict_types=1);

namespace App\Tests\Validator;

use kollex\Validator\CompositeValidator;
use kollex\Validator\Validator;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;

class CompositeValidatorTest extends TestCase
{
    private const SOME_FIELD = 'some_field';
    private const WRONG_VALUE = 'wrong value';
    private const ARRAY_VALUE = [self::SOME_FIELD => 'some value'];

    /** @var Validator|ObjectProphecy */
    private $someValidator;

    /** @var Validator|ObjectProphecy */
    private $anotherValidator;

    private CompositeValidator $validator;

    protected function setUp(): void
    {
        $this->someValidator = $this->prophesize(Validator::class);
        $this->anotherValidator = $this->prophesize(Validator::class);
        $this->validator = new CompositeValidator([$this->someValidator->reveal(), $this->anotherValidator->reveal()]);
    }

    public function testValidWrongValue(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->someValidator->valid(Argument::any())
            ->shouldNotBeCalled();
        $this->anotherValidator->valid(Argument::any())
            ->shouldNotBeCalled();

        $this->validator->valid(self::WRONG_VALUE);
    }

    public function testValidFirstInvalid(): void
    {
        $this->someValidator->field()
            ->willReturn(null)
            ->shouldBeCalled();
        $this->someValidator->valid(self::ARRAY_VALUE)
            ->shouldBeCalled()
            ->willReturn(false);
        $this->anotherValidator->valid(Argument::any())
            ->shouldNotBeCalled();

        self::assertFalse($this->validator->valid(self::ARRAY_VALUE));
    }

    public function testValidSecondInvalid(): void
    {
        $this->someValidator->field()
            ->willReturn(null)
            ->shouldBeCalled();
        $this->someValidator->valid(self::ARRAY_VALUE)
            ->shouldBeCalled()
            ->willReturn(true);
        $this->anotherValidator->field()
            ->willReturn(self::SOME_FIELD)
            ->shouldBeCalled();
        $this->anotherValidator->valid(self::ARRAY_VALUE[self::SOME_FIELD])
            ->shouldBeCalled()
            ->willReturn(false);

        self::assertFalse($this->validator->valid(self::ARRAY_VALUE));
    }


    public function testValid(): void
    {
        $this->someValidator->field()
            ->willReturn(null)
            ->shouldBeCalled();
        $this->someValidator->valid(self::ARRAY_VALUE)
            ->shouldBeCalled()
            ->willReturn(true);
        $this->anotherValidator->field()
            ->willReturn(self::SOME_FIELD)
            ->shouldBeCalled();
        $this->anotherValidator->valid(self::ARRAY_VALUE[self::SOME_FIELD])
            ->shouldBeCalled()
            ->willReturn(true);

        self::assertTrue($this->validator->valid(self::ARRAY_VALUE));
    }

    public function testField(): void
    {
        self::assertNull($this->validator->field());
    }
}
