<?php

namespace Tests\Unit;

use App\Classes\Card;
use App\Evaluator\FourOfaKind;
use App\Classes\Hand;
use App\Classes\Suit;
use PHPUnit\Framework\TestCase;
use Tests\TestCase as bbb;

class ForOfAKindTest extends bbb
{

    public $fourOfaKindHand;
    /**
     * setUp
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Ensure that we have an instance of the class FourOfAKind
     */
    public function test_is_instance_of_evaluator_class(): void
    {
        $newHand = new Hand();
        $newHand->addCard('D3');

        $newEvaluator = new FourOfaKind($newHand);
        $result = $newEvaluator instanceof FourOfaKind;
        $this->assertTrue($result);
    }

    public function test_is_hand_four_of_a_kind_strait(): void
    {
        $this->fourOfaKindHand = new Hand();
        $this->fourOfaKindHand->addCard('D3');
        $this->fourOfaKindHand->addCard('S3');
        $this->fourOfaKindHand->addCard('C3');
        $this->fourOfaKindHand->addCard('H3');
        $this->fourOfaKindHand->addCard('H4');

        // four of the same rank
         dump($this->fourOfaKindHand);
         $newEvaluator = new FourOfaKind($this->fourOfaKindHand);
         $result = $newEvaluator->evaluate();
         $this->assertTrue($result);
    }


    public function test_is_hand_four_of_a_kind_with_one_duplication(){
        $this->fourOfaKindHand = new Hand();
        $this->fourOfaKindHand->addCard('D3');
        $this->fourOfaKindHand->addCard('S3');
        $this->fourOfaKindHand->addCard('C3');
        $this->fourOfaKindHand->addCard('H3');
        $this->fourOfaKindHand->addCard('H3');

        // four of the same rank
        dump($this->fourOfaKindHand);
        $newEvaluator = new FourOfaKind($this->fourOfaKindHand);
        $result = $newEvaluator->evaluate();
        $this->assertFalse($result);
    }

    public function test_is_hand_four_of_a_kind_with_all_duplications(){
        $this->fourOfaKindHand = new Hand();
        $this->fourOfaKindHand->addCard('H3');
        $this->fourOfaKindHand->addCard('H3');
        $this->fourOfaKindHand->addCard('H3');
        $this->fourOfaKindHand->addCard('H3');
        $this->fourOfaKindHand->addCard('H3');

        // four of the same rank
        dump($this->fourOfaKindHand);
        $newEvaluator = new FourOfaKind($this->fourOfaKindHand);
        $result = $newEvaluator->evaluate();
        $this->assertFalse($result);
    }

    public function test_is_hand_four_of_a_kind_switched_placements(){
        $this->fourOfaKindHand = new Hand();
        $this->fourOfaKindHand->addCard('H3');
        $this->fourOfaKindHand->addCard('S3');
        $this->fourOfaKindHand->addCard('H5');
        $this->fourOfaKindHand->addCard('D3');
        $this->fourOfaKindHand->addCard('C3');

        // four of the same rank
        dump($this->fourOfaKindHand);
        $newEvaluator = new FourOfaKind($this->fourOfaKindHand);
        $result = $newEvaluator->evaluate();
        $this->assertTrue($result);
    }
}
