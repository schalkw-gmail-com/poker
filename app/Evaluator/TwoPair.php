<?php

namespace App\Evaluator;

use App\Interface\Evaluators;
use App\Classes\Hand;
use Illuminate\Support\Facades\Log;

class TwoPair extends AbstractEvaluator
{

    public Hand $hand;

    public function __construct(Hand $hand)
    {
        parent::__construct($hand);
    }

    /**
     * @return bool
     */
    public function validHand(): bool
    {
        return $this->hand->validateHand();
    }

    /**
     * two pairs of the same rank and a separate card
     *
     * @return bool
     */
    public function evaluate(): bool
    {
        Log::debug(__METHOD__ . ' bof() ');
        $return = false;

        if ($this->validHand()) {
            $handRanks = $this->hand->returnRanks();
            $return = $this->checkWithIntegers();
        }

        Log::debug(__METHOD__ . ' eof() ');
        return $return;
    }


    /**
     *  Because we are dealing with ranks that is not of integer value [K,Q,J,A], it is better to do the pair checking
     *  on an integer representation value of the card to be on the safe side, comparing apples with apples.
     *
     * @return bool
     */
    public function checkWithIntegers(): bool
    {
        Log::debug(__METHOD__ . ' bof() ');
        $return = false;
        $handRanksIntegers = $this->hand->returnIntegerValues();

        $handValuesIntegers = array_count_values($handRanksIntegers);
        sort($handValuesIntegers, SORT_NUMERIC);

        $singleKey = min(array_keys($handValuesIntegers));

        if ((count($handValuesIntegers) == 3) && (min($handValuesIntegers) == 1)) {
            // we have established that we have 3 elements of which one is a separate card.
            // remove this card and compare the remaining 2 values.
            // if they are the same this is a 2 pair hand
            unset($handValuesIntegers[$singleKey]);
            $values = (array_values($handValuesIntegers));
            if ($values[0] === $values[1]) {
                $return = true;
            }
        }

        Log::debug(__METHOD__ . ' eof() ');
        return $return;
    }
}
