<?php
/**
 * Part of the InterNetX ScaleManager Test Suite
 *
 * @copyright  Copyright (C) 2017 InterNetX GmbH. All rights reserved.
 * @license    MIT license; see LICENSE
 */
use IX\ScaleManager\History;
use IX\ScaleManager\State;
use PHPUnit\Framework\TestCase;

/**
 * Class HistoryDBTest
 */
class HistoryDBTest extends TestCase
{
	private static $dsn = 'mysql:host=127.0.0.1:3308;dbname=scalemanager_eventlog';

	private static $user = 'root';

	/** @var  PDO */
	private $pdo;

	static public function setUpBeforeClass()
	{
		// Set up database
		try {
			$pdo = new PDO(self::$dsn, self::$user);
		}
		catch (\Exception $e) {
		}
	}

	static public function tearDownAfterClass()
	{
		// Tear down database
	}

	public function setUp()
	{
		try {
			$this->pdo = new PDO(self::$dsn, self::$user);
		}
		catch (\Exception $e) {
			$this->markTestSkipped('The PDO connection is not available.');
		}
	}

	public function testSaveEvent()
	{
		$history = new History($this->pdo);

		$state = new State('reseller/123', 'memory', 1024, time());

		$originalCount = $this->getRecordCount('history');
		$result = $history->saveEvent($state);

		$this->assertTrue($result, 'Saving state failed');
		$this->assertRecordCount('history', $originalCount + 1, 'Number of records is not as expected');
	}

	protected function getRecordCount(string $table): int
	{
		$result = $this->pdo->query("SELECT COUNT(*) FROM `$table`");
		return $result->fetchColumn(0);
	}

	protected function assertRecordCount(string $table, int $count, $messsage = '')
	{
		$this->assertEquals($count, $this->getRecordCount($table), $messsage);
	}
}
