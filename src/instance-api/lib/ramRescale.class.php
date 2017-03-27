<?php

/**
 * Part of the InterNetX ScaleManager
 *
 * @copyright  Copyright (C) 2017 InterNetX GmbH. All rights reserved.
 * @license    MIT license; see LICENSE
 */
require_once 'rescaleBuilder.class.php';


class ramRescale extends rescaleBuilder
{
    public function calculateValues($instance, $type, $diffValue)
    {
        $ramNew = $this->adjustValue($instance->ram, $type, $diffValue);
        $instance->ram = $ramNew;
    }
}