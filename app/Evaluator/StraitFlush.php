<?php

namespace App\Evaluator;

use App\Interface\Evaluators;
use App\Classes\Hand;
use Illuminate\Support\Facades\Log;

class StraitFlush implements Evaluators
{

    public Hand $hand;

    public function __construct(Hand $hand)
    {
        $this->hand = $hand;
    }

    /**
     * @return bool
     */
    public function validHand(): bool
    {
        return $this->hand->validateHand();
    }

    /**
     *  All cards must have the SAME suite and be sequential
     *
     *  First check if the all cards are of the same suite. If not return false, as this is not strait flush
     *  check that all the cards are sequential. if not return false
     *
     * @return bool
     */
    public function evaluate(): bool
    {
        Log::debug(__METHOD__ . ' bof() ');
        $return = false;

        if ($this->validHand()) {
            $handSuites = $this->hand->returnSuites();
            $handSuiteValue = array_count_values($handSuites);

            //check that we have 1 suit and 5 cards total in the suite
            if ((count($handSuiteValue) != 1) && max($handSuiteValue) != 5) {
                Log::debug(__METHOD__ . ' hand contains more than 1 suit ');
                return false;
            }
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
