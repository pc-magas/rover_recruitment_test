<?php

namespace Tests\Rover;

use PHPUnit\Framework\TestCase;
use Rover\Constants;
use Rover\Rover;

use Rover\Exceptions\InvalidCommandException;
use Rover\Exceptions\TooManyCommandsException;


class RoverTest extends TestCase
{
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
     * @dataProvider roverProvider
     */
    public function testRotationLeft($x,$y,$orientation)
    {
      $expectedResult = Constants::ROTATIONS[Constants::COMMAND_ROT_LEFT][$orientation];
      echo 'Expecting Result: '.$expectedResult." Provided Orientation $orientation \n";
      $rover = new Rover($x,$y,$orientation);
      $rover->processCommand(Constants::COMMAND_ROT_LEFT);

      $this->assertSame($rover->getOrientation(),$expectedResult);
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
}