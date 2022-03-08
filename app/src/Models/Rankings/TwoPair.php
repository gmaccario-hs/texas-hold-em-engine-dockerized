<?php

namespace TexasHoldem\Models\Rankings;

use TexasHoldem\Interfaces\iRanking;

class TwoPair extends BaseRanking implements iRanking
{
    protected const RANK = 300;
    protected const RANK_NAME = "Two pair";

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

        $pairEncountered = 0;
        foreach ($countValues as $key => $countValue) {
            if (2 == $countValue) {
                $this->denomination = $this->denomination + $key;

                $pairEncountered++;
            }
        }

        if ($pairEncountered != 2) {
            return 0;
        }

        return self::RANK;
    }
}
