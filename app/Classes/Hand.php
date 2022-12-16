<?php

namespace App\Classes;

use App\Evaluator\FourOfaKind;
use App\Evaluator\Strait;
use App\Evaluator\StraitFlush;
use App\Evaluator\ThreeOfaKind;
use App\Evaluator\TwoPair;
use Illuminate\Support\Facades\Log;

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

    public function returnSuites(){
        $suites = array();
        foreach($this->cards as $card => $e ){
            $suites[] = $e->suite->value;
        }
        return $suites;
    }

    public function returnIntegerValues(){
        $values = array();
        foreach($this->cards as $card => $e ){
            $values[] = $e->value;
        }
        return $values;
    }

    public function returnHand(){
        $data = array();

        foreach($this->cards as $card => $e ){
            $data[] = $e;
        }
        return $data;
    }

    public function returnEvaluation(){
        $pre = __METHOD__ . ' : ';
        Log::debug($pre . ' x '.print_r($this->cards,true));
        //$x = app()->make(FourOfaKind::class,[$this->cards])->evaluate();
        $x = new FourOfaKind($this);

        if ($x->evaluate()){
            return "Four Of a Kind";
        }




        Log::debug($pre . ' x '.print_r($x,true));
//        $w = app()->make(Strait::class,[$this])->evaluate();
//        Log::debug($pre . ' w '.print_r($w,true));
//        $s = app()->make(StraitFlush::class,[$this])->evaluate();
//        Log::debug($pre . ' s '.print_r($s,true));
//        $r = app()->make(TwoPair::class,[$this])->evaluate();
//        Log::debug($pre . ' r '.print_r($r,true));
//        $d = app()->make(ThreeOfaKind::class,[$this])->evaluate();
//        Log::debug($pre . ' d '.print_r($d,true));
    }

}
