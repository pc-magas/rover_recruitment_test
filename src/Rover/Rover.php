<?php

namespace Rover;

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
     * @var String
     */
    private $orientation;

    /**
     * @param $x The initial x coordinate of the rover
     * @param $y The initial y coordinate of he rover
     * @param $orientation The initial rover orientation
     */
    public function __construct(int $x,int $y,string $orientation)
    {
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
        return $orientation;
    }

    public function rotate(string $command)
    {

    }
}