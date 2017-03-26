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
	 * @var \pdo
	 */
	private $connection;

	/**
	 * History constructor.
	 *
	 * @param \pdo $connection The database connection
	 */
	public function __construct(\pdo $connection)
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
		$query->bindParam(':timestamp', $state->getTimeStamp());
		$query->bindParam(':type', $state->getType());
		$query->bindParam(':instance', $state->getInstance());
		$query->bindParam(':value', $state->getValue());

		return $query->execute();
	}

	/**
	 * Fire a query against the Event Log and return a bool.
	 * The query is a simple SQL string.
	 *
	 * @param string $query JSON that contains the data for the query.
	 *
	 * @return bool We return true or false wrapped in Json.
	 */
	public function queryEventLog(string $query): bool
	{
		$stmt = $this->connection->prepare($query);
		$stmt->execute();

		return (bool) $stmt->fetchColumn();
	}
}
