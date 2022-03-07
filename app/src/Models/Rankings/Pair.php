<?php

namespace TexasHoldem\Models\Rankings;

use TexasHoldem\Interfaces\iRanking;

class Pair extends BaseRanking implements iRanking
{
    protected const RANK = 200;
    protected const RANK_NAME = "Pair";

    public function calculateRanking(array $cards): int
    {
        $tmp = array();
        foreach($cards as $card)
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

        //$this->setHandSpecificScore(Ranking::PAIR + $totDenominations);

        //$this->setHandScore(Ranking::PAIR);

        //return Ranking::PAIR;
        return self::RANK;
    }
}
