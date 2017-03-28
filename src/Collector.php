<?php
/**
 * Part of the InterNetX ScaleManager
 *
 * @copyright  Copyright (C) 2017 InterNetX GmbH. All rights reserved.
 * @license    MIT license; see LICENSE
 */

namespace IX\ScaleManager;

use Slim\Http\Request;

/**
 * Class Collector
 *
 * @package IX\ScaleManager
 */
class Collector
{
	/**
	 * The history manager
	 *
	 * @var HistoryInterface
	 */
	private $history;

	/**
	 * Collector constructor.
	 *
	 * @param HistoryInterface $history The history manager
	 */
	public function __construct(HistoryInterface $history)
	{
		$this->history = $history;
	}

	/**
	 * Collect a State
	 *
	 * @param Request $request The request containing the state information
	 *
	 * @return void
	 */
	public function collect(Request $request)
	{
		$payload = $this->getPayload($request);
		$state   = new State($payload->instance, $payload->type, $payload->value, $payload->timestamp);
		$this->history->saveEvent($state);
	}

	/**
	 * Get the payload from the request
	 *
	 * @param Request $request The request containing the state information
	 *
	 * @return \stdClass
	 */
	private function getPayload(Request $request): \stdClass
	{
		return json_decode($request->getBody());
	}
}
