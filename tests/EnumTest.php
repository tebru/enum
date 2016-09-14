<?php
/*
 * Copyright (c) 2015 Nate Brunette.
 * Distributed under the MIT License (http://opensource.org/licenses/MIT)
 */

namespace Tebru\Enum\Test;

use PHPUnit_Framework_TestCase;
use Tebru\Enum\Test\Mock\MockDirectionEnum;

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
        new MockDirectionEnum('foo');
    }

    /**
     * @dataProvider getDirections
     */
    public function testCreateEnum($direction)
    {
        $enum = new MockDirectionEnum($direction);
        $this->assertInstanceOf(MockDirectionEnum::class, $enum);
    }

    /**
     * @dataProvider getDirections
     */
    public function testCreateEnumStaticMethod($direction)
    {
        $enum = MockDirectionEnum::create($direction);
        $this->assertInstanceOf(MockDirectionEnum::class, $enum);
    }

    /**
     * @dataProvider getDirections
     */
    public function testEnumToString($direction)
    {
        $enum = new MockDirectionEnum($direction);
        $this->assertSame($direction, (string)$enum);
    }

    /**
     * @dataProvider getDirections
     */
    public function testEqualsEnum($direction)
    {
        $enum = new MockDirectionEnum($direction);
        $enumCompare = new MockDirectionEnum($direction);
        $this->assertTrue($enum->equals($enumCompare));
    }

    /**
     * @dataProvider getDirections
     */
    public function testEqualsString($direction)
    {
        $enum = new MockDirectionEnum($direction);
        $enumCompare = new MockDirectionEnum($direction);
        $this->assertTrue($enum->equals($enumCompare->getValue()));
    }

    public function testNotEqualsEnum()
    {
        $enum = new MockDirectionEnum('north');
        $enumCompare = new MockDirectionEnum('south');
        $this->assertFalse($enum->equals($enumCompare));
    }

    public function testNotEqualsString()
    {
        $enum = new MockDirectionEnum('north');
        $this->assertFalse($enum->equals(MockDirectionEnum::SOUTH));
    }

    public function testNotStrictlyEqual()
    {
        $enum = new MockDirectionEnum('north');
        $enumCompare = new MockDirectionEnum('north');
        $this->assertFalse($enum === $enumCompare);
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
        $enum = new MockDirectionEnum($direction);
        $this->assertSame($direction, $enum->getValue());
    }

    public function testToArray()
    {
        $this->assertSame(['north' => 'north', 'east' => 'east', 'south' => 'south', 'west' => 'west'], MockDirectionEnum::toArray());
    }

    /**
     * @dataProvider getDirections
     */
    public function testCanIterate($direction)
    {
        $enum = new MockDirectionEnum($direction);
        foreach ($enum as $value) {
            $this->assertTrue($enum->exists($value));
        }
    }

    public function getDirections()
    {
        return [['north'], ['east'], ['south'], ['west']];
    }
}
