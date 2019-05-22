<?php

namespace Rover\Exceptions;

use Rover\Constants;


class InvalidCommandException extends \Exception
{  
    public function __construct(string $command)
    {
        parent::__construct("The command $command is an invalid one. Available commands are ". implode(',', Constants::AVAILABLE_COMMANDS));
    }
}