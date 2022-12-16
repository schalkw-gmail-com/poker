<?php

namespace Tests\Unit;

use App\Classes\Card;
use App\Evaluator\FourOfaKind;
use App\Classes\Hand;
use App\Classes\Suit;
use App\Evaluator\ThreeOfaKind;
use App\Evaluator\TwoPair;
use PHPUnit\Framework\TestCase;
use Tests\TestCase as bbb;

class TwoPairTest extends bbb
{

    public $twoPair;
    /**
     * setUp
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Ensure that we have an instance of the class ThreeOfAKind
     */
    public function test_is_instance_of_evaluator_class(): void
    {
        $newHand = new Hand();
        $newHand->addCard('D3');

        $newEvaluator = new TwoPair($newHand);
        $result = $newEvaluator instanceof TwoPair;
        $this->assertTrue($result);
    }

    public function test_is_hand_two_of_pair_strait(): void
    {
        $this->twoPair = new Hand();
        $this->twoPair->addCard('HJ');
        $this->twoPair->addCard('SJ');
        $this->twoPair->addCard('C3');
        $this->twoPair->addCard('S3');
        $this->twoPair->addCard('H2');

        // three of the same rank
         dump($this->twoPair);
         $newEvaluator = new TwoPair($this->twoPair);
         $result = $newEvaluator->evaluate();
         $this->assertTrue($result);
    }

    public function test_is_hand_two_of_pair_random(): void
    {
        $this->twoPair = new Hand();
        $this->twoPair->addCard('HJ');
        $this->twoPair->addCard('SK');
        $this->twoPair->addCard('C3');
        $this->twoPair->addCard('SJ');
        $this->twoPair->addCard('H3');

        // three of the same rank
        $newEvaluator = new TwoPair($this->twoPair);
        $result = $newEvaluator->evaluate();
        $this->assertTrue($result);
    }

    public function test_is_hand_two_of_pair_spread(): void
    {
        $this->twoPair = new Hand();
        $this->twoPair->addCard('DA');
        $this->twoPair->addCard('SJ');
        $this->twoPair->addCard('C3');
        $this->twoPair->addCard('CJ');
        $this->twoPair->addCard('HA');

        $newEvaluator = new TwoPair($this->twoPair);
        $result = $newEvaluator->evaluate();
        $this->assertTrue($result);
    }

    public function test_hand_is_not_two_spread(): void
    {
        $this->twoPair = new Hand();
        $this->twoPair->addCard('DA');
        $this->twoPair->addCard('S2');
        $this->twoPair->addCard('C3');
        $this->twoPair->addCard('CJ');
        $this->twoPair->addCard('H5');

        $newEvaluator = new TwoPair($this->twoPair);
        $result = $newEvaluator->evaluate();
        $this->assertFalse($result);
    }



}
