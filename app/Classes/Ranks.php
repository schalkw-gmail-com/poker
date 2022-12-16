<?php

namespace App\Classes;

//[K,Q,J,10,9,8,7,6,5,4,3,2,1,A,JKR]

enum Ranks: string
{
    case King = 'K';
    case Queen = "Q";
    case Jack = "J";
    case Ten = "10";
    case Nine = "9";
    case Eight = "8";
    case Seven = "7";
    case Six = "6";
    case Five= "5";
    case Four= "4";
    case Three= "3";
    case Two= "2";
    case Ace= "A";
    case Jkr= "Jkr";

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
