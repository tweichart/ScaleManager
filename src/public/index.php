<?php

use IX\ScaleManager\Collector;
use IX\ScaleManager\History;
use Slim\Http\Request;
use Slim\Http\Response;

require_once '../../vendor/autoload.php';

$app = new \Slim\App();

$app->post('/state', function (Request $request, Response $response) {
    $response = $response->withStatus(202);
    $pdo = new PDO('mysql:host=scalemanager-eventlog-db;dbname=scalemanager_eventlog', 'scalemanager_eventlog', 'scalemanager_eventlog');
    $collector = new Collector(new History($pdo));
    $collector->collect($request);
    return $response;
});
$app->run();