<?php

namespace TexasHoldem\Models;

use TexasHoldem\Models\Card;
use TexasHoldem\Interfaces\iHand;

class Hand implements iHand
{
  protected $rank = 0;
  protected $score = 0;
  protected $scoreName = "";
  protected $specificScore = 0;
  protected $cards = array();

  /**
   *
   * @param int $rank
   *
   * @return void
   */
  public function __construct(int $rank)
  {
    $this->rank = $rank;
  }

  public function getRank(): int
  {
    return $this->rank;
  }

  public function getCards(): array
  {
    return $this->cards;
  }

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

  public function setScore(int $score)
  {
    return $this->score = $score;
  }

  public function getScoreName(): string
  {
    return $this->scoreName;
  }

  public function setScoreName(string $scoreName)
  {
    return $this->scoreName = $scoreName;
  }

  public function getSpecificScore(): int
  {
    return $this->specificScore;
  }

  public function setSpecificScore(int $specificScore)
  {
    return $this->specificScore = $specificScore;
  }
}
