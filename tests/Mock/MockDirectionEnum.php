<?php
/*
 * Copyright (c) 2015 Nate Brunette.
 * Distributed under the MIT License (http://opensource.org/licenses/MIT)
 */

namespace Tebru\Enum\Test\Mock;

use Tebru\Enum\AbstractEnum;

/**
 * Class MockEnum
 *
 * @method static $this NORTH()
 * @method static $this EAST()
 * @method static $this SOUTH()
 * @method static $this WEST()
 * @author Nate Brunette <n@tebru.net>
 */
class MockDirectionEnum extends AbstractEnum
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
            self::NORTH,
            self::EAST,
            self::SOUTH,
            self::WEST,
        ];
    }
}
