<?php

namespace App\Evaluator;

use App\Interface\Evaluators;
use App\Classes\Hand;
use Exception;

use function PHPUnit\Framework\throwException;

class Strait implements Evaluators
{
    public Hand $hand;

    public function __construct(Hand $hand)
    {
        $this->hand = $hand;
    }

    public function validHand()
    {
        return $this->hand->validateHand();
    }

    // we need to determine if the values of the array is sequential
    // determining the sequence is relativaly easy if you are dealing with just rank [10 - 2]
    // if the other ranks are being add [K,Q,J,A] we will need to convert them to a integer
    //  value to determine sequence
    // step 1 - gather all the ranks in integer form
    // step 2 - order the list
    // step 3 - using a for loop starting at the min value and incrementing 1 per loop, check if the value in the
    // sequence match. if it does not you dont have a sequencial list, therefor not a strait hand
    public function evaluate()
    {
        $return = false;

        if($this->validHand()) {
            $values = $this->hand->returnIntegerValues();
            sort($values, SORT_NUMERIC);
            $arrayCounter = count($values);

            for($x = 0; $x < $arrayCounter-1; $x++){
                $currentValue = $values[$x];
                $nextValue = $values[$x+1];
                if($currentValue + 1 <> $nextValue){
                    // the sequence is non sequencial, no need to continue with any testing as the sequence must span
                    // all 5 cards
                    $x =  99;
                }else{
                    $return = true;
                }
            }
        }
        return $return;
    }
}

