<?php

namespace TexasHoldem\Models\Rankings;

use TexasHoldem\Interfaces\iRanking;

class TwoPair extends BaseRanking implements iRanking
{
    protected const RANK = 300;
    protected const RANK_NAME = "Two pair";

    public function calculateRanking(array $cards): int
    {
        $tmp = array();
        foreach ($cards as $card) {
            array_push($tmp, $card->getDenominationConverted());
        }

        // Check the progression
        sort($tmp);

        $countValues = array_count_values($tmp);

        $pairEncountered = 0;
        $totDenominations = 0;
        foreach ($countValues as $key => $countValue) {
            if (2 == $countValue) {
                $totDenominations = $totDenominations + $key;

                $pairEncountered++;
            }
        }

        if ($pairEncountered != 2) {
            return 0;
        }

        //$this->setHandSpecificScore(Ranking::TWO_PAIR + $totDenominations);

        //$this->setHandScore(Ranking::TWO_PAIR);

        //return Ranking::TWO_PAIR;
        return self::RANK;
    }
}
