<?php

namespace App\Classes;

use Illuminate\Support\Facades\Log;

class Card
{
    public string $name = '';
    public Suit $suite;
    public Ranks $rank;
    public int $value; // this is to make it easier to do comparisons and calculations

    //these are the integer values of the individual ranks.
    public const integerValues = [
        'K' => 13,
        'Q' => 12,
        'J' => 11,
        '10' => 10,
        '9' => 9,
        '8' => 8,
        '7' => 7,
        '6' => 6,
        '5' => 5,
        '4' => 4,
        '3' => 3,
        '2' => 2,
        'A' => 1,
    ];

    /**
     * @param $card
     */
    public function __construct($card)
    {
        // set the name of the card
        $this->setName($card);
    }

    /**
     *
     *  card is valid if
     *  - it is alphanumeric only
     *  - it is between 2 and 3 characters
     *  - the first character is a letter as per the suits
     *  - the remaining characters is in the allowed rank list
     *
     *  valid suite = [S,D,H,C]
     *  valid rank = [K,Q,J,10,9,8,7,6,5,4,3,2,A,JKR]
     *
     * [SK, SA, S10, S1]
     *
     * @return bool
     */
    public function isCardValid(): bool
    {
        Log::debug(__METHOD__ . ' bof() ');
        $return = true;
        if (!$this->isLengthCorrect() || !$this->isCharacterAlhpaNumeric()) {
            Log::debug(__METHOD__ . 'this card is not valid: length or characters are incorrect ');
            $return = false;
        }

        if (!$this->isSuitCorrect()) {
            Log::debug(__METHOD__ . 'this card is not valid: suit is incorrect ');
            $return = false;
        }

        if (!$this->isRankCorrect()) {
            Log::debug(__METHOD__ . 'this card is not valid: rank is incorrect ');
            $return = false;
        }

        Log::debug(__METHOD__ . ' eof() ');
        return $return;
    }

    /**
     *
     * determine is the suit provided is valid
     *
     * Suit is define of by the first character of the name and can be one of : [S,D,H,C]
     *
     * Loop through the suits, defined by the enum, if we find a match set the card suit and exit the loop
     *
     * @return bool
     */
    public function isSuitCorrect(): bool
    {
        Log::debug(__METHOD__ . ' bof() ');
        $return = false;

        $suits = Suit::cases();
        $cardSuit = substr($this->getName(), 0, 1);

        foreach ($suits as $suit) {
            Log::debug(__METHOD__ . ' card suit: ' . $cardSuit . ' -- suit->value: ' . $suit->value);
            if (strtolower($cardSuit) === strtolower($suit->value)) {
                $this->setSuite($suit);
                $return = true;
                break;
            }
        }

        Log::debug(__METHOD__ . ' eof() ');
        return $return;
    }

    /**
     * determine the rank of the card
     *
     * rank is defined as all the characters after the first one in the name and can be one of the
     * valid ranks as per the enum [K,Q,J,10,9,8,7,6,5,4,3,2,A,JKR]
     *
     * Loop through the available ranks and if the correct one is found, set the card rank and exit the loop
     *
     * @return bool
     */
    public function isRankCorrect(): bool
    {
        Log::debug(__METHOD__ . ' bof() ');
        $return = false;
        $ranks = Ranks::cases();
        $cardRank = substr($this->getName(), 1);
        foreach ($ranks as $rank) {
            if (strtolower($cardRank) === strtolower($rank->value)) {
                $this->setRank($rank);
                $this->setValue(self::integerValues[$rank->value]);
                $return = true;
                break;
            }
        }
        Log::debug(__METHOD__ . ' eof() ');
        return $return;
    }

    /**
     * determine is the name is alphanumeric
     *
     * @return bool
     */
    public function isCharacterAlhpaNumeric(): bool
    {
        Log::debug(__METHOD__ . ' bof() ');
        $return = false;
        if (ctype_alnum($this->name)) {
            $return = true;
        }
        Log::debug(__METHOD__ . ' eof() ');
        return $return;
    }

    /**
     * determine if the length of the name is correct
     *
     * @return bool
     */
    public function isLengthCorrect(): bool
    {
        Log::debug(__METHOD__ . ' bof() ');
        $return = false;
        if ((strlen($this->name) == 3 || (strlen($this->name) == 2))) {
            $return = true;
        }
        Log::debug(__METHOD__ . ' eof() ');
        return $return;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->name;
    }

    /**
     * @return Suit
     */
    public function getSuite(): Suit
    {
        return $this->suite;
    }

    /**
     * @param string $suite
     */
    public function setSuite(Suit $suite): void
    {
        $this->suite = $suite;
    }

    /**
     * @return Ranks
     */
    public function getRank(): Ranks
    {
        return $this->rank;
    }

    /**
     * @param string $rank
     */
    public function setRank(Ranks $rank): void
    {
        $this->rank = $rank;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @param int $value
     */
    public function setValue(int $value): void
    {
        $this->value = $value;
    }
}
