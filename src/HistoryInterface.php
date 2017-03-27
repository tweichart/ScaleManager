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
	 * Fire a query against the Event Log.
	 * The query is a simple SQL string.
	 *
	 * @param string $instance  The instance ID
	 * @param string $condition A condition
	 * @param int    $timeStart Start of the time range
	 * @param int    $timeEnd   Start of the time range
	 *
	 * @return bool Success.
	 */
	public function queryEventLog(string $instance, string $condition, int $timeStart, int $timeEnd): bool;
}
