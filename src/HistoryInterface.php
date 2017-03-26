<?php
/**
 * Part of the InterNetX ScaleManager
 *
 * @copyright  Copyright (C) 2017 InterNetX GmbH. All rights reserved.
 * @license    MIT license; see LICENSE
 */

namespace IX\ScaleManager;

/**
 * Interface HistoryInterface
 */
interface HistoryInterface
{

	/**
	 * Save an event to the history storage.
	 *
	 * @param State $state The state we want to store.
	 *
	 * @return bool
	 */
	public function saveEvent(State $state): bool;

	/**
	 * Fire a query against the Event Log and return a bool.
	 * The query is a simple SQL string.
	 *
	 * @param string $query JSON that contains the data for the query.
	 *
	 * @return bool True or false wrapped in JSON.
	 */
	public function queryEventLog(string $query): bool;
}
