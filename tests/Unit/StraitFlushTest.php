<?php

namespace Tests\Unit;

use App\Classes\Card;
use App\Evaluator\FourOfaKind;
use App\Classes\Hand;
use App\Classes\Suit;
use App\Evaluator\StraitFlush;
use App\Evaluator\ThreeOfaKind;
use App\Evaluator\TwoPair;
use PHPUnit\Framework\TestCase;
use Tests\TestCase as bbb;

class StraitFlushTest extends bbb
{

    public $straitFlush;
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

        $newEvaluator = new StraitFlush($newHand);
        $result = $newEvaluator instanceof StraitFlush;
        $this->assertTrue($result);
    }

    public function test_is_hand_a_strait_flush(): void
    {
        $this->straitFlush = new Hand();
        $this->straitFlush->addCard('CJ');
        $this->straitFlush->addCard('C10');
        $this->straitFlush->addCard('C9');
        $this->straitFlush->addCard('C8');
        $this->straitFlush->addCard('C7');

        // three of the same rank
         dump($this->straitFlush);
         $newEvaluator = new StraitFlush($this->straitFlush);
         $result = $newEvaluator->evaluate();
         $this->assertTrue($result);
    }

    public function test_is_hand_a_strait_flush_diamond(): void
    {
        $this->straitFlush = new Hand();
        $this->straitFlush->addCard('DJ');
        $this->straitFlush->addCard('D10');
        $this->straitFlush->addCard('D9');
        $this->straitFlush->addCard('D8');
        $this->straitFlush->addCard('D7');

        // three of the same rank
        dump($this->straitFlush);
        $newEvaluator = new StraitFlush($this->straitFlush);
        $result = $newEvaluator->evaluate();
        $this->assertTrue($result);
    }

    public function test_is_hand_a_strait_flush_hart(): void
    {
        $this->straitFlush = new Hand();
        $this->straitFlush->addCard('HK');
        $this->straitFlush->addCard('H10');
        $this->straitFlush->addCard('HJ');
        $this->straitFlush->addCard('H9');
        $this->straitFlush->addCard('HQ');

        // three of the same rank
        dump($this->straitFlush);
        $newEvaluator = new StraitFlush($this->straitFlush);
        $result = $newEvaluator->evaluate();
        $this->assertTrue($result);
    }

    public function test_hand_is_not_a_strait_flush(): void
    {
        $this->straitFlush = new Hand();
        $this->straitFlush->addCard('HK');
        $this->straitFlush->addCard('H10');
        $this->straitFlush->addCard('H4');
        $this->straitFlush->addCard('H9');
        $this->straitFlush->addCard('HA');

        // three of the same rank
        dump($this->straitFlush);
        $newEvaluator = new StraitFlush($this->straitFlush);
        $result = $newEvaluator->evaluate();
        $this->assertFalse($result);
    }

    public function test_hand_is_not_a_strait_flush_suite(): void
    {
        $this->straitFlush = new Hand();
        $this->straitFlush->addCard('HK');
        $this->straitFlush->addCard('DQ');
        $this->straitFlush->addCard('SJ');
        $this->straitFlush->addCard('C10');
        $this->straitFlush->addCard('H9');

        // three of the same rank
        dump($this->straitFlush);
        $newEvaluator = new StraitFlush($this->straitFlush);
        $result = $newEvaluator->evaluate();
        $this->assertFalse($result);
    }


}
