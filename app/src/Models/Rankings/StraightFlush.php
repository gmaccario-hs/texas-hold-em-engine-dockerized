<?php

namespace TexasHoldem\Models\Rankings;

use TexasHoldem\Interfaces\iRanking;

class StraightFlush extends BaseRanking implements iRanking
{
    protected const RANK = 900;
    protected const RANK_NAME = "Straight flush";

    public function calculateRanking(array $cards): int
    {
        $lastSuit = 0;
        $totSuits = 0;
        $totDenominations = 0;
        $tmp = array();
        foreach ($cards as $card) {
            if ($card->getDenominationConverted() > 9) {
                return 0;
            }

            $lastSuit = $card->getSuitConverted();
            $totSuits = $totSuits + $card->getSuitConverted();
            $totDenominations = $totDenominations + $card->getDenominationConverted();

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

        //$this->setHandSpecificScore(Ranking::STRAIGHT_FLUSH + $totDenominations);

        //$this->setHandScore(Ranking::STRAIGHT_FLUSH);

        return self::RANK;
    }
}
