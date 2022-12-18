<?php

namespace App\Evaluator;

use App\Interface\Evaluators;
use App\Classes\Hand;

abstract class AbstractEvaluator implements Evaluators
{

    public Hand $hand;

    public function __construct(Hand $hand)
    {
        $this->hand = $hand;
    }

    public function validHand():bool
    {
        return $this->hand->validateHand();
    }

    public function evaluate():bool {
        return false;
    }
}
