<?php

namespace App\Classes;

class Card
{
    public string $name = '';
    public string $suite = '';
    public string $rank = '';

    public function __construct($card)
    {

        $this->setName($card);
        // take the card as input and define it into the rank and the suit

        $this->splitName($card);

//        $this->setRank();
//        $this->setSuite();
    }

//    [S,D,H,C]
//    [K,Q,J,10,9,8,7,6,5,4,3,2,A,JKR]
//    [SK, SA, S10, S1]

    public function isCardValid(){
        //name is valid if
        //  - it is alphanumeric only
        //  - it is between 2 and 3 characters
        //  - the first character is a letter as per the suits
        //  - the remaining characters is in the allowed rank list
        $return = true;
        if(!$this->isLengthCorrect() || !$this->isCharacterAlhpaNumeric()){
            echo "the is not valid";
            $return = false;
        }

        if(!$this->isSuitCorrect()){
            echo "the suit is not correct";
            $return = false;
        }

        if(!$this->isRankCorrect()){
            echo "the rank is not correct";
            $return = false;
        }

        return $return;
    }

    public function isSuitCorrect(){
        $suits = Suit::cases();
        $cardSuit = substr($this->getName(), 0, 1);
        foreach ($suits as $suit){
            if(strtolower($cardSuit) === strtolower($suit->value)){
                return true;
            }
        }
        return false;
    }

    public function isRankCorrect(){
        $ranks = Ranks::cases();
        $cardRank = substr($this->getName(), 1);
        foreach ($ranks as $rank){
            if(strtolower($cardRank) === strtolower($rank->value)){
                return true;
            }
        }
        return false;

    }

    public function isCharacterAlhpaNumeric(){
        $return = false;
        if(ctype_alnum($this->name)){
            $return = true;
        }
        return $return;
    }

    public function isLengthCorrect(){
        $return = false;
        if((strlen($this->name) == 3 || (strlen($this->name) == 2))){
            $return = true;
        }
        return $return;
    }

    public function splitName($card){
        // the name be received as
    }

    public function __toString(): string
    {
        return 'my name is'.$this->name;
    }

    /**
     * @return string
     */
    public function getSuite(): string
    {
        return $this->suite;
    }

    /**
     * @param string $suite
     */
    public function setSuite(string $suite): void
    {
        $this->suite = $suite;
    }

    /**
     * @return string
     */
    public function getRank(): string
    {
        return $this->rank;
    }

    /**
     * @param string $rank
     */
    public function setRank(string $rank): void
    {
        $this->rank = $rank;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
