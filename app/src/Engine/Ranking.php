<?php

namespace TexasHoldem\Engine;

use ReflectionClass;
use TexasHoldem\Models\Hand;

class Ranking
{
    protected $hand;
    protected $cards;

    /*private const ROYAL_FLUSH = 1000;
    private const STRAIGHT_FLUSH = 900;
    private const FOUR_OF_A_KIND = 800;
    private const FULL_HOUSE = 700;
    private const FLUSH = 600;
    private const STRAIGHT = 500;
    private const THREE_OF_A_KIND = 400;
    private const TWO_PAIR = 300;
    private const PAIR = 200;
    private const HIGH_CARD = 100;
    private const EMPTY = 0;*/

    /**
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     *
     * @return void
     */
    public function setHand(Hand $hand)
    {
        $this->hand = $hand;
    }

    /**
     *
     * @return array
     */
    public function getCards(): array
    {
        return $this->hand->getCards();
    }

    /**
     *
     * @param int $score
     *
     * @return void
     */
    public function setHandScore(int $score)
    {
        $this->hand->setScore($score);

        $this->setHandScoreName($score);
    }

    /**
     *
     * @param int $score
     *
     * @return void
     */
    public function setHandScoreName(int $score)
    {
        $class = new ReflectionClass(__CLASS__);
        $constants = array_flip($class->getConstants());

        $friendlyScore = ucwords(strtolower(str_replace("_", " ", $constants[$score])));

        $this->hand->setScoreName($friendlyScore);
    }

    /**
     *
     * @param int $specificScore
     *
     * @return void
     */
    public function setHandSpecificScore(int $specificScore)
    {
        $this->hand->setSpecificScore($specificScore);
    }

    /**
     *
     * @param array $unsorted
     *
     * @return void
     */
    public function compareSameHands(array $unsorted)
    {
        usort($unsorted, function ($handA, $handB) {
            return $handB->getSpecificScore() - $handA->getSpecificScore();
        });

        return $unsorted;
    }

    /**
     *
     * @param array $array
     *
     * @return bool
     */
    /*
    private function isProgression(array $array) : bool
    {
      $count = count($array) - 1;

      $target = $array[0];
      for ($i = 1; $i < $count; $i++)
      {
          if($array[$i] - $target !== 1)
          {
            return 0;
          }

          $target = $array[$i];
      }

      return true;
    }*/

    /**
     *
     * @param int $totSuits
     * @param int $lastSuit
     *
     * @return bool
     */
    /*
    private function isSameSuits(int $totSuits, int $lastSuit) : bool
    {
      if(($totSuits / 5) != $lastSuit)
      {
        return false;
      }

      return true;
    }*/

    /**
     * Check if the denomination is > 10
     * All cards have same suits
     *
     * @return int
     */
    /*public function isRoyalFlush() : int
    {
      $lastSuit = 0;
      $totSuits = 0;
      $totDenominations = 0;
      foreach($this->getCards() as $card)
      {
        if($card->getDenominationConverted() < 9)
        {
          return 0;
        }

        $lastSuit = $card->getSuitConverted();
        $totSuits = $totSuits + $card->getSuitConverted();
        $totDenominations = $totDenominations + $card->getDenominationConverted();
      }

      // Check same suits
      if(!$this->isSameSuits($totSuits, $lastSuit))
      {
        return 0;
      }

      $this->setHandSpecificScore(Ranking::ROYAL_FLUSH + $totDenominations);

      $this->setHandScore(Ranking::ROYAL_FLUSH);

      return Ranking::ROYAL_FLUSH;
    }*/

    /**
     * Check if cards are in sequence and < 10
     * All cards have same suits
     *
     * @return int
     */
    /*public function isStraightFlush() : int
    {
      $lastSuit = 0;
      $totSuits = 0;
      $totDenominations = 0;
      $tmp = array();
      foreach($this->getCards() as $card)
      {
        if($card->getDenominationConverted() > 9)
        {
          return 0;
        }

        $lastSuit = $card->getSuitConverted();
        $totSuits = $totSuits + $card->getSuitConverted();
        $totDenominations = $totDenominations + $card->getDenominationConverted();

        array_push($tmp, $card->getDenominationConverted());
      }

      // Check the progression
      sort($tmp);

      if(!$this->isProgression($tmp))
      {
        return 0;
      }

      // Check same suits
      if(!$this->isSameSuits($totSuits, $lastSuit))
      {
        return 0;
      }

      $this->setHandSpecificScore(Ranking::STRAIGHT_FLUSH + $totDenominations);

      $this->setHandScore(Ranking::STRAIGHT_FLUSH);

      return Ranking::STRAIGHT_FLUSH;
    }*/

    /**
     *
     * @return int
     */
    /*public function isFourOfAKind() : int
    {
      $tmp = array();
      foreach($this->getCards() as $card)
      {
        array_push($tmp, $card->getDenominationConverted());
      }

      // Check if four cards of the same rank
      sort($tmp);

      $countValues = array_count_values($tmp);

      if(!in_array(4, $countValues))
      {
        return 0;
      }

      // One in each suit
      $denominationPoker = array_search(4, $countValues);

      $tmp = array();
      $totDenominations = 0;
      foreach($this->getCards() as $card)
      {
        if($card->getDenominationConverted() != $denominationPoker)
        {
            continue;
        }

        $totDenominations = $totDenominations + $card->getDenominationConverted();

        array_push($tmp, $card->getSuitConverted());
      }

      $countValues = array_count_values($tmp);

      foreach($countValues as $value)
      {
        if($value > 1)
        {
          return 0;
        }
      }

      $this->setHandSpecificScore(Ranking::FOUR_OF_A_KIND + $totDenominations);

      $this->setHandScore(Ranking::FOUR_OF_A_KIND);

      return Ranking::FOUR_OF_A_KIND;
    }*/

