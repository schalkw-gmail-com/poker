<?php

namespace Tests\Unit;

use App\Classes\Card;
use App\Classes\Suit;
use PHPUnit\Framework\TestCase;
use Tests\TestCase as bbb;

class CardTest extends bbb
{

    protected $card;

    /**
     * setUp
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Ensure that we have an instance of the class Card
     */
    public function test_is_instance_of_card_class(): void
    {
        $newCard = new Card('aa');
        $result = $newCard instanceof Card;
        $this->assertTrue($result);
    }

    public function card_can_must_receive_argument(): void
    {
        $card = new Card('A1');
        $this->assertTrue($card);
    }

    public function test_card_validator_is_length_two_characters(){
        $card = new Card('A1');
        $result = $card->isLengthCorrect();
        $this->assertTrue($result);
    }

    public function test_card_validator_is_length_three_characters(){
        $card = new Card('A10');
        $result = $card->isLengthCorrect();
        $this->assertTrue($result);
    }

    public function test_card_validator_is_length_more_characters(){
        $card = new Card('A103');
        $result = $card->isLengthCorrect();
        $this->assertFalse($result);
    }

    public function test_card_validator_must_be_alpha_numeric(): void
    {
        $card = new Card('A1');
        $result = $card->isCharacterAlhpaNumeric();
        $this->assertTrue($result);
    }

    public function test_card_validator_must_be_alpha_numeric_error(): void
    {
        $card = new Card('A1%');
        $result = $card->isCharacterAlhpaNumeric();
        $this->assertFalse($result);
    }

    public function test_is_suit_correct(){
        $card = new Card('S1');
        $result = $card->isSuitCorrect();
        $this->assertTrue($result);
    }


    public function test_is_suit_not_correct(){
        $card = new Card('Z1');
        $result = $card->isSuitCorrect();
        $this->assertFalse($result);
    }


    public function test_is_rank_valid(){
        $card = new Card('H2');
        $result = $card->isRankCorrect();
        $this->assertTrue($result);
    }

    public function test_is_rank_invalid(){
        $card = new Card('H1');
        $result = $card->isRankCorrect();
        $this->assertFalse($result);
    }

    public function test_is_card_valid(){
        $card = new Card('H2');
        $result = $card->isCardValid();
        $this->assertTrue($result);
    }

    public function test_is_card_invalid_x1(){
        $card = new Card('X1');
        $result = $card->isCardValid();
        $this->assertFalse($result);
    }


    public function test_is_card_invalid_aaa123(){
        $card = new Card('aaa123');
        $result = $card->isCardValid();
        $this->assertFalse($result);
    }

    public function test_is_card_invalid_aaas(){
        $card = new Card('aaas');
        $result = $card->isCardValid();
        $this->assertFalse($result);
    }

    public function test_is_card_invalid_special_characters(){
        $card = new Card('-*/*-');
        $result = $card->isCardValid();
        $this->assertFalse($result);
    }

    /**
     * A card can only be of one suite
     */

    /**
     * A card can only have one rank
     */
}
