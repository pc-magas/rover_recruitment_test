<?php

namespace Tests\Rover;
use PHPUnit\Framework\TestCase;
use Rover\Constants;
use Rover\Utils;

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
}