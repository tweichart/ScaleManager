<?php
/**
 * Part of the InterNetX ScaleManager
 *
 * @copyright  Copyright (C) 2017 InterNetX GmbH. All rights reserved.
 * @license    MIT license; see LICENSE
 */

/**
 * Class storageRescale
 */
class storageRescale extends rescaleBuilder
{
    /**
     * @param $instance instance object
     * @param $type resize type (abs/rel/percent)
     * @param $diffValue difference value
     * @return mixed instance object with new storage value
     */
    public function calculateValues($instance, $type, $diffValue)
    {
        $storageNew = $this->adjustValue($instance->storage, $type, $diffValue);
        $instance->storage = $storageNew;
        return $instance;
    }
}