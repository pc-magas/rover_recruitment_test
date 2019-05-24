<?php

namespace Tests\Rover;
use PHPUnit\Framework\TestCase;
use Rover\Constants;
use Rover\Utils;
use Rover\Rover;
use Rover\Terain;

class UtilsTest extends TestCase
{
    public function testRegexCorrectSingle()
    {
        $commands=[Constants::COMMAND_ROT_LEFT,Constants::COMMAND_ROT_RIGHT,Constants::COMMAND_MOVE];
        foreach($commands as $command){
            $result=Utils::verifyCommand($command);
            $this->assertTrue($result);
        }
    }

    public function testRegexIncorrect()
    {
        $invalidCommand="H";
        $result=Utils::verifyCommand($invalidCommand);
        $this->assertFalse($result);
    }

    public function testRegexMultipleCommands()
    {
        $commands=Constants::COMMAND_ROT_LEFT.Constants::COMMAND_ROT_LEFT.Constants::COMMAND_ROT_LEFT.Constants::COMMAND_MOVE.Constants::COMMAND_ROT_RIGHT;
        $result=Utils::verifyCommand($commands);
        $this->assertTrue($result);
    }

    public function moveRover($roverX, $roverY,$orientation, $terrainX, $terrainY, $commands, $expectedX, $expectedY, $expectedOrientation)
    {
        $terrain = new Terain($terainX,$terainY);
        $rover = new Rover($roverX,$roverY,$orientation,$terrain);
        $resultRover=Utils::executeCommands($rover,$commands);

        $this->assertEquals($resultRover->getX(),$expectedX);
        $this->assertEquals($resultRover->getY(),$epxetedY);
        $this->assertEquals($resultRover->getOrientation(),$expectedOrientation);
    }

    //Data Providers
    public function roversToMove(){
        return [
            [1,2,Constants::ORIENTATION_NORTH,5,5,'LMLMLMLMM',1,3,Constants::ORIENTATION_EAST],
            [3,3,Constants::ORIENTATION_EAST,5,5,'MMRMMRMRRM',5,1,Constants::ORIENTATION_EAST]
        ];
    }
}