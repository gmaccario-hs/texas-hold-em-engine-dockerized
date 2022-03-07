<?php

namespace TexasHoldem\Models\Rankings;

use TexasHoldem\Interfaces\iRanking;

class Straight extends BaseRanking implements iRanking
{
    protected const RANK = 500;
    protected const RANK_NAME = "Straight";

    public function calculateRanking(array $cards): int
    {
        $tmp = array();
        $totDenominations = 0;
        foreach($cards as $card)
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

        //$this->setHandSpecificScore(Ranking::STRAIGHT + $totDenominations);

        //$this->setHandScore(Ranking::STRAIGHT);

        //return Ranking::STRAIGHT;
        return self::RANK;
    }
}
