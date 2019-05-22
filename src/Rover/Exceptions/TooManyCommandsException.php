<?php

namespace Rover\Exceptions;

class TooManyCommandsException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Rover can process one command at the time.');
    }
}