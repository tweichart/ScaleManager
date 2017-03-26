<?php

use IX\ScaleManager\Collector;
use IX\ScaleManager\History;
use Slim\Http\Request;

class CollectorTest extends \PHPUnit\Framework\TestCase{

    public function testCollect(){
        $history = $this->createMock(History::class);
        $history
            ->expects($this->once())
            ->method('saveEvent');
        $collector = new Collector($history);
        $request = $this->createMock(Request::class);
        $request
            ->expects($this->any())
            ->method('getBody')
            ->willReturn(json_encode([
                'instance' => 'reseller/123',
                'type' => 'memory',
                'value' => '20',
                'timestamp' => '123123123'
        ]));
        $collector->collect($request);
    }

}