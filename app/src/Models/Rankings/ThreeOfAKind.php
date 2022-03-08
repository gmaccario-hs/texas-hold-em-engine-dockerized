<?php

namespace TexasHoldem\Models\Rankings;

use TexasHoldem\Interfaces\iRanking;

class ThreeOfAKind extends BaseRanking implements iRanking
{
    protected const RANK = 400;
    protected const RANK_NAME = "Three of a kind";

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
        $tmp = array();
        foreach ($cards as $card) {
            array_push($tmp, $card->getDenominationConverted());
        }

        // Check the progression
        sort($tmp);

        $countValues = array_count_values($tmp);

        if (!in_array(3, $countValues)) {
            return 0;
        }

        foreach ($countValues as $key => $countValue) {
            if (3 == $countValue) {
                $this->denomination = $this->denomination + $key;
            }
        }

        return self::RANK;
    }
}
