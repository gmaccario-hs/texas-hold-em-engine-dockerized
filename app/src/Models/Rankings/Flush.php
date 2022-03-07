<?php

namespace TexasHoldem\Models\Rankings;

use TexasHoldem\Interfaces\iRanking;

class Flush extends BaseRanking implements iRanking
{
    protected const RANK = 600;
    protected const RANK_NAME = "Flush";

    public function calculateRanking(array $cards): int
    {
        $tmp = array();
        $totDenominations = 0;
        foreach($cards as $card)
        {
            $totDenominations = $totDenominations + $card->getDenominationConverted();

            array_push($tmp, $card->getSuitConverted());
        }

        $countValues = array_count_values($tmp);

        if(count($countValues) > 1)
        {
            return 0;
        }

        //$this->setHandSpecificScore(Ranking::FLUSH + $totDenominations);

        //$this->setHandScore(Ranking::FLUSH);

        //return Ranking::FLUSH;
        return self::RANK;
    }
}
