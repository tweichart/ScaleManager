<?php
/**
 * Part of the InterNetX ScaleManager
 *
 * @copyright  Copyright (C) 2017 InterNetX GmbH. All rights reserved.
 * @license    MIT license; see LICENSE
 */

namespace IX\ScaleManager;

/**
 * Class History
 */
class History implements HistoryInterface
{
	/**
	 * The database connection
	 *
	 * @var \PDO
	 */
	private $connection;

	/**
	 * History constructor.
	 *
	 * @param \PDO $connection The database connection
	 */
	public function __construct(\PDO $connection)
	{
		$this->connection = $connection;
	}

	/**
	 * Save an event to the history storage.
	 *
	 * @param State $state The state to store
	 *
	 * @return bool
	 */
	public function saveEvent(State $state): bool
	{
		$query     = $this->connection->prepare(
			'INSERT INTO history (`timestamp`, `type`, `instance`, `value`) VALUES(:timestamp, :type, :instance, :value);'
		);

		$timeStamp = $state->getTimeStamp();
		$type      = $state->getType();
		$instance  = $state->getInstance();
		$value     = $state->getValue();

		$query->bindParam(':timestamp', $timeStamp);
		$query->bindParam(':type', $type);
		$query->bindParam(':instance', $instance);
		$query->bindParam(':value', $value);

		return $query->execute();
	}

	/**
	 * Fire a query against the Event Log.
	 *
	 * @param string $instance  The instance ID
	 * @param string $condition A condition
	 * @param int    $timeStart Start of the time range
	 * @param int    $timeEnd   End of the time range
	 *
	 * @return bool True if the condition was always true in the given time range.
	 */
	public function queryEventLog(string $instance, string $condition, int $timeStart, int $timeEnd): bool
	{
		$query = $this->connection->prepare(
			"SELECT COUNT(*) FROM `history` WHERE `instance` = :instance AND `timestamp` BETWEEN :timeStart AND :timeEnd AND NOT `value` :condition"
		);

		$query->bindParam(':instance', $instance);
		$query->bindParam(':timeStart', $timeStart);
		$query->bindParam(':timeEnd', $timeEnd);
		$query->bindParam(':condition', $condition);

		$query->execute();

		return $query->fetchColumn() > 0;
	}
}
