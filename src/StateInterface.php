<?php
/**
 * Part of the InterNetX ScaleManager
 *
 * @copyright  Copyright (C) 2017 InterNetX GmbH. All rights reserved.
 * @license    MIT license; see LICENSE
 */

namespace IX\ScaleManager;

/**
 * Interface StateInterface
 */
interface StateInterface
{
	/**
	 * Get the type of the state, e.g., memory, cpu-load, ...
	 *
	 * @return string The type of the state
	 */
	public function getType();

	/**
	 * Get the state value
	 *
	 * @return mixed The state value
	 */
	public function getValue();

	/**
	 * Get the instance ID
	 *
	 * @return string The instance ID
	 */
	public function getInstance();

	/**
	 * Get the timestamp of the measurement
	 *
	 * @return int The timestamp, number of seconds since 00:00:00 UTC on January 1, 1970
	 */
	public function getTimeStamp();
}
