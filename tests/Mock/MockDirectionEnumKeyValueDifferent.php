<?php
/*
 * Copyright (c) 2015 Nate Brunette.
 * Distributed under the MIT License (http://opensource.org/licenses/MIT)
 */

namespace Tebru\Enum\Test\Mock;

use Tebru\Enum\AbstractEnum;

/**
 * Class MockDirectionEnumKeyValueDifferent
 *
 *
 * @author Nate Brunette <n@tebru.net>
 */
class MockDirectionEnumKeyValueDifferent extends AbstractEnum
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
