<?php

namespace TexasHoldem\Models;

class Card
{
    protected $denomination;
    protected $suit;

    // Numbers conversion
    protected $denominationsConversion = array(
        "2" => 1,
        "3" => 2,
        "4" => 3,
        "5" => 4,
        "6" => 5,
        "7" => 6,
        "8" => 7,
        "9" => 8,
        "10" => 9,
        "J" => 10,
        "Q" => 11,
        "K" => 12,
        "A" => 13,
    );

    protected $suitsConversion = array(
        "♥" => 43,
        "♦" => 47,
        "♣" => 53,
        "♠" => 59,
    );

    /**
     *
     * @return void
     */
    public function __construct(string $item)
    {
        $this->setDenomination(intval($item));

        if (!$this->getDenomination()) {
            $this->setDenomination(substr($item, 0, 1));
        }

        $this->setSuit(str_replace($this->getDenomination(), "", $item));
    }

    /**
     *
     * @return string
     */
    public function getDenomination(): string
    {
        return $this->denomination;
    }

    /**
     *
     * @param string $denomination
     *
     * @return void
     */
    public function setDenomination(string $denomination)
    {
        $this->denomination = $denomination;
    }

    /**
     *
     * @return string
     */
    public function getDenominationConverted(): int
    {
        return $this->denominationsConversion[$this->denomination];
    }

    /**
     *
     * @return string
     */
    public function getSuit(): string
    {
        return $this->suit;
    }

    /**
     *
     * @param string $suit
     *
     * @return void
     */
    public function setSuit(string $suit)
    {
        $this->suit = $suit;
    }

    /**
     *
     * @return int
     */
    public function getSuitConverted(): int
    {
        return $this->suitsConversion[$this->suit];
    }
}
