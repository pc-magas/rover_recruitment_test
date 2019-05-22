<?php

namespace Tests\Rover;

use PHPUnit\Framework\TestCase;
use Rover\Constants;
use Rover\Rover;
use Rover\Exceptions\InvalidCommandException;

class RoverTest extends TestCase
{
    public function testInvalidCommand()
    {
        $command="H";
        $rover=new Rover(1,2,Constants::ORIENTATION_NORTH);
        $this->expectException(InvalidCommandException::class);
        $rover->processCommand($command);
    }
}