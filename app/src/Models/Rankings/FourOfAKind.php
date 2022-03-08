<?php

namespace TexasHoldem\Models\Rankings;

use TexasHoldem\Interfaces\iRanking;

class FourOfAKind extends BaseRanking implements iRanking
{
    protected const RANK = 800;
    protected const RANK_NAME = "Four of a kind";

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

        if (!in_array(4, $countValues)) {
            return 0;
        }

        // One in each suit
        $denominationPoker = array_search(4, $countValues);

        $tmp = array();
        foreach ($cards as $card) {
            if ($card->getDenominationConverted() != $denominationPoker) {
                continue;
            }

            $this->denomination = $this->denomination + $card->getDenominationConverted();

            array_push($tmp, $card->getSuitConverted());
        }

        $countValues = array_count_values($tmp);

        foreach ($countValues as $value) {
            if ($value > 1) {
                return 0;
            }
        }

        return self::RANK;
    }
}
