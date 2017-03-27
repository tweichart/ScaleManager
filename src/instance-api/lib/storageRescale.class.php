<?php
/**
 * Part of the InterNetX ScaleManager
 *
 * @copyright  Copyright (C) 2017 InterNetX GmbH. All rights reserved.
 * @license    MIT license; see LICENSE
 */

class storageRescale extends rescaleBuilder
{
    public function calculateValues($instance, $type,$diffValue )
    {
        $storageNew = $this->adjustValue($instance->storage, $type, $diffValue);
        $instance->storage = $storageNew;
    }
}