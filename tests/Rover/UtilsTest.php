<?php

namespace Tests\Rover;
use PHPUnit\Framework\TestCase;
use Rover\Constants;
use Rover\Utils;

class UtilsTest extends TestCase
{
    public function testRegexCorrentSingle()
    {
        $commands=[Constants::COMMAND_ROT_LEFT,Constants::COMMAND_ROT_RIGHT,Constants::COMMAND_MOVE];
        foreach($commands as $command){
            $result=Utils::verifyCommand($command);
            $this->assertTrue($result);
        }
    }
}