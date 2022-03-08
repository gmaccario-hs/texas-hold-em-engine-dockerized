<?php

namespace TexasHoldem\Models;

use TexasHoldem\Interfaces\iHand;

class Hand implements iHand
{
    protected $originalIndex = 0;
    protected $score = 0;
    protected $scoreName = "";
    protected $specificScore = 0;
    protected $cards = array();

    public function getOriginalIndex(): int
    {
        return $this->originalIndex;
    }

    /**
     *
     * @return void
     */
    public function setOriginalIndex(int $originalIndex)
    {
        $this->originalIndex = $originalIndex;
    }

    public function getCards(): array
    {
        return $this->cards;
    }

    /**
     *
     * @return void
     */
    public function setCards(array $cards)
    {
        return $this->cards = $cards;
    }

    public function addCard(Card $card)
    {
        array_push($this->cards, $card);
    }

    public function getScore(): int
    {
        return $this->score;
    }

    /**
     *
     * @return void
     */
    public function setScore(int $score)
    {
        return $this->score = $score;
    }

    public function getScoreName(): string
    {
        return $this->scoreName;
    }

    /**
     *
     * @return void
     */
    public function setScoreName(string $scoreName)
    {
        return $this->scoreName = $scoreName;
    }

    public function getSpecificScore(): int
    {
        return $this->specificScore;
    }

    /**
     *
     * @return void
     */
    public function setSpecificScore(int $specificScore)
    {
        return $this->specificScore = $specificScore;
    }
}
