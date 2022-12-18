<?php

namespace App\Classes;

/**
 * Enum to house and handle the defined ranks of a card
 */
enum Ranks: string
{
    //Allowed ranks with the integer values
    case King = 'K'; // 13
    case Queen = "Q";// 12
    case Jack = "J"; // 11
    case Ten = "10"; // 10
    case Nine = "9"; //  9
    case Eight = "8"; // 8
    case Seven = "7"; // 7
    case Six = "6";   // 6
    case Five = "5";   // 5
    case Four = "4";   // 4
    case Three = "3";  // 3
    case Two = "2";    // 2
    case Ace = "A";   //  1
    case Jkr = "Jkr"; // *

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getShortName(): string
    {
        return substr($this->getName(), 0, 1);
    }
}
