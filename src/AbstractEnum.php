<?php
/*
 * Copyright (c) Nate Brunette.
 * Distributed under the MIT License (http://opensource.org/licenses/MIT)
 */

namespace Tebru\Enum;

use BadMethodCallException;
use RuntimeException;

/**v
 * Class AbstractEnum
 *
 * @author Nate Brunette <n@tebru.ent>
 */
abstract class AbstractEnum implements EnumInterface
{
    /**
     * @var string
     */
    private $value;

    /**
     * An array of created instances to ensure singleton
     *
     * @var array
     */
    private static $instances = [];

    /**
     * Constructor
     *
     * @param string $value
     * @throws RuntimeException If the value is not valid
     */
    final private function __construct($value)
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
     * Do a comparison to check if the enum values are equal
     *
     * @param string $value
     * @return bool
     */
    public function equals($value)
    {
        return $this->value === $value;
    }

    /**
     * Create a new instance of the enum
     *
     * @param string $value
     * @return AbstractEnum
     * @throws RuntimeException If the value is not valid
     */
    public static function create($value)
    {
        $class = get_called_class();
        if (isset(self::$instances[$class][$value])) {
            return self::$instances[$class][$value];
        }

        $instance = new static($value);
        self::$instances[$class][$value] = $instance;

        return $instance;
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
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Allow enum instantiation by magic method
     *
     * @param string $name
     * @param $arguments
     * @return static
     * @throws RuntimeException If the value is not valid
     * @throws BadMethodCallException If the constant doesn't exist in the class
     */
    public static function __callStatic($name, $arguments)
    {
        $constant = @constant('static::' . $name);

        if (null === $constant) {
            throw new BadMethodCallException(sprintf('Could not find constant "%s" for class "%s"', $name, static::class));
        }

        return self::create($constant);
    }
}
