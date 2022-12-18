<?php

namespace Tests\Unit;

use App\Classes\Hand;
use App\Evaluator\ThreeOfaKind;
use Tests\TestCase;

class ThreeOfAKindTest extends TestCase
{

    public $threeOfaKindHand;

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

        $newEvaluator = new ThreeOfaKind($newHand);
        $result = $newEvaluator instanceof ThreeOfaKind;
        $this->assertTrue($result);
    }

    public function test_is_hand_three_of_a_kind_strait(): void
    {
        $this->threeOfaKind = new Hand();
        $this->threeOfaKind->addCard('CQ');
        $this->threeOfaKind->addCard('SQ');
        $this->threeOfaKind->addCard('HQ');
        $this->threeOfaKind->addCard('H9');
        $this->threeOfaKind->addCard('C2');

        // three of the same rank
        //$this->inspect_variable($this->threeOfaKind);
        $newEvaluator = new ThreeOfaKind($this->threeOfaKind);
        $result = $newEvaluator->evaluate();
        $this->assertTrue($result);
    }

    public function test_is_hand_three_of_a_kind_pair(): void
    {
        $this->threeOfaKind = new Hand();
        $this->threeOfaKind->addCard('CQ');
        $this->threeOfaKind->addCard('SQ');
        $this->threeOfaKind->addCard('HQ');
        $this->threeOfaKind->addCard('C9');
        $this->threeOfaKind->addCard('H9');

        // three of the same rank
        //$this->inspect_variable($this->threeOfaKind);
        $newEvaluator = new ThreeOfaKind($this->threeOfaKind);
        $result = $newEvaluator->evaluate();
        $this->assertTrue($result);
    }

    public function test_hand_is_not_three_of_a_kind(): void
    {
        $this->threeOfaKind = new Hand();
        $this->threeOfaKind->addCard('CQ');
        $this->threeOfaKind->addCard('SQ');
        $this->threeOfaKind->addCard('HK');
        $this->threeOfaKind->addCard('C9');
        $this->threeOfaKind->addCard('H9');

        // three of the same rank
        //$this->inspect_variable($this->threeOfaKind);
        $newEvaluator = new ThreeOfaKind($this->threeOfaKind);
        $result = $newEvaluator->evaluate();
        $this->assertFalse($result);
    }
}
