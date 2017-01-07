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
        $this->assertSame($direction, $enum->getValue());
    }

    /**
     * @dataProvider getDirections
     */
    public function testCreateEnumStaticMethod($direction)
    {
        $enum = MockDirectionEnum::create($direction);
        $this->assertSame($direction, $enum->getValue());
    }

    public function testCreateEnumMagicMethod()
    {
        $enum = MockDirectionEnum::EAST();
        $this->assertSame(MockDirectionEnum::EAST, $enum->getValue());
    }

    /**
     * @expectedException \BadMethodCallException
     * @expectedExceptionMessage Could not find constant "FOO" for class "Tebru\Enum\Test\Mock\MockDirectionEnum"
     */
    public function testCreateEnumMagicMethodException()
    {
        $this->assertInstanceOf(MockDirectionEnum::class, MockDirectionEnum::FOO());
    }

    /**
     * @dataProvider getDirections
     */
    public function testEnumToString($direction)
    {
        $enum = MockDirectionEnum::create($direction);
        $this->assertSame($direction, (string)$enum);
    }

    /**
     * @dataProvider getDirections
     */
    public function testEqualsEnum($direction)
    {
        $enum = MockDirectionEnum::create($direction);
        $enumCompare = MockDirectionEnum::create($direction);
        $this->assertTrue($enum->equals($enumCompare));
    }

    public function testNotEqualsEnum()
    {
        $enum = MockDirectionEnum::create('north');
        $enumCompare = MockDirectionEnum::create('south');
        $this->assertFalse($enum->equals($enumCompare));
    }

    public function testStrictlyEqual()
    {
        $enum = MockDirectionEnum::create('north');
        $enumCompare = MockDirectionEnum::create('north');
        $this->assertSame($enum, $enumCompare);
    }

    public function testStrictlyEqualCreateAndCallStatic()
    {
        $enum = MockDirectionEnum::create('north');
        $enumCompare = MockDirectionEnum::NORTH();
        $this->assertSame($enum, $enumCompare);
    }

    /**
     * @dataProvider getDirections
     */
    public function testValueExists($direction)
    {
        $this->assertTrue(MockDirectionEnum::exists($direction));
    }

    public function testGetValues()
    {
        $this->assertSame(['north', 'east', 'south', 'west'], MockDirectionEnum::values());
    }

    /**
     * @dataProvider getDirections
     */
    public function testGetValue($direction)
    {
        $enum = MockDirectionEnum::create($direction);
        $this->assertSame($direction, $enum->getValue());
    }

    public function testToArray()
    {
        $this->assertSame(['north' => 'north', 'east' => 'east', 'south' => 'south', 'west' => 'west'], MockDirectionEnum::toArray());
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

        $this->assertSame($north, MockDirectionEnum::NORTH());
        $this->assertSame($east, MockDirectionEnum::EAST());
        $this->assertSame($south, MockDirectionEnum::SOUTH());
        $this->assertSame($west, MockDirectionEnum::WEST());

        $this->assertSame($up, MockPointerEnum::UP());
        $this->assertSame($right, MockPointerEnum::RIGHT());
        $this->assertSame($down, MockPointerEnum::DOWN());
        $this->assertSame($left, MockPointerEnum::LEFT());
    }

    public function getDirections()
    {
        return [['north'], ['east'], ['south'], ['west']];
    }
}
