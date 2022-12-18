<?php

namespace App\Interface;

interface Evaluators{
    /**
     * Evaluate the hand to determine if it is as of a certain rank, based on the rules set of the current rank
     *
     * @return bool
     */
    public function evaluate(): bool;

    /**
     * Check to make sure the hand is valid
     *
     * @return bool
     */
    public function validHand(): bool;
}
