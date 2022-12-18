<?php

namespace App\Evaluator;

use App\Interface\Evaluators;
use App\Classes\Hand;
use Illuminate\Support\Facades\Log;

class ThreeOfaKind implements Evaluators
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

    //

    /**
     * three of a kind = 3 cards of same rank plus 2 cards of other ranks.
     *
     * @return bool
     */
    public function evaluate(): bool
    {
        Log::debug(__METHOD__ . ' bof() ');
        $return = false;

        if ($this->validHand()) {
            $handRanks = $this->hand->returnRanks();
            $handValues = array_count_values($handRanks);

            // the array can contain either 3 or 2 elements, but the max value for the elements is 3
            if ((count($handValues) == 3 || (count($handValues) == 2)) && (max($handValues) == 3)) {
                $return = true;
            }
        }

        Log::debug(__METHOD__ . ' eof() ');
        return $return;
    }
}
