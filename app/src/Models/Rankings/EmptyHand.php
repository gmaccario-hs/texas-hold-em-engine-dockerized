<?php

namespace TexasHoldem\Models\Rankings;

use TexasHoldem\Interfaces\iRanking;

class EmptyHand extends BaseRanking implements iRanking
{
    protected const RANK = 0;
    protected const RANK_NAME = "Empty hand";

    public function calculateRanking(array $cards): int
    {
        return self::RANK;
    }
}
