<?php

namespace Tests\Unit;

use App\Classes\Card;
use App\Classes\Hand;
use App\Classes\Suit;
use PHPUnit\Framework\TestCase;
use Tests\TestCase as bbb;

class HandTest extends bbb
{

    protected $hand;

    /**
     * setUp
     */
    public function setUp(): void
    {
        parent::setUp();
        unset($this->hand);
    }

    /**
     * Ensure that we have an instance of the class Card
     */
    public function test_is_instance_of_hand_class(): void
    {
        $newHand = new Hand();
        $result = $newHand instanceof Hand;
        $this->assertTrue($result);
    }

    public function test_is_received_single_card_valid(): void
    {
        $newHand = new Hand();
        $result = $newHand->addCard('D3');
        $this->assertTrue($result);

        $this->assertEquals('D3',$newHand->viewCard(0)->name,'The name is not correct');
        $this->assertEquals('Diamonds',$newHand->viewCard(0)->suite->name,'Suite is not correct');
        $this->assertEquals('3',$newHand->viewCard(0)->rank->value,'rank is not correct');
    }

    public function test_is_received_single_card_invalid(): void
    {
        $newHand = new Hand();
        $result = $newHand->addCard('XX3');
        $this->assertFalse($result);
    }

    public function test_is_received_multiple_cards_valid(): void
    {
        $newHand = new Hand();
        $result = $newHand->addCard('D3');
        $this->assertTrue($result);

        $this->assertEquals('D3',$newHand->viewCard(0)->name,'The name is not correct');
        $this->assertEquals('Diamonds',$newHand->viewCard(0)->suite->name,'Suite is not correct');
        $this->assertEquals('3',$newHand->viewCard(0)->rank->value,'rank is not correct');

        $result = $newHand->addCard('S9');
        $this->assertTrue($result);

        $this->assertEquals('S9',$newHand->viewCard(1)->name,'The name is not correct');
        $this->assertEquals('Spades',$newHand->viewCard(1)->suite->name,'Suite is not correct');
        $this->assertEquals('9',$newHand->viewCard(1)->rank->value,'rank is not correct');
    }

    public function test_is_received_multiple_cards_mixed(): void
    {
        $newHand = new Hand();
        $result = $newHand->addCard('D3');
        $this->assertTrue($result);

        $this->assertEquals('D3',$newHand->viewCard(0)->name,'The name is not correct');
        $this->assertEquals('Diamonds',$newHand->viewCard(0)->suite->name,'Suite is not correct');
        $this->assertEquals('3',$newHand->viewCard(0)->rank->value,'rank is not correct');

        $result = $newHand->addCard('X9');
        $this->assertFalse($result);
    }

    public function test_is_hand_valid(){
        $newHand = new Hand();
        $result1 = $newHand->addCard('D3');
        $result2 = $newHand->addCard('C3');
        $result3 = $newHand->addCard('H3');
        $result4 = $newHand->addCard('S3');
        $result5 = $newHand->addCard('SK');

        $isValidHand = $newHand->validateHand();
        $this->asserttrue($isValidHand);
    }

    public function test_is_hand_valid_with_two_cards(){
        $newHand = new Hand();
        $result1 = $newHand->addCard('D3');
        $result2 = $newHand->addCard('C3');

        $isValidHand = $newHand->validateHand();
        $this->assertFalse($isValidHand);
    }

    public function test_is_hand_valid_with_extra_cards(){
        $newHand = new Hand();
        $result1 = $newHand->addCard('D3');
        $result2 = $newHand->addCard('C3');
        $result3 = $newHand->addCard('H3');
        $result4 = $newHand->addCard('S3');
        $result5 = $newHand->addCard('SK');
        $result6 = $newHand->addCard('SK');
        $result7 = $newHand->addCard('SK');
        $result8 = $newHand->addCard('SK');

        $isValidHand = $newHand->validateHand();
        $this->asserttrue($isValidHand);
    }

    public function test_can_duplicate_cards_be_added(){
        $newHand = new Hand();
        $result1 = $newHand->addCard('D3');
        $result2 = $newHand->addCard('C3');
        $result3 = $newHand->addCard('C3');
        $this->assertFalse($result3);
        $isValidHand = $newHand->validateHand();
        $this->assertFalse($isValidHand);
    }
}
