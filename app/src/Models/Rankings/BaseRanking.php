<?php

namespace TexasHoldem\Models\Rankings;

class BaseRanking
{
    protected const RANK = 0;
    protected const RANK_NAME = "";

    protected function isProgression(array $array): bool
    {
        $count = count($array) - 1;

        $target = $array[0];
        for ($i = 1; $i < $count; $i++) {
            if ($array[$i] - $target !== 1) {
                return 0;
            }

            $target = $array[$i];
        }

        return true;
    }

    protected function isSameSuits(int $totSuits, int $lastSuit): bool
    {
        if (($totSuits / 5) != $lastSuit) {
            return false;
        }

        return true;
    }
}
