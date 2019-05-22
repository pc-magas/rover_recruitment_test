<?php

namespace Tests\Rover;
use PHPUnit\Framework\TestCase;
use Rover\Constants;
use Rover\Utils;

class TestUtils extends TestCase
{
    public function testRegexCorrentSingle()
    {
        $command=Constants::COMMAND_ROT_LEFT;
        $result=Utils::verifyCommand($command);
        echo(Constants::AVAILABLE_COMMANDS_CONFIRM_REGEX);
        $this->assertTrue($result);
    }
}