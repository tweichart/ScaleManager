<?php
/**
 * Part of the InterNetX ScaleManager
 *
 * @copyright  Copyright (C) 2017 InterNetX GmbH. All rights reserved.
 * @license    MIT license; see LICENSE
 */

/**
 * Class rescaleBuilder
 */
class rescaleBuilder
{

    /**
     * Adjusts the value
     *
     * @param int $currentValue
     * @param string $type
     * @param $diffValue
     * @return int|null new value
     */
    public function adjustValue(int $currentValue, string $type, $diffValue)
    {
        $newValue = null;

        switch ($type) {
            case "abs":
                $newValue = $diffValue;
                break;

            case "rel":
                $newValue = $currentValue + $diffValue;
                break;

            case "percent":
                $newValue = $currentValue + ($currentValue / 100 * $diffValue);
                break;

            default:
                return null;
        }
        return $newValue;
    }
}