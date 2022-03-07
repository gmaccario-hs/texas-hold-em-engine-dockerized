<?php

namespace TexasHoldem\Engine;

use TexasHoldem\Models\Card;
use TexasHoldem\Models\Hand;
use TexasHoldem\Engine\Ranking;

class HandsRulesEngine
{
  protected $ranking;
  protected $hands = array();

  /**
   *
   * @return void
   */
  public function __construct(Ranking $ranking)
  {
    $this->ranking = $ranking;
  }

  public function getHands() : array
  {
    return $this->hands;
  }

  /**
   *
   * @return void
   */
  public function setHands(array $hands)
  {
    foreach($hands as $index => $hand)
    {
      $entityHand = new Hand($index);

      // i.e. 10♥ 10♦ 10♠ 9♣ 9♦
      $cards = explode(" ", $hand);
      foreach($cards as $card)
      {
        $entityCard = new Card($card);
        $entityHand->addCard($entityCard);
      }

      array_push($this->hands, $entityHand);
    }
  }

  public function getSortedHands(array $rankings) : array
  {
    return $this->evaluate($rankings);
  }

  protected function evaluate(array $rankings) : array
  {
    $sorted = array();

    foreach($this->hands as $hand)
    {
        $this->ranking->setHand($hand);

        foreach ($rankings as $ranking)
        {
            //$index = $hand->getScore();

            $rank = $ranking->calculateRanking($hand->getCards());

            dump($rank);

            //$this->ranking->setHandSpecificScore($rank + $totDenominations);

            $this->ranking->setHandScore($rank);

            $sorted[$rank][] = $hand;
        }
    }

    return $this->reverseSorted($sorted);
  }

  private function reverseSorted(array $sorted) : array
  {
    ksort($sorted);

    // Sorting Nested Array (same value hands)
    foreach($sorted as $key => $sameHandsUnsorted)
    {
      $sameHandsUnsorted = $this->ranking->compareSameHands($sameHandsUnsorted);

      unset($sorted[$key]);

      $sorted[$key] = $sameHandsUnsorted;
    }

    return array_reverse($sorted, true);
  }
}
