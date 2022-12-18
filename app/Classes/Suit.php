<?php

namespace App\Classes;

/**
 * Enum to house and handle the suit of a playing card
 */
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

    public function getShortName(): string
    {
        return substr($this->getName(), 0, 1);
    }
}
