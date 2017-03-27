<?php
/**
 * Part of the InterNetX ScaleManager
 *
 * @copyright  Copyright (C) 2017 InterNetX GmbH. All rights reserved.
 * @license    MIT license; see LICENSE
 */

require_once 'rescaleBuilder.class.php';

class cpuRescale extends rescaleBuilder
        {
    public function calculateValues($instance, $type, $diffValue)
    {
        $cpuNew = $this->adjustValue($instance->cpu, $type, $diffValue);
        $instance->cpu = $cpuNew;
        return $instance;
    }
}