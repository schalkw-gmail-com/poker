<?php

namespace Tests\Unit;

use App\Classes\Card;
use Tests\TestCase;

class CardTest extends TestCase
{
    protected Card $card;

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
        $newCard = new Card('D5');
        $result = $newCard instanceof Card;
        $this->assertTrue($result);
    }

    public function test_card_can_must_receive_argument(): void
    {
        $card = new Card('H2');
        $this->assertTrue((bool)$card);
    }

    public function test_card_validator_is_length_two_characters(): void
    {
        $card = new Card('D2');
        $result = $card->isLengthCorrect();
        $this->assertTrue($result);
    }

    public function test_card_validator_is_length_three_characters(): void
    {
        $card = new Card('D10');
        $result = $card->isLengthCorrect();
        $this->assertTrue($result);
    }

    public function test_card_validator_is_length_more_characters(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('This is not a valid card');
        $card = new Card('A103');
        $result = $card->isLengthCorrect();
        $this->assertFalse($result);
    }

    public function test_card_validator_must_be_alpha_numeric(): void
    {
        $card = new Card('D5');
        $result = $card->isCharacterAlhpaNumeric();
        $this->assertTrue($result);
    }

    public function test_card_validator_must_be_alpha_numeric_error(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('This is not a valid card');
        $card = new Card('A1%');
        $result = $card->isCharacterAlhpaNumeric();
        $this->assertFalse($result);
    }

    public function test_is_suit_correct(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('This is not a valid card');
        $card = new Card('S1');
        $result = $card->isSuitCorrect();
        $this->assertTrue($result);
    }

    public function test_is_suit_not_correct(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('This is not a valid card');
        $card = new Card('Z1');
        $result = $card->isSuitCorrect();
        $this->assertFalse($result);
    }

    public function test_is_rank_valid(): void
    {
        $card = new Card('H2');
        $result = $card->isRankCorrect();
        $this->assertTrue($result);
    }

    public function test_is_rank_invalid(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('This is not a valid card');
        $card = new Card('H1');
        $result = $card->isRankCorrect();
        $this->assertFalse($result);
    }

    public function test_is_card_valid(): void
    {
        $card = new Card('H2');
        $result = $card->isCardValid();
        $this->assertTrue($result);
    }

    public function test_is_card_invalid_x1(){
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('This is not a valid card');
        $card = new Card('X1');
        $result = $card->isCardValid();
        $this->assertFalse($result);
    }

    public function test_is_card_invalid_aaa123(){
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('This is not a valid card');
        $card = new Card('aaa123');
        $result = $card->isCardValid();
        $this->assertFalse($result);
    }

    public function test_is_card_invalid_aaas(){
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('This is not a valid card');
        $card = new Card('aaas');
        $result = $card->isCardValid();
        $this->assertFalse($result);
    }

    public function test_is_card_invalid_special_characters(){
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('This is not a valid card');
        $card = new Card('-*/*-');
        $result = $card->isCardValid();
        $this->assertFalse($result);
    }
}
