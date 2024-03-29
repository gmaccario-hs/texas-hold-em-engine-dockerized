<?php

namespace TexasHoldem\Engine;

use TexasHoldem\Models\Card;
use TexasHoldem\Models\Hand;

class HandsEngine
{
    protected $hands = array();

    public function getHands(): array
    {
        return $this->hands;
    }

    /**
     *
     * @return void
     */
    public function setHands(array $hands)
    {
        foreach ($hands as $index => $hand) {
            $entityHand = new Hand();

            $entityHand->setOriginalIndex($index);

            // i.e. 10♥ 10♦ 10♠ 9♣ 9♦
            $cards = explode(" ", $hand);
            foreach ($cards as $card) {
                $entityCard = new Card($card);
                $entityHand->addCard($entityCard);
            }

            array_push($this->hands, $entityHand);
        }
    }

    public function getSortedHands(array $rankings): array
    {
        return $this->evaluateHands($rankings);
    }

    private function evaluateHands(array $rankings): array
    {
        $sorted = array();

        foreach ($this->hands as $hand) {
            foreach ($rankings as $ranking) {

                $score = $ranking->calculateRanking($hand->getCards());

                if ($score) {
                    $hand->setSpecificScore($ranking->getDenominations());
                    $hand->setScore($score);
                    $hand->setScoreName($ranking->getRankName());

                    $sorted[$score][] = $hand;
                    break;
                }
            }
        }

        return $this->reverseSorted($sorted);
    }

    private function reverseSorted(array $sorted): array
    {
        ksort($sorted);

        // Sorting Nested Array (same value hands)
        foreach ($sorted as $key => $sameHandsUnsorted) {
            $sameHandsUnsorted = $this->compareSameHands($sameHandsUnsorted);

            unset($sorted[$key]);

            $sorted[$key] = $sameHandsUnsorted;
        }

        return array_reverse($sorted, true);
    }

    /**
     *
     * @return void
     */
    private function compareSameHands(array $unsorted)
    {
        usort($unsorted, function ($handA, $handB) {
            return $handB->getSpecificScore() - $handA->getSpecificScore();
        });

        return $unsorted;
    }
}
