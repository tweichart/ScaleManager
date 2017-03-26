<?php
/**
 * Part of the InterNetX ScaleManager
 *
 * @copyright  Copyright (C) 2017 InterNetX GmbH. All rights reserved.
 * @license    MIT license; see LICENSE
 */

namespace IX\ScaleManager;

/**
 * Class ScaleCommand
 */
abstract class ScaleCommand implements ScaleCommandInterface
{
	/**
	 * The given value is absolute
	 */
	const ABSOLUTE = 'absolute';

	/**
	 * The given value is relative
	 */
	const RELATIVE = 'relative';

	/**
	 * The given value is a percentage of the current value
	 */
	const PERCENTAGE = 'percent';

	/**
	 * The instance ID
	 *
	 * @var string
	 */
	private $instance;

	/**
	 * The change value
	 *
	 * @var float
	 */
	private $value;

	/**
	 * The type of value, one of the ScaleCommand constants
	 *
	 * @var string
	 */
	private $type;

	/**
	 * ScaleCommand constructor.
	 *
	 * @param string $instance The instance ID
	 * @param float  $value    The change value
	 * @param string $type     The type of value, one of the ScaleCommand constants
	 */
	public function __construct(string $instance, float $value, string $type = self::ABSOLUTE)
	{
		$this->instance = $instance;
		$this->type     = $type;
		$this->value    = $value;
	}

	/**
	 * Get the type of change, i.e., one of the ScaleCommand constants
	 *
	 * @return string The type
	 */
	public function getType(): string
	{
		return $this->type;
	}

	/**
	 * Get the value
	 *
	 * @return float The value
	 */
	public function getValue(): float
	{
		return $this->value;
	}

	/**
	 * Get the instance ID
	 *
	 * @return string The instance ID
	 */
	public function getInstance(): string
	{
		return $this->instance;
	}
}
