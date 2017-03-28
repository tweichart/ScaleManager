<?php

/**
 * Part of the InterNetX ScaleManager
 *
 * @copyright  Copyright (C) 2017 InterNetX GmbH. All rights reserved.
 * @license    MIT license; see LICENSE
 */
require_once 'rescaleBuilder.class.php';

/**
 * Class ramRescale
 */
class ramRescale extends rescaleBuilder
{
    /**
     * @param $instance instance object
     * @param $type resize type (abs/rel/percent)
     * @param $diffValue difference value
     * @return mixed instance object with new ram value
     */
    public function calculateValues(stdClass $instance, string $type, int $diffValue)
    {
        $ramNew = $this->adjustValue($instance->ram, $type, $diffValue);
        $instance->ram = $ramNew;
        return $instance;
    }
}