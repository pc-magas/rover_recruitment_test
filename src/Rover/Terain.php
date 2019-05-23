<?php

namespace Rover;

class Terain
{
    public function __construct(int $x, int $y)
    {
        if($x<0 || $y <0){
            throw new \InvalidArgumentException('Terrain size cannot be negative');
        }
        $this->x=$x;
        $this->y=$y;
    }

    /**
     * @return bool
     */
    public function areRoverCoordinatesValid(int $roverX, int $roverY)
    {
        return $roverX>0 && $roverY>0 && $roverX < $this->x && $roverY < $this->y;
    }
}