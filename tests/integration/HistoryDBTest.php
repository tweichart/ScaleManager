<?php
/**
 * Part of the InterNetX ScaleManager Test Suite
 *
 * @copyright  Copyright (C) 2017 InterNetX GmbH. All rights reserved.
 * @license    MIT license; see LICENSE
 */
use IX\ScaleManager\History;
use IX\ScaleManager\Query;
use IX\ScaleManager\State;
use PHPUnit\Framework\TestCase;

/**
 * Class HistoryDBTest
 */
class HistoryDBTest extends TestCase
{
	private $dsn  = 'mysql:host=127.0.0.1:3308;dbname=scalemanager_eventlog';

	private $user = 'root';

	/** @var  PDO */
	private $pdo;

	public function setUp()
	{
		try {
			$this->pdo = new PDO($this->dsn, $this->user);
		}
		catch (\PDOException $e) {
			$this->markTestSkipped('The PDO connection is not available.');
		}

		$this->pdo->query("TRUNCATE `history`");
		$this->pdo->query("INSERT INTO `history`
			(`instance`, `type`, `value`, `timestamp`)
		VALUES
			('reseller/123', 'memory', 1024, 100),
			('reseller/123', 'memory', 1000, 200),
			('reseller/123', 'memory', 1048, 300)
		");
	}

	/**
	 * @testdox saveEvent() adds a record to the history table
	 */
	public function testSaveEvent()
	{
		$history = new History($this->pdo);

		$state = new State('reseller/123', 'memory', 1024, 100);

		$originalCount = $this->getRecordCount('history');
		$result        = $history->saveEvent($state);

		$this->assertTrue($result, 'Saving state failed');

		$this->assertRecordCount('history', $originalCount + 1, 'Number of records is not as expected');
	}

	public function queryDataProvider()
	{
		return [
			'no incidents'                   => [400, 500, false] /**/,
			'no matching incidents'          => [101, 299, false] /* 200:1000 */,
			'only matching incidents'        => [201, 400, true] /* 300:1048 */,
			'both matching and not matching' => [0, 400, false] /* 100:1024, 200:1000, 300:1048 */,
		];
	}

	/**
	 * @dataProvider queryDataProvider
	 */
	public function testQuery(int $timeStart, int $timeEnd, bool $expected)
	{
		$history = new History($this->pdo);

		$query  = new Query('reseller/123', 'memory', '>=', 1024, $timeStart, $timeEnd);
		$result = $history->queryEventLog($query);

		$this->assertEquals($expected, $result);
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
