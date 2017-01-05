<?php
/*
 * Copyright (c) Nate Brunette.
 * Distributed under the MIT License (http://opensource.org/licenses/MIT)
 */

namespace Tebru\Enum;

/**
 * Interface EnumInterface
 *
 * @author Nate Brunette <n@tebru.net>
 */
interface EnumInterface
{
    /**
     * Return an array of enum class constants
     *
     * @return array
     */
    public static function getConstants();
}
