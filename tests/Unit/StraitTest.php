<?php

namespace Tests\Unit;

use App\Classes\Card;
use App\Evaluator\FourOfaKind;
use App\Classes\Hand;
use App\Classes\Suit;
use App\Evaluator\Strait;
use PHPUnit\Framework\TestCase;
use Tests\TestCase as bbb;

class StraitTest extends bbb
{
    public $stairtHand;

    public function setUp(): void
    {
        parent::setUp();
        unset($this->stairtHand);
    }

    /**
     * Ensure that we have an instance of the class FourOfAKind
     */
    public function test_is_instance_of_evaluator_class(): void
    {
        $newHand = new Hand();
        $newHand->addCard('D3');

        $newEvaluator = new Strait($newHand);
        $result = $newEvaluator instanceof Strait;
        $this->assertTrue($result);
    }

    public function test_is_hand_a_strait(): void
    {
        $this->fourOfaKindHand = new Hand();
        $this->fourOfaKindHand->addCard('D2');
        $this->fourOfaKindHand->addCard('S3');
        $this->fourOfaKindHand->addCard('C4');
        $this->fourOfaKindHand->addCard('H5');
        $this->fourOfaKindHand->addCard('H6');

        $newEvaluator = new Strait($this->fourOfaKindHand);
        $result = $newEvaluator->evaluate();
        $this->assertTrue($result);
    }

    public function test_is_hand_a_strait_king(): void
    {
        $this->fourOfaKindHand = new Hand();
        $this->fourOfaKindHand->addCard('HK');
        $this->fourOfaKindHand->addCard('DQ');
        $this->fourOfaKindHand->addCard('SJ');
        $this->fourOfaKindHand->addCard('C10');
        $this->fourOfaKindHand->addCard('H9');

        $newEvaluator = new Strait($this->fourOfaKindHand);
        $result = $newEvaluator->evaluate();
        $this->assertTrue($result);
    }

    public function test_is_hand_not_a_strait_mid(): void
    {
        $this->fourOfaKindHand = new Hand();
        $this->fourOfaKindHand->addCard('HK');
        $this->fourOfaKindHand->addCard('DQ');
        $this->fourOfaKindHand->addCard('S4');
        $this->fourOfaKindHand->addCard('C10');
        $this->fourOfaKindHand->addCard('H9');

        $newEvaluator = new Strait($this->fourOfaKindHand);
        $result = $newEvaluator->evaluate();
        $this->assertFalse($result);
    }

    public function test_is_hand_not_a_strait_last(): void
    {
        $this->fourOfaKindHand = new Hand();
        $this->fourOfaKindHand->addCard('HJ');
        $this->fourOfaKindHand->addCard('D10');
        $this->fourOfaKindHand->addCard('S9');
        $this->fourOfaKindHand->addCard('C8');
        $this->fourOfaKindHand->addCard('H5');

        $newEvaluator = new Strait($this->fourOfaKindHand);
        $result = $newEvaluator->evaluate();
        $this->assertFalse($result);
    }

    public function test_is_hand_a_strait_first(): void
    {
        $this->fourOfaKindHand = new Hand();
        $this->fourOfaKindHand->addCard('HA');
        $this->fourOfaKindHand->addCard('DQ');
        $this->fourOfaKindHand->addCard('SJ');
        $this->fourOfaKindHand->addCard('C10');
        $this->fourOfaKindHand->addCard('H9');

        $newEvaluator = new Strait($this->fourOfaKindHand);
        $result = $newEvaluator->evaluate();
        $this->assertFalse($result);
    }
}
