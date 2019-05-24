<?php

namespace Rover\Exceptions;


class RoverOutOfTerrainBoundsException extends \Exception
{
    public function __construct()
    {
        parent::__construct('The rover cannot move ousideof terrain');
    }
}