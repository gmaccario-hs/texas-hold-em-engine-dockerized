<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use TexasHoldem\Engine\Ranking;
use TexasHoldem\Entity\Card;
use TexasHoldem\Entity\Hand;

final class RankingTest extends TestCase
{
    public function testClassExists() : void
    {
        $class = new Ranking();

        $this->assertInstanceOf(Ranking::class, $class, "Ranking is not a Ranking Class");
    }

    public function testIsRoyalFlush() : void
    {
        $hand = "10♥ J♥ Q♥ K♥ A♥";

        $ranking = new Ranking();

        $entityHand = new Hand(1);

        $cards = explode(" ", $hand);

        foreach($cards as $card)
        {
          $entityCard = new Card($card);
          $entityHand->addCard($entityCard);

          $ranking->setHand($entityHand);
        }

        $output = $ranking->isRoyalFlush();

        $this->assertEquals(1000, $output);
    }

    public function testIsNotRoyalFlush() : void
    {
        $hand = "4♣ 4♠ 3♣ 3♦ Q♣";

        $ranking = new Ranking();

        $entityHand = new Hand(1);

        $cards = explode(" ", $hand);

        foreach($cards as $card)
        {
          $entityCard = new Card($card);
          $entityHand->addCard($entityCard);

          $ranking->setHand($entityHand);
        }

        $output = $ranking->isRoyalFlush();

        $this->assertNotEquals(1000, $output);
    }

    public function testIsStraightFlush() : void
    {
        $hand = "3♥ 4♥ 5♥ 6♥ 7♥";

        $ranking = new Ranking();

        $entityHand = new Hand(1);

        $cards = explode(" ", $hand);

        foreach($cards as $card)
        {
          $entityCard = new Card($card);
          $entityHand->addCard($entityCard);

          $ranking->setHand($entityHand);
        }

        $output = $ranking->isStraightFlush();

        $this->assertEquals(900, $output);
    }

    public function testIsNotStraightFlush() : void
    {
        $hand = "2♥ 4♥ 5♥ 6♥ 7♥";

        $ranking = new Ranking();

        $entityHand = new Hand(1);

        $cards = explode(" ", $hand);

        foreach($cards as $card)
        {
          $entityCard = new Card($card);
          $entityHand->addCard($entityCard);

          $ranking->setHand($entityHand);
        }

        $output = $ranking->isStraightFlush();

        $this->assertNotEquals(900, $output);
    }

    public function testIsFourOfAKind() : void
    {
      $hand = "6♥ 7♦ 6♦ 6♠ 6♣";

      $ranking = new Ranking();

      $entityHand = new Hand(1);

      $cards = explode(" ", $hand);

      foreach($cards as $card)
      {
        $entityCard = new Card($card);
        $entityHand->addCard($entityCard);

        $ranking->setHand($entityHand);
      }

      $output = $ranking->isFourOfAKind();

      $this->assertEquals(800, $output);
    }

    public function testIsNotFourOfAKind() : void
    {
      $hand = "2♥ 4♥ 5♥ 6♥ 7♥";

      $ranking = new Ranking();

      $entityHand = new Hand(1);

      $cards = explode(" ", $hand);

      foreach($cards as $card)
      {
        $entityCard = new Card($card);
        $entityHand->addCard($entityCard);

        $ranking->setHand($entityHand);
      }

      $output = $ranking->isFourOfAKind();

      $this->assertNotEquals(800, $output);
    }

    public function testIsFullHouse() : void
    {
      $hand = "7♣ 7♦ 7♠ K♣ K♦"; // 2♥ 4♥ 5♥ 6♥ 7♥

      $ranking = new Ranking();

      $entityHand = new Hand(1);

      $cards = explode(" ", $hand);

      foreach($cards as $card)
      {
        $entityCard = new Card($card);
        $entityHand->addCard($entityCard);

        $ranking->setHand($entityHand);
      }

      $output = $ranking->isFullHouse();

      $this->assertEquals(700, $output);
    }

    public function testIsFlush() : void
    {
      $hand = "8♣ 7♣ 6♣ 5♣ 4♣"; // 3♦ J♣ 8♠ 4♥ 2♠

      $ranking = new Ranking();

      $entityHand = new Hand(1);

      $cards = explode(" ", $hand);

      foreach($cards as $card)
      {
        $entityCard = new Card($card);
        $entityHand->addCard($entityCard);

        $ranking->setHand($entityHand);
      }

      $output = $ranking->isFlush();

      $this->assertEquals(600, $output);
    }

    public function testIsStraight()
    {
      $hand = "3♦ 4♥ 5♠ 6♣ 7♥"; // 3♦ J♣ 8♠ 4♥ 2♠

      $ranking = new Ranking();

      $entityHand = new Hand(1);

      $cards = explode(" ", $hand);

      foreach($cards as $card)
      {
        $entityCard = new Card($card);
        $entityHand->addCard($entityCard);

        $ranking->setHand($entityHand);
      }

      $output = $ranking->isStraight();

      $this->assertEquals(500, $output);
    }

    public function testIsThreeOfAKind()
    {
      $hand = "7♣ 7♦ 7♠ K♣ 3♦"; // 3♦ J♣ 8♠ 4♥ 2♠

      $ranking = new Ranking();

      $entityHand = new Hand(1);

      $cards = explode(" ", $hand);

      foreach($cards as $card)
      {
        $entityCard = new Card($card);
        $entityHand->addCard($entityCard);

        $ranking->setHand($entityHand);
      }

      $output = $ranking->isThreeOfAKind();

      $this->assertEquals(400, $output);
    }

    public function testIsTwoPair()
    {
      $hand = "7♣ J♦ 6♠ 6♣ 7♦"; // 3♦ J♣ 8♠ 4♥ 2♠

      $ranking = new Ranking();

      $entityHand = new Hand(1);

      $cards = explode(" ", $hand);

      foreach($cards as $card)
      {
        $entityCard = new Card($card);
        $entityHand->addCard($entityCard);

        $ranking->setHand($entityHand);
      }

      $output = $ranking->isTwoPair();

      $this->assertEquals(300, $output);
    }

    public function testIsPair()
    {
      $hand = "7♣ J♦ 5♠ K♣ 7♦"; // 3♦ J♣ 8♠ 4♥ 2♠

      $ranking = new Ranking();

      $entityHand = new Hand(1);

      $cards = explode(" ", $hand);

      foreach($cards as $card)
      {
        $entityCard = new Card($card);
        $entityHand->addCard($entityCard);

        $ranking->setHand($entityHand);
      }

      $output = $ranking->isPair();

      $this->assertEquals(200, $output);
    }

    public function testIsHighCard()
    {
      $hand = "4♣ J♠ 8♣ 2♥ 9♠"; // 3♦ J♣ 8♠ 4♥ 2♠

      $ranking = new Ranking();

      $entityHand = new Hand(1);

      $cards = explode(" ", $hand);

      foreach($cards as $card)
      {
        $entityCard = new Card($card);
        $entityHand->addCard($entityCard);

        $ranking->setHand($entityHand);
      }

      $output = $ranking->isHighCard();

      $this->assertEquals(100, $output);
    }
}
