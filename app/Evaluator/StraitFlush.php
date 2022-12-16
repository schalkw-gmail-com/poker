<?php

namespace App\Evaluator;

use App\Interface\Evaluators;
use App\Classes\Hand;
use Exception;

use function PHPUnit\Framework\throwException;

class StraitFlush implements Evaluators
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

    // All cards must have the same suite and be sequencial
    public function evaluate(){
        $return = false;
        if($this->validHand()) {

            $handSuites = $this->hand->returnSuites();
            $handSuiteValue = array_count_values($handSuites);

            //check that we have 1 suit and 5 cards total in the suite
            if((count($handSuiteValue) != 1) && max($handSuiteValue) != 5 ){
                dump('this contains more than 1 suite');
                return false;
            }
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
