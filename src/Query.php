<?php
/**
 * Part of the InterNetX ScaleManager
 *
 * @copyright  Copyright (C) 2017 InterNetX GmbH. All rights reserved.
 * @license    MIT license; see LICENSE
 */

namespace IX\ScaleManager;

/**
 * Class Query
 */
class Query
{
	/**
	 * The instance ID
	 *
	 * @var string
	 */
	private $instance;

	/**
	 * The metric type
	 *
	 * @var string
	 */
	private $type;

	/**
	 * The comparision operator
	 *
	 * @var string
	 */
	private $operator;

	/**
	 * The meric value
	 *
	 * @var string
	 */
	private $value;

	/**
	 * Start of the time period
	 *
	 * @var int
	 */
	private $timeStart;

	/**
	 * End of the time period
	 *
	 * @var int
	 */
	private $timeEnd;

	public function __construct(string $instance, string $type, string $operator, $value, int $timeStart, int $timeEnd)
	{
		$this->instance  = $instance;
		$this->type      = $type;
		$this->operator  = $operator;
		$this->value     = $value;
		$this->timeStart = $timeStart;
		$this->timeEnd   = $timeEnd;
	}

	/**
	 * @return string
	 */
	public function getInstance(): string
	{
		return $this->instance;
	}

	/**
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}

	/**
	 * @return string
	 */
	public function getOperator(): string
	{
		return $this->operator;
	}

	/**
	 * @return string
	 */
	public function getValue(): string
	{
		return $this->value;
	}

	/**
	 * @return int
	 */
	public function getTimeStart(): int
	{
		return $this->timeStart;
	}

	/**
	 * @return int
	 */
	public function getTimeEnd(): int
	{
		return $this->timeEnd;
	}
}
