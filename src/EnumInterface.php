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

    /**
     * Get the current enum value
     *
     * @return string
     */
    public function getValue();

    /**
     * Do a comparison to check if the enum values are equal
     *
     * @param EnumInterface $enum
     * @return bool
     */
    public function equals(EnumInterface $enum);

    /**
     * Return the value as a string
     *
     * @return string
     */
    public function __toString();
}
