<?php

namespace App\Interface;

interface Evaluators{
    public function evaluate();// evaluate against the rules set
    public function validHand(); //check if the hand is actually valid
}