    /**
     *
     * @return int
     */
    /*public function isFullHouse() : int
    {
      $tmp = array();
      foreach($this->getCards() as $card)
      {
        array_push($tmp, $card->getDenominationConverted());
      }

      // Check if four cards of the same rank
      sort($tmp);

      $countValues = array_count_values($tmp);

      if(count($countValues) != 2)
      {
        return 0;
      }

      $totDenominations = 0;
      foreach($countValues as $key => $occurrence)
      {
        if($occurrence != 2 && $occurrence != 3)
        {
          return 0;
        }

         $totDenominations = $totDenominations + $key;
      }

      $this->setHandSpecificScore(Ranking::FULL_HOUSE + $totDenominations);

      $this->setHandScore(Ranking::FULL_HOUSE);

      return Ranking::FULL_HOUSE;
    }*/

    /**
     *
     * @return int
     */
    /*public function isFlush() : int
    {
      $tmp = array();
      $totDenominations = 0;
      foreach($this->getCards() as $card)
      {
          $totDenominations = $totDenominations + $card->getDenominationConverted();

          array_push($tmp, $card->getSuitConverted());
      }

      $countValues = array_count_values($tmp);

      if(count($countValues) > 1)
      {
        return 0;
      }

      $this->setHandSpecificScore(Ranking::FLUSH + $totDenominations);

      $this->setHandScore(Ranking::FLUSH);

      return Ranking::FLUSH;
    }*/

    /**
     *
     * @return int
     */
    /*public function isStraight() : int
    {
      $tmp = array();
      $totDenominations = 0;
      foreach($this->getCards() as $card)
      {
          $totDenominations = $totDenominations + $card->getDenominationConverted();

          array_push($tmp, $card->getDenominationConverted());
      }

      // Check the progression
      sort($tmp);

      if(!$this->isProgression($tmp))
      {
        return 0;
      }

      $this->setHandSpecificScore(Ranking::STRAIGHT + $totDenominations);

      $this->setHandScore(Ranking::STRAIGHT);

      return Ranking::STRAIGHT;
    }*/

    /**
     *
     * @return int
     */
    /*public function isThreeOfAKind() : int
    {
      $tmp = array();
      foreach($this->getCards() as $card)
      {
          array_push($tmp, $card->getDenominationConverted());
      }

      // Check the progression
      sort($tmp);

      $countValues = array_count_values($tmp);

      if(!in_array(3, $countValues))
      {
        return 0;
      }

      $totDenominations = 0;
      foreach($countValues as $key => $countValue)
      {
          if(3 == $countValue)
          {
              $totDenominations = $totDenominations + $key;
          }
      }

      $this->setHandSpecificScore(Ranking::THREE_OF_A_KIND + $totDenominations);

      $this->setHandScore(Ranking::THREE_OF_A_KIND);

      return Ranking::THREE_OF_A_KIND;
    }*/

    /**
     *
     * @return int
     */
    /*public function isTwoPair() : int
    {
      $tmp = array();
      foreach($this->getCards() as $card)
      {
          array_push($tmp, $card->getDenominationConverted());
      }

      // Check the progression
      sort($tmp);

      $countValues = array_count_values($tmp);

      $pairEncountered = 0;
      $totDenominations = 0;
      foreach($countValues as $key => $countValue)
      {
          if(2 == $countValue)
          {
              $totDenominations = $totDenominations + $key;

              $pairEncountered++;
          }
      }

      if($pairEncountered != 2)
      {
        return 0;
      }

      $this->setHandSpecificScore(Ranking::TWO_PAIR + $totDenominations);

      $this->setHandScore(Ranking::TWO_PAIR);

      return Ranking::TWO_PAIR;
    }*/

    /**
     *
     * @return int
     */
    /*public function isPair() : int
    {
      $tmp = array();
      foreach($this->getCards() as $card)
      {
          array_push($tmp, $card->getDenominationConverted());
      }

      // Check the progression
      sort($tmp);

      $countValues = array_count_values($tmp);

      $pairEncountered = 0;
      $totDenominations = 0;
      foreach($countValues as $key => $countValue)
      {
          if(2 == $countValue)
          {
              $totDenominations = $totDenominations + $key;

              $pairEncountered++;
          }
      }

      if($pairEncountered != 1)
      {
        return 0;
      }

      $this->setHandSpecificScore(Ranking::PAIR + $totDenominations);

      $this->setHandScore(Ranking::PAIR);

      return Ranking::PAIR;
    }*/

    /**
     *
     * @return int
     */
    /*public function isHighCard() : int
    {
        $tmp = array();
        foreach($this->getCards() as $card)
        {
            array_push($tmp, $card->getDenominationConverted());
        }

        sort($tmp);

        $this->setHandSpecificScore(Ranking::HIGH_CARD + array_reverse($tmp)[0]);

        $this->setHandScore(Ranking::HIGH_CARD);

        return Ranking::HIGH_CARD;
    }*/
}
