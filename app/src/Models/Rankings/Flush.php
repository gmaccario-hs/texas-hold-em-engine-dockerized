<?php

namespace TexasHoldem\Models\Rankings;

use TexasHoldem\Interfaces\iRanking;

class Flush extends BaseRanking implements iRanking
{
    protected const RANK = 600;
    protected const RANK_NAME = "Flush";

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
            $this->denomination = $this->denomination + $card->getDenominationConverted();

            array_push($tmp, $card->getSuitConverted());
        }

        $countValues = array_count_values($tmp);

        if (count($countValues) > 1) {
            return 0;
        }

        return self::RANK;
    }
}
