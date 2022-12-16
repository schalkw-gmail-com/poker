<?php

namespace App\Classes;

class Hand
{
    public array $cards;

    public function __construct()
    {
        $this->cards = [];
    }

    public function addCard($value){
        $return = false;
        $card = new Card($value);

        if ($card->isCardValid() && count($this->cards) < 5){
            if (!$this->checkForDuplicatedCards($card)) {
                $this->cards[] = $card;
                $return = true;
                dump("Added the card = ".print_r($card->name,true));
            }
        }else{
            dump("Either the card is invalid or the hand is already full");
        }

        return $return;
    }

    public function checkForDuplicatedCards($card){
        foreach ($this->cards as $cards){
            dump("$$ ".$cards->name . " ---- ".$card);
            if(strtolower($cards->name) === strtolower($card)){
                dump("we  found a duplicte");
                return true;
            }
        }
        dump("no duplicate found");
        return false;
    }

    public function viewCard($cardNumber){
        return $this->cards[$cardNumber];
    }

    public function validateHand(){
        $return = false;
        if(count($this->cards) == 5){
            $return = true;
        }
        return $return;
    }

    public function returnRanks(){
        $ranks = array();
        foreach($this->cards as $card => $e ){
            $ranks[] = $e->rank->value;
        }
        return $ranks;
    }

    public function returnIntegerValues(){
        $values = array();
        foreach($this->cards as $card => $e ){
            $values[] = $e->value;
        }
        return $values;
    }
}
