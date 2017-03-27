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
		$query = $this->connection->prepare(
			'INSERT INTO history (`timestamp`, `type`, `instance`, `value`) VALUES(:timestamp, :type, :instance, :value);'
		);

		$instance  = $state->getInstance();
		$type      = $state->getType();
		$value     = $state->getValue();
		$timeStamp = $state->getTimeStamp();

		$query->bindParam(':instance', $instance);
		$query->bindParam(':type', $type);
		$query->bindParam(':value', $value);
		$query->bindParam(':timestamp', $timeStamp);

		return $query->execute();
	}

	/**
	 * Ask the Event Log, if a condition persisted for a given time range
	 *
	 * @param Query $query The Query
	 *
	 * @return bool True if the condition was always true in the given time range.
	 * @throws \Exception
	 */
	public function queryEventLog(Query $query): bool
	{
		$instance  = $query->getInstance();
		$type      = $query->getType();
		$operator  = $query->getOperator();
		$value     = $query->getValue();
		$timeStart = $query->getTimeStart();
		$timeEnd   = $query->getTimeEnd();

		$query = $this->connection->prepare(
			"SELECT AVG(`value`) AS `average`, SUM(`match`) AS `match`, SUM(`nomatch`) AS `nomatch`
			FROM (
				SELECT
					`value`,
					CASE WHEN `value` $operator :value THEN 1 ELSE 0 END AS `match`,
					CASE WHEN `value` $operator :value THEN 0 ELSE 1 END AS `nomatch`
					FROM `history`
					WHERE `instance` = :instance
					AND `type` = :type
					AND `timestamp` BETWEEN :timeStart AND :timeEnd
			) AS `match_table`"
		);

		$query->bindParam(':instance', $instance);
		$query->bindParam(':type', $type);
		$query->bindParam(':value', $value);
		$query->bindParam(':timeStart', $timeStart);
		$query->bindParam(':timeEnd', $timeEnd);

		$query->execute();

		$result = $query->fetchObject();

		if (!is_object($result)) {
			$error = $query->errorInfo();
			throw new \Exception(print_r($error[2], true));
		}

		return $result->match > 0 && $result->nomatch == 0;
	}
}
