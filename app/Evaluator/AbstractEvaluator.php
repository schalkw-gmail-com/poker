<?php

namespace App\Evaluator;

use App\Interface\Evaluators;
use App\Classes\Hand;
use Exception;

use Illuminate\Support\Facades\Log;

use function PHPUnit\Framework\throwException;

abstract class AbstractEvaluator implements Evaluators
{

    public Hand $hand;

    public function __construct(Hand $hand)
    {
        Log::debug( ' 3333333333333333 '.print_r($hand,true));
        $this->hand = $hand;
    }

    public function validHand():bool
    {
        return $this->hand->validateHand();
    }

    // four of a kind = 4 cards of same rank plus another.
    public function evaluate():bool {
//        Log::debug( ' 3333333333333333 ');
//        $return = false;
//        if($this->validHand()) {
//            Log::debug( ' rrrrrrr ');
//            $handRanks = $this->hand->returnRanks();
//            $handValues = array_count_values($handRanks);
//            Log::debug( ' ggggggg ');
//            // the array contains only 2 values and the max of these 2 values is four
//            // the values is from the ranks of the hand, their for it is a four of a kind hand
//            if ((count($handValues) == 2) && (max($handValues) == 4)) {
//                $return = true;
//                Log::debug( ' hhhhh ');
//            }
//        }
//        Log::debug( ' fffffffffffffff == '.print_r($return,true));
//        return $return;
    return false;
    }
}
