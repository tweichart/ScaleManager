<?php
/**
 * Part of the InterNetX ScaleManager
 *
 * @copyright  Copyright (C) 2017 InterNetX GmbH. All rights reserved.
 * @license    MIT license; see LICENSE
 */

require_once 'rescaleBuilder.class.php';

/**
 * Class cpuRescale
 */
class cpuRescale extends rescaleBuilder
{
    /**
     * @param $instance instance object
     * @param $type resize type (abs/rel/percent)
     * @param $diffValue difference value
     * @return mixed instance object with new cpu value
     */
    public function calculateValues($instance, $type, $diffValue)
    {
        $cpuNew = $this->adjustValue($instance->cpu, $type, $diffValue);
        $instance->cpu = $cpuNew;
        return $instance;
    }
}