<?php

namespace IX\ScaleManager;

use Slim\Http\Request;

class Collector{

    private $history;

    public function __construct(HistoryInterface $history){
        $this->history = $history;
    }

    public function collect(Request $request): void{
        $payload = $this->getPayload($request);
        $state = new State($payload->instance, $payload->type, $payload->value, $payload->timestamp);
        $this->history->saveEvent($state);
    }

    private function getPayload(Request $request): \stdClass
    {
        return json_decode($request->getBody());
    }

}