<?php

namespace Tests\Rover;

use PHPUnit\Framework\TestCase;
use Rover\Constants;
use Rover\Rover;

use Rover\Exceptions\InvalidCommandException;
use Rover\Exceptions\TooManyCommandsException;


class RoverTest extends TestCase
{
    public function testGetters()
    {
        $rover=new Rover(1, 2, Constants::ORIENTATION_WEST);
        $this->assertSame($rover->getX(),1);
        $this->assertSame($rover->getY(),2);
        $this->assertSame($rover->getOrientation(),Constants::ORIENTATION_WEST);
    }

    public function testInvalidCommand()
    {
        $command="H";
        $rover=new Rover(1,2,Constants::ORIENTATION_NORTH);
        $this->expectException(InvalidCommandException::class);
        $rover->processCommand($command);
    }

    public function testInvalidMultiCommandExceptionThrow()
    {
        $command="HRMHV";
        $rover=new Rover(1,2,Constants::ORIENTATION_NORTH);
        $this->expectException(TooManyCommandsException::class);
        $rover->processCommand($command);
    }

    public function testValidMultiCommandExceptionThrow()
    {
        $commands=[Constants::COMMAND_ROT_LEFT,
            Constants::COMMAND_MOVE,
            Constants::COMMAND_MOVE,
            Constants::COMMAND_ROT_RIGHT
        ];
        $rover=new Rover(1,2,Constants::ORIENTATION_NORTH);
        $this->expectException(TooManyCommandsException::class);
        $rover->processCommand(implode('',$commands));
    }

    /**
     * @param Int $x The initial x coordinate of the rover
     * @param Int $y The initial y coordinate of he rover
     * @param String $orientation The initial rover orientation
     * @param String $rotationCommand The command for the rover to rotate
     */
    private function rotationTest($x, $y, $orientation, $rotationCommand)
    {
        $expectedResult = Constants::ROTATIONS[$rotationCommand][$orientation];
        $rover = new Rover($x,$y,$orientation);
        $rover->processCommand($rotationCommand);
  
        $this->assertSame($rover->getOrientation(),$expectedResult);
    }

    /**
     * @dataProvider roverProvider
     */
    public function testRotationLeft($x,$y,$orientation)
    {
      $this->rotationTest($x,$y,$orientation,Constants::COMMAND_ROT_LEFT);
    }

    /**
     * @dataProvider roverProvider
     */
    public function testRotationRight($x,$y,$orientation)
    {
        $this->rotationTest($x,$y,$orientation,Constants::COMMAND_ROT_RIGHT);
    }

    /**
     * @dataProvider roverMoveProvider
     */
    public function testMove($x, $y, $orientation, $expectedX, $expectedY)
    {
        $rover = new Rover($x, $y, $orientation);
        $rover->processCommand(Constants::COMMAND_MOVE);
        $this->assertSame($rover->getX(),$expectedX,'X coordinates does not match');
        $this->assertSame($rover->getY(),$expectedY,'Y coordinates does not match');
        // Orientations must not be changed
        $this->assertSame($rover->getOrientation(),$orientation,'Orientation is not the same');
    }

    public function roverProvider()
    {
        return [
            'orientation North' => [1, 2, Constants::ORIENTATION_NORTH],
            'orientation South' => [1, 2, Constants::ORIENTATION_SOUTH],
            'orientation East'  => [1, 2, Constants::ORIENTATION_EAST],
            'orientation West'  => [1, 2, Constants::ORIENTATION_WEST]
        ];
    }

    public function roverMoveProvider()
    {
        return [
            'orientation North' => [1, 2, Constants::ORIENTATION_NORTH, 1, 3],
            'orientation South' => [1, 2, Constants::ORIENTATION_SOUTH, 1, 1],
            'orientation East'  => [1, 2, Constants::ORIENTATION_EAST , 0, 2],
            'orientation West'  => [1, 2, Constants::ORIENTATION_WEST , 2, 2]
        ];
    }
}