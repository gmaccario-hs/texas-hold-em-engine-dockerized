<?php

namespace TexasHoldem\Models\Rankings;

use TexasHoldem\Interfaces\iRanking;

class StraightFlush extends BaseRanking implements iRanking
{
    protected const RANK = 900;
    protected const RANK_NAME = "Straight flush";

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
        $tmp = array();
        foreach ($cards as $card) {
            if ($card->getDenominationConverted() > 9) {
                return 0;
            }

            $lastSuit = $card->getSuitConverted();
            $totSuits = $totSuits + $card->getSuitConverted();
            $this->denomination = $this->denomination + $card->getDenominationConverted();

            array_push($tmp, $card->getDenominationConverted());
        }

        // Check the progression
        sort($tmp);

        if (!$this->isProgression($tmp)) {
            return 0;
        }

        // Check same suits
        if (!$this->isSameSuits($totSuits, $lastSuit)) {
            return 0;
        }

        return self::RANK;
    }
}
