<?php
/**
 * Part of the InterNetX ScaleManager Test Suite
 *
 * @copyright  Copyright (C) 2017 InterNetX GmbH. All rights reserved.
 * @license    MIT license; see LICENSE
 */

use IX\ScaleManager\Collector;
use IX\ScaleManager\HistoryInterface;
use Slim\Http\Request;

/**
 * Class CollectorTest
 */
class CollectorTest extends \PHPUnit\Framework\TestCase
{
	/**
	 * @testdox Collect::collect() forwards the State to the History manager
	 */
	public function testCollect()
	{
		$history = $this->createMock(HistoryInterface::class);
		$history
			->expects($this->once())
			->method('saveEvent')
		;
		$collector = new Collector($history);
		$request   = $this->createMock(Request::class);
		$request
			->expects($this->any())
			->method('getBody')
			->willReturn(json_encode([
										 'instance'  => 'reseller/123',
										 'type'      => 'memory',
										 'value'     => '20',
										 'timestamp' => '123123123',
									 ]))
		;
		$collector->collect($request);
	}
}
