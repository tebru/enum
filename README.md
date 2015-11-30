[![Build Status](https://travis-ci.org/tebru/enum.svg)](https://travis-ci.org/tebru/enum)
[![Coverage Status](https://coveralls.io/repos/tebru/enum/badge.svg?branch=master&service=github)](https://coveralls.io/github/tebru/enum?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/tebru/enum/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/tebru/enum/?branch=master)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/6d6111c3-d668-4c3a-9620-02ad504b23a4/mini.png)](https://insight.sensiolabs.com/projects/6d6111c3-d668-4c3a-9620-02ad504b23a4)

Enum
====

A simple PHP library to add support for enums.  This requires more work than myclabs/php-enum, but does not require reflection.

Installation
------------

    composer require tebru/enum

Usage
-----

To use, extend `AbstractEnum` and implement the getConstants() method.

    class DirectionEnum extends AbstractEnum
    {
        const NORTH = 'north';
        const EAST = 'east';
        const SOUTH = 'south';
        const WEST = 'west';

        /**
         * Return an array of enum class constants
         *
         * @return array
         */
        public static function getConstants()
        {
            return [
                'NORTH' => self::NORTH,
                'EAST' => self::EAST,
                'SOUTH' => self::SOUTH,
                'WEST' => self::WEST,
            ];
        }
    }

Now you can create a new instance normally or using the static method.

    new DirectionEnum('north');
    DirectionEnum::create('north');

You can also iterate over the enum

    $enum = new DirectionEnum('north');
    foreach ($enum as $key => $value) {}

Reference
---------

There are multiple methods available on each enum

* `values()` [static] A 0-indexed array of all of the enum values
* `names()` [static] A 0-indexed array of all of the enum names
* `valueExists($value)` [static] Returns true if the value exists
* `nameExists($name)` [static] Returns true if the name exists
* `getValue()` Returns the current value of the enum
* `getName()` Returns the current name of the enum
* `toArray()` Same as the `getConstants()` method you implement
* `__toString()` Same as `getValue()`