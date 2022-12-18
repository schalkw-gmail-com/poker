<?php

namespace App\Classes;

use Illuminate\Support\Facades\Log;

use App\Evaluator\AbstractEvaluator;
use App\Evaluator\FourOfaKind;
use App\Evaluator\Strait;
use App\Evaluator\StraitFlush;
use App\Evaluator\ThreeOfaKind;
use App\Evaluator\TwoFourOfaKind;
use App\Evaluator\TwoPair;

class Hand
{
    // array to house of the cards contained in this hand
    public array $cards;

    public function __construct()
    {
        $this->cards = [];
    }

    /**
     * Add the given card to the hand.
     *
     * To add a card to the hand, the card must be valid and the hand must contain less than 5 cards
     * If the card was added return true else return false
     *
     * Return true or false
     *
     * @param $value
     * @return bool
     */
    public function addCard($value): bool
    {
        Log::debug(__METHOD__ . ' bof() ');
        $return = false;
        $card = new Card($value);

        if ($card->isCardValid() && count($this->cards) < 5) {
            if (!$this->checkForDuplicatedCards($card)) {
                $this->cards[] = $card;
                $return = true;
                Log::debug(__METHOD__ . ' Added the card ' . print_r($card->name, true));
            }
        } else {
            Log::debug(__METHOD__ . ' Card is invalid of hand is already full');
        }

        Log::debug(__METHOD__ . ' eof() ');
        return $return;
    }

    /**
     * Duplicate cards are not allowed to be added to the hand.
     * Loop through the current cards in the hand, if the current card is found return true and exist the loop
     *
     * @param $card
     * @return bool
     */
    public function checkForDuplicatedCards($card): bool
    {
        Log::debug(__METHOD__ . ' bof() ');
        $return = false;

        foreach ($this->cards as $cards) {
            if (strtolower($cards->name) === strtolower($card)) {
                Log::debug(__METHOD__ . ' Duplicate card found, not adding it to the hand');
                $return = true;
                break;
            }
        }

        Log::debug(__METHOD__ . ' eof() ');
        return $return;
    }

    /**
     * view the details of the specified card
     *
     * @param $cardNumber
     * @return Card
     */
    public function viewCard($cardNumber): Card
    {
        return $this->cards[$cardNumber];
    }

    /**
     * A hand is valid if it contains 5 cards.
     * Because the system automatically checks if the cards is valid and not duplicated, we do not need to check that
     * to determine if the hand is valid, only that is has 5 cards
     *
     * @return bool
     */
    public function validateHand(): bool
    {
        Log::debug(__METHOD__ . ' bof() ');
        $return = false;

        if (count($this->cards) == 5) {
            $return = true;
        }

        Log::debug(__METHOD__ . ' eof() ');
        return $return;
    }

    /**
     * Loop through the cards in the hand and return their ranks
     *
     * @return array
     */
    public function returnRanks(): array
    {
        Log::debug(__METHOD__ . ' bof() ');
        $ranks = array();

        foreach ($this->cards as $card => $e) {
            $ranks[] = $e->rank->value;
        }

        Log::debug(__METHOD__ . ' eof() ');
        return $ranks;
    }

    /**
     * loop throught the cards in the hand and return their suites
     *
     * @return array
     */
    public function returnSuites(): array
    {
        Log::debug(__METHOD__ . ' bof() ');
        $suites = array();

        foreach ($this->cards as $card => $e) {
            $suites[] = $e->suite->value;
        }

        Log::debug(__METHOD__ . ' eof() ');
        return $suites;
    }

    /**
     * Loop through the cards in the hand and return the integer values of the cards
     *
     * @return array
     */
    public function returnIntegerValues(): array
    {
        Log::debug(__METHOD__ . ' bof() ');
        $values = array();

        foreach ($this->cards as $card => $e) {
            $values[] = $e->value;
        }

        Log::debug(__METHOD__ . ' eof() ');
        return $values;
    }

    public function returnHand(){
        $data = array();

        foreach($this->cards as $card => $e ){
            $data[] = $e;
        }
        return $data;
    }

    public function xxx(AbstractEvaluator $sss){

        return $sss->evaluate();
    }

    public function returnEvaluation(){
        $pre = __METHOD__ . ' : ';
        Log::debug($pre . ' x '.print_r($this->cards,true));
        //$x = app()->make(FourOfaKind::class,[$this->cards])->evaluate();
//        $x = new FourOfaKind($this);
//
//        if ($x->evaluate()){
//            return "Four Of a Kind";
//        }

//        $w = new TwoFourOfaKind($this);
//        $e = $w->evaluate();
        $xxxB = new TwoFourOfaKind($this);
        $www = $this->xxx($xxxB);

       // Log::debug($pre . ' x '.print_r(var_dump($w),true));
       // return "TwoFourOfAKind";




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
