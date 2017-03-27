<?php
/**
 * Part of the InterNetX ScaleManager
 *
 * @copyright  Copyright (C) 2017 InterNetX GmbH. All rights reserved.
 * @license    MIT license; see LICENSE
 */

namespace IX\ScaleManager;

/**
 * Interface ScaleCommandInterface
 */
interface ScaleCommandInterface extends CommandInterface
{
	/**
	 * Get the type of change, i.e., one of the ScaleCommand constants
	 *
	 * @return string The type
	 */
	public function getType(): string;

	/**
	 * Get the value
	 *
	 * @return float The value
	 */
	public function getValue(): float;
}
