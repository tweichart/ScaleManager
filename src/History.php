<?php
/**
 * Part of the InterNetX ScaleManager
 *
 * @copyright  Copyright (C) 2017 InterNetX GmbH. All rights reserved.
 * @license    MIT license; see LICENSE
 */

namespace IX\ScaleManager;

/**
 * Class Rule
 */
class History implements HistoryInterface {

    private $connection;

    function __construct(\pdo $connection) {
        $this->connection = $connection;
    }

    /**
     * Save an event to the history storage.
     *
     * @param \IX\ScaleManager\State $state
     * @return bool
     */
    function saveEvent(State $state): bool {

        $query = $this->connection->prepare(
            'INSERT INTO history 
                        (`timestamp`, `type`, `instance`, `value`)
                        VALUES(:timestamp, :type, :instance, :value);'
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
     * @param $query
     * Json that contains the data for the query.
     *
     * @return bool
     * We return true or false wrapped in Json.
     */
    function queryEventLog(string $query): bool {
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return (bool) $stmt->fetchColumn();
    }
}
