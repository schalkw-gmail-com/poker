<?php

namespace App\Evaluator;

use App\Interface\Evaluators;
use App\Classes\Hand;
use Exception;

use function PHPUnit\Framework\throwException;

class ThreeOfaKind implements Evaluators
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

    // three of a kind = 3 cards of same rank plus another.
    public function evaluate(){
        $return = false;
        dump('ssss');
        if($this->validHand()) {
            $handRanks = $this->hand->returnRanks();
            $handValues = array_count_values($handRanks);

            dump($handValues);
            dump(count($handValues));
            dump(max($handValues));

            // the array can contain either 3 or 2 elements, but the max value for the elements is 3
            if ((count($handValues) == 3 || (count($handValues) == 2)) && (max($handValues) == 3)) {
                $return = true;
            }
        }
        return $return;
    }
}
