<?php

namespace App\Evaluator;

use App\Interface\Evaluators;
use App\Classes\Hand;
use Illuminate\Support\Facades\Log;

class FourOfaKind implements Evaluators
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
     *  four of a kind = 4 cards of same rank plus another.
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

            // the array contains only 2 values and the max of these 2 values is four
            // the values is from the ranks of the hand, their for it is a four of a kind hand
            if ((count($handValues) == 2) && (max($handValues) == 4)) {
                $return = true;
            }
        }

        Log::debug(__METHOD__ . ' eof() ');
        return $return;
    }
}
