<?php
/**
 * Part of the InterNetX ScaleManager
 *
 * @copyright  Copyright (C) 2017 InterNetX GmbH. All rights reserved.
 * @license    MIT license; see LICENSE
 */

namespace IX\ScaleManager;

/**
 * Class State
 */
class State
{
	/**
	 * The instance ID
	 *
	 * @var string
	 */
	private $instance;

	/**
	 * The type of the state
	 *
	 * @var string
	 */
	private $type;

	/**
	 * The state value
	 *
	 * @var mixed
	 */
	private $value;

	/**
	 * The timestamp
	 *
	 * @var int
	 */
	private $timeStamp;

	public function __construct(string $instance, string $type, $value, int $timeStamp)
	{
		$this->instance  = $instance;
		$this->type      = $type;
		$this->value     = $value;
		$this->timeStamp = $timeStamp;
	}

	/**
	 * Get the type of the state, e.g., memory, cpu-load, ...
	 *
	 * @return string The type of the state
	 */
	public function getType(): string
	{
		return $this->type;
	}

	/**
	 * Get the state value
	 *
	 * @return mixed The state value
	 */
	public function getValue()
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

	/**
	 * Get the timestamp of the measurement
	 *
	 * @return int The timestamp, number of seconds since 00:00:00 UTC on January 1, 1970
	 */
	public function getTimeStamp(): int
	{
		return $this->timeStamp;
	}
}
