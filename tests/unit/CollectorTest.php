<?php

use IX\ScaleManager\Collector;

class CollectorTest extends \PHPUnit\Framework\TestCase{

    public function testCollector(){
        $collector = new Collector();
        $request = new HttpRequest();
        $collector->collect($request);
        $this->asserTrue(true);
    }

}