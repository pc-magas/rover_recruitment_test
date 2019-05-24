<?php

namespace Rover;

use Rover\Utils;
use Rover\Exceptions\InvalidCommandException;
use Rover\Exceptions\TooManyCommandsException;
use Rover\Exceptions\InvalidRotationCommand;

use Rover\Terain;

class Rover
{

    /**
     * @var int
     */
    private $x;

    /**
     * @var int
     */
    private $y;

    /**
     * @var string
     */
    private $orientation;

    /**
     * @var terrain
     */
    private $terrain;

    /**
     * @param $x The initial x coordinate of the rover
     * @param $y The initial y coordinate of he rover
     * @param $orientation The initial rover orientation
     */
    public function __construct(int $x,int $y,string $orientation, Terain $t)
    {
        $this->terrain=$t;

        if(!$this->terrain->areRoverCoordinatesValid($x,$y)) {
            throw new \InvalidArgumentException("The rover contains invalid coordinates");
        }

        $this->x=$x;
        $this->y=$y;
        
        $this->orientation=$orientation;

    }

    public function getX()
    {
        return $this->x;
    }

    public function getY()
    {
        return $this->y;
    }

    public function getOrientation()
    {
        return $this->orientation;
    }


    /**
     * @param $command The rotation command
     * @throws TooManyCommandsException When is provided more than one command
     * @throws InvalidCommandException When the command is not either a move one or a rotate one
     * @throws InvalidRotationCommand When the command is not a rotation command
     */
    public function processCommand(string $command)
    {
        //Process one command only
        if(strlen($command)>1){
            throw new TooManyCommandsException();
        }

        // Valid Command
        if(!Utils::verifyCommand($command)){
            throw new InvalidCommandException($command);
        }

        if(!isset(Constants::ROTATIONS[$command][$this->orientation])){ 
           //Assuming Move Commanf if not a rotation command
           $step=Constants::MOVE_STEP[$this->orientation];

           $newCoordX=$this->x+$step[Constants::COORD_X];
           $newCoordY=$this->y+$step[Constants::COORD_Y];
           
           if($this->terrain->areRoverCoordinatesValid($newCoordX,$newCoordY)){
            $this->x=$newCoordX;
            $this->y=$newCoordY;
           }
           
        } else {
            $this->orientation=Constants::ROTATIONS[$command][$this->orientation];
        }

    }
}