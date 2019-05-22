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

    public function testInvalidMultiCommand()
    {
        $command="HRMHV";
        $rover=new Rover(1,2,Constants::ORIENTATION_NORTH);
        $this->expectException(TooManyCommandsException::class);
        $rover->processCommand($command);
    }

    public function testValidMultiCommand()
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
}