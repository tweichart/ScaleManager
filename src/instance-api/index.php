<?php
/**
 * Part of the InterNetX ScaleManager
 *
 * @copyright  Copyright (C) 2017 InterNetX GmbH. All rights reserved.
 * @license    MIT license; see LICENSE
 */

require_once __DIR__ . '../../../vendor/autoload.php';
require_once __DIR__ .'./lib/IsacApiConnector.class.php';
require_once __DIR__ .'./lib/cpuRescale.class.php';
require_once __DIR__ .'./lib/ramRescale.class.php';
require_once __DIR__ .'./lib/storageRescale.class.php';

use Slim\Http\Request;
use Slim\Http\Response;

$app = new Slim\App();

$app->post('/instance', function ($request, $response, $args) {

    $isacConnector = new IsacApiConnector();
    $isacConnector->authenticate();
    $data = $request->getParsedBody();


    $instance = $isacConnector->findInstanceByIP($data['instance']);

    $component = $data['component'];


    $newValue = null;

    switch ($component) {
        case "cpu":
            $cpuResizer = new cpuRescale();
            $newValue = $cpuResizer->calculateValues($instance, $data['type'], $data['value']);
            break;

        case "ram":
            $ramResizer = new ramRescale();
            $newValue = $ramResizer->calculateValues($instance, $data['type'], $data['value']);
            break;

        case "storage":
            $storageResizer = new storageRescale();
            $newValue = $storageResizer->calculateValues($instance, $data['type'], $data['value']);
            break;
        default:
           // $response->setStatus(401);
            return $response->write();
    }

    if ($newValue != null) {
        $resizeResult = $isacConnector->resizeInstance($newValue);

        if (!$resizeResult) {
           // $response->setStatus(400);
            return $response->write("");
        }
        // $response->setStatus(200);
        return $response->write("");


    } else {
        //$response->setStatus(401);
        return $response->write("");
    }

});



$app->run();





