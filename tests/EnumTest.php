<?php
/*
 * Copyright (c) 2015 Nate Brunette.
 * Distributed under the MIT License (http://opensource.org/licenses/MIT)
 */

namespace Tebru\Enum\Test;

use PHPUnit_Framework_TestCase;
use Tebru\Enum\Test\Mock\MockDirectionEnumKeyValueDifferent;
use Tebru\Enum\Test\Mock\MockDirectionEnumKeyValueMatch;

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
        new MockDirectionEnumKeyValueMatch('foo');
    }

    /**
     * @dataProvider getDirectionsSame
     */
    public function testCreateEnumSame($direction)
    {
        $enum = new MockDirectionEnumKeyValueMatch($direction);
        $this->assertInstanceOf(MockDirectionEnumKeyValueMatch::class, $enum);
    }

    /**
     * @dataProvider getDirectionsDifferent
     */
    public function testCreateEnumDifferent($name, $direction)
    {
        $enum = new MockDirectionEnumKeyValueDifferent($direction);
        $this->assertInstanceOf(MockDirectionEnumKeyValueDifferent::class, $enum);
    }

    /**
     * @dataProvider getDirectionsSame
     */
    public function testCreateEnumStaticMethodSame($direction)
    {
        $enum = MockDirectionEnumKeyValueMatch::create($direction);
        $this->assertInstanceOf(MockDirectionEnumKeyValueMatch::class, $enum);
    }

    /**
     * @dataProvider getDirectionsDifferent
     */
    public function testCreateEnumStaticMethodDifferent($name, $direction)
    {
        $enum = MockDirectionEnumKeyValueDifferent::create($direction);
        $this->assertInstanceOf(MockDirectionEnumKeyValueDifferent::class, $enum);
    }

    /**
     * @dataProvider getDirectionsSame
     */
    public function testEnumToStringSame($direction)
    {
        $enum = new MockDirectionEnumKeyValueMatch($direction);
        $this->assertSame($direction, (string)$enum);
    }

    /**
     * @dataProvider getDirectionsDifferent
     */
    public function testEnumToStringDifferent($name, $direction)
    {
        $enum = new MockDirectionEnumKeyValueDifferent($direction);
        $this->assertSame($direction, (string)$enum);
    }

    /**
     * @dataProvider getDirectionsSame
     */
    public function testValueExistsSame($direction)
    {
        $enum = new MockDirectionEnumKeyValueMatch($direction);
        $this->assertTrue($enum->valueExists($direction));
    }

    /**
     * @dataProvider getDirectionsDifferent
     */
    public function testValueExistsDifferent($name, $direction)
    {
        $enum = new MockDirectionEnumKeyValueDifferent($direction);
        $this->assertTrue($enum->valueExists($direction));
    }

    /**
     * @dataProvider getDirectionsSame
     */
    public function testNameExistsSame($direction)
    {
        $enum = new MockDirectionEnumKeyValueMatch($direction);
        $this->assertTrue($enum->nameExists($direction));
    }

    /**
     * @dataProvider getDirectionsDifferent
     */
    public function testNameExistsDifferent($name, $direction)
    {
        $enum = new MockDirectionEnumKeyValueDifferent($direction);
        $this->assertTrue($enum->nameExists($name));
    }

    /**
     * @dataProvider getDirectionsSame
     */
    public function testGetValuesSame($direction)
    {
        $this->assertSame(['north', 'east', 'south', 'west'], MockDirectionEnumKeyValueMatch::values());
    }

    /**
     * @dataProvider getDirectionsDifferent
     */
    public function testGetValuesDifferent($name, $direction)
    {
        $this->assertSame(['north', 'east', 'south', 'west'], MockDirectionEnumKeyValueDifferent::values());
    }

    /**
     * @dataProvider getDirectionsSame
     */
    public function testGetNamesSame($direction)
    {
        $this->assertSame(['north', 'east', 'south', 'west'], MockDirectionEnumKeyValueMatch::names());
    }

    /**
     * @dataProvider getDirectionsDifferent
     */
    public function testGetNamesDifferent($name, $direction)
    {
        $this->assertSame(['NORTH', 'EAST', 'SOUTH', 'WEST'], MockDirectionEnumKeyValueDifferent::names());
    }
    /**
     * @dataProvider getDirectionsSame
     */
    public function testGetValueSame($direction)
    {
        $enum = new MockDirectionEnumKeyValueMatch($direction);
        $this->assertSame($direction, $enum->getValue());
    }

    /**
     * @dataProvider getDirectionsDifferent
     */
    public function testGetValueDifferent($name, $direction)
    {
        $enum = new MockDirectionEnumKeyValueDifferent($direction);
        $this->assertSame($direction, $enum->getValue());
    }

    /**
     * @dataProvider getDirectionsSame
     */
    public function testGetNameSame($direction)
    {
        $enum = new MockDirectionEnumKeyValueMatch($direction);
        $this->assertSame($direction, $enum->getName());
    }

    /**
     * @dataProvider getDirectionsDifferent
     */
    public function testGetNameDifferent($name, $direction)
    {
        $enum = new MockDirectionEnumKeyValueDifferent($direction);
        $this->assertSame($name, $enum->getName());
    }

    /**
     * @dataProvider getDirectionsSame
     */
    public function testToArraySame($direction)
    {
        $enum = new MockDirectionEnumKeyValueMatch($direction);
        $this->assertSame(['north' => 'north', 'east' => 'east', 'south' => 'south', 'west' => 'west'], $enum->toArray());
    }

    /**
     * @dataProvider getDirectionsDifferent
     */
    public function testToArrayDifferent($name, $direction)
    {
        $enum = new MockDirectionEnumKeyValueDifferent($direction);
        $this->assertSame(['NORTH' => 'north', 'EAST' => 'east', 'SOUTH' => 'south', 'WEST' => 'west'], $enum->toArray());
    }

    /**
     * @dataProvider getDirectionsSame
     */
    public function testCanIterateSame($direction)
    {
        $enum = new MockDirectionEnumKeyValueMatch($direction);
        foreach ($enum as $key => $value) {
            $this->assertTrue($enum->valueExists($value));
            $this->assertTrue($enum->nameExists($key));
        }
    }

    /**
     * @dataProvider getDirectionsDifferent
     */
    public function testCanIterateDifferent($name, $direction)
    {
        $enum = new MockDirectionEnumKeyValueDifferent($direction);
        foreach ($enum as $key => $value) {
            $this->assertTrue($enum->valueExists($value));
            $this->assertTrue($enum->nameExists($key));
        }
    }

    public function getDirectionsSame()
    {
        return [['north'], ['east'], ['south'], ['west']];
    }

    public function getDirectionsDifferent()
    {
        return [['NORTH', 'north'], ['EAST', 'east'], ['SOUTH', 'south'], ['WEST', 'west']];
    }
}
