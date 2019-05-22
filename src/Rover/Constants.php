<?php
namespace Rover;

/**
 * Basic class that stores nessesary static data used in the logic
 */
final class Constants
{
    // Mapping orientations for north,east,south,west
    const ORIENTATION_NORTH='N';
    const ORIENTATION_SOUTH='S';
    const ORIENTATION_EAST='E';
    const ORIENTATION_WEST='W';

    //Coordinate references
    const COORD_X='x';
    const COORD_Y='y';

    //Commands
    const COMMAND_ROT_LEFT='L';
    const COMMAND_ROT_RIGHT='R';
    const COMMAND_MOVE='M';

    // Regex used in chgecking whether a command is valid
    const AVAILABLE_COMMANDS = [
        self::COMMAND_ROT_LEFT,
        self::COMMAND_ROT_RIGHT,
        self::COMMAND_MOVE
    ];

    const AVAILABLE_COMMANDS_CONFIRM_REGEX = "/^(".self::COMMAND_ROT_LEFT.'|'.self::COMMAND_ROT_RIGHT.'|'.self::COMMAND_MOVE.")*$/";
    
    //Coordinate Manipulators depending the orientation
    const MOVE_STEP=[
        self::ORIENTATION_NORTH => [ self::COORD_X =>  0, self::COORD_Y =>  1 ],
        self::ORIENTATION_SOUTH => [ self::COORD_X =>  0, self::COORD_Y => -1 ],
        self::ORIENTATION_EAST  => [ self::COORD_X => -1, self::COORD_Y =>  0 ],
        self::ORIENTATION_WEST  => [ self::COORD_X =>  1, self::COORD_Y =>  0 ],
    ];

    // Maps the Rotations that will be performed
    const ROTATIONS = [

        self::COMMAND_ROT_LEFT => [
            self::ORIENTATION_NORTH => self::ORIENTATION_EAST,
            self::ORIENTATION_SOUTH => self::ORIENTATION_WEST,
            self::ORIENTATION_EAST  => self::ORIENTATION_SOUTH,
            self::ORIENTATION_WEST  => self::ORIENTATION_NORTH,
        ],
        
        self::COMMAND_ROT_RIGHT => [
            self::ORIENTATION_NORTH => self::ORIENTATION_WEST,
            self::ORIENTATION_SOUTH => self::ORIENTATION_EAST,
            self::ORIENTATION_EAST  => self::ORIENTATION_NORTH,
            self::ORIENTATION_WEST  => self::ORIENTATION_SOUTH,
        ]

    ];

}