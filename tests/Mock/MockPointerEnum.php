<?php
/*
 * Copyright (c) Nate Brunette.
 * Distributed under the MIT License (http://opensource.org/licenses/MIT)
 */

namespace Tebru\Enum\Test\Mock;

use Tebru\Enum\AbstractEnum;

/**
 * Class MockPointerEnum
 *
 * @method static $this UP()
 * @method static $this RIGHT()
 * @method static $this DOWN()
 * @method static $this LEFT()
 * @author Nate Brunette <n@tebru.net>
 */
class MockPointerEnum extends AbstractEnum
{
    const UP = 'up';
    const RIGHT = 'right';
    const DOWN = 'down';
    const LEFT = 'left';

    /**
     * Return an array of enum class constants
     *
     * @return array
     */
    public static function getConstants()
    {
        return [
            self::UP,
            self::RIGHT,
            self::DOWN,
            self::LEFT,
        ];
    }
}
