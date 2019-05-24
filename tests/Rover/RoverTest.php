<?php

namespace Tests\Rover;

use PHPUnit\Framework\TestCase;
use Rover\Constants;
use Rover\Rover;
use Rover\Terain as Terrain;

use Rover\Exceptions\InvalidCommandException;
use Rover\Exceptions\TooManyCommandsException;


class RoverTest extends TestCase
{
    /**
     * @dataProvider misfitRoversInTerrain
     */
    public function testTerrainInvalid($roverX, $roverY, $terainX, $terainY)
    {
        $terrain= new Terrain($terainX, $terainY);
        $this->expectException(\InvalidArgumentException::class);
        $rover=new Rover($roverX, $roverY, 'N', $terrain);
    }

    public function testGettersValid()
    {
        $rover=new Rover(1, 2, Constants::ORIENTATION_WEST,new Terrain(5,5));
        $this->assertSame($rover->getX(),1);
        $this->assertSame($rover->getY(),2);
        $this->assertSame($rover->getOrientation(),Constants::ORIENTATION_WEST);
    }

    public function testInvalidCommand()
    {
        $command="H";
        $rover=new Rover(1,2,Constants::ORIENTATION_NORTH,new Terrain(5,5));
        $this->expectException(InvalidCommandException::class);
        $rover->processCommand($command);
    }

    public function testInvalidMultiCommandExceptionThrow()
    {
        $command="HRMHV";
        $rover=new Rover(1,2,Constants::ORIENTATION_NORTH,new Terrain(5,5));
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
        $rover=new Rover(1,2,Constants::ORIENTATION_NORTH,new Terrain(5,5));
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
        $rover = new Rover($x,$y,$orientation,new Terrain(5,5));
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
    public function testMove($x, $y, $orientation, $expectedX, $expectedY, $terrainWidth, $terrainHeight)
    {
        $rover = new Rover($x, $y, $orientation, new Terrain($terrainWidth,$terrainHeight));
        $rover->processCommand(Constants::COMMAND_MOVE);
        $this->assertSame($rover->getX(),$expectedX,'X coordinates does not match');
        $this->assertSame($rover->getY(),$expectedY,'Y coordinates does not match');
        // Orientations must not be changed
        $this->assertSame($rover->getOrientation(),$orientation,'Orientation is not the same');
    }

    // Data Providers
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
            'orientation North' => [1, 2, Constants::ORIENTATION_NORTH, 1, 3, 5, 5],
            'orientation South' => [1, 2, Constants::ORIENTATION_SOUTH, 1, 1, 5, 5],
            'orientation East'  => [1, 2, Constants::ORIENTATION_EAST , 0, 2, 5, 5],
            'orientation West'  => [1, 2, Constants::ORIENTATION_WEST , 2, 2, 5, 5]
        ];
    }

    public function misfitRoversInTerrain()
    {
        return [
            'Rover Negative position X'              => [-1, 2,  5, 5],
            'Rover Negative position Y'              => [ 2, -1, 5, 5],
            'Rover Negative position Both'           => [-2, -2, 5, 5],
            'Rover ouside of terrain Position X (1)' => [ 6,  1, 5, 5],
            'Rover ouside of terrain Position Y (1)' => [ 1,  6, 5, 5],
            'Rover ouside of terrain Position X (2)' => [ 5,  1, 5, 5],
            'Rover ouside of terrain Position Y (2)' => [ 1,  5, 5, 5],
            'Rover ouside of terrain Both (1)'       => [ 6,  6, 5, 5],
            'Rover ouside of terrain Both (5)'       => [ 5,  5, 5, 5],
        ];
    }
}