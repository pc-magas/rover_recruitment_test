<?php
/**
 * Generic Utility Functions
 */
namespace Rover;

use Rover\Constants;
use Rover\Exceptions\InvalidCommandException;
use Rover\Exceptions\RoverOutOfTerrainBoundsException;
use Rover\Terrain;

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

    /**
     * The function that actually executes a command Sequence.
     * It is not created in a seperate class because it will cause way too many files.
     * In case of a logic change please Do refactor and move to an appropriate class.
     * 
     * @param Rover $rover The rover that will move into a Terrain
     * @param string $commands The commands that the rover will execute.
     * 
     * @throws InvalidCommandException
     * @return Rover with the final position
     */
    public static function executeCommands(Rover $rover, string $commands)
    {
        if(stlen($commands)>0 &&!self::verifyCommand($commands)) {
            throw  new InvalidCommandException($commands);
        }

        $commandArray=explode($commands);
        /**
         * Try not to mutate the Rover.
         * @var Rover
         */
        $roverToMove=clone($rover);

        foreach($commandArray as $command){
            try{
                $roverToMove->processCommand($command);
            } catch(RoverOutOfTerrainBoundsException $o) {
                echo "Rover Cannot move proceeding to the next command \n";
            }
        }

        return $roverToMove;
    }
}