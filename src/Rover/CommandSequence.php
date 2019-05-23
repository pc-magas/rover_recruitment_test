<?php

namespace Rover;

use Rover\Utils;
use Rover\Exceptions\InvalidCommandException;

/**
 * Represents command sequence provided from user.
 * We utilize the php's Iterator patterns to make our lives easier.
 */
class CommandSequence implements Iterator
{
    /**
     * @var array
     */
    private $commands;

    /**
     * @var int
     */
    private $i=0;

    public function __construct(string $commandSequence)
    {
        if(!Utils::verifyCommand($commandSequence)){
            throw new InvalidCommandException($commandSequence);
        }

        $this->commands=explode('',$commandSequence);
    }

    public function rewind() {
        $this->i = 0;
    }

    public function current() {
        return $this->commands[$this->i];
    }

    public function key() {
        return $this->i;
    }

    public function next() {
        ++$this->i;
    }

    public function valid() {
        return isset($this->commands[$this->i]);
    }
}