<?php

namespace TexasHoldem\Models\Rankings;

use TexasHoldem\Interfaces\iRanking;

class Straight extends BaseRanking implements iRanking
{
    protected const RANK = 500;
    protected const RANK_NAME = "Straight";

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

            array_push($tmp, $card->getDenominationConverted());
        }

        // Check the progression
        sort($tmp);

        if (!$this->isProgression($tmp)) {
            return 0;
        }

        return self::RANK;
    }
}
