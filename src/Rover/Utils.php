<?php
/**
 * Generic Utility Functions
 */
namespace Rover;

use Rover\Constants;

class Utils
{
    /**
     * Verifies whather a string contains valid commands
     * @param $command Command that the Rover is provided.
     */
    public static function verifyCommand(string $command)
    {
        return preg_match(Constants::AVAILABLE_COMMANDS_CONFIRM_REGEX,$command)!==0;
    }
}