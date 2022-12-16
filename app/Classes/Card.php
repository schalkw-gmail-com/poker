<?php

namespace App\Classes;

use Illuminate\Support\Facades\Log;

class Card
{
    public string $name = '';
    public Suit $suite;
    public Ranks $rank;
    public int $value;

    //these are the integer values of the individual ranks.
    const integerValues  = [
            'K' => 13,
            'Q' => 12,
            'J' => 11,
            '10' => 10,
            '9' => 9,
            '8' => 8,
            '7' => 7,
            '6' => 6,
            '5' => 5,
            '4' => 4,
            '3' => 3,
            '2' => 2,
            'A' => 1,
    ];

    public function __construct($card)
    {
        // take the card as input and define it into the rank and the suit
        $this->setName($card);
    }

//    [S,D,H,C]
//    [K,Q,J,10,9,8,7,6,5,4,3,2,A,JKR]
//    [SK, SA, S10, S1]

    public function isCardValid(){
        Log::debug(__METHOD__. ' bof() ');

        //name is valid if
        //  - it is alphanumeric only
        //  - it is between 2 and 3 characters
        //  - the first character is a letter as per the suits
        //  - the remaining characters is in the allowed rank list
        $return = true;
        if(!$this->isLengthCorrect() || !$this->isCharacterAlhpaNumeric()){
            var_dump( "the is not valid" );
            $return = false;
        }

        if(!$this->isSuitCorrect()){
            var_dump( "the suit is not correct");
            $return = false;
        }

        if(!$this->isRankCorrect()){
            dump("the rank is not correct");
            $return = false;
        }

        Log::debug(__METHOD__. ' eof() ');
        return $return;
    }

    public function isSuitCorrect(){
        $suits = Suit::cases();
        $cardSuit = substr($this->getName(), 0, 1);
        var_dump("card Suit = ". $cardSuit);
        foreach ($suits as $suit){
            var_dump( $cardSuit. " - ".$suit->value );
            if(strtolower($cardSuit) === strtolower($suit->value)){
                $this->setSuite($suit);
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
                $this->setRank($rank);
                $this->setValue(self::integerValues[$rank->value]);
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
        return $this->name;
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
    public function setSuite(Suit $suite): void
    {
        var_dump("set suite = ".print_r($suite,true));
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
    public function setRank(Ranks $rank): void
    {
        var_dump("set rank = ".print_r($rank,true));
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

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @param int $value
     */
    public function setValue(int $value): void
    {
        $this->value = $value;
    }
}
