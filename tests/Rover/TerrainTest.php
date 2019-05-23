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

    public function testRoverCoordinatesNegative()
    {
        $terrain=new Terain(5,5);
        $result=$terrain->areRoverCoordinatesValid(-1,-1);
        $this->assertFalse($result);
    }
}