<?php

namespace App\Evaluator;

use App\Interface\Evaluators;
use App\Classes\Hand;
use Exception;

use function PHPUnit\Framework\throwException;

class FourOfaKind implements Evaluators
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

    // four of a kind = 4 cards of same rank plus another.
    public function evaluate(){
        $return = false;
        if($this->validHand()) {
            $handRanks = $this->hand->returnRanks();
            $handValues = array_count_values($handRanks);

            // the array contains only 2 values and the max of these 2 values is four
            // the values is from the ranks of the hand, their for it is a four of a kind hand
            if ((count($handValues) == 2) && (max($handValues) == 4)) {
                $return = true;
            }
        }
        return $return;
    }
}
