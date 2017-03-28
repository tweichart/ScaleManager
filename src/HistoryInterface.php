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
	 * Ask the Event Log, if a condition persisted for a given time range
	 *
	 * @param Query $query The Query
	 *
	 * @return bool True if the condition was always true in the given time range.
	 */
	public function queryEventLog(Query $query): bool;
}
