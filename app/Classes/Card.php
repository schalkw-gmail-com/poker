<?php

namespace App\Classes;

class Card
{
    public $name = '';

    public function __toString(): string
    {
        // TODO: Implement __toString() method.
        return 'my name is'.$this->name;
    }
}
