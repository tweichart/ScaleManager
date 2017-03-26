<?php
/**
 * Part of the InterNetX ScaleManager
 *
 * @copyright  Copyright (C) 2017 InterNetX GmbH. All rights reserved.
 * @license    MIT license; see LICENSE
 */

namespace IX\ScaleManager;

/**
 * Interface CommandInterface
 */
interface CommandInterface
{
	/**
	 * Get the instance ID
	 *
	 * @return string The instance ID
	 */
	public function getInstance();
}
