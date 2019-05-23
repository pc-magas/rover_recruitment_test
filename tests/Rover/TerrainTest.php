<?php

namespace Tests\Rover;
use PHPUnit\Framework\TestCase;
use Rover\Terain;

class TerrainTest extends TestCase
{
    public function testInvalidParamsNegative()
    {
        $this->expectException(\InvalidArgumentException::class);
        $terrain= new Terain(-1,-1);
    }

}