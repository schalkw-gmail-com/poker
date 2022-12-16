<?php

namespace App\Classes;

//[K,Q,J,10,9,8,7,6,5,4,3,2,1,A,JKR]

enum Ranks: string
{
    case King = 'K'; // 13
    case Queen = "Q";// 12
    case Jack = "J"; // 11
    case Ten = "10"; // 10
    case Nine = "9"; //  9
    case Eight = "8"; // 8
    case Seven = "7"; // 7
    case Six = "6";   // 6
    case Five= "5";   // 5
    case Four= "4";   // 4
    case Three= "3";  // 3
    case Two= "2";    // 2
    case Ace= "A";   //  1
    case Jkr= "Jkr"; // *

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
