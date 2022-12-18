<?php

namespace App\Evaluator;

use App\Interface\Evaluators;
use App\Classes\Hand;
use Illuminate\Support\Facades\Log;

class Strait implements Evaluators
{
    public Hand $hand;

    public function __construct(Hand $hand)
    {
        $this->hand = $hand;
    }

    public function validHand(): bool
    {
        return $this->hand->validateHand();
    }


    /**
     *   we need to determine if the values of the array is sequential
     *   determining the sequence is relatively easy if you are dealing with just rank [10 - 2]
     *   if the other ranks are being add [K,Q,J,A] we will need to convert them to an integer value to determine the
     *   sequence
     *   step 1 - gather all the ranks in integer form
     *   step 2 - order the list
     *   step 3 - using a for loop starting at the min value and incrementing 1 per loop, check if the value in the
     *   sequence match. if it does NOT you don't have a sequential list, therefor not a strait
     *   return false and exist loop
     *
     * @return bool
     */
    public function evaluate(): bool
    {
        Log::debug(__METHOD__ . ' bof() ');
        $return = false;

        if ($this->validHand()) {
            $values = $this->hand->returnIntegerValues();
            sort($values, SORT_NUMERIC);
            $arrayCounter = count($values);

            for ($x = 0; $x < $arrayCounter - 1; $x++) {
                $currentValue = $values[$x];
                $nextValue = $values[$x + 1];
                if ($currentValue + 1 <> $nextValue) {
                    Log::debug(__METHOD__ . ' NOT a sequential hand');
                    // the sequence is not sequential, no need to continue with any testing as the sequence must span
                    // all 5 cards
                    $x = 99;
                } else {
                    $return = true;
                }
            }
        }

        Log::debug(__METHOD__ . ' eof() ');
        return $return;
    }
}

