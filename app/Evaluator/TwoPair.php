<?php

namespace App\Evaluator;

use App\Interface\Evaluators;
use App\Classes\Hand;
use Exception;

use function PHPUnit\Framework\throwException;

class TwoPair implements Evaluators
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

    // two pairs of ranks and a separate card
    public function evaluate(){
        $return = false;
        if($this->validHand()) {
            $handRanks = $this->hand->returnRanks();
            $return = $this->checkWithIntegers($handRanks);
        }
        return $return;
    }


    public function checkWithIntegers($handRanks){

        /*
            becasue we are dealing with ranks that is not of inter value [K,Q,J,A], it is better to do the pair checking
            on the actual interger values to be on the safe side, comparing aples with aples.
        */

        $handRanksIntegers = $this->hand->returnIntegerValues();

        $handValuesIntegers = array_count_values($handRanksIntegers);
        sort($handValuesIntegers, SORT_NUMERIC);

        $singleKey = min(array_keys($handValuesIntegers));

        if ((count($handValuesIntegers) == 3 ) && (min($handValuesIntegers) == 1)) {
            // we have established that we have a 3 elements of which one is a separate card, remove this card and compare
            // the remaining 2 values. if they are the same this is a 2 pair hand
            unset($handValuesIntegers[$singleKey]);
            $values = (array_values($handValuesIntegers));
            if($values[0] === $values[1] ){
                return true;
            }
        }

        return false;
    }
}
