<?php

namespace App\Classes;

enum Suit: string
{
    case Hearts = 'H';
    case Diamonds = "D";
    case Clubs = "C";
    case Spades = "S";

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function getShortName(){
        return substr($this->getName(), 0, 1);
    }
}
