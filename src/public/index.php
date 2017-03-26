<?php

use IX\ScaleManager\Collector;
use IX\ScaleManager\History;
use Slim\Http\Request;
use Slim\Http\Response;

require_once 'vendor/autoload.php';

$app = new \Slim\App();

$app->post('/state', function (Request $request, Response $response) {
    $response = $response->withStatus(202);
    #$collector = new Collector(new History());
    #$collector->collect($request);
    return $response;
});
$app->run();