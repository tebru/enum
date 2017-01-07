<?php
/*
 * Copyright (c) Nate Brunette.
 * Distributed under the MIT License (http://opensource.org/licenses/MIT)
 */

namespace Tebru\Enum\Test;

use PHPUnit_Framework_TestCase;
use Tebru\Enum\Test\Mock\MockDirectionEnum;
use Tebru\Enum\Test\Mock\MockPointerEnum;

/**
 * Class EnumTest
 *
 * @author Nate Brunette <n@tebru.net>
 */
class EnumTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \RuntimeException
     */
    public function testConstructorWillThrowException()
    {
        MockDirectionEnum::create('foo');
    }

    /**
     * @dataProvider getDirections
     */
    public function testCreateEnum($direction)
    {
        $enum = MockDirectionEnum::create($direction);
        self::assertSame($direction, $enum->getValue());
    }

    /**
     * @dataProvider getDirections
     */
    public function testCreateEnumStaticMethod($direction)
    {
        $enum = MockDirectionEnum::create($direction);
        self::assertSame($direction, $enum->getValue());
    }

    public function testCreateEnumMagicMethod()
    {
        $enum = MockDirectionEnum::EAST();
        self::assertSame(MockDirectionEnum::EAST, $enum->getValue());
    }

    /**
     * @expectedException \BadMethodCallException
     * @expectedExceptionMessage Could not find constant "FOO" for class "Tebru\Enum\Test\Mock\MockDirectionEnum"
     */
    public function testCreateEnumMagicMethodException()
    {
        self::assertInstanceOf(MockDirectionEnum::class, MockDirectionEnum::FOO());
    }

    /**
     * @dataProvider getDirections
     */
    public function testEnumToString($direction)
    {
        $enum = MockDirectionEnum::create($direction);
        self::assertSame($direction, (string)$enum);
    }

    /**
     * @dataProvider getDirections
     */
    public function testEqualsEnum($direction)
    {
        $enum = MockDirectionEnum::create($direction);
        $enumCompare = MockDirectionEnum::create($direction);
        self::assertTrue($enum->equals($enumCompare));
    }

    public function testNotEqualsEnum()
    {
        $enum = MockDirectionEnum::create('north');
        $enumCompare = MockDirectionEnum::create('south');
        self::assertFalse($enum->equals($enumCompare));
    }

    public function testStrictlyEqual()
    {
        $enum = MockDirectionEnum::create('north');
        $enumCompare = MockDirectionEnum::create('north');
        self::assertSame($enum, $enumCompare);
    }

    public function testStrictlyEqualCreateAndCallStatic()
    {
        $enum = MockDirectionEnum::create('north');
        $enumCompare = MockDirectionEnum::NORTH();
        self::assertSame($enum, $enumCompare);
    }

    /**
     * @dataProvider getDirections
     */
    public function testValueExists($direction)
    {
        self::assertTrue(MockDirectionEnum::exists($direction));
    }

    public function testGetValues()
    {
        self::assertSame(['north', 'east', 'south', 'west'], MockDirectionEnum::values());
    }

    /**
     * @dataProvider getDirections
     */
    public function testGetValue($direction)
    {
        $enum = MockDirectionEnum::create($direction);
        self::assertSame($direction, $enum->getValue());
    }

    public function testToArray()
    {
        self::assertSame(['north' => 'north', 'east' => 'east', 'south' => 'south', 'west' => 'west'], MockDirectionEnum::toArray());
    }

    public function testMultipleEnumSingleton()
    {
        $north = MockDirectionEnum::NORTH();
        $east = MockDirectionEnum::EAST();
        $south = MockDirectionEnum::SOUTH();
        $west = MockDirectionEnum::WEST();

        $up = MockPointerEnum::UP();
        $right = MockPointerEnum::RIGHT();
        $down = MockPointerEnum::DOWN();
        $left = MockPointerEnum::LEFT();

        self::assertSame($north, MockDirectionEnum::NORTH());
        self::assertSame($east, MockDirectionEnum::EAST());
        self::assertSame($south, MockDirectionEnum::SOUTH());
        self::assertSame($west, MockDirectionEnum::WEST());

        self::assertSame($up, MockPointerEnum::UP());
        self::assertSame($right, MockPointerEnum::RIGHT());
        self::assertSame($down, MockPointerEnum::DOWN());
        self::assertSame($left, MockPointerEnum::LEFT());
    }

    public function getDirections()
    {
        return [['north'], ['east'], ['south'], ['west']];
    }
}
