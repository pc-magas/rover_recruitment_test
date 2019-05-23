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

    private function roverCheckFalseTest($roverX, $roverY)
    {
        $terrain=new Terain(5,5);
        $result=$terrain->areRoverCoordinatesValid($roverX, $roverY);
        $this->assertFalse($result);
    }

    public function testRoverCoordinatesNegative()
    {
        $this->roverCheckFalseTest(-1,-1);
    }

    public function testRoverCoordinatesSameTerainSize()
    {
        $this->roverCheckFalseTest(5,5);
    }

    public function testRoverCoordinatesOverTerrainSize()
    {
        $this->roverCheckFalseTest(6,6);
    }

    public function testCorrectRoverPosition()
    {
        $terrain=new Terain(5,5);
        $result=$terrain->areRoverCoordinatesValid(1, 2);
        $this->assertTrue($result);
    }
}