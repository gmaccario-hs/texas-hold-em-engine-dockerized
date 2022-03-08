<?php

namespace TexasHoldem\Models\Rankings;

use TexasHoldem\Interfaces\iRanking;

class FullHouse extends BaseRanking implements iRanking
{
    protected const RANK = 700;
    protected const RANK_NAME = "Full house";

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

        // Check if four cards of the same rank
        sort($tmp);

        $countValues = array_count_values($tmp);

        if (count($countValues) != 2) {
            return 0;
        }

        foreach ($countValues as $key => $occurrence) {
            if ($occurrence != 2 && $occurrence != 3) {
                return 0;
            }

            $this->denomination = $this->denomination + $key;
        }

        return self::RANK;
    }
}
