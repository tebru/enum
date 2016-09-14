<?php
/*
 * Copyright (c) 2015 Nate Brunette.
 * Distributed under the MIT License (http://opensource.org/licenses/MIT)
 */

namespace Tebru\Enum;

use ArrayIterator;
use IteratorAggregate;
use RuntimeException;

/**
 * Class AbstractEnum
 *
 * @author Nate Brunette <n@tebru.ent>
 */
abstract class AbstractEnum implements EnumInterface, IteratorAggregate
{
    /**
     * @var string
     */
    private $value;

    /**
     * Constructor
     *
     * @param string $value
     */
    public function __construct($value)
    {
        if (!static::exists($value)) {
            throw new RuntimeException(sprintf('%s is not a valid value for this enum.', $value));
        }

        $this->value = $value;
    }

    /**
     * Return the value as a string
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->value;
    }

    /**
     * Do a comparison to check if the enums are non-strictly equal
     *
     * @param AbstractEnum $enum
     * @return bool
     */
    public function equals(AbstractEnum $enum)
    {
        return $this == $enum;
    }

    /**
     * Create a new instance of the enum
     *
     * @param string $value
     * @return $this
     */
    public static function create($value)
    {
        return new static($value);
    }

    /**
     * Return true if the value is valid for the enum
     *
     * @param string $value
     * @return bool
     */
    public static function exists($value)
    {
        return in_array($value, static::values(), true);
    }

    /**
     * Get an array of the enum values
     *
     * @return array
     */
    public static function values()
    {
        return array_values(static::getConstants());
    }

    /**
     * Return enum as an array with keys matching values
     *
     * @return array
     */
    public static function toArray()
    {
        return array_combine(self::values(), self::values());
    }

    /**
     * Get the current enum value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Return the values to be used in a loop
     *
     * @return ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator(static::values());
    }
}
