<?php
/**
 * Part of the InterNetX ScaleManager
 *
 * @copyright  Copyright (C) 2017 InterNetX GmbH. All rights reserved.
 * @license    MIT license; see LICENSE
 */

namespace IX\ScaleManager;

/**
 * Class Rule
 */
class Rule
{
	/**
	 * The type of the state
	 *
	 * @var  string
	 */
	private $type;

	/**
	 * The state value
	 *
	 * @var mixed
	 */
	private $value;

	/**
	 * The comparision operator - $testValue $this->operator $this->value
	 *
	 * @var string
	 */
	private $operator;

	/**
	 * Minimum duration of the state needed to trigger the rule
	 *
	 * @var int Number of seconds
	 */
	private $duration;

	/**
	 * The command to be issued
	 *
	 * @var CommandInterface
	 */
	private $command;

	/**
	 * Rule constructor.
	 *
	 * @param string           $type     The state type
	 * @param mixed            $value    The state threshold value
	 * @param string           $operator The comparision operator
	 * @param int              $duration The expected duration
	 * @param CommandInterface $command  The command to be issued
	 */
	public function __construct(string $type, $value, string $operator, int $duration, CommandInterface $command)
	{
		$this->type     = $type;
		$this->value    = $value;
		$this->operator = $operator;
		$this->duration = $duration;
		$this->command  = $command;
	}

	/**
	 * Get the state type
	 *
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}

	/**
	 * Get the state value
	 *
	 * @return mixed
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * Get the comparision operator
	 *
	 * @return string
	 */
	public function getOperator(): string
	{
		return $this->operator;
	}

	/**
	 * Get the expected continuance
	 *
	 * @return int
	 */
	public function getDuration(): int
	{
		return $this->duration;
	}

	/**
	 * Get the command
	 *
	 * @return CommandInterface
	 */
	public function getCommand(): CommandInterface
	{
		return $this->command;
	}
}
