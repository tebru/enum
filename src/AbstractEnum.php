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
 * @author Nate Brunette <nbrunett@nerdery.com>
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
        if (!static::valueExists($value)) {
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
        return (string)$this->value;
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
    public static function valueExists($value)
    {
        return in_array($value, static::values());
    }

    /**
     * Return true if the name is valid for the enum
     *
     * @param string $name
     * @return bool
     */
    public static function nameExists($name)
    {
        return in_array($name, static::names());
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
     * Get an array of the enum keys
     *
     * @return array
     */
    public static function names()
    {
        return array_keys(static::getConstants());
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
     * Get the current enum name
     *
     * @return string
     */
    public function getName()
    {
        return array_search($this->getValue(), static::getConstants());
    }

    /**
     * Return enum as an array
     *
     * @return array
     */
    public function toArray()
    {
        return static::getConstants();
    }

    /**
     * Return the values to be used in a loop
     *
     * @return array
     */
    public function getIterator()
    {
        return new ArrayIterator(static::getConstants());
    }
}
