<?php

namespace TexasHoldem\Models\Rankings;

use TexasHoldem\Interfaces\iRanking;

class RoyalFlush extends BaseRanking implements iRanking
{
    protected const RANK = 1000;
    protected const RANK_NAME = "Royal flush";

    public function getRankName(): string
    {
        return self::RANK_NAME;
    }

    public function getDenominations(): int
    {
        return self::RANK + $this->denomination;
    }

    public function calculateRanking(array $cards): int
    {
        $lastSuit = 0;
        $totSuits = 0;
        foreach ($cards as $card) {
            if ($card->getDenominationConverted() < 9) {
                return 0;
            }

            $lastSuit = $card->getSuitConverted();
            $totSuits = $totSuits + $card->getSuitConverted();
            $this->denomination = $this->denomination + $card->getDenominationConverted();
        }

        // Check same suits
        if (!$this->isSameSuits($totSuits, $lastSuit)) {
            return 0;
        }

        //$this->setHandSpecificScore(Ranking::ROYAL_FLUSH + $totDenominations);

        //$this->setHandScore(Ranking::ROYAL_FLUSH);

        return self::RANK;
    }
}
