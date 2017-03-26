<?php
/**
 * Part of the InterNetX ScaleManager
 *
 * @copyright  Copyright (C) 2017 InterNetX GmbH. All rights reserved.
 * @license    MIT license; see LICENSE
 */

/**
 * Interface ScaleCommandInterface
 */
interface ScaleCommandInterface extends CommandInterface
{
	/**
	 * Get the type of change, i.e., one of 'absolute', 'relative', or 'percentage'
	 *
	 * @return string The type
	 */
	public function getType();

	/**
	 * Get the value
	 *
	 * @return float The value
	 */
	public function getValue();
}
