<?php

namespace TexasHoldem\Entity;

use TexasHoldem\Entity\Card;

class Hand
{
  protected $index = 0;
  protected $score = 0;
  protected $scoreName = "";
  protected $specificScore = 0;
  protected $cards = array();

  /**
   *
   * @param int $index
   *
   * @return void
   */
  public function __construct(int $index)
  {
    $this->index = $index;
  }

  /**
   *
   * @return int
   */
  public function getIndex() : int
  {
    return $this->index;
  }

  /**
   *
   * @return array
   */
  public function getCards() : array
  {
    return $this->cards;
  }

  /**
   *
   * @param array $cards
   *
   * @return void
   */
  public function setCards(array $cards)
  {
    return $this->cards = $cards;
  }

  /**
   *
   * @param Card $card
   *
   * @return void
   */
  public function addCard(Card $card)
  {
    array_push($this->cards, $card);
  }

  /**
   *
   * @return int
   */
  public function getScore() : int
  {
    return $this->score;
  }

  /**
   *
   * @param int $score
   *
   * @return void
   */
  public function setScore(int $score)
  {
    return $this->score = $score;
  }

  /**
   *
   * @return string
   */
  public function getScoreName() : string
  {
    return $this->scoreName;
  }

  /**
   *
   * @param string $scoreName
   *
   * @return void
   */
  public function setScoreName(string $scoreName)
  {
    return $this->scoreName = $scoreName;
  }

  /**
   *
   * @return int
   */
  public function getSpecificScore() : int
  {
    return $this->specificScore;
  }

  /**
   *
   * @param int $specificScore
   *
   * @return void
   */
  public function setSpecificScore(int $specificScore)
  {
    return $this->specificScore = $specificScore;
  }
}
