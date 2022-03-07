<?php

namespace TexasHoldem\Models\Rankings;

use TexasHoldem\Interfaces\iRanking;

class HighCard extends BaseRanking implements iRanking
{
    protected const RANK = 100;
    protected const RANK_NAME = "High card";

    public function calculateRanking(array $cards): int
    {
        $tmp = array();
        foreach($cards as $card)
        {
            array_push($tmp, $card->getDenominationConverted());
        }

        sort($tmp);

        //$this->setHandSpecificScore(Ranking::HIGH_CARD + array_reverse($tmp)[0]);

        //$this->setHandScore(Ranking::HIGH_CARD);

        //return Ranking::HIGH_CARD;
        return self::RANK;
    }
}
